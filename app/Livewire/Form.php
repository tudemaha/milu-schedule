<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Staff;
use App\Models\MasterTeam;

class Form extends Component
{
    public $team = 0;

    public $teams = [];
    private $staffs = [];
    public $selectedStaffs = [];
    
    public function updatedTeam($value) {

        
        foreach($this->staffs as $staff) {
            $selectedStaffs = [];
            switch($staff->team_id) {
                case 1:
                    $selectedStaffs[] = $staff;
                    break;
                case 2:
                    $selectedStaffs[] = $staff;
                    break;
                case 3:
                    $selectedStaffs[] = $staff;
                    break;
            }
        }
    }

    public function mount() {
        $this->teams = MasterTeam::all();
        $this->staffs = Staff::all();
        dump($this->staffs);
    }

    public function render()
    {
        return view('livewire.form');
    }
}
