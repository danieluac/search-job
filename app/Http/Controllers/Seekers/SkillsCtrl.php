<?php

namespace App\Http\Controllers\Seekers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use App\Models\Seekers\skills;

class SkillsCtrl extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("seekers.skills.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "name" => ["required"],
            "acquisition_option" => ["required"],
        ]);
         $skills = new skills;

         $skills->name = $request->name;
         $skills->acquisition_option = $request->acquisition_option;
         $skills->acquisition_place = $request->acquisition_place;
         $skills->description = $request->description;
         $skills->seeker_id = auth::user()->owner->id;
         $skills->save();
        
        return redirect()->route("profile");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        skills::find($id)->delete();
        return redirect()->route("profile");
    }
}
