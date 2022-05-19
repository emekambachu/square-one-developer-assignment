@extends('layouts.app')

@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="row">

            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-body">
                        <a href="{{ route('dashboard') }}">
                            <button class="btn btn-success btn-rounded">Dashboard</button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Blog entries-->
            <div class="col-lg-8">

                <div id="app">
                    <create-post></create-post>
                </div>

            </div>

        </div>
    </div>
@endsection
