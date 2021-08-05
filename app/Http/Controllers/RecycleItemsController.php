<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\AchievementRequirement;
use App\Models\RecycledItem;
use App\Models\UserAchievements;
use App\Models\UsersInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;

class RecycleItemsController extends Controller
{
    public function getRecycledItems(){
        return RecycledItem::orderBy('item_count','DESC')->get();
    }
 

    public function add(Request $request){

        $newItem = new RecycledItem();
        $item_name = $request->item["item_name"];
        $newItem->item_name = $item_name;

        $user_id = 1;
        $newItem->user_id = $user_id;

        if (! $this->checkUserId($user_id)){
            return "User Not Found";
        }

        $exists = $this->findExistingRecyclingItem($user_id,$item_name);

        if (is_null($exists)){
            $newItem->item_count = 1;
            $newItem->save();
            return $newItem;
        }
        else{

            $exists->item_count += 1;
            $exists->save();
            return $exists;
        }
        
    }

    private function findExistingRecyclingItem($user_id,$item_name){

        $result = RecycledItem::where('user_id','=',$user_id)
             ->where('item_name','=',$item_name)
             ->first();
        return $result;
            
    } 

    public function getTotalRecycled() {
        $full_items = RecycledItem::all();
        $count = 0;
        foreach($full_items as $item){
            $count += $item->item_count;
        }
        return $count;
    }

    private function checkUserId($user_id){
        $result =  UsersInfo::find($user_id);
        return (! is_null($result));
    }

    private function checkAchievementId($achievement_id){
        $result = Achievement::find($achievement_id);
        return (! is_null($result));
    }


    ///Achivements stuff


    public function getAchievementList(){
        return Achievement::orderBy('type')->get();
    }

    public function getAchievementRequirements(Request $request){
        $achievement_id = $request->achievement_id;
        $results = AchievementRequirement::where('achievement_id',$achievement_id)->orderBy('count')->get();
        return $results;
    }

    public function checkUserAchievement(Request $request) {

        $user_id = $request->user_id;
        $achievement_id = $request->achievement_id;
        if (! $this->validateUserAndAchievementId($user_id,$achievement_id)){
            return "User or achievement not found";
        }

        $result = UserAchievements::where('user_id',$user_id)
        ->where('achievement_id',$achievement_id)
        ->get()->first();
        return (! is_null($result));
    }


    private function validateUserAndAchievementId($user_id,$achievement_id){
        if (! $this->checkUserId($user_id)){
           return false;
        }
        if (! $this->checkAchievementId($achievement_id)){
            return false;
        }
        return true;
    }

    public function addUserAchievement(Request $request){

        $achivement = new UserAchievements();
        $user_id = $request->user_id;
        $achievement_id = $request->achievement_id;

        if (! $this->validateUserAndAchievementId($user_id,$achievement_id)){
            return "User or achievement not found";
        }

        $time = Carbon::now();
        $achivement->user_id = $user_id;
        $achivement->achievement_id = $achievement_id;
        $achivement->completed_at = $time;
        $achivement->save();
        return $achivement;
    }

}
