@extends('layouts.app')


@section('content')

<div class="container-fluid p-sm-3 p-md-5">
   <div class="col-md-12 m-auto">
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
            <form action="{{route('profile_update')}}" method="post" >
            @method("POST")
            @csrf
                <div class="row">
                <div class="col-md-6 mt-3">
                        <label for="">Nome</label>
                        <input required="" disabled name="name" value="{{ $seeker->user[0]->name}}" type="text" class="form-control">
                    </div>       
                    <div class="col-md-6 mt-3">
                        <label for="">Email</label>
                        <input required="" disabled name="email" value="{{ $seeker->user[0]->email}}" type="text" class="form-control">
                    </div>        
                                                  
                    <div class="col-md-6 mt-3">
                            <label class="" for="status">Data Nascimento</label>
                            <input required=""  name="date_birth" value="{{ $seeker->date_birth}}" type="date" class="form-control" />
                            <input name="seeker_id" value="{{ $seeker->id}}" type="hidden" class="form-control" />                       
                    </div>                    
                    <div class="col-md-6 mt-3">
                            <label for="">Telefone</label>
                            <input required="" name="telephone" type="text" value="{{ $seeker->telephone}}" class="form-control">
                    </div>
                    
                    <div class="col-md-12 mt-3">
                        <label for="description">Sobre</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="10">{{ $seeker->description }}</textarea>
                    </div> 
                    <div class="col-12 mt-3">
                        <button class="btn btn-success pull-right"> 
                        <i class="fa fa-edit"></i> Actualizar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>  
   </div>  
   
</div>

@endsection

@section("styles")

@endsection
@section("scripts")
<script>

</script>
@endsection