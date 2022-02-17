<?php

namespace App\Http\Livewire;

use App\Models\Group;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListGroups extends Component
{
    public $groups;
    public $grupJoins = [];

    public function joinGroup($id_group){
        $user_group = new UserGroup();
        $user_group->user_id = Auth::user()->id;
        $user_group->group_id = $id_group;
        $user_group->save();
        $this->myGroups();
    }

    public function mount(){
        $this->myGroups();
    }
    public function myGroups(){
        $this->groups = [];
        foreach (UserGroup::where('user_id',Auth::user()->id)->get() as $groups) {
            array_push($this->grupJoins,$groups->group_id );
        }
    }
    public function render()
    {
        $this->groups = Group::all();        
        return view('livewire.list-groups');
    }
}
