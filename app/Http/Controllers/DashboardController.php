<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use App\Models\Farm;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function view() {
        $cowData = DB::table('pets')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->where('type', 'cow')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $cumulativeCowData = [];
        $cumulativeTotal = 0;

        foreach ($cowData as $data) {
            $cumulativeTotal += $data->total;
            $cumulativeCowData[] = [
                'date' => sprintf("%04d-%02d-01", $data->year, $data->month), // Format YYYY-MM-DD
                'total' => $cumulativeTotal,
            ];
        }
        $goatData = DB::table('pets')
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as total')
            ->where('type', 'goat')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        $cumulativeGoatData = [];
        $cumulativeTotalGoat = 0;

        foreach ($goatData as $data) {
            $cumulativeTotalGoat += $data->total;
            $cumulativeGoatData[] = [
                'date' => sprintf("%04d-%02d-01", $data->year, $data->month),
                'total' => $cumulativeTotalGoat,
            ];
        }


        $totalCow = Pet::where('type', 'cow')->count();
        $totalFarms = Farm::count();
        $userCount = User::count();

        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        $cowCountByDistrict = DB::table('pets')
            ->join('farms', 'pets.farm_id', '=', 'farms.id')
            ->where('pets.type', 'cow') // Filter by pet type cow
            ->select('farms.district', DB::raw('COUNT(pets.id) as cow_count'))
            ->groupBy('farms.district')
            ->get();

        $farmCountByDistrict = Farm::select('district', DB::raw('COUNT(id) as farm_count'))
            ->groupBy('district')
            ->get();



        return view('layouts.Dashboard.dashboard', compact('totalCow','userCount', 'cumulativeCowData','announcements','totalFarms','cowCountByDistrict','farmCountByDistrict','cumulativeGoatData'));
    }

}
