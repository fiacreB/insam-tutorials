@extends('frontend.partials.main')
@section('content')
    <!-- Sidebar -->
    @forelse ($category->courses as $course)
        @if ($course->chapters->valid != 0 && $course->chapters->first == 'first')
        @else
            @foreach ($attempts as $attempt)
                @if ($attempt->marks >= $attempt->chapter->pass_marks)
                    @if ($attempt->valid == $course->chapter->id)
                        <div class="vertical-menu overflow-auto ">

                            <div data-simplebar class="h-100">

                                <!--- Sidemenu -->
                                <div id="sidebar-menu">

                                    <ul class="metismenu list-unstyled list-group mx-6 mt-4 " id="side-menu">

                                        <li> <a href="{{ route('layout-frontend.categories.videos', $course->chapter->slug) }}"
                                                class="list-group-item list-group-item-action py-2 ripple text-uppercase text-info"
                                                aria-current="true">
                                                <i class="fas fa-tachometer-alt fa-fw me-3 "></i><span><b> Videos</b></span>
                                            </a>
                                        </li>
                                        @foreach ($chapter->lesson as $video)
                                            <li class="d-flex">
                                                <a href="{{ route('layout-frontend.categories.video', $video->slug) }}"
                                                    class="list-group-item d-flex list-group-item-action py-1 ripple container ">
                                                    <i class="col-2 ">
                                                        <img src="/assets-frontend/img/lessone-details-tab-3.png"
                                                            class="img-fluid shadow-1-strong rounded" alt="connect" />
                                                    </i>
                                                    <span class="col mx-2">{{ $video->title }}</span>

                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <section id="popular-lessones" class="lessones mt main">

                            <div class="container" data-aos="fade-up">
                                <div class="section-title">
                                    <p>Résumé du lesson : <b class="text-info me-2">{{ $course->chapter->title }}
                                        </b>
                                    </p>
                                </div>

                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                                    <div class="carousel-inner">
                                        <div class=" active">
                                            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                                                <div class="col-lg-3 col-md-4 d-flex align-items-stretch mt-4 mt-md-0">
                                                    <p>{{ $course->chapter->description }}</p>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    @endif
                @endif
            @endforeach
        @endif

    @empty
        @if ($chapter->first == 'first')
            <section id="popular-lessones" class="lessones mt main">

                <div class="section-title">
                    <p>Résumé du lesson : <b class="text-info me-2">{{ $chapter->title }}
                        </b>
                    </p>
                </div>
                <div class="container">
                    <div>
                        <p>{!! $chapter->description !!}</p>
                    </div>
                </div>
            </section>
        @else
            <div class="lessone-content text-center">
                <h3 class="text-center">❌❌❌❌❌😥😥😥Vous n’avez pas encore le droit
                    nécessaire
                    pour suivre les lesson de ce chapitre. Veuillez SVP,
                    suivre les formations précédentes.🔙🔙🔙
                    <b>
                        MERCI POUR LA COMPREHENSION❗ VOTRE REUSSITE EST NOTRE PRIORITE.👍👍👍
                </h3>

                </b>
            </div>
        @endif
    @endforelse
@endsection
