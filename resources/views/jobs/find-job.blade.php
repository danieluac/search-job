@extends('layouts.app')

@section("page_title","Procure por vagas de trabalho")
@section('content')

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="card border-0">
                <form action="">
                    <div class="row p-4 pt-4 pb-5">
                        <div class="col-md-6">
                            <label for="">Pesquisar</label>
                            <input type="text" class="form-control"/>
                        </div>
                        <div class="col-md-6">
                                    <label for="degree_id">Área funcional</label>
                            <select class="form-control" name="degree_id" id="degree_id" required="">
                                <option selected disabled>Selecione: </option>
                                @foreach($activities as $degree)
                                <option value="{{$degree->id}}">{{$degree->name}}</option>
                                @endforeach
                            </select>
                                </div>
                        <div class="col-md-12 pt-3">
                            <button type="button" class="btn btn-app pull-right"> <i class="fa fa-search"></i> Procurar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

       <div class="col-md-12 job_card">
            <div class="row mt-0"> 
                <div class="col-md-4 mb-3">
                    <div class="card border-1 border-color ">
                        <li class="list-group-item text-white pb-1">
                        
                            <p class="m-0 ">  
                                        Empresa : <span class="font-lb">kadima Techonoly</span>
                                    </p>
                                    <p class="m-0"> 
                                        Vaga :  <span class="font-lb">Web developer</span>
                                    </p>
                                    <p class="m-0"> 
                                        Nº de vaga :  <span class="font-lb">3</span>
                                    </p>
                                    <p class="m-0"> 
                                        <small>Luanda, Angola</small>
                                    </p> 
                                    <a href="" class=" btn btn-outline-app mb-2 mt-3 btn-block">
                                            Candidate-se
                                    </a>
                                                        
                        </li>

                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-1 border-color ">
                        <li class="list-group-item text-white pb-1">
                        
                            <p class="m-0 ">  
                                        Empresa : <span class="font-lb">kadima Techonoly</span>
                                    </p>
                                    <p class="m-0"> 
                                        Vaga :  <span class="font-lb">Web developer</span>
                                    </p>
                                    <p class="m-0"> 
                                        Nº de vaga :  <span class="font-lb">3</span>
                                    </p>
                                    <p class="m-0"> 
                                        <small>Luanda, Angola</small>
                                    </p> 
                                    <a href="" class=" btn btn-outline-app mb-2 mt-3 btn-block">
                                            Candidate-se
                                    </a>
                                                        
                        </li>

                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-1 border-color ">
                        <li class="list-group-item text-white pb-1">
                        
                            <p class="m-0 ">  
                                        Empresa : <span class="font-lb">kadima Techonoly</span>
                                    </p>
                                    <p class="m-0"> 
                                        Vaga :  <span class="font-lb">Web developer</span>
                                    </p>
                                    <p class="m-0"> 
                                        Nº de vaga :  <span class="font-lb">3</span>
                                    </p>
                                    <p class="m-0"> 
                                        <small>Luanda, Angola</small>
                                    </p> 
                                    <a href="" class=" btn btn-outline-app mb-2 mt-3 btn-block">
                                            Candidate-se
                                    </a>
                                                        
                        </li>

                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>

@endsection