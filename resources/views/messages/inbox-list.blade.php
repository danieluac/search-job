@extends('layouts.app')

@section("page_title","Messagens")
@section('content')

<div class="container p-4 bg-white mt-3 mx-auto">
    <div class="row">
        <div class="col-md-2 mb-4 border-right">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active text-dark" aria-current="page" href="{{route('index_inbox')}}">
                    <i class="fa fa-inbox"></i>
                    @if($active == "inbox")
                        <strong>  Recebidos </strong>
                    @else
                        Recebidos
                    @endif
                    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="{{route('index_sent')}}">
                        <i class="fa fa-location-arrow"></i>
                        @if($active == "sent")
                            <strong>  Enviados </strong>
                        @else
                            Enviados
                        @endif
                        
                    </a>
                </li>
            </ul>
        </div>

       <div class="col-md-10">
            <table class="table table-borderless">
                <tbody>
                    @foreach($sms as $data)
                        @if($data->viewed == "0" and $active != "sent")
                            <tr>
                                <th class="py-0">
                                    <a class="text-dark" href="{{route('view_inbox', [$data->id])}}">
                                        {{$data->title}}
                                        &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <small class='pull-right'>
                                            {{dateTransform($data->sent_date,"/")}}
                                        </small>
                                    </a>
                                </th>
                            </tr>
                        @else
                            <tr>
                                <td class="py-0">
                                    <a class="text-dark" href="{{route('view_inbox', [$data->id])}}">
                                        {{$data->title}}
                                        &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <small class='pull-right'>
                                        {{dateTransform($data->sent_date,"/")}}
                                        </small>
                                    </a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
     
    </div>

</div>

@endsection