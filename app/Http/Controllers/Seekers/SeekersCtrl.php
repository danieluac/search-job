<?php

namespace App\Http\Controllers\Seekers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\OwnerHelpers;
use Session;
class SeekersCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function profile()
    {
        return view("seekers.profile");
    }
    public function profile_edit($seeker_id)
    {
        $seeker = (OwnerHelpers::seeker_type)::find($seeker_id);
        return view("seekers.profile-update", [
            "seeker" => $seeker,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Session::flash("aviso","Alguns dados estão incorretos...");
        $this->validate($request, [
            "seeker_id" => "required",
            "date_birth" => "required|date",
            "description" => "required",
            "telephone" => "required",
        ]);
        $seeker = (OwnerHelpers::seeker_type)::find($request->seeker_id);
        $seeker->date_birth = $request->date_birth;
        $seeker->description = $request->description;
        $seeker->telephone = $request->telephone;
        if($seeker->save())
        {
            Session::flash("sucesso","Dados actualizados com sucesso...");
        }
        return redirect()->route("profile");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
