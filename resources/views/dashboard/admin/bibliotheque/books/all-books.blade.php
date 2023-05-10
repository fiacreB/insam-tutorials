@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">All Books
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
                                    <h4 class="mt10">Books
                                    </h4>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="candidate_revew_select style2 text-right">
                                    <ul class="mb0">
                                        <li class="list-inline-item">
                                            <a href="{{ route('admin.books.allCreate', $user) }}" class="btn btn-primary">
                                                <span class="bi bi-plus"></span>Add book
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
                        <div class="container">
                            <table class="table">
                                <thead class="">
                                    <tr>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>View </th>
                                        <th>Bibliothèaue </th>
                                        <th class="text-right"> Option</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($books as $book)
                                        <tr>
                                            <td>
                                                {{ $book->title }}
                                            </td>
                                            <td style="width: 70px;"><img alt="{{ $book->title }}"
                                                    src="{{ Storage::url($book->image) }}" class="img-fluid"
                                                    height="50" />
                                            </td>
                                            <td> {{ $book->views }} @if ($book->views > 1)
                                                    vues
                                                @else
                                                    vue
                                                @endif
                                            </td>
                                            <td>
                                                <a class="text-primary "
                                                    href="{{ route('admin.book_categories.show', ['bookCategory' => $book->category]) }}">{{ $book->category ? $book->category->title : '-' }}</a>
                                            </td>
                                            <td class="text-right">
                                                <a class="btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                    href="{{ route('admin.books.edit', $book->slug) }}">
                                                    <span class="bi bi-pen"></span></a>
                                                <a class=" btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete "
                                                    href="{{ route('admin.books.delete', $book->slug) }}">
                                                    <span class="bi bi-trash3"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <nav aria-label="">
                                <ul class="pagination pagination-circle ">
                                    {{ $books->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
