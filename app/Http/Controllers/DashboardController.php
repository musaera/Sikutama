<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kunjungan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the dashboard.
     */
    public function index()
    {
        // Get statistics
        $today = Carbon::today();
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        $stats = [
            'today' => Kunjungan::whereDate('waktu_masuk', $today)->count(),
            'week' => Kunjungan::whereBetween('waktu_masuk', [$startOfWeek, Carbon::now()])->count(),
            'month' => Kunjungan::whereBetween('waktu_masuk', [$startOfMonth, Carbon::now()])->count(),
            'total' => Kunjungan::count(),
            'since' => Kunjungan::min('created_at') ?? Carbon::now(),
        ];

        // Get recent kunjungan
        $kunjungan = Kunjungan::orderBy('created_at', 'desc')->take(10)->get();

        return view('dashboard.index', compact('stats', 'kunjungan'));
    }

    /**
     * Show all kunjungan.
     */
    public function kunjungan(Request $request)
    {
        $query = Kunjungan::query();

        // Filter by search term
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_tamu', 'like', "%{$search}%")
                    ->orWhere('instansi', 'like', "%{$search}%")
                    ->orWhere('tujuan_kunjungan', 'like', "%{$search}%")
                    ->orWhere('bertemu_dengan', 'like', "%{$search}%");
            });
        }

        // Filter by date range
        if ($request->has('filter')) {
            $filter = $request->filter;

            if ($filter == 'today') {
                $query->whereDate('waktu_masuk', Carbon::today());
            } elseif ($filter == 'week') {
                $query->whereBetween('waktu_masuk', [Carbon::now()->startOfWeek(), Carbon::now()]);
            } elseif ($filter == 'month') {
                $query->whereBetween('waktu_masuk', [Carbon::now()->startOfMonth(), Carbon::now()]);
            }
        }

        $kunjungan = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('dashboard.kunjungan', compact('kunjungan'));
    }

    /**
     * Export kunjungan data.
     */
    public function export(Request $request)
    {
        $format = $request->format ?? 'csv';
        $query = Kunjungan::query();

        // Apply filters if any
        if ($request->has('filter')) {
            $filter = $request->filter;

            if ($filter == 'today') {
                $query->whereDate('waktu_masuk', Carbon::today());
            } elseif ($filter == 'week') {
                $query->whereBetween('waktu_masuk', [Carbon::now()->startOfWeek(), Carbon::now()]);
            } elseif ($filter == 'month') {
                $query->whereBetween('waktu_masuk', [Carbon::now()->startOfMonth(), Carbon::now()]);
            }
        }

        $kunjungan = $query->orderBy('created_at', 'desc')->get();

        if ($format == 'json') {
            return response()->json($kunjungan);
        } else {
            // Generate CSV
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="kunjungan_export_' . date('Y-m-d') . '.csv"',
            ];

            $callback = function () use ($kunjungan) {
                $file = fopen('php://output', 'w');

                // Add CSV header
                fputcsv($file, [
                    'ID',
                    'Nama Tamu',
                    'Instansi',
                    'Nomor Telepon',
                    'Email',
                    'Tujuan Kunjungan',
                    'Bertemu Dengan',
                    'Waktu Masuk',
                    'Waktu Keluar',
                    'Created At',
                    'Updated At'
                ]);

                // Add data rows
                foreach ($kunjungan as $k) {
                    fputcsv($file, [
                        $k->id,
                        $k->nama_tamu,
                        $k->instansi,
                        $k->nomor_telepon,
                        $k->email,
                        $k->tujuan_kunjungan,
                        $k->bertemu_dengan,
                        $k->waktu_masuk ? $k->waktu_masuk->format('Y-m-d H:i:s') : '',
                        $k->waktu_keluar ? $k->waktu_keluar->format('Y-m-d H:i:s') : '',
                        $k->created_at->format('Y-m-d H:i:s'),
                        $k->updated_at->format('Y-m-d H:i:s')
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        }
    }
}
