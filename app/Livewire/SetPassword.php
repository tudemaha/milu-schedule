<?php

namespace App\Livewire;

use App\Models\Employee;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Url;
use Livewire\Component;

class SetPassword extends Component
{
    #[Url]
    public $id = "";

    public $team = "";
    public $name = "";
    public $password = "";
    public $passwordRepeat = "";

    protected function rules() {
        return [
            'password' => 'required|min:6',
            'passwordRepeat' => 'required|same:password'
        ];
    }

    protected function messages() {
        return [
            'password.required' => 'Password must be filled.',
            'password.min' => 'Password must be at least 6 characters.',
            'passwordRepeat.required' => 'Retype your password.',
            'passwordRepeat.same' => 'Repeated password must be the same with password.'
        ];
    }

    public function mount() {
        if($this->id == "") {
            return $this->redirect('/');
        };

        $employee = Employee::join('master_teams', 'master_teams.id', '=', 'employees.team_id')
            ->select("master_teams.name as team", "employees.name", "employees.password")
            ->where('employees.id', $this->id)
            ->first();
        
        if(!$employee || $employee->password) {
            return $this->redirect('/');
        };
        
        $this->name = $employee->name;
        $this->team = $employee->team;
    }

    public function save() {
        $validated = $this->validate();

        $hashedPass = Hash::make($validated['password']);

        $employee = Employee::find($this->id);
        if($employee->password) {
            $this->addError("filled", "Can't set password. Password already set.");
            return;
        }
        $employee->password = $hashedPass;
        $employee->save();

        $this->reset();
        return $this->redirect('/');
    }

    public function render()
    {   
        return view('livewire.set-password');
    }
}
