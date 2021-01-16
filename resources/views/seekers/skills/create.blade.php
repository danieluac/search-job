@extends('layouts.app')

@section('content')
<div class="container-fluid p-sm-3 p-md-5">
   <div class="col-md-6 m-auto">
   <div class="card">
        <div class="card-header">
            <p class="text-center">
                <strong>Competências</strong>
            </p>            
        </div>
        <div class="card-body">

            <form action="{{route('skills_store')}}" method="post" >
            @method("POST")
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Competência</label>
                        <input name="name" type="text" class="form-control">
                    </div>
                   
                    <div class="col-md-12 mt-3">
                        <label >Forma adquirida</label> <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input ckeck-work" type="radio" name="acquisition_option" id="acquisition_option" value="autodidact">
                            <label class="form-check-label" for="acquisition_option">Autodidacta</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input ckeck-work" type="radio" checked="" name="acquisition_option" id="acquisition_option1" value="institute">
                            <label class="form-check-label" for="acquisition_option1">Instituição</label>
                        </div>
                    </div>
                        <div id="end_dateDiv" class="col-md-12 mt-3">
                            <label for="">Local de aquisição</label>
                            <input name="acquisition_place" type="text" class="form-control">
                        </div>
                    <div class="col-md-12">
                        <label for="">Descrição</label>
                        <textarea name="description" type="text" class="form-control"></textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <button class="btn btn-primary pull-right"> 
                        <i class="fa fa-plus-circle"></i> Guardar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>  
   </div>  
   
</div>

@endsection

@section("scripts")
<script >
     $("#end_dateDiv").show();
 $(".ckeck-work").click(function(){

    if($(this).val() == "institute"){
        $("#end_dateDiv").show();
    }else if($(this).val() == "autodidact"){
        $("#end_dateDiv").hide();
    }
 })
</script>
@endsection