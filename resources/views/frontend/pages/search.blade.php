<!-- @extends('layout-frontend.mainlayout')
@section('content')
    <main id="main" style="margin-top: 3px;">

        <section id="popular-courses" class="courses mt">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <p>Resultats de recherche pour: {{ $search }} ({{ $videos->count() }})</p>
                </div>
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-inner">
                        <div class=" active">
                            <div class="row" data-aos="zoom-in" data-aos-delay="100">
                                @foreach ($videos as $video)
                                    <div class="col-lg-2 col-md-3 d-flex align-items-stretch mt-4 mt-md-0">
                                        <div class="course-item">
                                            <video controls controlsList='nodownload'
                                                src="{{ Storage::url($video->video_path) }}"
                                                class="overlay img-fluid"></video>
                                            <div class="course-content">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h4>{{ $video->title }}</h4>
                                                </div>

                                                <p>{{ $video->description }}</p>
                                                <div class="trainer d-flex justify-content-between align-items-center">

                                                    <div class="trainer-rank d-flex align-items-center">
                                                        <i class="bx bx-user"></i>&nbsp;{{ $video->visits }}
                                                        &nbsp;&nbsp;
                                                        <i class="bx bx-heart"></i>&nbsp;{{ $video->likes->count() }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection -->
