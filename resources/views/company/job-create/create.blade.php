@extends('layouts.app')

@section('content')
<div class="container-fluid p-sm-3 p-md-5">
   <div class="col-md-6 m-auto">
   <div class="card">
        <div class="card-header">
            <p class="text-center m-0">
                <strong>Publique sua vaga</strong>
            </p>            
        </div>
        <div class="card-body">

            <form action="{{route('expirience_store')}}" method="post" >
            @method("POST")
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Titulo</label>
                        <input name="company_name" type="text" class="form-control">
                    </div>                                     
                    <div class="col-md-6 mt-3">
                            <label class="" for="status">Número de vagas</label>
                            <input name="company_name" type="number" class="form-control" />                       
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="degree_id">Titulo Academico</label>
                        <select class="form-control" name="degree_id" id="degree_id" required="">
                            <option selected disabled>Selecione: </option>
                           @foreach($degrees as $degree)
                           <option value="{{$degree->id}}">{{$degree->name}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="degree_id">Área de actividade</label>
                        <select class="form-control" name="degree_id" id="degree_id" required="">
                            <option selected disabled>Selecione: </option>
                           @foreach($activities as $degree)
                           <option value="{{$degree->id}}">{{$degree->name}}</option>
                           @endforeach
                        </select>
                    </div>
                        <div class="col-md-6 mt-3">
                            <label for="">Data de fim</label>
                            <input name="end_date" type="date" class="form-control">
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
 
</script>
@endsection