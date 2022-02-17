<?php

namespace App\Http\Livewire;

use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePointIt extends Component
{
    public $id_grupo;
    public $status = false;/* para ver si pertenece al grupo escogido */
    public function mount(){
        $this->status = UserGroup::where('group_id',$this->id_grupo)
            ->where('user_id',Auth::user()->id)->first() ? true : false;
    }
    public function joinGroup2(){
        $user_group = new UserGroup();
        $user_group->user_id = Auth::user()->id;
        $user_group->group_id = $this->id_group;
        $user_group->save();
        $this->status= true;
    }
    public function render()
    {
        return view('livewire.create-point-it');
    }
}
