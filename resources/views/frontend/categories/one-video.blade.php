@extends('frontend.partials.main')
@section('content')
<style>
    .all {
        display: flex;
        color: #fff !important;
        padding: 20px;
        margin: 35px;
    }


    section.left {
        padding: 0;
        margin-right: 20px;
        width: 1200px;
    }

    section.left p {
        width: 900px;
        text-align: center;
    }

    .video {
        width: 1200px;
    }

    .video video {
        width: 1200px;
    }

    section.rigth {
        width: calc(100% - 1100px);
        border: 1px solid rgb(63, 31, 31);
        border-radius: 10px;

        /* box-shadow: 0 0 0 900px rgba(86, 77, 79, 0.321) inset; */
    }

    section.rigth h1 {
        padding: 10px;
        margin-top: -50px;
        color: var(--primary);
    }

    .lessons {
        padding: 10px;
        margin-top: 10px;
        /* border: 2px solid rgb(53, 50, 50); */
        /* background: rgb(46, 46, 55); */
        padding: 10px;
        border-radius: 10px;
        overflow-y: scroll;
    }

    .lessons::-webkit-scrollbar {
        width: 10px;
    }

    .lessons::-webkit-scrollbar-thumb {
        width: 10px;
        background: rgba(4, 33, 225, 0.888);
        border-radius: 10px;
    }

    .lessons::-webkit-scrollbar-track {
        width: 10px;
        background: rgba(0, 0, 0, 0.2);
        border-radius: 10px;
    }

    .lesson {
        /* border: 2px solid rgb(43, 42, 42); */
        /* background: rgb(46, 46, 55); */
        background: #c1c1c1;
        padding: 10px;
        display: flex;
        border-radius: 10px;
        width: 100%;
        margin-bottom: 10px;
    }

    .lesson:hover {
        background: rgba(56, 104, 162, 0.4);
        cursor: pointer;
    }

    .lesson .img {
        width: 150px;
        height: 70px;
        margin-right: 10px;
    }

    .lesson .img img {
        width: 100%;
        object-fit: cover;
        height: 100%;
    }

    a.lesson {
        text-decoration: none;
    }

    @media (max-width: 1500px) {
        .all {
            display: block;
        }

        section.left {
            margin-right: 5px;
            margin: 0;
            width: 100%;
            background: rgba(38, 39, 43, 0.638)
        }

        .video iframe {
            width: 1200px;
            height: 600px;
        }

        section.rigth {
            margin-right: 5px;
            margin: 0;
            width: 100%;
            border-radius: 0;

        }

        section.left p {
            margin-left: 4px;
        }

        section.left h1 {
            margin-left: 4px;
            margin-right: 4px;

        }

        .video video {
            width: 100%;
        }

        .video {
            width: 100%;
            object-fit: cover;
            height: 100%;
        }

        a.lesson {
            text-decoration: none;
        }
    }

    @media (max-width: 1500px) {
        .all {
            display: block;
        }

        section.left {
            margin-right: 5px;
            margin: 0;
            width: 100%;
            background: rgba(38, 39, 43, 0.638)
        }

        section.rigth {
            margin-right: 5px;
            margin: 0;
            width: 100%;
            border-radius: 0;

        }

        section.left p {
            margin-left: 4px;
        }

        section.left h1 {
            margin-left: 4px;
            margin-right: 4px;

        }

        .video video {
            width: 100%;
        }

        .video iframe {
            height: 100%;
            width: 100%;

        }

        .video {
            width: 100%;
        }
    }
</style>
<main class="all">
    <section class="left">
        <div class=" video">
            @if (!$video->video_link)
            <video controls controlsList='nodownload' src="{{ Storage::url($video->video_path) }}" class="img-fluid"></video>
            @else
            @if ($video->video_provider == 'youtube' && isset(explode('=', $video->video_link)[1]))
            <iframe class="img-fluid" src="https://www.youtube.com/embed/{{ explode('=', $video->video_link)[1] }}"></iframe>
            @elseif ($video->video_provider == 'dailymotion' && isset(explode('video/', $video->video_link)[1]))
            <iframe class="embed-responsive-item img-fluid" src="https://www.dailymotion.com/embed/video/{{ explode('video/', $video->video_link)[1] }}"></iframe>
            @elseif ($video->video_provider == 'vimeo' && isset(explode('vimeo.com/', $video->video_link)[1]))
            <iframe class="embed-responsive-item img-fluid" src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $video->video_link)[1] }}" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
            @endif
            @endif
        </div>

        <h1 class="text-info" style="color: #fff;">
            {{ $video->title }}
        </h1>

        <h1 class="text-center">Le programme des videos</h1>
        <div class="overflow-auto " style=" height: 550px">
            <div class="list-group list-group-flush">
                <div class="lessons ">
                    <?php
                    $first = $video->chapter->lesson[0];
                    ?>
                    @forelse ($video->chapter->lesson as $video)
                    <?php
                    if ($first->title == $video->title) {
                    ?>
                        <a href="{{ route('layout-frontend.categories.video', $video) }}" class="lesson">
                            <div class="info">
                                <h5 style="color: #fff;">✅ {{ $video->title }}</h5>
                                <p>crée {{ $video->created_at }}</p>
                            </div>
                        </a>
                    <?php } else { ?>
                        <a href="#" class="lesson" style="cursor: not-allowed;">
                            <div class="info">
                                <h5 style="color: #fff;"> 🔒 {{ $video->title }}</h5>
                                <p>crée {{ $video->created_at }}</p>
                            </div>
                        </a>
                    <?php } ?>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </section>
</main>
@endsection