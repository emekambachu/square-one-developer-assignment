@extends('layouts.app')

@section('content')
    <!-- Page content-->
    <div class="container">
        <div id="app" class="row">

        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-body">
                    <a href="{{ route('user.post.create') }}">
                        <button class="btn btn-success btn-rounded">Create post</button>
                    </a>
                </div>
            </div>
        </div>

        <blog-posts></blog-posts>

        </div>
    </div>
@endsection
