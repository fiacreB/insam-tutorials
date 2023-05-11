@extends('frontend.partials.main')

@section('content')

<section class="inner_page_breadcrumb m-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 text-center">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">Formations</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Formations</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features-course pb20">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="main-title text-center">
                    <h3 class="mb0 mt0">Cours populaires</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shop_product_slider">
                    @forelse ($courses as $course)
                    <div class="item">
                        <div class="top_courses">
                            <div class="thumb">
                                <img class="img-whp" src="{{ Storage::url($course->image)}}" alt="t1.jpg">
                                <div class="overlay">
                                    <div class="tag">{{$course->category->title}}</div>
                                </div>
                            </div>
                            <div class="details">
                                <div class="tc_content">
                                    <p>{{$course->category->title}}</p>
                                    <h5>{{$course->title}}</h5>
                                    <ul class="tc_review">
                                    </ul>
                                </div>
                                <div class="tc_footer">
                                    <ul class="tc_meta float-left">
                                    </ul>
                                    <div class="tc_price float-right">
                                        <div class="tag">
                                            <a href="{{ route('layout-frontend.courses.show', $course) }}">Afficher</a>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="item">
                        <div class="top_courses">
                            <div class="thumb">
                                <img class="img-whp" src="{{ asset('admin/images/courses/t1.jpg')}}" alt="t1.jpg">
                                
                            </div>
                            <div class="details">
                                <div class="tc_content">
                                    <p>Pas de cours pour le moment</p>
                                    <ul class="tc_review">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Courses List -->
<section class="courses-list pb40">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12 col-lg-12 col-xl-12 shadow_box">
                <div class="row courses_list_heading">
                    <div class="col-xl-4 p0">
                        <div class="instructor_search_result style2">
                            <p class="mt10 fz15"><span class="color-dark pr10"> {{count($courses)}} </span> results</p>
                        </div>
                    </div>
                </div>
                <div class="row courses_container">
                    @forelse ($courses as $course)
                    <div class="col-lg-12 p0">
                        <div class="courses_list_content">
                            <div class="top_courses list">
                                <div class="thumb">
                                    <img class="img-whp" src="{{ Storage::url($course->image)}}" alt="t1.jpg">
                                    <div class="overlay">
                                        {{-- <div class="icon"><span class="flaticon-like"></span></div>
                                        <a class="tc_preview_course" href="#">Preview Course</a> --}}
                                    </div>
                                </div>
                                <div class="details">
                                    <div class="tc_content">
                                        <p>{{$course->category->title}}</p>
                                        <h5>{{$course->title}}</h5>
                                        <p>
                                            {{$course->description}}
                                        </p>
                                    </div>
                                    <div class="tc_footer">
                                        {{-- <ul class="tc_meta float-left fn-414">
                                            <li class="list-inline-item"><a href="#"><i class="flaticon-profile"></i></a></li>
                                            <li class="list-inline-item"><a href="#">1548</a></li>
                                            <li class="list-inline-item"><a href="#"><i class="flaticon-comment"></i></a></li>
                                            <li class="list-inline-item"><a href="#">25</a></li>
                                        </ul> --}}
                                        <div class="tc_price float-right fn-414">
                                            <a href="{{ route('layout-frontend.courses.show', $course) }}">Commencer maintenant</a>
                                        </div>
                                        {{-- <ul class="tc_review float-right fn-414">
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#">(5)</a></li> --}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="item">
                        <div class="top_courses">
                            <div class="thumb">
                                <img class="img-whp" src="{{ asset('admin/images/courses/t1.jpg')}}" alt="t1.jpg">
                                
                            </div>
                            <div class="details">
                                <div class="tc_content">
                                    <p>Pas de cours pour le moment</p>
                                    <ul class="tc_review">
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                {{-- <div class="row">
                    <div class="col-lg-12 mt30 mb30">
                        <div class="mbp_pagination">
                            <ul class="page_navigation">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> <span class="flaticon-left-arrow"></span> Prev</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item"><a class="page-link" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">14</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next <span class="flaticon-right-arrow-1"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
            </div>
           
           
        </div>
    </div>
</section>

@endsection