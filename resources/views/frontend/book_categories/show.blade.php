@extends('frontend.partials.main')
@section('content')
    <main id="main" style="margin-top: 3px;">
        <section class="intro-single mt-5 mb-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-lg-8">
                        <div class="section-title">
                            <p>Tous les livres de {{ $bookCategory->title }} ({{ $bookCategory->books->count() }})</p>
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

        <section class="news-grid grid">
            <div class="container">
                <div class="row">
                    @forelse ($bookCategory->books as $book)

                        <div class="col-md-3 col-sm-4">
                            <div class="card-box-b card-shad news-box">
            <a href="{{ route('layout-frontend.book.show', $book->slug) }}">

                                <div class="img-box-b">
                                    <img alt="{{ $book->title }}" src="{{ Helper::url($book->image) }}"
                                        class="img-b img-fluid" />
                                </div>

                                </a>

                                    <!-- <div class="card-overlay">
                                        <div class="card-header-b">
                                            <div class="card-title-b">
                                                <h2 class="title-2">
                                                    {{ $book->title }}
                                                </h2>
                                            </div>
                                            <div class="card-category-b">
                                                <p href="#" class="category-b">{{ $book->created_at }}</p>

                                                {{ $book->views }}
                                                @if ($book->views > 1)
                                                    vues
                                                @else
                                                    vue
                                                @endif
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                    @empty

                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                            <div class="course-item">
                                <div class="course-content">
                                    <h3><a href="#">Aucune livre pour l'instant</a></h3>
                                </div>
                            </div>
                        </div>
                    @endforelse

                </div>
            </div>

        </section>
    </main>
@endsection
