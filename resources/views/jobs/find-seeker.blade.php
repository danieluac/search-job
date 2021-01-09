@extends('layouts.app')

@section("page_title","Procure por candidatos")
@section('content')

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card border-0">
                <form action="{{route('search_jobs')}}" method="Post">
                    @method("POST")
                    @csrf
                    <div class="row p-4 pt-4 pb-5">
                        <div class="col-md-6">
                            <label for="">Pesquisar</label>
                            <input name="text_filter" type="text" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                                    <label for="activity_id">Área funcional</label>
                            <select class="form-control" name="activity_id" id="activity_id" required="">
                                <option selected disabled>Selecione: </option>
                                @foreach($activities as $data)
                                <option value="{{$data->id}}">{{$data->name}}</option>
                                @endforeach
                            </select>
                                </div>
                        <div class="col-md-12 pt-3">
                            <button type="submit" class="btn btn-app pull-right"> <i class="fa fa-search"></i> Procurar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

       <div class="col-md-12 job_card">
            <div class="row mt-0"> 
               
                @foreach($jobs as $data)
                <div class="col-md-4 mb-3">
                    <div class="card border-1 border-color ">
                        <li class="list-group-item text-white pb-1">
                        
                            <p class="m-0 ">  
                                       <span class="font-lb">{{$data->company->name}}</span>
                                    </p>
                                    <p class="m-0"> 
                                        Cargo :  <span class="font-lb">{{$data->job_title}}</span>
                                    </p>
                                    <p class="m-0"> 
                                        Área funcional :  <span class="font-lb">{{$data->activity->name}}</span>
                                    </p>
                                    <p class="m-0"> 
                                        Nº de vaga :  <span class="font-lb">{{$data->job_number}}</span> | 
                                        Candidaturas :  <span class="font-lb">{{isset(Auth::user()->owner_id)?count_candidatura($data->id) : 0}}</span>
                                    </p>
                                    <p class="m-0"> 
                                        <small>{{$data->job_location}}</small>
                                    </p> 
                                    @if(isset(Auth::user()->owner_id))
                                        @if(verifica_candidatura(Auth::user()->owner_id, $data->id))
                                            <a href="{{route('seekerIndexJobsById',[$data->id])}}" class=" btn btn-info mb-2 mt-3 pull-right">
                                                    Inscrito
                                            </a>
                                        @else 
                                            <a href="{{route('seekerIndexJobsById',[$data->id])}}" class=" btn btn-success mb-2 mt-3 pull-right">
                                                    Candidate-se
                                            </a>
                                        @endif
                                    @else
                                    <a href="{{route('login')}}" class=" btn btn-success mb-2 mt-3 pull-right">
                                                    Candidate-se
                                    </a>
                                    @endif
                                    
                                                        
                        </li>

                    </div>
                </div>        
            @endforeach            
            </div>
        </div>
    </div>

</div>

@endsection