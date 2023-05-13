@extends('frontend.partials.main')
@section('content')
    <?php
    
    use App\Models\Lesson;
    
    ?>
    <style>
        .thumb-image {
            border-radius: 50%;
        }
    </style>
    <section class="inner_page_breadcrumb csv1 top">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Video</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                            <li class="breadcrumb-item">Video</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $video->title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="our-team pb40">
        <div class="container">
            <div class="row">
                <div class="courses_single_container">
                    <div class="cs_row_two">

                        <div class="cs_row_one">
                            <div class="cs_ins_container">
                                <div class="cs_instructor">
                                    <ul class="cs_instrct_list float-left mb0">
                                        <li class="list-inline-item"><img class="thumb thumb-image"
                                                src="{{ asset('/admin/images/learn2.jpg') }}" alt="4.png">
                                        </li>

                                        <li class="list-inline-item"><a href="#">Derniere mise a jour
                                                {{ $video->updated_at }}</a></li>
                                    </ul>

                                </div>
                                <h3 class="cs_title">{{ $video->chapter->title }}</h3>

                                <div class="courses_big_thumb">
                                    <div class="thumb">
                                        {{-- @if (!$video->video_link) --}}
                                        <video controls controlsList='nodownload'
                                            src="{{ Storage::url($video->video_path) }}" width="100%" height="600"
                                            class="img"></video>
                                        {{-- @else
                                                        @if ($video->video_provider == 'youtube' && isset(explode('=', $video->video_link)[1]))
                                                            <iframe class="iframe_video" frameborder="0" allowfullscreen
                                                                src="https://www.youtube.com/embed/{{ explode('=', $video->video_link)[1] }}"
                                                                width="100%" height="400" style='min-height: 500px'> </iframe>
                                                        @elseif ($video->video_provider == 'dailymotion' && isset(explode('video/', $video->video_link)[1]))
                                                            <iframe class="embed-responsive-item img"
                                                                src="https://www.dailymotion.com/embed/video/{{ explode('video/', $video->video_link)[1] }}"></iframe>
                                                        @elseif ($video->video_provider == 'vimeo' && isset(explode('vimeo.com/', $video->video_link)[1]))
                                                            <iframe class="embed-responsive-item img"
                                                                src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $video->video_link)[1] }}"
                                                                width="500" height="281" frameborder="0" webkitallowfullscreen
                                                                mozallowfullscreen allowfullscreen></iframe>
                                                        @endif
                                                    @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="details">
                            <p>{!! $video->description !!}</p>
                            <div id="accordion" class="panel-group cc_tab">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="#panelBodyCourseStart" class="accordion-toggle link"
                                                data-toggle="collapse"
                                                data-parent="#accordion">{{ $video->chapter->title }}</a>
                                        </h4>
                                        <a href="{{ route('layout-frontend.categories.examen', ['chapter' => $video->chapter]) }}"
                                            class="text-info text-right"> <span
                                                class="bi text-danger bi-exclamation-diamond mr-3"></span><b><u>Passer
                                                    le test</u></b> </a>
                                    </div>
                                    <div id="panelBodyCourseStart" class="panel-collapse collapse show">
                                        <div class="panel-body">

                                            <?php
                                            $lessons = Lesson::where('chapter_id', $video->chapter->id)->get();
                                            ?>

                                            @forelse($lessons as $lesson)
                                                <ul class="cs_list mb0">
                                                    <li class="mt-2"><a
                                                            href="{{ route('layout-frontend.categories.video', ['video' => $lesson]) }}"><span
                                                                class="mr-4">✅</span> {{ $lesson->title }}</a>
                                                    </li>
                                                </ul>
                                            @empty
                                                <div class="col-md-4">
                                                    <div class="card-box-c foo">
                                                        <div class="card-header-c d-flex">
                                                            <div class="card-box-ico">
                                                                <a style="color: black; cursor: pointer">
                                                                    Pas d'autres videos
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse

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
@endsection
