@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <br>
                    <a href="{{url('projects')}}">Projects</a>
                    <br>
                    <a href="{{url('tasks')}}">Task</a>
                    <br>
                    <a href="{{url('get/precentage')}}">Precentage</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
