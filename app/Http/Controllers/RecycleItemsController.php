<?php

namespace App\Http\Controllers;

use App\Models\RecycledItem;
use App\Models\UsersInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;

class RecycleItemsController extends Controller
{
    public function index(){
        return RecycledItem::orderBy('item_count')->get();
    }

    public function add(Request $request){

        $newItem = new RecycledItem();
        $name = $request->item["item_name"];
        $newItem->item_name = $name;
        $user_id = 1;
        $newItem->userid = $user_id;
        $exists = $this->findExisting($user_id,$name);

        if (is_null($exists)){
            $newItem->item_count = 1;
            $newItem->save();
        }
        else{
            $item_id = $exists->item_id;
            $item_total = $exists->item_count + 1;
            $update = RecycledItem::where('item_id',$item_id)->update(["item_count" => $item_total]);
            $newItem->item_id = $item_id;
            $newItem->item_count = $item_total;
        }
        return $newItem;
    }

    private function findExisting($user_id,$item_name){

        $result = DB::table('recycleditems')
             ->where('userid','=',$user_id)
             ->where('item_name','=',$item_name)
             ->first();
        return $result;
            
    } 

    private function findUserIdByFullName($full_name){
        $id = null;
        ##full_name should be unique in database, this hasnt been forced but should have been
        $result = UsersInfo::where('full_name',$full_name)->get()->first();
        $id = $result;
        return $id;
    }

    public function getTotalRecycled() {
        $full_items = RecycledItem::all();
        $count = 0;
        foreach($full_items as $item){
            $count += $item->item_count;
        }
        return $count;
    }


    
}
