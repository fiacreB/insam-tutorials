@extends('frontend.partials.main')
@section('content')
    <main id="main">

        <section class="inner_page_breadcrumb csv1">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 offset-xl-3 text-center">
                        <div class="breadcrumb_content">
                            <h4 class="breadcrumb_title">Categories</h4>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Accueil</a></li>
                                <li class="breadcrumb-item active">Categories</li>
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
				<div class="col-md-12 col-lg-12 col-xl-12">
					<div class="row">
						<div class="col-sm-5 col-lg-5 col-xl-6">
							<div class="instructor_search_result">
								<p class="mt10 fz15"><span class="color-dark"> {{ count($categories)}}</span> Categories</p>
							</div>
						</div>
						{{-- <div class="col-sm-7 col-lg-7 col-xl-6">
							<div class="candidate_revew_search_box mb30 float-right fn-520">
								<form class="form-inline my-2 my-lg-0">
							    	<input class="form-control mr-sm-2" type="search" placeholder="Search our instructors" aria-label="Search">
							    	<button class="btn my-2 my-sm-0" type="submit"><span class="flaticon-magnifying-glass"></span></button>
							    </form>
							</div>
						</div> --}}
					</div>
					<div class="row">
                        @forelse ($categories as $category)
						<div class="col-sm-6 col-lg-6 col-xl-4">
							<div class="team_member style3 text-center mb30">
								<div class="instructor_col">
                                    <div class="thumb">
										<img class="img-fluid img-rounded-circle" src="{{ Storage::url($category->image) }}" alt="7.png">
									</div>
									<div class="details">
										<h4>{{ $category->title }}</h4>
										<p>{{ $category->description }}</p>
										<ul>
											{{-- <li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#"><i class="fa fa-star"></i></a></li>
											<li class="list-inline-item"><a href="#">(6)</a></li> --}}
										</ul>
									</div>
								</div>
								<div class="tm_footer">
									<ul>
                                        <li class="list-inline-item">Date {{$category->updated_at}}</li>
                                        <a href="{{ route('layout-frontend.categories.showcourse', $category) }}" class="text-primary">Decouvrir les cours</a>
									</ul>
								</div>
							</div>
						</div>
                        @empty
                        <div class="col-md-4">
                            <div class="card-box-b card-shadow news-box">
                                <div class="card-overlay">
                                    <div class="card-title-b">
                                        <h2 class="title-2">
                                            <a href="#">Aucune categorie pour le moment !</a>
                                        </h2>
                                    </div>
                                    <div class="card-date">
                                        <span class="date-b">18 Sep. 2017</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                @endforelse
					</div>
				</div>
			</div>
		</div>
	</section>


@endsection
