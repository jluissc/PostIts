<?php

namespace App\Http\Livewire;

use App\Jobs\SendEmail;
use App\Models\Group;
use App\Models\PointIt;
use Livewire\WithFileUploads;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePoint extends Component
{
    use WithFileUploads;

    public $id_grupo;
    public $name_group;
    public $modal=false;
    public $postits = [];
    public $title,$description;
    public $img;
    public $userLogueado;/* User logueado */
    public $status = false;/* para ver si pertenece al grupo escogido */
    public function mount(){
        $this->userLogueado = Auth::user();
        $this->name_group = Group::find($this->id_grupo)->title;
        $this->status = UserGroup::where('group_id',$this->id_grupo)
            ->where('user_id',$this->userLogueado->id)->first() ? true : false;
    }
    public function join(){
        $user_group = new UserGroup();
        $user_group->user_id = $this->userLogueado->id;
        $user_group->group_id = $this->id_grupo;
        $user_group->save();
        $this->status= true;
    }
    public function savePoint(){
        if($this->img){
            $urlImg ='post'.rand().'.'.$this->img->getclientOriginalExtension();
            $this->img->storeAs('img/point/',$urlImg,'public_uploads');
        }else $urlImg = '';
    
        $point = new PointIt();
        $point->title = $this->title;
        $point->description = $this->description;
        $point->img = $urlImg;
        $point->user_id = $this->userLogueado->id;
        $point->group_id = $this->id_grupo;
        $point->save();        
        $this->title = '';
        $this->description = '';
        $this->img = '';
        $this->SendNotification();
    }
    public function SendNotification(){
        $otherUsers = UserGroup::where('group_id',$this->id_grupo)->where('user_id','!=',$this->userLogueado->id)->get();

        foreach ($otherUsers as $otherUser) {
            /* php artisan queue:work =>>>>  para ejecutar las tareas */
            SendEmail::dispatch($otherUser->user->email, 'New PostIt in the'.$this->name_group.' group');            
        }
        
    }
    public function render()
    {
        $this->postits= PointIt::where('group_id',$this->id_grupo)->get();
        return view('livewire.create-point');
    }
}
