@extends('layouts.app')

@section('content')
    <!-- Page content-->
    <div class="container">
        <div class="row">

            <!-- Side widgets-->
            <div class="col-lg-5">
                <!-- Search widget-->
                <div class="card mb-4">
                    <div class="card-body">
                        @if(Session::has('success'))
                            <p class="bg-success text-center p-1 text-white">
                                {{ Session::get('success') }}
                            </p>
                        @endif
                        <form method="post" action="{{ route('admin.posts.fetch') }}">
                            @csrf
                            <div class="form-group mb-4">
                                <label>Paste posts from API</label>
                                <input class="form-control" type="text" name="fetch"
                                       value="https://sq1-api-test.herokuapp.com/posts" required>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-info">Fetch posts</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Blog entries-->
            <div class="col-lg-7">
                <h3>All Posts</h3>
                @if($posts->total() > 0)
                <div id="app">
                    @foreach($posts as $post)
                        <home-posts :post="{{ $post }}"></home-posts>
                    @endforeach
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
