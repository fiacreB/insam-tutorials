@extends('frontend.partials.main')
@section('title', 'Books Categories')
@section('content')



    <style>
        .top {
            margin-top: -40px;
        }
    </style>
    <!-- Inner Page Breadcrumb -->
    <section class="inner_page_breadcrumb top">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Bibliothèque</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bibliothèque</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Blog Post Content -->
    <section class="blog_post_container">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9">
                    <div class="main_blog_post_content">
                        <div class="row">
                            <style>
                                .thumb {
                                    height: 300px;
                                }

                                .thumb img {
                                    height: 300px;
                                }

                                .thumb:hover {
                                    opacity: 0.5;
                                }

                                .details {
                                    max-height: 200px;
                                    overflow: auto;
                                }
                            </style>
                            @forelse ($bookCategories as $bookCategory)
                                <div class="col-sm-6 col-lg-6 col-xl-6">
                                    <div class="blog_grid_post mb30">
                                        <a href="{{ route('layout-frontend.book_categories.show', $bookCategory) }}">
                                            <div class="thumb">
                                                <img src="{{ asset('/admin/images/books.jpg') }}" alt=""
                                                    class="img-fluid">
                                                <div class="tag">{{ $bookCategory->title }}
                                                </div>
                                                <div class="post_date">
                                                    <h4 class="text-info">{{ $bookCategory->books->count() }}</h4>
                                                    <span>{{ $bookCategory->created_at }}</span>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="details">
                                            <h3>Learning</h3>
                                            {{-- <ul class="post_meta">
                                                <li><a href="#"><span>{{ $bookCategory->link }}</span></a>
                                                </li>
                                            </ul> --}}
                                            <p>{!! $bookCategory->description !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <h4 class="text-center">
                                    <a href="#">Aucune bibliothèque</a>
                                </h4>
                            @endforelse
                        </div>
                        <div class="row">
                            <nav aria-label="">
                                <ul class="pagination pagination-circle ">
                                    {{ $bookCategories->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3 pl10 pr10">
                    <div class="main_blog_post_widget_list">
                        <div class="blog_search_widget">
                            <form class="" id="sort_capacities" action="" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" id="search" name="search" class="form-control"
                                        placeholder="Search Here" aria-label="Recipient's username"
                                        aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" id="button-addon2"><span
                                                class="flaticon-magnifying-glass"></span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="blog_category_widget">
                            <ul class="list-group">
                                <h4 class="title">Category</h4>
                                @foreach ($bookCategories as $bookCategory)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $bookCategory->title }} <span
                                            class="float-right">{{ $bookCategory->books->count() }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog_recent_post_widget media_widget">
                            <h4 class="title">Recent Posts</h4>
                            @foreach ($bookCategories as $bookCategory)
                                <div class="media">
                                    <img class="align-self-start mr-3" src="{{ asset('/admin/images/books2.png') }}"
                                        alt="s1.jpg">
                                    <div class="media-body">
                                        <a href="{{ route('layout-frontend.book_categories.show', $bookCategory) }}">
                                            <h5 class="mt-0 post_title">{{ $bookCategory->title }}</h5>
                                        </a>
                                        <a href="#">{{ $bookCategory->created_at }}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{-- <div class="blog_tag_widget">
                            <h4 class="title">Tags</h4>
                            <ul class="tag_list">
                                @foreach ($bookCategories as $bookCategory)
                                    <li class="list-inline-item"><a href="#">
                                            {{ $bookCategory->title }}
                                        </a></li>
                                @endforeach

                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
        var route = "{{ route('layout-frontend.book_categories.index') }}";
        $('#search').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>
@endsection
