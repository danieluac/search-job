@extends('layouts.app')

@section("page_title","Procure por vagas de trabalho")
@section('content')

<div class="container-fluid p-4">
    <div class="row">      
       <div class="col-md-12 job_card">
            <div class="text-center">
                    @include('components.messages')
            </div>
            <div class="row mt-0"> 
            @foreach($job_seeker as $data)
                <div class="col-md-4 mb-3">
                    <div class="card border-1 border-color ">
                        <li class="list-group-item text-white pb-1">
                        
                            <p class="m-0 ">  
                                        Titulo : <span class="font-lb">{{$data->job->job_title}}</span>
                                    </p>
                                    <p class="m-0"> 
                                        Derpatamento :  <span class="font-lb">{{$data->job->activity->name}}</span>
                                    </p>
                                    <p class="m-0"> 
                                        Nº de candidatos :  <span class="font-lb">{{$data->job->job_number}}</span> |
                                        Oferta aberta até: <span class="font-lb">{{dateTransform($data->job->end_date,"/")}}</span>
                                    </p>                                   
                                    <a href="{{route('seekerIndexJobsById',[$data->job->id])}}" class=" btn btn-light mb-2 mt-3 ">
                                            <i class="fa fa-eye"></i>
                                    </a>
                                                        
                        </li>

                    </div>
                </div>             
            @endforeach
            </div>
        </div>
    </div>

</div>

@endsection