<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Employee;
use App\Models\MasterTeam;
use App\Models\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use function Symfony\Component\Clock\now;

class Form extends Component
{
    public $teams = [];
    public $employees = [];
    public $types = [];
    public $nextWeekStartDate = '';
    public $nextWeekEndDate = '';

    public $teamID = 0;
    public $employeeID = '';
    public $requests = [
        ['date' => '', 'type_id' => 0],
    ];

    protected function rules() {
        return [
            'teamID' => 'required|min:1|max:3',
            'employeeID' => 'required|uuid|min:5',
            'requests.*.date' => 'required',
            'requests.*.type_id' => 'required|min:1|max:5'
        ];
    }

    public function updatedTeamID($value) {
        $this->employees = Employee::where('team_id', $value)->get();
    }

    public function add() {
        $this->requests[] = ['date' => '', 'type_id' => 0];
    }

    public function remove($index) {
        if(count($this->requests) <= 1) {
            return;
        }
        
        array_splice($this->requests, $index, 1);
    }

    public function mount() {
        $this->teams = MasterTeam::all();
        $this->types = DB::table("master_request_types")->get();
        
        $nextSunday = Carbon::now()->next(Carbon::SUNDAY);
        $this->nextWeekStartDate = $nextSunday->format('Y-m-d');
        $this->nextWeekEndDate = $nextSunday->addDays(6)->format('Y-m-d');
    }

    public function save() {
        $this->validate();

        $insertToDB = [];
        foreach($this->requests as $request) {
            $insertToDB[] = [
                'id' => Str::uuid()->toString(),
                'employee_id' => $this->employeeID,
                'type_id' => $request['type_id'],
                'date' => $request['date'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Request::insert($insertToDB);

        session()->flash('success', 'Requests submitted!');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.form');
    }
}
