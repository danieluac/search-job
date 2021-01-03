@extends('layouts.app')
@section("page_title","Job - Procure e crie oportunidades de emprego")
@section('content')
        <div id="main">
            <div class=" pt-5 m-auto col-md-8 text-center">
            <div class="row">
                <div class=" col-md-12  mb-5">
                
                <div class=" p-3 pl-5 pr-5" style="background: none; border-radius:5px">
                            <a href="{{ route('find_jobs') }}" class="btn btn-success btn-lg p-2"> <i class="fa fa-search"></i> Encontre oportunidades de trabalho</a>
                        </div>
                </div>
                </div>
               <div class="row">
               <div class="col-md-6 " style="margin-bottom:20px">
                    <div class="">
                        <div class=" m-b-md shadow-sm p-3 pl-5 pr-5" style="background: rgba(0,0,0,.4); border-radius:5px">
                            <span> <i class="fa fa-cog text-white"></i></span>
                            <p class="text-white">Personalize seu curriculo para que recrutadores possam encontra-lo facilmente</p>
                            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg "> Crie Curriculos</a>
                        </div>
                    </div>
                </div>
                <br>
                <div class="col-md-6 " style="margin-bottom:20px">
                    <div class="">
                        <div class=" m-b-md shadow-sm p-3 pl-5 pr-5" style="background: rgba(0,0,0,.4); border-radius:5px">
                            <span> <i class="fa fa-cog text-white"></i></span>
                            <p class="text-white">Encontre os Candidatos que sua empresa precisa </p>
                            <a href="{{ route('company_registration') }}" class="btn btn-outline-light btn-lg ">  Encontre Curriculos</a>
                        </div>
                    </div>
                </div>
                
               </div>
            </div>
        </div>
        @endsection

@section("scripts")

<script >
 
</script>
@endsection