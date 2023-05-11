@extends('frontend.partials.main')

@section('content')

<section class="inner_page_breadcrumb csv1">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 offset-xl-3 text-center">
                <div class="breadcrumb_content">
                    <h4 class="breadcrumb_title">Cours</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">{{$course->category->title}} </a></li>
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
											{{-- <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#">4.5 (11,382 Ratings)</a></li> --}}
										</ul>
										{{-- <ul class="cs_review_enroll">
											<li class="list-inline-item"><a href="#"><span class="flaticon-profile"></span> 57,869 students enrolled</a></li>
											<li class="list-inline-item"><a href="#"><span class="flaticon-comment"></span> 25 Review</a></li>
										</ul> --}}
										<div class="courses_big_thumb">
											<div class="thumb">
												<iframe class="iframe_video" src="//www.youtube.com/embed/57LQI8DKwec" frameborder="0" allowfullscreen></iframe>
											</div>
										</div>
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
											<h4 class="title">Course Content</h4>
											<ul class="course_schdule float-right">
												<li class="list-inline-item"><a href="#">92 Lectures</a></li>
												<li class="list-inline-item"><a href="#">10:56:11</a></li>
											</ul>
										</div>
										<br>
										<div class="details">
										  	<div id="accordion" class="panel-group cc_tab">
											    <div class="panel">
											      	<div class="panel-heading">
												      	<h4 class="panel-title">
												        	<a href="#panelBodyCourseStart" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion">Getting Started</a>
												        </h4>
											      	</div>
												    <div id="panelBodyCourseStart" class="panel-collapse collapse show">
												        <div class="panel-body">
												        	<ul class="cs_list mb0">
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.1 Introduction to the User Experience Course <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.2 Exercise: Your first design challenge <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.3 How to solve the previous exercise <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.4 Find out why smart objects are amazing <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.5 How to use text layers effectively <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        	</ul>
												        </div>
												    </div>
											    </div>
											</div>
										</div>
										<div class="details">
										  	<div id="accordion" class="panel-group cc_tab">
											    <div class="panel">
											      	<div class="panel-heading">
												      	<h4 class="panel-title">
												        	<a href="#panelBodyCourseBrief" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion">The Brief</a>
												        </h4>
											      	</div>
												    <div id="panelBodyCourseBrief" class="panel-collapse collapse">
												        <div class="panel-body">
												        	<ul class="cs_list mb0">
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.1 Introduction to the User Experience Course <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.2 Exercise: Your first design challenge <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.3 How to solve the previous exercise <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.4 Find out why smart objects are amazing <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.5 How to use text layers effectively <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        	</ul>
												        </div>
												    </div>
											    </div>
											</div>
										</div>
										<div class="details">
										  	<div id="accordion" class="panel-group cc_tab">
											    <div class="panel">
											      	<div class="panel-heading">
												      	<h4 class="panel-title">
												        	<a href="#panelBodyCourseLow" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion">Wireframing Low Fidelity</a>
												        </h4>
											      	</div>
												    <div id="panelBodyCourseLow" class="panel-collapse collapse">
												        <div class="panel-body">
												        	<ul class="cs_list mb0">
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.1 Introduction to the User Experience Course <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.2 Exercise: Your first design challenge <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.3 How to solve the previous exercise <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.4 Find out why smart objects are amazing <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.5 How to use text layers effectively <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        	</ul>
												        </div>
												    </div>
											    </div>
											</div>
										</div>
										<div class="details">
										  	<div id="accordion" class="panel-group cc_tab">
											    <div class="panel">
											      	<div class="panel-heading">
												      	<h4 class="panel-title">
												        	<a href="#panelBodyCourseType" class="accordion-toggle link" data-toggle="collapse" data-parent="#accordion">Type, Color & Icon Introduction</a>
												        </h4>
											      	</div>
												    <div id="panelBodyCourseType" class="panel-collapse collapse">
												        <div class="panel-body">
												        	<ul class="cs_list mb0">
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.1 Introduction to the User Experience Course <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.2 Exercise: Your first design challenge <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.3 How to solve the previous exercise <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.4 Find out why smart objects are amazing <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        		<li><a href="#"><span class="flaticon-play-button-1 icon"></span> Lecture1.5 How to use text layers effectively <span class="cs_time">02:53</span> <span class="cs_preiew">Preview</span></a></li>
												        	</ul>
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

			</div>
		</div>
	</section>

@endsection