@extends('layouts.app')

@section("page_title","Procure por vagas de trabalho")
@section('content')

<div class="container-fluid p-4">
    <div class="row">      
       <div class="col-md-12 job_card">
            <div class="col-7 m-auto text-center">
                    @include('components.messages')
            </div>
            <div class="card col-md-7 p-0 mb-4 m-auto ">
                <div class="card-header bg-dark text-white p-2 pl-4">
                    <p class="p-0 m-0">Cargo: <strong>{{$job->job_title}}</strong>
                        <a href="{{route('skills_create')}}" class="btn p-0 pl-2 pr-2 m-0 btn-success pull-right">
                            Aplicar

                           
                        </a>
                    </p>                
                </div>
                <div class="card-body bg-dark text-white">
                    <div>
                    <h6 class="m-0 mt-3 ">
                            Vagas : <small class="pl-3">{{$job->job_number}}</small> 
                    </h6>
                    <h6 class="m-0 mt-3 ">
                    Oferta aberta até: <small class="pl-3">{{$job->end_date}}</small> 
                    </h6>  
                    <h6 class="m-0 mt-3 ">
                            Titulo Academico : <small class="pl-3">{{$job->degree->name}}</small> 
                    </h6>                                           
                    <div class="drecription">
                            {!! $job->job_description !!}
                    </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

</div>

@endsection