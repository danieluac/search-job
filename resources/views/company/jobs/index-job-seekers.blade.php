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
            @foreach($jobs as $data)
                <div class="col-md-4 mb-3">
                    <div class="card border-1 border-color ">
                        <li class="list-group-item text-white pb-1">
                        
                            <p class="m-0 ">  
                                        Titulo : <span class="font-lb">{{$data->job_title}}</span>
                                    </p>
                                    <p class="m-0"> 
                                        Derpatamento :  <span class="font-lb">{{$data->activity->name}}</span>
                                    </p>
                                    <p class="m-0"> 
                                        Nº de candidatos :  <span class="font-lb">{{$data->job_number}}</span>
                                    </p>                                   
                                    <a href="" class=" btn btn-light mb-2 mt-3 ">
                                            <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="" class=" btn btn-primary mb-2 mt-3 text-white">
                                    <i class="fa fa-edit"></i> Editar
                                    </a>
                                    <a href="{{route('close_jobs',[$data->id])}}" class=" btn btn-danger mb-2 mt-3 text-white">
                                    <i class="fa fa-trash"></i> Fechar
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