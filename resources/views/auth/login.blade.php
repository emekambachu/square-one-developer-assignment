@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(Session::has('success-verify'))
                <p class="text-center bg-success p-1 text-sucess">
                    {{ Session::get('success-verify') }}
                </p>
            @endif
            @if(Session::has('danger-admin'))
                <p class="text-center bg-success p-1 text-danger">
                    {{ Session::get('danger-admin') }}
                </p>
            @endif
        </div>
        <div id="app" class="col-md-8">
            <login-user></login-user>
        </div>
    </div>
</div>
@endsection
