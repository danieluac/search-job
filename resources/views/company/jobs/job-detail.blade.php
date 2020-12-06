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
                    <p class="p-0 m-0">Vaga: <strong>{{$job->job_title}}</strong>
                        <a href="{{route('skills_create')}}" class="btn p-0 pl-2 pr-2 m-0 btn-success pull-right">
                            Aplicar

                           
                        </a>
                    </p>                
                </div>
                <div class="card-body bg-dark text-white">
                    <div>
                    <h5 class="m-0 mt-3 ">
                            Titulo Academico
                        </h5>
                        <p class="pl-3">{{$job->degree->name}}</p>
                        <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                        Ullam aut suscipit doloribus expedita! Distinctio nemo non <br>
                        architecto nulla, culpa labore? Molestias voluptates quas quis nostrum quae impedit eligendi, voluptatum error!
                        </p>
                        <h5 class="m-0 mt-3">
                            Comptências
                        </h5>
                        <ul>
                            <li>POO</li>
                            <li>Laravel</li>
                            <li>Blade</li>
                            <li>HTML5/CSS/SCSS</li>
                            <li>Inglês escrito</li>
                        </ul>  
                        <h5 class="m-0 mt-3">
                            Função a Desepenhar
                        </h5>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. 
                            Ullam aut suscipit doloribus expedita! Distinctio nemo non
                            architecto nulla, culpa labore? Molestias voluptates quas quis nostrum quae impedit eligendi, voluptatum error!
                        </p>

                   
                    </div>
                </div>
            </div> 
        </div>
    </div>

</div>

@endsection