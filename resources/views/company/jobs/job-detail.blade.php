@extends('layouts.app')

@section("page_title","Detalhe da vaga de trabalho - ".$job->job_title)
@section('content')

<div class="container-fluid p-4">
    <div class="row">      
       <div class="col-md-12 job_card">
            <div class="col-7 m-auto text-center">
                @if(auth::user()->owner_type != App\Helpers\OwnerHelpers::company_type )
                    @include('components.messages')
                @endif
            </div>
            <div class="card col-md-7 p-0 mb-4 m-auto ">
                <div class="card-header bg-dark text-white p-2 pl-4">
                    <p class="p-0 m-0">Cargo: <strong>{{$job->job_title}}</strong>
                        @if(auth::user()->owner_type != App\Helpers\OwnerHelpers::company_type )
                            <a href="{{route('apply_jobs')}}" class="btn p-0 pl-2 pr-2 m-0 btn-success pull-right"
                            onclick="event.preventDefault();
                                                     document.getElementById('apply_job_form').submit();">
                                Aplicar                           
                            </a>
                            <form id="apply_job_form" action="{{ route('apply_jobs') }}" method="POST" class="d-none">
                                        @csrf
                                <input type="hidden" name="seeker_id" value="{{auth::user()->owner_id}}"/>
                                <input type="hidden" name="job_id" value="{{$job->id}}"/>
                            </form>
                        @else
                            <a href="{{route('edit_jobs',[$job->id])}}" class=" btn btn-primary mb-2 m-1 text-white pull-right">
                                <i class="fa fa-edit"></i> Editar
                            </a>
                            <a href="{{route('close_jobs',[$job->id])}}" class=" btn btn-danger mb-2 m-1 text-white pull-right">
                                <i class="fa fa-trash"></i> Fechar
                            </a>
                        @endif
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