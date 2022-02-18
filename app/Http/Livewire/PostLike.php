<?php

namespace App\Http\Livewire;

use App\Models\PostLike as ModelsPostLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PostLike extends Component
{   
    public $id_post;
    public $countLike= 0;
    public $status = false;

    public function likeStatus(){
        ModelsPostLike::updateOrInsert(
            ['user_id' => Auth::user()->id, 'post_id' => $this->id_post],
            ['status' => !$this->status]
        );
        $this->status = !$this->status;
    }

    public function mount(){
        $this->status = ModelsPostLike::where('user_id',Auth::user()->id)
            ->where('post_id',$this->id_post)->where('status',1)->first() ? true : false;
    }
    public function render()
    {
        $this->countLike = ModelsPostLike::where('post_id',$this->id_post)->where('status',1)->count();
        return view('livewire.post-like');
    }

}
