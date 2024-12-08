<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
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
            @unlink(public_path('upload/team_image'.$data->image));
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
}
