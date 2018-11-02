@extends('layouts.app')

@section('content')

<div class="jumbotron">

    <div class="row">
        <div class="col align-right">
            <h4>Birthday: {{ $user->birthday }}</h4>
            <br />
            <br />
            <h4>Location: {{ $user->location }}</h4>
            <br />
            <br />

        </div>

        <div class="col align-center">
            <h3>{{ $user->username }}</h3>
            <div class="avatar">
                <img src="/imgs/default-avatar.png">
            </div>

            <p>Bio: {{ $user->bio }}
        </div>

        <div class="col align-left">
            <h4>Occupation: {{ $user->occupation }}</h4>
            <br />
            <br />
            <h4>Website: <a href="{{ $user->website }}">Website: {{ $user->website }}</a></h4>
        </div>
    </div>




</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white align-center"><h3>Your Bit Plan</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <div class="card">
                        <div id="app" class="h-screen flex items-center justify-center bg-teal-lightest font-sans">
                            <task-list></task-list>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
