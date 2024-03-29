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
        $this->middleware("auth")->except(['findJobs',"search_jobs"]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function findJobs($company_id = 0)
    {
       
        if( $company_id != 0 and auth::check()){
            $user_activity = [];
            foreach(auth::user()->owner->qualification as $data){
                $user_activity[] = $data->activity_id;
            }
            $activity1 = (OwnerHelpers::jobs)::where("state",0)
                    ->where("company_id","=",$company_id)
                    ->where("end_date",">", date("Y-m-d"))                    
                    ->where("show_by_activity", "0")
                    ->inRandomOrder()->limit(12)->get();
            $activity = (OwnerHelpers::jobs)::where("state",0)
                ->where("company_id","=",$company_id)
                ->where("end_date",">", date("Y-m-d"))
                ->whereIn("activity_id", $user_activity)
                ->inRandomOrder()->limit(12)->get();
        }else if( $company_id != 0 and !auth::check()){            
            $activity = (OwnerHelpers::jobs)::where("state",0)
                ->where("company_id","=",$company_id)
                ->where("end_date",">", date("Y-m-d"))
                ->inRandomOrder()->limit(12)->get();
        }else{

            if(auth::check() and OwnerHelpers::company_type != auth::user()->owner_type){
                $user_activity = [];
                foreach(auth::user()->owner->qualification as $data){
                    $user_activity[] = $data->activity_id;
                }
                $activity = (OwnerHelpers::jobs)::where("state",0)
                    ->where("end_date",">", date("Y-m-d"))
                    ->whereIn("activity_id", $user_activity)
                    ->inRandomOrder()->limit(12)->get();
                $activity1 = (OwnerHelpers::jobs)::where("state",0)
                    ->where("end_date",">", date("Y-m-d"))
                    ->where("show_by_activity", "0")
                    ->inRandomOrder()->limit(12)->get();
            }                
            else
                $activity = (OwnerHelpers::jobs)::where("state",0)
                    ->where("end_date",">", date("Y-m-d"))
                    ->inRandomOrder()->limit(12)->get();
        }
            
        
        if(!auth::check())
            return view("jobs.find-job",[
                "activities" => (OwnerHelpers::activity)::all(),
                "jobs" => $activity,
                "jobs1" => [],
                "is_company" => false,
                "user_find_company" => false,
            ]);
        else
            if( OwnerHelpers::company_type != auth::user()->owner_type)
                return view("jobs.find-job",[
                    "activities" => (OwnerHelpers::activity)::all(),
                    "jobs" => $activity,
                    "jobs1" => $activity1,
                    "is_company" => false,
                    "user_find_company" => false,
                ]); 
            else 
                return view("jobs.find-seeker",[                
                    "seeker" => [],
                ]);
            
    }
    
    public function search_jobs(Request $request)
    {
        $is_company = false;
        $user_find_company = false;
        if($request->filter_type == "seeker"){
            $activity = (OwnerHelpers::user)::where("owner_type",OwnerHelpers::seeker_type)
            ->Where("name","like", "%". $request->text_filter."%")
            ->inRandomOrder()->limit(20)->get();
            $is_company = true;
        }else{
            $user_activity = [];
            if(auth::check()){
                foreach(auth::user()->owner->qualification as $data)
                    $user_activity[] = $data->activity_id;

                $activity = (OwnerHelpers::jobs)::where("state",0)
                ->where("end_date",">", date("Y-m-d"))
                ->where("activity_id", $request->activity_id)
                ->whereIn("activity_id", $user_activity)
                ->where("show_by_activity", '1')
                ->inRandomOrder()->limit(20)->get();
                $activity1 = (OwnerHelpers::jobs)::where("state",0)
                ->where("end_date",">", date("Y-m-d"))
                ->where("activity_id", $request->activity_id)
                ->where("show_by_activity", '0')
                ->inRandomOrder()->limit(20)->get();

            }
            else{
                $activity1 =[];
                $activity = (OwnerHelpers::jobs)::where("state",0)
                ->where("end_date",">", date("Y-m-d"))
                ->where("activity_id", $request->activity_id)
                ->inRandomOrder()->limit(20)->get();
            }
            
            if($request->filter_type != "seeker"){
                    if(!isset($activity[0]) and $request->text_filter != '' and $request->text_filter != " ")
                    {
                       if(auth::check()){
                            $activity = (OwnerHelpers::jobs)::where("state",0)
                            ->where("end_date",">", date("Y-m-d"))
                            ->Where("job_title","like", "%". $request->text_filter."%")
                            ->whereIn("activity_id", $user_activity)
                            ->where("show_by_activity", '1')
                            ->inRandomOrder()->limit(20)->get();
                            $activity1 = (OwnerHelpers::jobs)::where("state",0)
                            ->where("end_date",">", date("Y-m-d"))
                            ->Where("job_title","like", "%". $request->text_filter."%")
                            ->where("show_by_activity", '0')
                            ->inRandomOrder()->limit(20)->get();
                       }else{
                            $activity = (OwnerHelpers::jobs)::where("state",0)
                            ->where("end_date",">", date("Y-m-d"))
                            ->Where("job_title","like", "%". $request->text_filter."%")
                            ->inRandomOrder()->limit(20)->get();
                       }
                    }
            }

            
                if(!isset($activity[0]) and $request->text_filter != '' and $request->text_filter != " ")
                {
                    $activity = (OwnerHelpers::user)::where("owner_type",OwnerHelpers::company_type)
                    ->Where("name","like", "%". $request->text_filter."%")
                    ->inRandomOrder()->limit(20)->get();
                    $user_find_company = true;
                }

            
        }
        // dd($activity);
        if($is_company != true)
            return view("jobs.find-job",[
                "activities" => (OwnerHelpers::activity)::all(),
                "jobs" => $activity,
                "jobs1" => $activity1,
                "is_company" => $is_company,
                "user_find_company" => $user_find_company,
                ]);
        else
            return view("jobs.find-seeker",[                
                "seeker" => $activity,               
            ]);
    }
    public function seekerIndexJobsById($job_id){
        $job = (OwnerHelpers::jobs)::where("state",0)->where("id",$job_id)->first();        
        if(isset($job)){
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
        return redirect()->back();
    }
    public function my_job_application(){
        $job_seeker = [];
        if(Auth::user()->owner_type != OwnerHelpers::company_type){            
            $job_seeker = (OwnerHelpers::job_seekers)::where("seeker_id", Auth::user()->owner_id)->
            whereHas("job", function($query){
                $query->where("state",0);
            })->get();            
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
                $seeker =  (OwnerHelpers::seeker_type)::find($job_seeker->seeker_id);
                $sms = (OwnerHelpers::messages);
                $sms = new $sms;
                $sms->from = $seeker->user[0]->id;
                $sms->to =  $seeker->user[0]->id;
                $sms->message = "A empresa ".auth::user()->name." está analisando o seu perfil, aproveita e personalize-o";
                $sms->title = "revisão do perfil";
                $sms->sent_date = date("Y-m-d");
                $sms->viewed = "0";
                $sms->save();                  
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
        $jobs_activity = (OwnerHelpers::jobs)::where("id", $job_id)->first()->activity_id;
        
        $job_seeker = (OwnerHelpers::job_seekers)::where("job_id", $job_id)->get();  
        $seeker = [];
        $seeker1 = [];
        foreach($job_seeker  as $job){
            $found = false;
            foreach($job->seeker->qualification as $qualification){
                if($found == false  and $qualification->activity_id == $jobs_activity){
                    $seeker[] = $job->seeker_id;
                    $found = true;
                    break;
                }
            }
        }
        foreach($job_seeker  as $job){
            if(!in_array($job->seeker_id, $seeker))
                $seeker1[] = $job->seeker_id;            
        }
        
        $job_seeker = (OwnerHelpers::job_seekers)::where("job_id", $job_id)->whereIn("seeker_id",$seeker)->get(); 
        $job_seeker1 = (OwnerHelpers::job_seekers)::where("job_id", $job_id)->whereIn("seeker_id",$seeker1)->get(); 
        
      
        return view("company.jobs.application-list",[
            "job_seeker" => $job_seeker,
            "job_seeker1" => $job_seeker1,
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
            "show_by_activity" => "required",
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
            $jobs->show_by_activity = $request->show_by_activity;
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
