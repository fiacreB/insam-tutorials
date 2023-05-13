@extends('frontend.partials.main')
@section('content')

    <?php
    
    use App\Models\Lesson;
    
    ?>

    <section class="inner_page_breadcrumb csv1 top">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 offset-xl-3 text-center">
                    <div class="breadcrumb_content">
                        <h4 class="breadcrumb_title">Cours</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                            <li class="breadcrumb-item">Formations</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $course->title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .thumb-image {
            border-radius: 50%;
        }
    </style>
    <!-- Our Team Members -->
    <section class="our-team pb40">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="courses_single_container">

                                <div class="cs_row_two">

                                </div>
                                <div class="cs_row_three">
                                    <div class="cs_overview">
                                        {{-- <h4 class="title">Overview</h4> --}}
                                        <h4 class="subtitle">Description de la formation</h4>
                                        <p class="mb30">
                                            {!! $course->description !!}
                                        </p>


                                    </div>


                                    <div class="course_content">
                                        <div class="cc_headers">
                                            <h4 class="title">Contenu de la formation</h4>
                                            {{-- <ul class="course_schdule float-right">
												<li class="list-inline-item"><a href="#">92 Lectures</a></li>
												<li class="list-inline-item"><a href="#">10:56:11</a></li>
											</ul> --}}
                                        </div>
                                        <br>
                                        <style>
                                            .bg {
                                                background-color: rgb(94, 107, 247);
                                            }

                                            .bg:hover {
                                                opacity: 75%;
                                            }

                                            a:hover {
                                                color: rgb(0, 20, 245)
                                            }
                                        </style>
                                        <table class="table">
                                            <tbody>
                                                @forelse($chapters as $chapter)
                                                    <?php
                                                    $lessons = Lesson::where('chapter_id', $chapter->id)->get();
                                                    $lessonFirst = Lesson::where('chapter_id', $chapter->id)->first();
                                                    ?>
                                                    <tr class="bg">
                                                        <td class="h3 text-center ">
                                                            <a
                                                                href="{{ route('layout-frontend.categories.video', ['video' => $lessonFirst]) }}">
                                                                {{ $chapter->title }}</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="container">
                                                            @forelse($lessons as $lesson)
                                                                @if ($chapter->first == 'first')
                                                                    <ul class="cs_list">
                                                                        <li class="mt-3 "><a
                                                                                href="{{ route('layout-frontend.categories.video', ['video' => $lesson]) }}"><span
                                                                                    class="flaticon-play-button-1  mr-3 icon"></span>{{ $lesson->title }}</a>
                                                                        </li>
                                                                    </ul>
                                                                @else
                                                                    @foreach ($attempts as $attempt)
                                                                        @if ($attempt->marks >= $chapter->pass_marks && $attempt->valid == $chapter->id)
                                                                            <ul class="cs_list mb0">
                                                                                <li class="mt-3"><a
                                                                                        href="{{ route('layout-frontend.categories.video', ['video' => $lesson]) }}"><span
                                                                                            class="flaticon-play-button-1 mr-3 icon"></span>{{ $lesson->title }}</a>
                                                                                </li>
                                                                            </ul>
                                                                        @else
                                                                            <ul class="cs_list mb0">
                                                                                <li><a href="#"><span
                                                                                            class="flaticon-key-1 icon"></span>{{ $lesson->title }}</a>
                                                                                </li>
                                                                            </ul>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @empty
                                                                <div class="col-md-4">
                                                                    <div class="card-box-c foo">
                                                                        <div class="card-header-c d-flex">
                                                                            <div class="card-box-ico">
                                                                                <a style="color: black; cursor: pointer">
                                                                                    Pas de lesson displonible
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforelse
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <a href="#"><span class="flaticon-close-button-1 icon"></span> Pas
                                                        de
                                                        somaire disponible pour ce cours</a>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="instructor_pricing_widget">
                        <h5 class="subtitle text-left">Chapitres</h5>
                        <ul class="price_quere_list text-left">
                            @foreach ($chapters as $chapter)
                                <li><a href="#"><span class=""></span>{{ $chapter->title }}</a></li>
                            @endforeach

                            {{-- <li><a href="#"><span class="flaticon-key-1"></span> Full lifetime access</a></li> --}}
                    </div>
                    <div class="feature_course_widget">
                        <ul class="list-group">
                            <h4 class="title">Formation recentes</h4>
                            @foreach ($othersCourses as $course)
                                <li class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('layout-frontend.courses.show', $course) }}">{{ $course->title }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
