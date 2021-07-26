<?php

namespace App\Http\Controllers;

use App\Models\RecycledItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecycleItemsController extends Controller
{
    public function create(Request $request){
        
        $user_id = $request->user_id;
        $item_name = $request->recycledItem;
        
        $Item = new RecycledItem();
        $result = $this->findExisting($user_id,$item_name);
        $Item->item_name = $item_name;
        $Item->userid = $user_id;
        
        if (is_null($result)){
            $Item->item_count = 1;
            $Item->save();
        }
        else{
            $item_id = $result->item_id;
            $item_total = $result->item_count + 1;
            $update = RecycledItem::where('item_id',$item_id)->update(["item_count" => $item_total]);
        }
        return redirect()->back();
    }

    public function findExisting($user_id,$item_name){

        $result = DB::table('recycleditems')
             ->where('userid','=',$user_id)
             ->where('item_name','=',$item_name)
             ->first();
        return $result;
            
    } 
}
