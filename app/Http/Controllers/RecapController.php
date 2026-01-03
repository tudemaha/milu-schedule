<?php

namespace App\Http\Controllers;

use App\Models\Request as Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RecapController extends Controller
{
    public function index()
    {
        $nextSunday = Carbon::now()->next(Carbon::SUNDAY);
        $nextWeekStartDate = $nextSunday->format('Y-m-d');
        $nextWeekEndDate = $nextSunday->addDays(6)->endOfDay();

        $recap = Request::whereBetween('date', [$nextWeekStartDate, $nextWeekEndDate])
            ->with('employee')
            ->get()
            ->sortBy('employee.team_id')
            ->groupBy(['employee.team_id', 'employee_id']);

            dump($recap);

        return view('recap', ['recap' => $recap]);
    }
}
