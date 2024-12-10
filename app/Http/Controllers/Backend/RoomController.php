<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RoomController extends Controller
{
    public function EditRoom($id){
        $editData = Room::find($id);
        return view('backend.allroom.rooms.edit_room',compact('editData'));
    }
}
