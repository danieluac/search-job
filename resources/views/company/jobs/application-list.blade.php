@extends('layouts.app')

@section("page_title","Lista de candidatos - ")
@section('content')

<div class="container-fluid p-4">
    <div class="row">      
       <div class="col-md-10 m-auto job_card bg-light p-2 shadow-none bg-dark">
       <table class="table table-dark table-striped">
                            <thead>
                            <tr>
                                <tr>
                                    <th>Nome do candidato</th>
                                    <th>Curriculo</th>
                                    <th>Messagem</th>
                                    <th>#</th>
                                </tr>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($job_seeker as $data)
                                <tr>
                                    <td> {{$data->seeker->user[0]->name}}</td>                                   
                                    <td>
                                    <a href="{{route('seeker_cv',[$data->seeker->id,$data->id])}}" class="border-0 btn btn-primary">
                                        <i class="fa fa-eye"></i> Ver CV</a>
                                        
                                    </td>
                                    <td> 
                                        <a href="{{route('write_message',[$data->seeker->user[0]->id,$data->job->job_title])}}" class="border-0 btn btn-primary">
                                            <i class="fa fa-envelope"></i></a>
                                    </td>      
                                    <td>
                                        @if($data->status == "selected")
                                            <span class="badge-success p-2 rounded"> {{$data->status}}</span>
                                        @else 
                                            <span class="badge-info p-2 rounded"> {{$data->status}}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($job_seeker1 as $data)
                                <tr>
                                    <td> {{$data->seeker->user[0]->name}}</td>                                   
                                    <td>
                                    <a href="{{route('seeker_cv',[$data->seeker->id,$data->id])}}" class="border-0 btn btn-primary">
                                        <i class="fa fa-eye"></i> Ver CV</a>
                                        
                                    </td>
                                    <td> 
                                        <a href="{{route('write_message',[$data->seeker->user[0]->id,$data->job->job_title])}}" class="border-0 btn btn-primary">
                                            <i class="fa fa-envelope"></i></a>
                                    </td>      
                                    <td>
                                        @if($data->status == "selected")
                                            <span class="badge-success p-2 rounded"> {{$data->status}}</span>
                                        @else 
                                            <span class="badge-info p-2 rounded"> {{$data->status}}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                </table>
        </div>
    </div>

</div>

@endsection
@section("styles")
    <!-- <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet"> -->
@endsection
@section('scripts')
    <!-- <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script> -->

@endsection