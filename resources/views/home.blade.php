@extends('layouts.app')
@section("page_title","Dashboard")
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <form id="addFoto-form" action="" method="POST" class="" enctype="multipart/form-data">
                                        @csrf
                                       
                                           
                                        <input required="" type="file" hidden="" name="foto" hidde="" id="fotoPerfil">
                                        <label for="fotoPerfil">
                                        @if(auth::user()->foto != null)
                                            <img id='imgFotoP' src="{{url(auth::user()->foto)}}" style="width:150px;height:150px;border-radius: 10px;" class="mb-3" alt=""/>
                                        @else
                                            <img id='imgFotoP' src="/img/user1.png" style="width:150px;height:150px;border-radius: 10px;" class="mb-3" alt=""/>
                                        @endif
                                        <p>{{ __('Adicione ou altere sua foto') }}</p>
                                        </label>

                                        <input required="" type="hidden" value="{{auth::user()->id}}" name="user_id" hidde="" id="user_id">
                                        <!-- <button class="btn btn-primary" type="submit">Alterar</button> -->
                                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section("scripts")

<script>
   $(function(){
       $("input[type='file'], #fotoPerfil").change(function(event){
        document.getElementById("addFoto-form").submit();
       })
   });
</script>
@endsection 