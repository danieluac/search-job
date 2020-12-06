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
            <div class="col-md-12">
                    @include('components.messages')
            </div>
            <form action="{{route('store_jobs')}}" method="post" >
            @method("POST")
            @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Titulo</label>
                        <input required="" name="job_title" value="{{old('job_title')}}" type="text" class="form-control">
                    </div>                                     
                    <div class="col-md-6 mt-3">
                            <label class="" for="status">Número de vagas</label>
                            <input required=""  name="job_number" value="{{old('job_number')}}" type="number" class="form-control" />
                            <input name="company_id" value="{{auth()->user()->owner_id}}" type="hidden" class="form-control" />                       
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="degree_id">Titulo Academico</label>
                        <select required="" class="form-control" value="{{old('degree_id')}}" name="degree_id" id="degree_id" required="">
                            <option selected disabled>Selecione: </option>
                           @foreach($degrees as $degree)
                           <option value="{{$degree->id}}">{{$degree->name}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="degree_id">Área de actividade</label>
                        <select required="" class="form-control" value="{{old('activity_id')}}" name="activity_id" id="degree_id" required="">
                            <option selected disabled>Selecione: </option>
                           @foreach($activities as $degree)
                           <option value="{{$degree->id}}">{{$degree->name}}</option>
                           @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                            <label for="">Data de fim</label>
                            <input required="" name="end_date" type="date" value="{{old('end_date')}}" class="form-control">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="">Municipio/Provincia de Localidade</label>
                        <input required="" name="job_location" value="{{old('job_location')}}" type="text" class="form-control">
                    </div>   
                    <div class="col-md-12">
                        <label for="">Descrição</label>
                        <textarea required="" name="job_description" value="{{old('job_description')}}" type="text" class="form-control"></textarea>
                    </div>
                    <div class="col-12 mt-3">
                        <button class="btn btn-success pull-right"> 
                        <i class="fa fa-plus-circle"></i> Publicar
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