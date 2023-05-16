@extends('frontend.partials.main')
@section('title', 'IUEs/Insam-Tutorials')
@section('content')
    <style>
        .top {
            margin-top: -100px;
        }
    </style>
    <div class="home1-mainslider top">
        <div class="container-fluid p0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-banner-wrapper">
                        <div class="banner-style-one owl-theme owl-carousel">
                            <div class="slide slide-one"
                                style="background-image: url(../admin/images/study.jpg); height: 95vh;">
                                <div class="container">
                                    <div class="row home-content">
                                        <div class="col-lg-12 text-center p0">
                                            <h3 class="banner-title">Apprendre toujours plus</h3>
                                            {{-- <p>Technology is brining a massive wave of evolution on learning things on different ways.</p> --}}
                                            <div class="btn-block"><a href="{{ route('layout-frontend.courses.index') }}"
                                                    class="banner-btn">Commencer maintenant</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slide-one"
                                style="background-image: url(../admin/images/books.jpg);height: 95vh;">
                                <div class="container">
                                    <div class="row home-content">
                                        <div class="col-lg-12 text-center p0">
                                            <h3 class="banner-title">Apprendre toujours plus</h3>
                                            {{-- <p>Technology is brining a massive wave of evolution on learning things on different ways</p> --}}
                                            <div class="btn-block"><a href="{{ route('layout-frontend.courses.index') }}"
                                                    class="banner-btn">Commencer maintenant</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slide slide-one"
                                style="background-image: url(../admin/images/category.jpg);height: 95vh;">
                                <div class="container">
                                    <div class="row home-content">
                                        <div class="col-lg-12 text-center p0">
                                            <h3 class="banner-title">Apprendre toujours plus</h3>
                                            {{-- <p>Technology is brining a massive wave of evolution on learning things on different ways</p> --}}
                                            <div class="btn-block"><a href="{{ route('layout-frontend.courses.index') }}"
                                                    class="banner-btn">Commencer maintenant</a></div>
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

                <style>
                    .thum {
                        height: 300px;
                    }

                    .thum img {
                        height: 300px;
                    }

                    .thum:hover {
                        opacity: 0.5;
                    }

                    .details1 {
                        max-height: 200px;
                        overflow: auto;
                    }
                </style>
                @forelse ($categories as $category)
                    <div class="col-sm-6 col-lg-6 col-xl-4">
                        <div class="team_member style3 text-center mb30 text-truncate">
                            <div class="blog_grid_post mb30 mt-2 ">
                                <a href="{{ route('layout-frontend.categories.showcourse', $category) }}">
                                    <div class="thum thumb">
                                        @if ($category->image)
                                            <img class="img-fluid" src="{{ Storage::url($category->image) }}"
                                                alt="7.png">
                                        @else
                                            <img src="{{ asset('/admin/images/study.jpg') }}" alt=""
                                                class="img-fluid">
                                        @endif
                                    </div>
                                </a>
                                <h4><b class="text-info">{{ $category->title }}</b></h4>
                                <div class="details1">
                                    <p>{!! $category->description !!}</p>

                                </div>
                            </div>
                            <div class="tm_footer">
                                <ul>
                                    <li class="list-inline-item">{{ $category->updated_at->diffForHumans() }}</li>
                                    <a href="{{ route('layout-frontend.categories.showcourse', $category) }}"
                                        class="btn btn-transparent">Decouvrir les cours</a>
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
                    <a class="btn btn-transparent" href="{{ route('layout-frontend.categories.index') }}">Voir toutes les
                        categories</a>
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
                                            @if (!$course->image)
                                                <img src="{{ asset('/admin/images/learn.jpg') }}" alt=""
                                                    class="img-whp">
                                            @else
                                                <img class="img-whp" src="{{ Storage::url($course->image) }}"
                                                    alt="t1.jpg">
                                            @endif
                                            <div class="overlay">
                                                <div class="tag">{{ $course->category->title }}</div>
                                            </div>
                                        </div>
                                        <div class="details">
                                            <div class="tc_content">
                                                <p>{{ $course->category->title }}</p>
                                                <h5>{{ $course->title }}</h5>
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
                                                        <a class="btn btn-transparent"
                                                            href="{{ route('layout-frontend.courses.show', $course) }}">Afficher</a>

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
                                <a class="btn btn-transparent" href="{{ route('layout-frontend.lessons.index') }}">Voir
                                    toutes les formations</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- about3 home3 -->
            <section class="home3_about2 pb10 pt30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3">
                            <div class="main-title text-center">
                                <h3 class="mt0">Top Courses</h3>
                                <p>Les meilleurs cours de l'année.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="instructor_slider_home3">
                                @foreach ($lessons as $video)
                                    <div class="item">
                                        <div class="instructor_col">
                                            <div class="thumb">
                                                @if (!$video->video_link)
                                                    <video controls controlsList='nodownload'
                                                        src="{{ Storage::url($video->video_path) }}"
                                                        class="img-fluid img-rounded-circle"></video>
                                                @else
                                                    @if ($video->video_provider == 'youtube' && isset(explode('=', $video->video_link)[1]))
                                                        <iframe class="img-fluid img-rounded-circle"
                                                            src="https://www.youtube.com/embed/{{ explode('=', $video->video_link)[1] }}"></iframe>
                                                    @elseif ($video->video_provider == 'dailymotion' && isset(explode('video/', $video->video_link)[1]))
                                                        <iframe class="img-fluid img-rounded-circle"
                                                            src="https://www.dailymotion.com/embed/video/{{ explode('video/', $video->video_link)[1] }}"></iframe>
                                                    @elseif ($video->video_provider == 'vimeo' && isset(explode('vimeo.com/', $video->video_link)[1]))
                                                        <iframe class="img-fluid img-rounded-circle"
                                                            src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $video->video_link)[1] }}"
                                                            width="500" height="281" frameborder="0"
                                                            webkitallowfullscreen mozallowfullscreen
                                                            allowfullscreen></iframe>
                                                    @else
                                                        <img src="{{ asset('/admin/images/computer.jpg') }}"
                                                            alt="" class="img-fluid img-rounded-circle">
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="details">
                                                <ul>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fa fa-star"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fa fa-star"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fa fa-star"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fa fa-star"></i></a></li>
                                                    <li class="list-inline-item"><a href="#"><i
                                                                class="fa fa-star"></i></a></li>
                                                    <li class="list-inline-item"><a href="#">(5)</a></li>
                                                </ul>
                                                <h4>{{ $video->title }}</h4>
                                                <p>{{ $video->chapter->title }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    <div class="row mt60">
                        <div class="col-sm-6 col-lg-6 col-xl-6">
                            <div class="becomea_instructor_home3 style1">
                                <div class="bi_grid">
                                    <h3>Become A Genius</h3>
                                    <p>Learn what you love. IUEs/Insam Tutorials give you the tools to achieve this <br
                                            class="dn-lg"> an online course.</p>
                                    <a class="btn btn-white" href="{{ route('layout-frontend.categories.index') }}">Start
                                        Learning <span class="flaticon-right-arrow-1"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6 col-xl-6">
                            <div class="becomea_instructor_home3 style2">
                                <div class="bi_grid">
                                    <h3>See All Libraries</h3>
                                    <p>Get unlimited access to 2,500 of IUEs/INSAM top courses for <br class="dn-lg"> you
                                    </p>
                                    <a class="btn btn-white"
                                        href="{{ route('layout-frontend.book_categories.index') }}">Getting Started <span
                                            class="flaticon-right-arrow-1"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </section>
@endsection
