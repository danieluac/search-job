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
    public function findJobs($activity_id = 0)
    {
        $activity = [];
        if($activity_id == 0){
            $activity = (OwnerHelpers::jobs)::where("state",0)
            ->where("end_date",">", date("Y-m-d"))
            ->inRandomOrder()->limit(12)->get();
        }else
            $activity = (OwnerHelpers::jobs)::where("state",0)
            ->where("end_date",">", date("Y-m-d"))->where("activity_id", $activity_id)
            ->inRandomOrder()->limit(20)->get();

        return view("jobs.find-job",[
            "activities" => (OwnerHelpers::activity)::all(),
            "jobs" => $activity,
        ]);
    }
    public function search_jobs(Request $request)
    {
            $activity = (OwnerHelpers::jobs)::where("state",0)
            ->where("end_date",">", date("Y-m-d"))
            ->where("activity_id", $request->activity_id)
            ->inRandomOrder()->limit(20)->get();
            if(!isset($activity[0]) and $request->text_filter != '' and $request->text_filter != " ")
                $activity = (OwnerHelpers::jobs)::where("state",0)
                ->where("end_date",">", date("Y-m-d"))
                ->Where("job_title","like", "%". $request->text_filter."%")
                ->inRandomOrder()->limit(20)->get();

        return view("jobs.find-job",[
            "activities" => (OwnerHelpers::activity)::all(),
            "jobs" => $activity,
        ]);
    }
    public function seekerIndexJobsById($job_id){
        $job = (OwnerHelpers::jobs)::where("state",0)->where("id",$job_id)->first();        
        
        if(Auth::user()->owner_type != OwnerHelpers::company_type){
            $seeker_id = Auth::user()->owner_id;
            $top = false;
            $qualifications = (OwnerHelpers::qualifications)::where("seeker_id", $seeker_id)->get();
            foreach( $qualifications as $data){
                if($data->degree_id >= $job->degree_id ){
                    $top = true;
                }
            }
            if($top != true)
                Session::flash("aviso", "Lamentamos, mas você não é um candidato top para está vaga, por causa do seu titulo academico...");
        }

        return view("company.jobs.job-detail",[
            "job" => $job,
        ]);
    }
    public function my_job_application(){
        $job_seeker = [];
        if(Auth::user()->owner_type != OwnerHelpers::company_type){            
            $job_seeker = (OwnerHelpers::job_seekers)::where("seeker_id", Auth::user()->owner_id)->get();            
        }
        return view("company.jobs.job-my-application",[
            "job_seeker" => $job_seeker,
        ]);
    }
    public function select_seeker($seeker_job_id){
        $job_seeker = (OwnerHelpers::job_seekers)::where("id",$seeker_job_id)->get()->last(); 
        

        if(Auth::user()->owner_type == OwnerHelpers::company_type and isset($job_seeker)){ 
            $job_seeker->status = "selected";
            if($job_seeker->save()){     
                Session::flash("sucesso","Candidato selecionado...");                    
            }else 
                Session::flash("erro","Não possível selecionar o Candidato...");   
        }else 
            Session::flash("erro","Não possível selecionar o Candidato...");
        return redirect()->back();
            
    }
    public function unselect_seeker($seeker_job_id){
        $job_seeker = (OwnerHelpers::job_seekers)::where("id",$seeker_job_id)->get()->last(); 
        

        if(Auth::user()->owner_type == OwnerHelpers::company_type and isset($job_seeker)){ 
            $job_seeker->status = "applied";
            if($job_seeker->save()){     
                Session::flash("sucesso","Seleção cancelada...");                    
            }else 
                Session::flash("erro","Não possível cancelar a seleção...");   
        }else 
            Session::flash("erro","Não possível cancelar a seleção...");
        return redirect()->back();            
    }
    public function seeker_cv($seeker_id, $job_seeker_id= 0){

        $seeker = (OwnerHelpers::seeker_type)::where("id", $seeker_id)->get()->last();        
        return view("company.jobs.seeker-cv",[
            "seeker" => $seeker,
            "job_seeker_id" => $job_seeker_id
        ]);

    }
    public function application_list($job_id){
        $job_seeker = (OwnerHelpers::job_seekers)::where("job_id", $job_id)->get();  
      
        return view("company.jobs.application-list",[
            "job_seeker" => $job_seeker,
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
    public function editJobs($job_id)
    {
        return view("company.jobs.edit",[
            "job" => (OwnerHelpers::jobs)::find($job_id),
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
    public function apply_job(Request $request)
    {
        Session::flash("aviso","Alguns campos são de preenchimento obrigatório...");
        $this->validate($request, [
            "job_id" => "required|integer",
            "seeker_id" => "required|integer",
        ]);
        $job_seekers = (OwnerHelpers::job_seekers);
        $job_seeker = new $job_seekers;
        $job_seeker->status = "applied";
        $job_seeker->seeker_id  = $request->seeker_id;
        $job_seeker->job_id   = $request->job_id ;
        if($job_seeker->save()){           
            Session::flash("sucesso","Aplicado com sucesso");
           return redirect()->back(); 
        }
        Session::flash("erro","Não foi possível aplicar a vaga...");
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
