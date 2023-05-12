@extends('frontend.partials.main')
@section('content')
    <main id="main" style="margin-top: 3px;">
        <!-- ======= Intro Single ======= -->
        <section class="intro-single mt-5 mb-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="title-single-box">
                            <h1 class="title-single" style="color: black">Toutes les Categories - bibliothèque</h1>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-4">
                        <nav aria-label="breadcrumb" class="breadcrumb-box d-flex justify-content-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Accueil</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Categories
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>




        <!-- =======  Blog Grid ======= -->
        <section class="news-grid grid">
            <div class="container">
                <div class="row">
                    @forelse ($bookCategories as $bookCategory)
                        <div class="col-md-3">
                            <div class="card-box-b card-shadow news-box">
                            <a
                                                    href="{{ route('layout-frontend.book.categories.show', $bookCategory) }}">
                                <div class="img-box-b">
                                    <img src="{{ asset('utils/img/post-1.jpg') }}" alt="" class="img-b img-fluid">
                                </div>
                                </a>
                                <div class="card-overlay">
                                    <div class="card-header-b">
                                        <div class="card-title-b">
                                            <h2 class="title-2">
                                                <a
                                                    href="{{ route('layout-frontend.book.categories.show', $bookCategory) }}">{{ $bookCategory->title }}</a>
                                            </h2>
                                        </div>
                                        <div class="card-category-b">
                                            <a href="#" class="category-b">{{ $bookCategory->created_at }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-4">
                            <div class="card-box-b card-shadow news-box">
                                <div class="card-overlay">
                                    <div class="card-title-b">
                                        <h2 class="title-2">
                                            <a href="#">Aucune bibliothèque</a>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </section><!-- End Blog Grid-->
    </main>
@endsection
