@extends('layouts.app')

@section("page_title","Registo de empresa")
@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
    <div class="col-md-7 m-auto">
        <a href="{{ route('register') }}" class="btn btn-app btn-lg ">  Candidato?</a>

            <div class="card mt-5">                
                <div class="card-body">
                    <form class="row" method="POST" action="{{ route('register') }}">
                        @csrf
                        <input type="hidden" class="form-control" name="type" value="Company"/>
                        <div class="form-group col-md-6">   
                            <label for="name" class="">{{ __('Nif') }}</label>
                                <input id="name" type="text" class="form-control @error('nif') is-invalid @enderror" name="nif" value="{{ old('nif') }}" required autocomplete="nif" autofocus>

                                @error('nif')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">   
                            <label for="name" class="">{{ __('Nome') }}</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="">{{ __('Sector de actividade') }}</label>
                                <select required="" class="form-control @error('activity_id') is-invalid @enderror" name="activity_id" id="activity_id">
                                    <option selected="" disabled="">Selecione o sector</option>    
                                @foreach($activity::all() as $act)
                                        <option value="{{$act->id}}">{{$act->name}}</option>
                                    @endforeach
                                </select>
                               
                                @error('activity_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>     
                            <div class="col-md-6">
                                <label for="email" class="">{{ __('Email') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                            
                            <div class="col-md-6">
                                <label for="password" class="">{{ __('Senha') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>                            
                            <div class="col-md-6">
                                <label for="password-confirm" class="">{{ __('Confirme a senha') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-success pull-right">
                                    {{ __('Criar conta') }}
                                </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
