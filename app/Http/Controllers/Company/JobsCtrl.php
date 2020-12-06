<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\OwnerHelpers;
use Session;
use Auth;
class JobsCtrl extends Controller
{
    public function __construct(){
        $this->middleware("auth")->except('findJobs');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findJobs()
    {
        return view("jobs.find-job",[
            "activities" => (OwnerHelpers::activity)::all(),
            "jobs" => (OwnerHelpers::jobs)::where("state",0)->inRandomOrder()->limit(12)->get()
        ]);
    }
    public function seekerIndexJobsById($job_id){
        Session::flash("aviso", "Lamentamos, mas você não é um candidato top para está vaga, por causa do seu titulo academico...");
        return view("company.jobs.job-detail",[
            "job" => (OwnerHelpers::jobs)::where("state",0)->where("id",$job_id)->first(),
        ]);
    }
    public function indexJobSeekers($job_id){
        
        return view("company.jobs.index-job-seekers",[
            "jobs" => (OwnerHelpers::job_seekers)::where("company_id", Auth::user()->owner_id)->where("state",0)->get(),
        ]);
    }
    public function index()
    {
        return view("company.jobs.index-job",[
            "jobs" => (OwnerHelpers::jobs)::where("company_id", Auth::user()->owner_id)->where("state",0)->get(),
        ]);
    }
    public function createJobs()
    {
        return view("company.jobs.create",[
            "degrees" => (OwnerHelpers::degrees)::all(),
            "activities" => (OwnerHelpers::activity)::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fecharVaga($id)
    {
        $job = (OwnerHelpers::jobs)::find($id);
        if(isset($job->company_id) && $job->company_id ==  Auth::user()->owner_id ){
            $job->state = 1;
           if( $job->save())
                Session::flash("sucesso","A sua vaga foi fechada");

           return redirect()->back(); 
        }
        Session::flash("erro","Não foi possível fechar a vaga...");
        return redirect()->back();        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash("aviso","Alguns campos são de preenchimento obrigatório...");
        $this->validate($request, [
            "job_title" => "required",
            "job_number" => "required|integer",
            "end_date" => "required|date",
            "activity_id" => "required|integer",
            "degree_id" => "required|integer",
            "company_id" => "required|integer",
            "job_location" => "required|string",
            "job_description" => "required|string",
        ]);
            $job = OwnerHelpers::jobs;
            $jobs = new $job();
            $jobs->job_title = $request->job_title;
            $jobs->job_number = $request->job_number;
            $jobs->end_date = $request->end_date;
            $jobs->activity_id = $request->activity_id;
            $jobs->degree_id = $request->degree_id;
            $jobs->state = 0;
            $jobs->job_location =  $request->job_location;
            $jobs->company_id = $request->company_id;
            $jobs->job_description = $request->job_description;
        if($jobs->save()){
            Session::flash("sucesso","A sua vaga foi publicada");
           return redirect()->back(); 
        }
        Session::flash("erro","Não foi possível publicar a vaga, verifique os dados que inseriu...");
        return redirect()->back(); 
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
        Session::flash("aviso","Alguns campos são de preenchimento obrigatório...");
        $this->validate($request, [
            "job_title" => "required",
            "job_number" => "required|integer",
            "end_date" => "required|date",
            "activity_id" => "required|integer",
            "degree_id" => "required|integer",
            "company_id" => "required|integer",
            "job_location" => "required",
            "job_description" => "required",
        ]);
        $jobs = (OwnerHelpers::jobs)::find($id);          

        if(isset($jobs->company_id) && $jobs->company_id ==  Auth::user()->owner_id ){
            $jobs->job_title = $request->job_title;
            $jobs->job_number = $request->job_number;
            $jobs->end_date = $request->end_date;
            $jobs->activity_id = $request->activity_id;
            $jobs->degree_id = $request->degree_id;
            $jobs->company_id = $request->company_id;
            $jobs->job_location =  $request->job_location;
            $jobs->job_description = $request->job_description;
           if( $jobs->save())
            {
                Session::flash("sucesso","A sua vaga foi actualizada");
                return redirect()->back(); 
            }
        }
        Session::flash("erro","Não foi possível actualizar a vaga...");
        return redirect()->back();    
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
