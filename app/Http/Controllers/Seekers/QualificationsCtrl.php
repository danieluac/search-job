<?php

namespace App\Http\Controllers\Seekers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seekers\qualifications;
use App\Models\Seekers\degrees;
use auth;

class QualificationsCtrl extends Controller
{
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("seekers.qualifications.create",['degrees' => degrees::all()]);
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
            "course" => ["required"],
            "place_degree" => ["required"],
            "degree_id" => ["required"],
            "issue_year" => ["required"],
            "status" => ["required"],
        ]);
         $qualifications = new qualifications;
         $qualifications->course = $request->course;
         $qualifications->place_degree = $request->place_degree;
         $qualifications->issue_year = $request->issue_year;
         $qualifications->end_year = $request->end_year;
         $qualifications->status = $request->status;
         $qualifications->degree_id = $request->degree_id;
         $qualifications->seeker_id = auth::user()->owner->id;
         $qualifications->save();
        
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
        qualifications::find($id)->delete();
        return redirect()->route("profile");
    }
}
