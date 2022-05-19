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

            <!-- Side widgets-->
            <div class="col-lg-4">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-header">Search</div>
                    <div class="card-body">
                        <div class="input-group">
                            <form>
                                <div class="row">
                                    <div class="col-12 mb-2">
                                        <label>Search term</label>
                                        <input type="text" class="form-control" name="term"
                                               placeholder="search here">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label>Published from</label>
                                        <input type="date" class="form-control" name="from">
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <span>Published to</span>
                                        <input type="date" class="form-control" name="to">
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary">
                                            Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Blog entries-->
            <div class="col-lg-8">

                <div class="row">
                    <div class="col-12">
                        <span style="float: right;" class="mb-4">
                            @if($order === 'random')
                                <a href="{{ route('home.recent') }}" class="btn btn-sm btn-primary">Most recent</a>
                            @else
                                <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Random</a>
                            @endif
                        </span>
                    </div>
                </div>

                <div id="app">
                    @foreach($posts as $post)
                        <home-posts
                            :post="{{ $post }}"
                        ></home-posts>
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

        </div>
    </div>
@endsection
