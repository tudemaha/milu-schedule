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
    public $offRequests = [];

    public $teamID = 0;
    public $employeeID = '';
    public $requests = [
        ['date' => '', 'type_id' => 0],
    ];

    protected function rules() {
        return [
            'teamID' => 'required|integer|min:1|max:3',
            'employeeID' => 'required|uuid',
            'requests' => 'required|array|min:1',
            'requests.*.date' => "required|date",
            'requests.*.type_id' => 'required|integer|min:1|max:5'
        ];
    }

    protected function messages() {
        return [
            'teamID' => 'Select your team.',
            'employeeID' => 'Select your name.',
            'requests.required' => 'Request minimal 1.',
            'requests.*.date.required' => 'Request date must be filled.',
            'requests.*.type_id.required' => 'Request type must be filled.',
            'requests.*.type_id.min' => 'Request type must in selection.',
            'requests.*.type_id.max' => 'Request type must in selection.'
        ];
    }

    public function updateOffRequests($teamID) {
        $end = Carbon::parse($this->nextWeekEndDate)->endOfDay();

        $this->offRequests = DB::table('requests')
            ->join('employees', 'employees.id', '=', 'requests.employee_id')
            ->select('date', DB::raw('COUNT(date) AS total'))
            ->whereBetween('date', [$this->nextWeekStartDate, $end])
            ->where([
                'type_id' => 1,
                'employees.team_id' => $teamID
            ])
            ->groupBy('date')
            ->get();
    }

    public function updatedTeamID($value) {
        $this->employees = Employee::where('team_id', $value)->get();
        $this->updateOffRequests($value);        
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
        $validated = $this->validate();

        $offRequests = DB::table('requests')
            ->join('employees', 'employees.id', '=', 'requests.employee_id')
            ->select('date', DB::raw('COUNT(date) AS total'))
            ->where([
                'type_id' => 1,
                'employees.team_id' => $this->teamID,
            ])
            ->groupBy('date')
            ->get();

        $insertToDB = [];
        foreach($validated['requests'] as $index => $request) {
            // validate off count before insert into database
            foreach($offRequests as $off) {
                if($request['date'] == $off->date) {
                    if(($this->teamID == 1 && $off->total >= 3) || 
                        ($this->teamID > 1 && $off->total >= 2)) {
                            $this->addError("requests.".$index.".date_error", 'Off slot already full.');
                            $this->updateOffRequests($this->teamID);
                            return;
                        }
                }
            }

            $insertToDB[] = [
                'id' => Str::uuid()->toString(),
                'employee_id' => $validated['employeeID'],
                'type_id' => $request['type_id'],
                'date' => $request['date'],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        Request::insert($insertToDB);

        $this->reset();

        return $this->redirect('/success');
    }

    public function render()
    {
        return view('livewire.form');
    }
}
