<?php

namespace App\Http\Controllers\Seekers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seekers\expiriences;
use auth;
class ExpiriencesCtrl extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("seekers.expirience.create");
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
            "company_name" => ["required"],
            "position" => ["required"],
            "status" => ["required"],
            "start_date" => ["required"],
        ]);
         $expiriences = new expiriences;

         $expiriences->company_name = $request->company_name;
         $expiriences->position = $request->position;
         $expiriences->status = $request->status;
         $expiriences->start_date = $request->start_date;
         $expiriences->end_date = $request->end_date;
         $expiriences->description = $request->description;
         $expiriences->seeker_id = auth::user()->owner->id;
         $expiriences->save();
        
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
        expiriences::find($id)->delete();
        return redirect()->route("profile");
    }
}
