<?php

namespace App\Http\Controllers;

use App\Models\Request as Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RecapController extends Controller
{
    public function index()
    {
        $nextMonday = Carbon::now()->next(Carbon::MONDAY);
        $nextWeekStartDate = $nextMonday->format('Y-m-d');
        $nextWeekEndDate = $nextMonday->addDays(6)->endOfDay();

        $recap = Request::whereBetween('date', [$nextWeekStartDate, $nextWeekEndDate])
            ->with('employee')
            ->get()
            ->sortBy('employee.team_id')
            ->groupBy(['employee.team_id', 'employee_id']);

        return view('recap', [
            'recap' => $recap,
            'startDate' => $nextWeekStartDate,
            'endDate' => $nextWeekEndDate,
        ]);
    }
}
