<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function addFoto(){
        return view('home');
    }
    public function storeFoto(Request $request){
        $this->validate($request,[
            'foto' => "required"
        ]);
        $user = User::find($request->user_id);
        if($request->hasFile("foto")){
           
           $extension = strtolower($request->file("foto")->getclientOriginalExtension());
            $path = $request->file("foto")->storeAs(
                "public/fotos", 
                "foto_perfil".'_'.time().'.'.$extension          
            );
            $user->foto = "/storage/".str_replace("public/","",$path);        
        }
        if($user->save())
            return redirect()->route("addFoto");
        return redirect()->route("addFoto");
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
