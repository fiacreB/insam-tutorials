@php
    use App\Models\Course;
    use App\Models\Category;
    use App\Models\Lesson;
    use App\Models\Book;
    use App\Models\User;
    $courses = Course::all();
    $lessons = Lesson::all();
    $books = Book::all();
    $categories = Category::all();
    $users = User::all();
@endphp


@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <!-- Our Dashbord -->
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">Dashboard</h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="ff_one">
                    <div class="icon"><span class="flaticon-online-learning"></span></div>
                    <div class="detais">
                        <p>Categories Courses</p>
                        <div class="timer">{{ $categories->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="ff_one style3">
                    <div class="icon"><span class="bi bi-bookmarks"></span></div>
                    <div class="detais">
                        <p>Courses</p>
                        <div class="timer">{{ $courses->count() }}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="ff_one style2">
                    <div class="icon"><span class="bi bi-camera-reels"></span></div>
                    <div class="detais">
                        <p>Videos</p>
                        <div class="timer">
                            {{ $lessons->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="ff_one style4">
                    <div class="icon"><span class="bi bi-book"></span></div>
                    <div class="detais">
                        <p>Books</p>
                        <div class="timer">
                            {{ $books->count() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-6 col-xl-3">
                <div class="ff_one style3">
                    <div class="icon"><span class="bi bi-people"></span></div>
                    <div class="detais">
                        <p>All Users</p>
                        <div class="timer">
                            {{ $users->count() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="application_statics">
                    <h4>Your Profile Views</h4>
                    <div class="c_container"></div>
                </div>
            </div>
        </div>

        @include('dashboard.admin.layout.partials.footer')
    </div>
@endsection
