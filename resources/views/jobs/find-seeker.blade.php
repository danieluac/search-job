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
                        <div class="col-md-12">
                            <label for="">Pesquisar</label>
                            <input name="text_filter" type="text" class="form-control"/>
                            <input name="filter_type" value="seeker" type="hidden" class="form-control"/>
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
               
                @foreach($seeker as $data)
                <div class="col-md-4 mb-3">
                    <div class="card border-1 border-color ">
                        <li class="list-group-item text-white pb-1">
                        
                            <p class="m-0 ">  
                                       <span class="font-lb">{{$data->name}}</span>
                                    </p>
                                    <p class="m-0"> 
                                        Formação em :  <span class="font-lb">{{$data->owner->qualification[0]->course}}</span>
                                    </p>
                                    <p class="m-0"> 
                                        Nivel :  <span class="font-lb">{{$data->owner->qualification[0]->degree->name}}</span>
                                    </p>
                                   <div class="btn-group pull-right">
                                   
                                   <a href="{{route('seeker_cv',[$data->id])}}" class=" btn btn-outline-primary text-white mb-2 mt-3 ">
                                                    CV
                                            </a>    
                                    <a href="{{route('write_message',[$data->id,' '])}}" class=" btn btn-outline-warning text-white mb-2 mt-3">
                                                    sms
                                            </a>   
                                   </div>                     
                                    
                                                        
                        </li>

                    </div>
                </div>        
            @endforeach            
            </div>
        </div>
    </div>

</div>

@endsection