@extends('layouts.app')

@section('content')
<div class="container-fluid p-sm-3 p-md-5">
   <div class="col-md-6 m-auto">
   <div class="card">
        <div class="card-header">
            <p class="text-center">
                <strong>Nível Académico</strong>
            </p>            
        </div>
        <div class="card-body">

            <form action="{{route('qualifications_store')}}" method="post" >
            @method("POST")
            @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Curso</label>
                        <input name="course" type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="">Escola/Instituição de ensino</label>
                        <input name="place_degree" type="text" class="form-control" required="" />
                    </div>
                    <div class="col-md-6">
                        <label for="degree_id">Nível</label>
                        <select class="form-control" name="degree_id" id="degree_id" required="">
                           @foreach($degrees as $degree)
                           <option value="{{$degree->id}}">{{$degree->name}}</option>
                           @endforeach
                        </select>
                    </div>
                   
                    <div class="col-md-6 mt-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input ckeck-work" type="radio" checked="" name="status" id="status" value="attended">
                            <label class="form-check-label" for="status">Frequentou</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input ckeck-work" type="radio"  name="status" id="status1" value="attending">
                            <label class="form-check-label" for="status1">Frequentando</label>
                        </div>
                    </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Ano de inicio</label>
                            <input name="issue_year" type="number" min="1975" max="{{date('Y')}}" required="" class="form-control">
                        </div>
                        <div id="end_dateDiv" class="col-md-6 mt-3">
                            <label for="">Ano de fim</label>
                            <input name="end_year" type="number" min="1975" max="{{date('Y')+10}}"  class="form-control">
                        </div>
                        <div class="col-md-12">
                        <label for="activity_id">Área de aplicação</label>
                        <select class="form-control" name="activity_id" id="activity_id" required="">
                            <option value="" selected disabled>Selecione: </option>
                           @foreach($activities as $activity)
                           <option value="{{$activity->id}}">{{$activity->name}}</option>
                           @endforeach
                        </select>
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
   // $("#end_dateDiv").hide();
   $(".ckeck-work").click(function(){

if($(this).val() == "attended"){
    $("#end_dateDiv").show();
}else if($(this).val() == "attending"){
    $("#end_dateDiv").hide();
}
})
</script>
@endsection