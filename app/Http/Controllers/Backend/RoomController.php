<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\Facility;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\Constraint\Count;

class RoomController extends Controller
{
    public function EditRoom($id){
        $basic_facility = Facility::where('room_id', $id)->get();
        $editData = Room::find($id);
        return view('backend.allroom.rooms.edit_room',compact('editData','basic_facility'));
    }

    public function UpdateRoom(Request $request, $id)
    {

        // update single image

        if ($request->file('image')) {
            $file = $request->file('image');
            // @unlink(public_path('upload/team_image'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/room_image'),$filename);
            $data['image'] = $filename;
        }


        $room = Room::find($id);
        $room->roomtype_id = $request->roomtype_id;
        $room->total_adult = $request->total_adult;
        $room->total_child = $request->total_child;
        $room->room_capacity= $request->room_capacity;
        $room->price = $request->price;
        $room->size = $request->size;
        $room->bed_type = $request->bed_type;
        $room->view = $request->view;
        $room->discount = $request->discount;
        $room->short_desc = $request->short_desc;
        $room->description = $request->description;
        $room->image = $filename;
        $room->save();


        if ($request->facility_name == NULL) {

            $notification = array(
                'message' => 'Sorry! Not Any Basic Facility Selected',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        } else {
            Facility::where('room_id',$id)->delete();
            $facilities = Count($request->facility_name);

            for ($i=0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->room_id = $room->id;
                $fcount->facility_name = $request->facility_name[$i];
                $fcount->save();
            }
        }

    }
}
