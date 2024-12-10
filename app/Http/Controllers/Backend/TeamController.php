<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\BookArea;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
// use Faker\Provider\Image;
class TeamController extends Controller
{
    public function AllTeam(){
        $team = Team::latest()->get();
        return view('backend.team.all_team',compact('team'));
    }

    public function AddTeam(){
        $team = Team::latest()->get();
        return view('backend.team.add_team',compact('team'));
    }

    public function StoreTeam(Request $request){


        if ($request->file('image')) {
            $file = $request->file('image');
            // @unlink(public_path('upload/team_image'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/team_image'),$filename);
            $data['image'] = $filename;
        }


        Team::insert([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'image' => $filename,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Team Date Save Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.team')->with($notification);

    }

    public function EditTeam ($id){
        $team = Team::find($id);
        return view('backend.team.edit_team',compact('team'));
    }

    public function UpdateTeam(Request $request)
    {
        $team_id = $request->id;

        if ($request->file('image')) {
            $file = $request->file('image');
            // @unlink(public_path('upload/team_image'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/team_image'),$filename);
            $data['image'] = $filename;


        Team::findOrFail($team_id)->update([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'image' => $filename,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Team Date Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.team')->with($notification);


    } else {
        Team::findOrFail($team_id)->update([
            'name' => $request->name,
            'position' => $request->position,
            'facebook' => $request->facebook,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Team Date Updated WithOut Image Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('all.team')->with($notification);
        }

    } // end methods

    public function DeleteTeam($id) {
        $item = Team::findOrFail($id);
        $img = $item->image;
        @unlink($img);

        Team::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Team Date Deleted Successfully!',
            'alert-type' => 'danger'
        );

        return redirect()->route('all.team')->with($notification);
    }


    // this will for book area all methods

    public function BookArea(){
        $book = BookArea::find(1);
        return view('backend.bookarea.book_area',compact('book'));
    }

    public function UpdateBookArea(Request $request){

        $book_id = $request->id;

        if ($request->file('image')) {
            $file = $request->file('image');
            // @unlink(public_path('upload/team_image'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/book_image'),$filename);
            $data['image'] = $filename;
        }

        BookArea::findOrFail($book_id)->update([
            'main_title' => $request->main_title,
            'short_title' => $request->short_title,
            'short_desc' => $request->short_desc,
            'image' => $filename,
            'link_url' => $request->link_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Book Area Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('book.area')->with($notification);

    }

}
