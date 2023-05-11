<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>

@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')

    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">All Videos</span>
                    </h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-12">
                <div class="my_course_content_container">
                    <div class="my_course_content mb30">
                        <div class="my_course_content_header">
                            <div class="col-xl-4">
                                <div class="instructor_search_result style2">
                                    <h4 class="mt10">videos (<span class="text-info">{{ $lessons->count() }}</span>)</h4>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="candidate_revew_select style2 text-right">
                                    <ul class="mb0">
                                        <li class="list-inline-item">
                                            <a href="{{ route('admin.lessons.allCreate', ['user' => Auth::user()->id]) }}"
                                                class="btn btn-primary"><span class="bi bi-plus"></span> Ajouter
                                                une
                                                video
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <form class="" id="sort_capacities" action="" method="GET">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" id="search" name="search"
                                                        placeholder="Type name & Enter" class="form-control" />
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <style>
                            .video_div {
                                height: 100px;
                                overflow: auto;
                            }
                        </style>
                        <div class="row row-cols-1 row-cols-md-3 g-4 container py-3">
                            @forelse ($lessons as $video)
                                <div class="col-xl-3">
                                    <div class="card mt-4 ">
                                        @if ($video->video_link === 'null' || !$video->video_link)
                                            <video controls controlsList='nodownload'
                                                src="{{ Storage::url($video->video_path) }}" height="250"
                                                class="card-img-top"></video>
                                        @else
                                            @if ($video->video_provider == 'youtube' && isset(explode('=', $video->video_link)[1]))
                                                <iframe class="card-img-top" height="250"
                                                    src="https://www.youtube.com/embed/{{ explode('=', $video->video_link)[1] }}"></iframe>
                                            @elseif ($video->video_provider == 'dailymotion' && isset(explode('video/', $video->video_link)[1]))
                                                <iframe class="card-img-top" height="250"
                                                    src="https://www.dailymotion.com/embed/video/{{ explode('video/', $video->video_link)[1] }}"></iframe>
                                            @elseif ($video->video_provider == 'vimeo' && isset(explode('vimeo.com/', $video->video_link)[1]))
                                                <iframe class="card-img-top" height="250"
                                                    src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $video->video_link)[1] }}"
                                                    width="500" height="281" frameborder="0" webkitallowfullscreen
                                                    mozallowfullscreen allowfullscreen></iframe>
                                            @endif
                                        @endif
                                        <div class="card-body video_div">
                                            <h5 class="card-title">{{ $video->chapter->title }}</h5>
                                            <p class="card-text">{{ $video->title }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted d-flex row">
                                                <div class="col ">
                                                    <i class="bx bx-user"></i>&nbsp; <span
                                                        class="text-info">{{ $video->visits }}</span>
                                                    &nbsp;&nbsp;
                                                    <i class="bx bx-heart"></i>&nbsp; <span
                                                        class="text-success">{{ $video->likes->count() }}</span>
                                                    &nbsp;&nbsp;
                                                </div>
                                                <div class="col text-right">
                                                    <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                        href="{{ route('admin.lessons.edit', $video->slug) }}"> <span
                                                            class="bi bi-pen"></span></a>
                                                    <a class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        href="{{ route('admin.lessons.delete', $video->slug) }}"><span
                                                            class="bi bi-trash3"></span></a>
                                                </div>
                                            </small>
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
                            <nav aria-label="">
                                <ul class="pagination pagination-circle ">
                                    {{ $lessons->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
