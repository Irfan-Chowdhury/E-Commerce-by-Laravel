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
                    
                    
                    <p class="display-4">Welcome, <b> {{ Auth::user()->name }} </b></p>

                    You are logged in!

                    <br><br><br>
                    <a href="{{route('user.logout')}}" class="btn btn-danger">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
