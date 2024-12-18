<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Facility;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RoomController extends Controller
{
    public function EditRoom($id){
        $basic_facility = Facility::where('room_id', $id)->get();
        $editData = Room::find($id);
        return view('backend.allroom.rooms.edit_room',compact('editData','basic_facility'));
    }
}
