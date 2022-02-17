<?php

namespace App\Http\Livewire;

use App\Jobs\Ejemplo;
use App\Jobs\SendEmail;
use App\Models\PointIt;
use Livewire\WithFileUploads;
use App\Models\UserGroup;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreatePoint extends Component
{
    use WithFileUploads;

    public $id_grupo;
    public $modal=false;
    public $postits = [];
    public $title,$description;
    public $img;
    public $status = false;/* para ver si pertenece al grupo escogido */
    public function mount(){
        $this->status = UserGroup::where('group_id',$this->id_grupo)
            ->where('user_id',Auth::user()->id)->first() ? true : false;
    }
    public function join(){
        $user_group = new UserGroup();
        $user_group->user_id = Auth::user()->id;
        $user_group->group_id = $this->id_grupo;
        $user_group->save();
        $this->status= true;
    }
    public function savePoint(){
        $urlImg ='post'.rand().'.'.$this->img->getclientOriginalExtension();
        $this->img->storeAs('img/point/',$urlImg,'public_uploads');
    
        $point = new PointIt();
        $point->title = $this->title;
        $point->description = $this->description;
        $point->img = $urlImg;
        $point->user_id = Auth::user()->id;
        $point->group_id = $this->id_grupo;
        $point->save();        
        $this->title = '';
        $this->description = '';
        // php artisan queue:work /* para ejecutar las tareas */
        SendEmail::dispatch('jlsc.hco17@gmail.com', 'Enviado por colas');
        // Ejemplo::dispatch('hola cmo estas');

    }
    public function render()
    {
        $this->postits= PointIt::where('group_id',$this->id_grupo)->get();
        return view('livewire.create-point');
    }
}
