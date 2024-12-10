<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomType;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RoomTypeController extends Controller
{
    public function RoomTypeList(){
        $allData = RoomType::orderBy('id', 'desc')->get();
        return view('backend.allroom.roomtype.view_roomtype',compact('allData'));
    }

    public function AddRoomType(){
        return view('backend.allroom.roomtype.add_roomtype');
    }

    public function StoreRoomType(Request $request){
       $roomtype_id = RoomType::insertGetId([
            'name' => $request->name,
            'created_at' => Carbon::now(),
        ]);

        Room::insert([
            'roomtype_id' =>$roomtype_id,
        ]);

        $notification = array(
            'message' => 'Room Type Date Save Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('room.type.list')->with($notification);
    }
}
