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


<!-- Our Courses List -->
<section class="courses-list pb40">
    <div class="container">
        <div class="row">
            
            <div class="col-md-12 col-lg-8 col-xl-9 shadow_box p-4">
                <div class="row">
                    <div class="col-xl-4">
                        <div class="instructor_search_result style2">
                            <p class="mt10 fz15"><span class="color-dark pr10">{{count($courses)}} </span> formations</p>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="candidate_revew_select style2 text-right mb25">
                            <ul>
                                <li class="list-inline-item">
                                    <div class="candidate_revew_search_box course mb30 fn-520">
                                        <form class="form-inline my-2 my-lg-0" method="GET" action="/courses/search">
                                            @csrf
                                            <input class="form-control mr-sm-2" type="search" name="title" placeholder="Rechercher une formation" aria-label="Search">
                                            <button class="btn my-2 my-sm-0" type="submit"><span class="flaticon-magnifying-glass"></span></button>
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @forelse ($courses as $course)
                    <div class="col-lg-6 col-xl-4">
                        <div class="top_courses">
                            <div class="thumb">
                                <img class="img-whp" height="300" src="{{ Storage::url($course->image)}}" alt="t1.jpg">
                                <div class="overlay">
                                </div>
                            </div>
                            <div class="details">
                                <div class="tc_content">
                                    <p>{{$course->category->title}}</p>
                                    <h5>{{$course->title}}</h5>
                                    <ul class="tc_review">
                                        {{-- <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                        <li class="list-inline-item"><a href="#">(6)</a></li> --}}
                                    </ul>
                                </div>
                                <div class="tc_footer text-center">
                                    <div class="tc_price">
                                        <a class="btn btn-transparent" href="{{ route('layout-frontend.courses.show', $course) }}">Commencer maintenant</a>
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
                {!! $courses->links() !!}
                
            </div>
            <div class="col-lg-4 col-xl-3">
                <div class="instructor_pricing_widget">
                    
                    <h5 class="subtitle text-left color-dark">Categories</h5>
                    <ul class="price_quere_list text-left">
                        @foreach ($categories as $category)
                        <li><a  href="{{ route('layout-frontend.categories.showcourse', $category) }}">{{ $category->title }}</li>
                        @endforeach
                        
                    </ul>
                </div>
                <div class="feature_course_widget">
                    <ul class="list-group">
                        <h4 class="title">Dernieres formations</h4>
                        @foreach ($new_courses as $course)
                        <li><a  href="{{ route('layout-frontend.courses.show', $course) }}">{{ $course->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
           
        </div>
    </div>
</section>

@endsection