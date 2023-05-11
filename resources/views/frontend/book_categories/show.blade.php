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
                        <h4 class="breadcrumb_title">Livres</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span
                                    class="text-info">{{ $bookCategory->title }}</span></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>





    <!-- Our Team Members -->
    <section class="our-team pb40">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="instructor_search_result style2">
                                <p class="mt10 fz15"><span class="color-dark pr10">{{ $bookCategory->books->count() }}
                                    </span> results </span> Books</p>
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="candidate_revew_select style2 text-right mb25">
                                <ul>
                                    {{-- <li class="list-inline-item">
                                        <select class="selectpicker show-tick">
                                            
                                        </select>
                                    </li> --}}
                                    <li class="list-inline-item">
                                        <div class="candidate_revew_search_box course mb30 fn-520">
                                            <form class="form-inline my-2 my-lg-0" id="sort_capacities" action=""
                                                method="GET">
                                                <input class="form-control mr-sm-2" id="search" name="search"
                                                    type="search" placeholder="Search" aria-label="Search">
                                                <button class="btn my-2 my-sm-0" type="submit"><span
                                                        class="flaticon-magnifying-glass"></span></button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <style>
                            .thumb {
                                height: 200px;
                            }

                            .thumb img {
                                height: 200px;
                                width: 300px;
                            }

                            .thumb:hover {
                                opacity: 0.5;
                            }

                            .tc_h5 {
                                height: 70px;
                                overflow: auto;
                            }
                        </style>
                        @forelse ($books as $book)
                            <div class="col-lg-6 col-xl-4">

                                <div class="top_courses">
                                    <div class="thumb">
                                        <img alt="{{ $book->title }}" src="{{ Storage::url($book->image) }}"
                                            class="img-fluid" />
                                        <div class="overlay">
                                            <div class="tag">Book</div>
                                            <div class="icon"><span class="flaticon-like"></span></div>
                                            <a class="tc_preview_course"
                                                href="{{ route('layout-frontend.book.show', $book->slug) }}">Voir le
                                                livre</a>
                                        </div>
                                    </div>

                                    <div class="details">
                                        <div class="tc_content">
                                            <p class="h2">{{ $book->title }}</p>
                                            <h5 class="tc_h5">{!! $book->description !!}</h5>
                                        </div>
                                        <div class="tc_footer">
                                            <ul class="tc_meta float-left">
                                                <li class="list-inline-item"><a href="#"><span
                                                            class="flaticon-profile"></span></a></li>
                                                <li class="list-inline-item"><a href="#"
                                                        class="text-info">{{ $book->views }}</a></li>
                                            </ul>
                                            <div class="float-right text-success">{{ $book->created_at }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty

                            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                                <div class="course-item">
                                    <div class="course-content">
                                        <h3><a href="#">Aucun livre pour l'instant</a></h3>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                        <div class="col-lg-12">
                            <div class="mbp_pagination">
                                <nav aria-label="">
                                    <ul class="pagination pagination-circle ">
                                        {{ $books->links() }}
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="selected_filter_widget style2">
                        <div id="accordion" class="panel-group">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a href="#panelBodyAuthors" class="accordion-toggle text-primary link fz20 mb15"
                                            data-toggle="collapse" data-parent="#accordion">CATEGORIES</a>
                                    </h4>
                                </div>
                                <div id="panelBodyAuthors" class="panel-collapse collapse show">
                                    <div class="panel-body">
                                        <div class="cl_skill_checkbox">
                                            <div class="content ui_kit_checkbox style2 text-left">
                                                @foreach ($bookCategories as $bookcategory)
                                                    <div class="custom-control custom-checkbox">
                                                        <a href="{{ route('layout-frontend.book_categories.show', $bookCategory) }}"
                                                            class="custom-control-label"
                                                            for="customCheck10">{{ $bookcategory->title }}
                                                            <span class="float-right">( <span
                                                                    class="text-info">{{ $bookcategory->books->count() }}</span>)</a>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
