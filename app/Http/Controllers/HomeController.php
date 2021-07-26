<?php

namespace App\Http\Controllers;

use App\Models\UsersInfo;
use App\Models\RecycledItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index($id = null){

        $recycled_total = $this->getTotalRecycled();
        $users_recycled_list = $this->getSpecificUserItems($id);
        $page_title = "Recyclebox";
        
        $parameters = [
            'page_title' => $page_title,
            'recycled_total' => $recycled_total,
            'users_recycled_list' => $users_recycled_list
        ];

        if ($id != null ){
            $user = $this->getSpecificUsers($id);
            $parameters['current_user'] = $user;
        }
        return view('home',$parameters);
    }

    public function indexWithUser(Request $request){
        $username = $request->username;
        $users = DB::table('usersinfo')->where('full_name',$username)->first();
        $id = $users->userid;
        return $this->index($id);
    }

    public function getTotalRecycled() {
        $full_items = RecycledItem::all();
        $count = 0;
        foreach($full_items as $item){
            $count += $item->item_count;
        }
        return $count;
    }

    public function getSpecificUsers($id){
        $user = DB::table('usersinfo')->where('userid',$id)->get();
        $user = $user[0];
        return $user;
    }

    public function getSpecificUserItems($id){
        $recycled_items = DB::table('recycleditems')->where('userid',$id)->get();
        //$count = $recycled_items->count();
        return $recycled_items;
    }





   
}
