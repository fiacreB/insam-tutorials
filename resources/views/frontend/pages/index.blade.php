@extends('frontend.partials.main')

@section('content')
<div class="home1-mainslider">
    <div class="container-fluid p0">
        <div class="row">
            <div class="col-lg-12">
                <div class="main-banner-wrapper">
                    <div class="banner-style-one owl-theme owl-carousel">
                        <div class="slide slide-one" style="background-image: url(images/home/1.jpg); height: 95vh;">
                            <div class="container">
                                <div class="row home-content">
                                    <div class="col-lg-12 text-center p0">
                                        <h3 class="banner-title">Apprendre toujours plus</h3>
                                        {{-- <p>Technology is brining a massive wave of evolution on learning things on different ways.</p> --}}
                                        <div class="btn-block"><a href="{{ route('layout-frontend.courses.index') }}" class="banner-btn">Commencer maintenant</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide slide-one" style="background-image: url(images/home/2.jpg);height: 95vh;">
                            <div class="container">
                                <div class="row home-content">
                                    <div class="col-lg-12 text-center p0">
                                        <h3 class="banner-title">Apprendre toujours plus</h3>
                                        {{-- <p>Technology is brining a massive wave of evolution on learning things on different ways</p> --}}
                                        <div class="btn-block"><a href="{{ route('layout-frontend.courses.index') }}" class="banner-btn">Commencer maintenant</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="slide slide-one" style="background-image: url(images/home/3.jpg);height: 95vh;">
                            <div class="container">
                                <div class="row home-content">
                                    <div class="col-lg-12 text-center p0">
                                        <h3 class="banner-title">Apprendre toujours plus</h3>
                                        {{-- <p>Technology is brining a massive wave of evolution on learning things on different ways</p> --}}
                                        <div class="btn-block"><a href="{{ route('layout-frontend.courses.index') }}" class="banner-btn">Commencer maintenant</a></div>
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

<!-- School Category Courses -->
<section id="our-courses" class="our-courses pt90 pt650-992">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <a href="#our-courses">
                    <div class="mouse_scroll">
                        <div class="icon"><span class="flaticon-download-arrow"></span></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="main-title text-center">
                    <h3 class="mt0">Les Categories De Cours</h3>
                    {{-- <p>Cum doctus civibus efficiantur in imperdiet deterruisset.</p> --}}
                </div>
            </div>
        </div>
        <div class="row">

            
            @forelse ($categories as $category)
            <div class="col-sm-6 col-lg-6 col-xl-4">
                <div class="team_member style3 text-center mb30 text-truncate">
                    <div class="instructor_col">
                        <div class="thumb">
                            <img class="img-fluid img-rounded-circle" src="{{ Storage::url($category->image) }}" alt="7.png">
                        </div>
                        <div class="details">
                            <h4>{{ $category->title }}</h4>
                            <p class="m-2">{{ $category->description }}</p>
                            <ul>
                            </ul>
                        </div>
                    </div>
                    <div class="tm_footer">
                        <ul>
                            <li class="list-inline-item">{{$category->updated_at->diffForHumans()}}</li>
                            <a href="{{ route('layout-frontend.categories.showcourse', $category) }}" class="btn btn-transparent">Decouvrir les cours</a>
                        </ul>
                    </div>
                </div>
            </div>
            @empty
                
            <div class="col-sm-6 col-lg-3">
                <div class="img_hvr_box" style="background-image: url(images/courses/1.jpg);">
                    <div class="overlay">
                        <div class="details">
                            <h5>Pas de categorie pour le moment</h5>
                    </div>
                </div>
            </div>
                
            @endforelse

            
            

            
        </div>
        <div class="col-lg-6 offset-lg-3">
            <div class="courses_all_btn text-center">
                <a class="btn btn-transparent" href="{{ route('layout-frontend.categories.index') }}">Voir toutes les categories</a>
            </div>
        </div>
    </div>
</section>


<!-- Top Courses -->
<section id="top-courses" class="top-courses pb30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="main-title text-center">
                    <h3 class="mt0">Nos dernieres formations</h3>
                    <p>Parcourez nos formations les plus recentes.</p>
                </div>
            </div>
        </div>
        <div class="row">
             <div class="col-lg-12">
                 <div class="emply-text-sec">
                     <div class="row" id="masonry_abc">

                        @forelse ($news_courses as $course)
                        <div class="col-md-6 col-lg-4 col-xl-3 business design">
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
                                            {{-- <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
                                            <li class="list-inline-item"><a href="#">(6)</a></li> --}}
                                        </ul>
                                    </div>
                                    <div class="tc_footer">
                                        <ul class="tc_meta float-left">
                                            {{-- <li class="list-inline-item"><a href="#"><i class="flaticon-profile"></i></a></li>
                                            <li class="list-inline-item"><a href="#">1548</a></li>
                                            <li class="list-inline-item"><a href="#"><i class="flaticon-comment"></i></a></li>
                                            <li class="list-inline-item"><a href="#">25</a></li> --}}
                                        </ul>
                                        <div class="tc_price float-right">
                                            <div class="tag">
                                                <a class="btn btn-transparent" href="{{ route('layout-frontend.courses.show', $course) }}">Afficher</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                        @empty
                            
                        @endforelse
                         
                        
                     </div>
                     <div class="col-lg-6 offset-lg-3">
                        <div class="courses_all_btn text-center">
                            <a class="btn btn-transparent" href="{{ route('layout-frontend.lessons.index') }}">Voir toutes les formations</a>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</section>
@endsection