@extends('frontend.partials.main')
@section('content')
    <main id="main">

        <!-- ======= Intro Single ======= -->
        <section class="intro-single">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="title-single-box">
                            <h1 class="title-single" style="color: black">{{ $category->title }}</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Accueil</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Categories</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    {{ $category->title }}
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section><!-- End Intro Single -->

        <!-- ======= Agent Single ======= -->
        <section class="agent-single">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            @forelse ($category->chapters as $chapter)
                                <div class="col-md-4" style="color: black; cursor: pointer">
                                    <a class="card-box-c foo" href="{{ route('layout-frontend.lessons.show', $chapter) }}">
                                        <div class="card-header-c d-flex">
                                            <div class="card-box-ico">
                                                <p style="color: black">
                                                    <i class="bi bi-film"></i> {{ $chapter->title }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @empty


                                <div class="col-md-4">
                                    <div class="card-box-c foo">
                                        <div class="card-header-c d-flex">
                                            <div class="card-box-ico">
                                                <a style="color: black; cursor: pointer">
                                                    Aucune lecon pour le moment
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
        </section><!-- End Agent Single -->

    </main><!-- End #main -->
@endsection
