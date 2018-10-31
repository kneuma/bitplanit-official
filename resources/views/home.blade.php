@extends('layouts.app')

@section('content')

<div class="jumbotron">

</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white"><h3>List Title</h3></div>

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
