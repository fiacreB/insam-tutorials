<!-- @extends('layout-frontend.mainlayout')
@section('content') -->
@extends('frontend-client.main')
@section('content')
<!-- Sidebar -->
<div class="vertical-menu overflow-auto marg ">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled list-group mx-6 mt-4 " id="side-menu">
                <li><a href="{{ route('layout-frontend.categories.videos', $sujet) }}" class="list-group-item list-group-item-action py-2 ripple text-uppercase text-info" aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3 "></i><span><b> Videos</b></span>
                    </a>
                </li>
                <li><a href="{{ route('layout-frontend.categories.resultDashboard', $sujet) }}" class="list-group-item list-group-item-action py-2 ripple text-uppercase text-info" aria-current="true">
                        <i class="fa fa-list-alt fa-fw me-3 "></i><span><b> Mes Résultats</b></span>
                    </a>
                </li>
                <li><a href="{{ route('layout-frontend.categories.resume', $sujet) }}" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
                        <span><i><u><b> Résumé du cours</b></u></i> </span>
                    </a></li>
                @foreach ($sujet->cours as $video)
                <li> <a href="#" class="list-group-item list-group-item-action py-2 ripple container  mx-2 ml-4 ">

                        <span>{{ $video->title }}</span>
                    </a>
                </li>
                @endforeach

            </ul>
        </div>
    </div>
</div>
<button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect " id="vertical-menu-btn">
    <i class="ri-menu-2-line align-middle"></i>
</button>
@if ($sujet->first == 'first')
<section id="popular-courses" class="courses mt main">

    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <p>Toutes les formations <b class="text-info me-2">({{ $sujet->sujet }}
                    ({{ $sujet->cours->count() }})
                    )</b>
            </p>
            <a href="{{ route('layout-frontend.categories.examen', $sujet) }}" class="btn btn-success ansButton">
                passer un
                test
                Maintenant</a>

        </div>

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-inner">
                <div class=" active">
                    <div class="row" data-aos="zoom-in" data-aos-delay="100">
                        @forelse ($sujet->cours as $video)
                        <div class="col-lg-3 col-md-4 d-flex align-items-stretch mt-4 mt-md-0">
                            <div class="course-item-video mt-3">

                                <div class=" absolute1  overlay1 d-block">
                                    <i class="icostyle  bi bi-collection-play  "></i>
                                </div>
                                <video controls controlsList='nodownload' data-src="{{ Storage::url($video->video_path) }}" autoplay="1" class="img-fluid  md"></video>
                                <div class="course-content">
                                    <div style=" height: 40px" class="overflow-auto d-flex justify-content-between align-items-center mb-3">
                                        <h3 class="text-info">{{ $video->sujet->sujet }}</h3>
                                    </div>
                                    <a href="{{ route('layout-frontend.categories.video', $video) }}">
                                        <div class=" overflow-auto " style=" height: 70px">
                                            <h3>
                                                {{ $video->title }}
                                            </h3>

                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                        @empty

                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                            <div class="course-item">
                                <div class="course-content">
                                    <h3><a href="#">Aucune video pour l'instant</a></h3>
                                </div>
                            </div>
                        </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@else
@forelse ($attempts as $attempt)
@if ($attempt->marks >= $attempt->sujet->pass_marks && $attempt->valid == $sujet->id)
<section id="popular-courses" class="courses mt main">

    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <p>Toutes les formation <b class="text-info me-2">({{ $sujet->sujet }}
                    ({{ $sujet->cours->count() }})
                    )</b>
            </p>
            <a href="{{ route('layout-frontend.categories.examen', $sujet) }}" class="btn btn-success ansButton">
                passer un
                test
                Maintenant</a>

        </div>

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-inner">
                <div class=" active">
                    <div class="row" data-aos="zoom-in" data-aos-delay="100">
                        @forelse ($sujet->cours as $video)
                        <div class="col-lg-3 col-md-4 d-flex align-items-stretch mt-4 mt-md-0">
                            <div class="course-item-video mt-3">

                                <div class=" absolute1  overlay1 d-block">
                                    <i class="icostyle  bi bi-collection-play  "></i>
                                </div>
                                <video controls controlsList='nodownload' data-src="{{ Storage::url($video->video_path) }}" autoplay="1" class="img-fluid  md"></video>
                                <div class="course-content">
                                    <div style=" height: 40px" class="overflow-auto d-flex justify-content-between align-items-center mb-3">
                                        <h3 class="text-info">{{ $video->sujet->sujet }}</h3>
                                    </div>
                                    <a href="{{ route('layout-frontend.categories.video', $video) }}">
                                        <div class=" overflow-auto " style=" height: 70px">
                                            <h3>
                                                {{ $video->title }}
                                            </h3>

                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                        @empty

                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                            <div class="course-item">
                                <div class="course-content">
                                    <h3><a href="#">Aucune video pour l'instant</a></h3>
                                </div>
                            </div>
                        </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@empty
<div class="container">

    <div class="course-content text-center  d-flex">
        <div class="me-5"></div>

        <h3 class="text-center">❌❌❌❌❌😥😥😥Vous n’avez pas encore le droit
            nécessaire
            pour suivre les cours de ce chapitre. Veuillez SVP,
            suivre les formations précédentes.🔙🔙🔙
            <b>
                MERCI POUR LA COMPREHENSION❗ VOTRE REUSSITE EST NOTRE PRIORITE.👍👍👍
            </b>
        </h3>

    </div>
</div>
@endforelse
@endif
<script>
    document.querySelectorAll('.overlay1').forEach(function(overlay1) {
        var video = overlay1.parentNode.querySelector('video');
        video.src = '';
        overlay1.addEventListener('click', function() {
            video.src = video.dataset.src;
            video.style.display = "block";
            var i = overlay1.querySelector('i');
            i.style.transition = "all 0.7s";
            i.classList.add('200px', 'opacity-0');

            i.addEventListener('transitionend', function() {

                overlay1.style.display = "none";
                overlay1.style.background = "none";

            });
        });
    });
</script>
@endsection