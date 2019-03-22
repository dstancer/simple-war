@extends('layout')

@section('title', 'War')

@section('content')

    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            @if(!empty($errorMessages))
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errorMessages as $message)
                            <li class="error">{!! $message !!}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

    @if(empty($errorMessages))
        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <h2>Battles</h2>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th colspan="4" class="bg-primary">Army 1</th>
                        <th colspan="4" class="bg-secondary">Army 2</th>
                    </tr>
                    <tr>
                        <th class="bg-info">Total</th>
                        <th>Level 1</th>
                        <th>Level 2</th>
                        <th>Level 3</th>
                        <th class="bg-info">Total</th>
                        <th>Level 1</th>
                        <th>Level 2</th>
                        <th>Level 3</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($war as $battle)
                        <tr>
                            <td class="bg-info">{{ count($battle['army1']['all']) }}</td>
                            <td>{{ count($battle['army1']['level1']) }}</td>
                            <td>{{ count($battle['army1']['level2']) }}</td>
                            <td>{{ count($battle['army1']['level3']) }}</td>
                            <td class="bg-info">{{ count($battle['army2']['all']) }}</td>
                            <td>{{ count($battle['army2']['level1']) }}</td>
                            <td>{{ count($battle['army2']['level2']) }}</td>
                            <td>{{ count($battle['army2']['level3']) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-2"></div>
            <div class="col-8">
                <div class="jumbotron bg-{{ $finalMessage['color'] }}">
                    <h1 class="display-4">{{ $finalMessage['message'] }}</h1>
                </div>
            </div>
        </div>

        @include('config')
    @endif

@stop