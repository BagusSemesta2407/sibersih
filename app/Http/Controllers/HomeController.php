<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Employee;
use App\Models\User;
use App\Models\Village;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title= 'Dashboard';
        $countUser=User::whereNotIn('nomor_induk', ['3213230504', '321323050401'])
        ->count();
        $countActivityProgress=Activity::where('status', 'on progress')
        ->count();
        $countActivityFinish=Activity::where('status', 'finish')
        ->count();
        $countActivityAll=Activity::count();

        // Ambil semua desa
        $villages = Village::all();

        // Inisialisasi array untuk data label dan nilai per desa
        $labels = [];
        $values = [];

        foreach ($villages as $village) {
            // Query untuk mengambil jumlah aktivitas finish per bulan
            $activityData = Activity::select(
                DB::raw('MONTH(date) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('village_id', $village->id)
            ->where('status', 'finish')
            ->groupBy(DB::raw('MONTH(date)'))
            ->get();

            // Inisialisasi array untuk label dan nilai per bulan
            $labelData = [];
            $valueData = [];

            foreach ($activityData as $activity) {
                $labelData[] = Carbon::create()->month($activity->month)->format('M'); // Format bulan menjadi tiga huruf
                $valueData[] = $activity->count;
            }
            // Jika tidak ada data aktivitas, tambahkan label dan nilai default
            if (empty($labelData) || empty($valueData)) {
                $labelData[] = 'No Data';
                $valueData[] = 0;
            }

            $labels[$village->id] = $labelData;
            $values[$village->id] = $valueData;
        }

        $recentActivity=Activity::where('status', 'on progress')->latest()->take('5')->get();


        $auth=Auth::user()->id;
        $employee=Employee::where('user_id', $auth)->first();

        $recentActivityForVillage=Activity::where('status', 'on progress')
        ->where('village_id', @$employee->village_id)
        ->get();

        return view('dashboard', [
            'title' =>  $title,
            'labels' => $labels,
            'values' => $values,
            'villages' => $villages,
            'countUser' => $countUser,
            'countActivityProgress'=> $countActivityProgress,
            'recentActivity'=> $recentActivity,
            'recentActivityForVillage' => $recentActivityForVillage,
            'countActivityFinish' => $countActivityFinish,
            'countActivityAll' => $countActivityAll
        ]);
    }
}
