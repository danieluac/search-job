<?php

namespace App\Http\Controllers\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\OwnerHelpers;
use Session;
use Auth;
class MessagesCtrl extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_inbox()
    {
        $sms = (OwnerHelpers::messages)::where("to",auth::user()->id)->orderBy("sent_date","DESC")->get();       
        return view("messages.inbox-list",[
            "sms" => $sms,
            "active" => "inbox"
        ]);
    }
    public function index_sent()
    {
        $sms = (OwnerHelpers::messages)::where("from",auth::user()->id)->orderBy("sent_date","DESC")->get();       
        return view("messages.inbox-list",[
            "sms" => $sms,
            "active" => "sent"
        ]);
    }
    public function view_inbox($sms_id)
    {
        $sms = (OwnerHelpers::messages)::where("id",$sms_id)->get()->last();
        $sms->viewed = "1";
        $sms->update();
        return view("messages.inbox-view",[
            "sms" => $sms,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id, $title)
    {
        return view("messages.write",[
            "user_id" => $user_id,
            "title" =>  $title,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash("aviso","Alguns campos não preenchidos...");
        $this->validate($request, [
            "from_id" => "required",
            "to_id" => "required",
            "message" => "required",
            "title" => "required",
        ]);
        $sms = (OwnerHelpers::messages);
        $sms = new $sms;
        $sms->from = $request->from_id;
        $sms->to = $request->to_id;
        $sms->message = $request->message;
        $sms->title = $request->title;
        $sms->sent_date = date("Y-m-d");
        $sms->viewed = "0";
        if($sms->save()){
            Session::flash("sucesso","Enviada com sucesso..");
            return redirect()->back();
        }
        Session::flash("erro","erro ao processar os dados...");
        return redirect()->back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
