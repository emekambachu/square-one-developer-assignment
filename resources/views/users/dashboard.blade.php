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
                        <a href="{{ route('post.create') }}">
                            <button class="btn btn-success btn-rounded">Create post</button>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Blog entries-->
            <div class="col-lg-8">
                @if($posts->total() > 0)
                    <div id="app">
                        <home-posts :posts="{{ $posts }}"></home-posts>
                    </div>
                @else
                    <div>
                        <p class="text-center">You have'nt submitted any post yet</p>
                    </div>
                @endif

                <!-- Pagination-->
                @if($posts->lastPage() > 1)
                    <nav aria-label="Pagination">
                        <hr class="my-0" />
                        <ul class="pagination justify-content-center my-4">
                            {{ $posts->appends(Request::all())->links() }}
                        </ul>
                    </nav>
                @endif

            </div>

        </div>
    </div>
@endsection
