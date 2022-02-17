<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\PointIt;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index($id){
        if(Group::find($id)){
            $title = Group::find($id)->title;
            // $postits= PointIt::where('group_id',$id)->get();
            return view('group', [
                // 'postits' => $postits,
                'title' => $title,
                'id_grupo' => $id,
            ]);
        }else return redirect('');
        
    }
}
