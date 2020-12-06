@extends('layouts.app')

@section("page_title","Perfil do candidato")
@section('content')
<div class="container-fluid p-sm-3 p-md-5">
  
    <div class="row">
       <div class="col-md-4 col-sm-12 mb-4" >
            <div class="card col-md-12 p-0 mb-4 m-auto  " style="height: 100vh">
                <div class="card-header bg-dark text-white">
                    <p><strong>Status</strong>
                        <a href='' class="btn btn-outline-light pull-right">
                            <i class="fa fa-edit"></i>
                        </a>
                    </p>
                
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                    <h4 class="m-0"><strong>{{auth::user()->name}}</strong></h4>
                    <strong> Nascimento </strong><small></small>
                    <p class="m-0"> <small> {{auth::user()->owner->date_birth}} </small> </p>
                    <strong> Email </strong>
                    <p class="m-0"> <small> {{auth::user()->owner->email}} </small> </p>
                    <strong> Telefone </strong>
                    <p class="m-0"> <small> {{auth::user()->owner->telephone}} </small> </p>
                    
                    <strong> Línguas </strong>
                    <p class="p-0 m-0"> <small> Inglês (médio) </small> </p>
                   
                    <strong> Sobre </strong>
                    <p class="m-0"> <small>
                        {{auth::user()->owner->description}}
                    </small> </p>
                    </li>
                </ul>
            </div> 
       </div>
       <div class="col-md-8">
            <div class="card col-md-12 p-0 mb-4 m-auto ">
                <div class="card-header p-1 pl-3 m-0  bg-dark text-white">
                <p class="p-0 m-0 "><strong>Expiriências</strong>
                        <a href="{{route('expirience_create')}}" class="btn p-0 pl-2 pr-2 m-0  btn-outline-light pull-right">
                        <i class="fa fa-plus-circle"></i>
                        </a>
                    </p>
                
                </div>
                <ul class="list-group list-group-flush">
                @foreach(auth::user()->owner->expirience()->orderBy("status","asc")->get() as $data)
                    <li class="list-group-item">
                        <a href="javascript:" class=" m-1 text-warning pull-right" onclick="event.preventDefault();
                                                     document.getElementById('destroy-expirience').submit();">
                                <i class="fa fa-trash"></i>
                        </a>
                        <form id="destroy-expirience" action="{{route('expirience_destroy',$data->id)}}" method="POST" >@csrf </form>
                        <a href="{{route('expirience_edit',$data->id)}}" class=" m-1 text-white pull-right">
                                <i class="fa fa-pencil"></i>
                        </a>
                       
                       
                    @if($data->status =="attended")
                        
                    <p class="m-0"> 
                            <i class="fa fa-institution text-white"></i> 
                            Empresa : <strong>{{$data->company_name}}</strong>
                        </p>
                        <p class="m-0"> 
                            <i class="fa fa-at text-white"></i>
                            Cargo :  <strong>{{$data->position}}</strong>
                        </p>
                        <p class="m-0"> 
                            <i class="fa fa-calendar text-white"></i> 
                            <small>Luanda, {{$data->start_date}} - {{ $data->end_date}}</small>
                        </p>
                        <p class="m-0">
                            &nbsp;&nbsp; <small>{{$data->description}} </small>
                        </p>                        
                    @else 
                         <p class="m-0"> 
                            <i class="fa fa-institution text-white"></i> 
                            Empresa : <strong>{{$data->company_name}}</strong>
                        </p>
                        <p class="m-0"> 
                            <i class="fa fa-at text-white"></i>
                            Cargo :  <strong>{{$data->position}}</strong>
                        </p>
                        <p class="m-0"> 
                            <i class="fa fa-calendar text-white"></i> 
                            <small> Desde {{$data->start_date}} - ate agora</small>
                        </p>
                        <p class="m-0">
                        &nbsp;&nbsp; <small>{{$data->description}} </small>
                        </p>
                    @endif
                    </li>
                @endforeach
                </ul>
            </div> 
            <br/>
            <div class="card col-md-12 p-0 mb-4 m-auto ">
                <div class="card-header p-1 pl-3 m-0 bg-dark text-white">
                    <p class="p-0 m-0"><strong>Qualificações academicas</strong>
                        <a href="{{route('qualifications_create')}}" class="btn p-0 pl-2 pr-2 m-0 btn-outline-light pull-right">
                        <i class="fa fa-plus-circle"></i>
                        </a>
                    </p>
                
                </div>
                <ul class="list-group list-group-flush">
                @foreach(auth::user()->owner->qualification()->orderBy("status","asc")->get() as $data)
                    <li class="list-group-item">
                    <a href="javascript:" class=" m-1 text-warning pull-right" onclick="event.preventDefault();
                                                     document.getElementById('destroy-qualifications').submit();">
                                <i class="fa fa-trash"></i>
                        </a>
                        <form id="destroy-qualifications" action="{{route('qualifications_destroy',$data->id)}}" method="POST" >@csrf </form>
                        <a href="" class=" m-1 text-white pull-right">
                                <i class="fa fa-pencil"></i>
                        </a>
                    @if($data->status =="attended")
                        
                        <p class="m-0"> 
                        <i class="fa fa-institution text-white"></i> 
                        <strong>{{$data->place_degree}}</strong>
                        </p>
                        <p class="m-0">
                            <i class="fa fa-graduation-cap text-white "></i> 
                            <small>Frequentou {{$data->degree->name}} : {{$data->course}}</small>

                        </p>
                        <p class="m-0"><i class="fa fa-history text-white"></i> <small> Luanda, {{ $data->end_year}}</small></p>
                    
                        
                    @else 
                        <p class="m-0"> 
                            <i class="fa fa-institution text-white"></i> 
                            <strong>{{$data->place_degree}}</strong>
                        </p>
                           <p class="m-0">
                                <i class="fa fa-graduation-cap text-white "></i> 
                                <small>Frequentando(a) {{$data->degree->name}} : {{$data->course}}</small>
                           </p>
                        <p class="m-0"> <i class="fa fa-history text-white"></i> <small> Desde {{ $data->issue_year}} ate agora </small></p>
                    @endif
                    </li>
                @endforeach
                </ul>
            </div> 
            <br/>
            <div class="card col-md-12 p-0 mb-4 m-auto ">
                <div class="card-header p-1 pl-3 m-0 bg-dark text-white">
                    <p class="p-0 m-0"><strong>Competências</strong>
                        <a href="{{route('skills_create')}}" class="btn p-0 pl-2 pr-2 m-0 btn-outline-light pull-right">
                        <i class="fa fa-plus-circle"></i>
                        </a>
                    </p>
                
                </div>
                <ul class="list-group list-group-flush">
                @foreach(auth::user()->owner->skill as $data)
                    <li class="list-group-item">
                    <a href="javascript:" class=" m-1 text-warning pull-right" onclick="event.preventDefault();
                                                     document.getElementById('destroy-skills').submit();">
                                <i class="fa fa-trash"></i>
                        </a>
                        <form id="destroy-skills" action="{{route('skills_destroy',$data->id)}}" method="POST" >@csrf </form>
                        <a href="" class=" m-1 text-white pull-right">
                                <i class="fa fa-pencil"></i>
                        </a>
                    @if($data->acquisition_option =="autodidact")
                        
                        <p class="m-0"> 
                        <i class="fa fa-certificate text-white"></i> 
                        <strong>{{$data->name}}</strong>
                        </p>
                        <p class="m-0">
                            <small>{{$data->description}}</small>

                        </p>
                    @else 
                        <p class="m-0"> 
                            <i class="fa fa-certificate text-white"></i> 
                            <strong>{{$data->name}}</strong>
                        </p>
                        <p class="m-0">
                            <i class="fa fa-institution text-white "></i> 
                            <small>{{$data->acquisition_place}}</small>
                        </p>
                        <p class="m-0">
                            
                            <small>{{$data->description}}</small>
                        </p>
                    @endif
                    </li>
                @endforeach
                </ul>
            </div> 
            <br/>
       </div>
    </div>
        
        
   
</div>

@endsection

@section("scripts")

<script >
 
</script>
@endsection