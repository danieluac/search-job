@extends('layouts.app')

@section("page_title","Resume - ")
@section('content')

<div class="container-fluid p-4">
    <div class="row">   
    <div class="col-md-8 mx-auto">
                    @include('components.messages')
            </div>   
       <div class="col-md-12 job_card">
            <div class="card col-md-10 p-0 mb-4 m-auto border-0 ">
                <div class="card-body text-white bg-white border-none p-1 pt-1">
                    <a href="{{ URL::previous() }}" class="btn pull-left m-0 p-1">
                        <i class="fa fa-arrow-left text-white rounded-circle bg-info p-3"></i>
                    </a>
                    <a href="#" class="btn pull-right m-0 p-1" onclick='printBy("#printable")'>
                        <i class="fa fa-print text-white rounded-circle bg-primary p-3"></i>
                    </a>
                   @if($job_seeker_id != 0 )
                        @if(verifica_selecao($job_seeker_id) == 0)
                            <a href="#" class="btn pull-right m-0 p-1"
                            onclick="event.preventDefault();document.getElementById('select_seekerform').submit();">
                                <i class="fa fa-check text-white rounded-circle bg-success p-3"></i>
                                </a>
                                <form id="select_seekerform" action="{{ route('select_seeker',[$job_seeker_id]) }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                        @else
                            <a href="#" class="btn pull-right m-0 p-1"
                            onclick="event.preventDefault();document.getElementById('select_seekerform').submit();">
                                <i class="fa fa-trash text-white rounded-circle bg-danger p-3"></i>
                                </a>
                                <form id="select_seekerform" action="{{ route('unselect_seeker',[$job_seeker_id]) }}" method="POST" class="d-none">
                                                @csrf
                                        </form>
                        @endif
                   @endif 

                    <div class="px-5" id="printable">
                        <div class="row">
                       
                        <div class="col-8">
                           
                           <h4 class="  text-left mt-3 mx-auto text-dark ">
                                <span class="font-lb m-0 text-uppercase "> {{ $seeker->user[0]->name??""}}</span> <br>
                                    <small class="fz-14 m-0 font-lb" >Nascido aos {{ dateTransform($seeker->date_birth??'',"/")}} ({{ (date("Y")-dateTransform($seeker->date_birth??'',"Y"))}})</small> 
                                    <br>
                                    <small class="fz-14 m-0 font-lb">  
                                    <i class="fa fa-envelope text-black"></i>  {{ $seeker->email??""}} - &nbsp; &nbsp; &nbsp; 
                                    <i class="fa fa-phone text-black"></i>  (+244) {{ $seeker->telephone??""}}</small>
                            </h4>
                        </div>
                        <div class="col-4 pt-3 text-right">
                            @if(isset($seeker->user[0]->foto) and $seeker->user[0]->foto != null)
                                <img id='imgFotoP' src="{{url($seeker->user[0]->foto)}}" style="width:150px;height:150px;border-radius: 10px;" class="mb-3" alt=""/>
                            @endif
                        </div>
                        </div>
                            <hr>

                        <p class="text-dark">
                        {{ $seeker->description??""}}
                        </p>
                        <br>
                        <h6 class="text-uppercase text-dark font-lb">Educação</h6>
                        <hr>
                        @foreach($seeker->qualification as $data)
                            <li class="list-group-item bg-light" style="">                           
                                @if($data->status =="attended")
                                    
                                    <p class="m-0"> 
                                    <i class="fa fa-institution text-info"></i> 
                                    <strong>{{$data->place_degree}}</strong>
                                    </p>
                                    <p class="m-0">
                                        <i class="fa fa-graduation-cap text-info "></i> 
                                        <small>{{$data->degree->name}} : {{$data->course}}</small>

                                    </p>
                                    <p class="m-0"><i class="fa fa-history text-info"></i> <small> Luanda, {{ $data->end_year}}</small></p>
                                
                                    
                                @else 
                                    <p class="m-0"> 
                                        <i class="fa fa-institution text-info"></i> 
                                        <strong>{{$data->place_degree}}</strong>
                                    </p>
                                    <p class="m-0">
                                            <i class="fa fa-graduation-cap text-info "></i> 
                                            <small> {{$data->degree->name}} : {{$data->course}}</small>
                                    </p>
                                    <p class="m-0"> <i class="fa fa-history text-info"></i> <small> Desde {{ $data->issue_year}} ate agora </small></p>
                                @endif
                            </li>
                        @endforeach
                        <h6 class="text-uppercase text-dark font-lb">Competências</h6>
                        <hr>
                        @foreach($seeker->skill as $data)
                            <li class="list-group-item">
                        
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
                        <h6 class="text-uppercase text-dark font-lb">Experiências</h6>
                        <hr>
                        @foreach($seeker->expirience()->orderBy("status","asc")->get() as $data)
                            <li class="list-group-item">
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
                                        <small>Luanda, {{dateTransform($data->start_date,"/")}} - {{ dateTransform($data->end_date,"/")}}</small>
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
                                        <small> Desde {{dateTransform($data->start_date,"/")}} - ate agora</small>
                                    </p>
                                    <p class="m-0">
                                        &nbsp;&nbsp; <small>{{$data->description}} </small>
                                    </p>
                                @endif
                            </li>
                        @endforeach                    
                    </div>
                </div>
               
            </div> 
            
        </div>
    </div>

</div>

@endsection
@section("scripts")

<script>
    function printBy(selector){
        var $app = $("#app");
        var $print = $(selector)
            .clone()
            .addClass('print')
            .prependTo('body');
            $("<body>").hide();
        $app.hide();
        // Stop JS execution
        window.print();
        // Remove div once printed
        $print.remove();
        $app.show();
    }
</script>
@endsection 