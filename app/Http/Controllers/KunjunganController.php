<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class KunjunganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kunjungan = Kunjungan::orderBy('created_at', 'desc')->get();
        return view('kunjungan.index', compact('kunjungan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kunjungan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tamu' => 'required|string|min:2',
            'nomor_telepon' => 'required|string|min:10',
            'tujuan_kunjungan' => 'required|string|min:5',
            'bertemu_dengan' => 'required|string|min:2',
            'foto_tamu' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $fotoPath = null;
        if ($request->has('foto_tamu') && $request->foto_tamu != '') {
            // Handle base64 image
            $image_parts = explode(";base64,", $request->foto_tamu);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'foto_tamu_' . time() . '.' . $image_type;
            $fotoPath = 'uploads/foto_tamu/' . $fileName;

            // Store the image
            Storage::disk('public')->put($fotoPath, $image_base64);
        }

        $kunjungan = new Kunjungan();
        $kunjungan->nama_tamu = $request->nama_tamu;
        $kunjungan->instansi = $request->instansi;
        $kunjungan->nomor_telepon = $request->nomor_telepon;
        $kunjungan->email = $request->email;
        $kunjungan->tujuan_kunjungan = $request->tujuan_kunjungan;
        $kunjungan->bertemu_dengan = $request->bertemu_dengan;
        $kunjungan->foto_tamu = $fotoPath;
        $kunjungan->waktu_masuk = Carbon::now();
        $kunjungan->save();

        return redirect()->route('kunjungan.success')->with('success', 'Data kunjungan berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kunjungan $kunjungan)
    {
        return view('kunjungan.show', compact('kunjungan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kunjungan $kunjungan)
    {
        return view('kunjungan.edit', compact('kunjungan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kunjungan $kunjungan)
    {
        $validator = Validator::make($request->all(), [
            'nama_tamu' => 'required|string|min:2',
            'nomor_telepon' => 'required|string|min:10',
            'tujuan_kunjungan' => 'required|string|min:5',
            'bertemu_dengan' => 'required|string|min:2',
            'foto_tamu' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->has('foto_tamu') && $request->foto_tamu != '' && strpos($request->foto_tamu, 'base64') !== false) {
            // Delete old photo if exists
            if ($kunjungan->foto_tamu) {
                Storage::disk('public')->delete($kunjungan->foto_tamu);
            }

            // Handle base64 image
            $image_parts = explode(";base64,", $request->foto_tamu);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $fileName = 'foto_tamu_' . time() . '.' . $image_type;
            $fotoPath = 'uploads/foto_tamu/' . $fileName;

            // Store the image
            Storage::disk('public')->put($fotoPath, $image_base64);

            $kunjungan->foto_tamu = $fotoPath;
        }

        $kunjungan->nama_tamu = $request->nama_tamu;
        $kunjungan->instansi = $request->instansi;
        $kunjungan->nomor_telepon = $request->nomor_telepon;
        $kunjungan->email = $request->email;
        $kunjungan->tujuan_kunjungan = $request->tujuan_kunjungan;
        $kunjungan->bertemu_dengan = $request->bertemu_dengan;
        $kunjungan->save();

        return redirect()->route('dashboard.kunjungan')->with('success', 'Data kunjungan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kunjungan $kunjungan)
    {
        // Delete photo if exists
        if ($kunjungan->foto_tamu) {
            Storage::disk('public')->delete($kunjungan->foto_tamu);
        }

        $kunjungan->delete();

        return redirect()->route('dashboard.kunjungan')->with('success', 'Data kunjungan berhasil dihapus!');
    }

    /**
     * Show success page after creating a new kunjungan.
     */
    public function success()
    {
        return view('kunjungan.success');
    }

    /**
     * Record waktu_keluar for a kunjungan.
     */
    public function recordKeluar(Kunjungan $kunjungan)
    {
        $kunjungan->waktu_keluar = Carbon::now();
        $kunjungan->save();

        return redirect()->back()->with('success', 'Waktu keluar berhasil dicatat!');
    }
}
