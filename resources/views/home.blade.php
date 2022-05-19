@extends('layouts.app')

@section('content')
    <header class="py-2 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Blog Home!</h1>
            </div>
        </div>
    </header>

    <!-- Page content-->
    <div class="container">
        <div class="row">

            <!-- Blog entries-->
            <div class="col-lg-8">

                <div id="app">
                    @foreach($posts as $post)
                        <home-posts :post="{{ $post }}"></home-posts>
                    @endforeach
                </div>

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

            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <input class="form-control" type="text" placeholder="Enter search term..."
                                   aria-label="Enter search term..." aria-describedby="button-search" />
                            <input class="form-control" type="text" placeholder="Enter search term..."
                                   aria-label="Enter search term..." aria-describedby="button-search" />
                            <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
