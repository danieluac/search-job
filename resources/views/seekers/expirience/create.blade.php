@extends('layouts.app')

@section('content')
<div class="container-fluid p-sm-3 p-md-5">
   <div class="col-md-6 m-auto">
   <div class="card">
        <div class="card-header">
            <p class="text-center">
                <strong>Experiências</strong>
            </p>            
        </div>
        <div class="card-body">

            <form action="{{route('expirience_store')}}" method="post" >
            @method("POST")
            @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="">Empresa</label>
                        <input name="company_name" type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="">Cargo</label>
                        <input name="position" type="text" class="form-control">
                    </div>
                   
                    <div class="col-md-12 mt-3">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status" id="status" value="attended">
                            <label class="form-check-label" for="status">Trabalhou</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" checked="" name="status" id="status1" value="attending">
                            <label class="form-check-label" for="status1">Trabalhando</label>
                        </div>
                    </div>
                        <div class="col-md-6 mt-3">
                            <label for="">data de inicio</label>
                            <input name="start_date" type="date" class="form-control">
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="">data de fim</label>
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