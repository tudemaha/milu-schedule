<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Staff;
use App\Models\MasterTeam;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Form extends Component
{
    public $teams = [];
    public $staffs = [];
    public $reasons = [];
    public $nextWeekStartDate = '';
    public $nextWeekEndDate = '';

    public $teamID = 0;
    public $staffID = '';
    public $requests = [
        ['date' => '', 'reason_id' => 0],
    ];

    public function updatedTeamID($value) {
        $this->staffs = Staff::where('team_id', $value)->get();
    }

    public function add() {
        $this->requests[] = ['date' => '', 'reason_id' => 0];
    }

    public function remove($index) {
        if(count($this->requests) <= 1) {
            return;
        }
        
        array_splice($this->requests, $index, 1);
    }

    public function mount() {
        $this->teams = MasterTeam::all();
        $this->reasons = DB::table("master_request_types")->get();
        
        $nextSunday = Carbon::now()->next(Carbon::SUNDAY);
        $this->nextWeekStartDate = $nextSunday->format('Y-m-d');
        $this->nextWeekEndDate = $nextSunday->addDays(6)->format('Y-m-d');
        dump($this->nextWeekStartDate);
    }

    public function save() {

    }

    public function render()
    {
        return view('livewire.form');
    }
}
