@extends('frontend.partials.main')

@section('content')

<?php
    
use App\Models\Lesson;

?>

<section class="inner_page_breadcrumb csv1">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 text-center">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">Cours</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                        <li class="breadcrumb-item">Formations</li>
                        <li class="breadcrumb-item active" aria-current="page">{{$course->title}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

	<!-- Our Team Members -->
	<section class="our-team pb40">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-8 col-xl-9">
					<div class="row">
						<div class="col-lg-12">
							<div class="courses_single_container">
								<div class="cs_row_one">
									<div class="cs_ins_container">
										<div class="cs_instructor">
											<ul class="cs_instrct_list float-left mb0">
												<li class="list-inline-item"><img class="thumb" src="{{asset('admin/images/team/4.png')}}" alt="4.png"></li>
												
												<li class="list-inline-item"><a href="#">Derniere mise a jour {{$course->updated_at}}</a></li>
											</ul>
											
										</div>
										<h3 class="cs_title">{{$course->title}}</h3>
										<ul class="cs_review_seller">
											<li class="list-inline-item"><a href="#"><span>{{$course->category->title}}</span></a></li>
										</ul>
										
                                        <?php
                                        if (sizeof($chapters) > 0) {
                                            $first = Lesson::where('chapter_id', $chapters[0]->id)->first();
                                            ?>
                                            
                                        
										<div class="courses_big_thumb">
											<div class="thumb">
                                                {{-- @if (!$video->video_link) --}}
                                                <video controls controlsList='nodownload' src="{{ Storage::url($first->video_path) }}"
                                                    width="100%" class="img"></video>
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
                                        @php
                                        }
                                        @endphp
									</div>
								</div>
								<div class="cs_row_two">
									
								</div>
								<div class="cs_row_three">
                                    <div class="cs_overview">
										{{-- <h4 class="title">Overview</h4> --}}
										<h4 class="subtitle">Description de la formation</h4>
										<p class="mb30">
                                            {{$course->description}}
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
                                        @forelse($chapters as $chapter)

										<div class="details">
										  	<div id="accordion" class="panel-group cc_tab">
											    <div class="panel">
											      	<div class="panel-heading">
												      	<h4 class="panel-title">
												        	<a href="#panelBodyCourseStart" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion">{{ $chapter->title }}</a>
												        </h4>
											      	</div>
												    <div id="panelBodyCourseStart" class="panel-collapse collapse show">
												        <div class="panel-body">
												        	
                                                                <?php
                                                                $lessons = Lesson::where('chapter_id', $chapter->id)->get();
                                                                ?>

                                                                @forelse($lessons as $lesson)
                                                                <ul class="cs_list mb0">
                                                                    @if ($chapter->first == 'first')
                                                                        <?php if ($first->title == $lesson->title) { ?>
                                                                        <li><a href="#"><span class="flaticon-play-button-1 icon"></span>{{$lesson->title}}</a></li>
                                                                        <?php } else { ?>
                                                                        <li><a href="#"><span class="flaticon-key-1 icon"></span>{{$lesson->title}}</a></li>
                                                                        <?php } ?>
                                                                    @else
                                                                    <li><a href="#"><span class="flaticon-key-1 icon"></span>{{$lesson->title}}</a></li>
                                                                        @foreach ($attempts as $attempt)
                                                                            @if ($attempt->marks >= $chapter->pass_marks && $attempt->valid == $chapter->id)
                                                                                <?php if ($first->title == $lesson->title) { ?>
                                                                                    <li><a href="#"><span class="flaticon-play-button-1 icon"></span>{{$lesson->title}}</a></li>
                                                                                    <?php } else { ?>
                                                                                    <li><a href="#"><span class="flaticon-key-1 icon"></span> {{$lesson->title}}</a></li>
                                                                                <?php } ?>
                                                                            @else
												        		                <li><a href="#"><span class="flaticon-key-1 icon"></span> {{$lesson->title}}</a></li>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
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
												        	
												        </div>
												    </div>
											    </div>
											</div>
										</div>

                                        @empty
                                        <a href="#"><span class="flaticon-close-button-1 icon"></span> Pas de somaire disponible pour ce cours</a>
                                        @endforelse
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
						    	<a href="{{ route('layout-frontend.courses.show', $course) }}">{{$course->title}}</a> 
							</li>
                            @endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>

    @endsection