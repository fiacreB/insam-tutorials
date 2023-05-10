@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">All Categories</h4>
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
                                    <h4 class="mt10">Category</h4>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="candidate_revew_select style2 text-right">
                                    <ul class="mb0">
                                        <li class="list-inline-item">
                                            <a href="{{ route('admin.book_categories.create') }}"
                                                class="btn btn-primary"><span class="bi bi-plus"></span>Add category</a>
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
                                        <th>Parent</th>
                                        <th>Books </th>
                                        <th class="text-right"> Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bookCategories as $category)
                                        <tr>
                                            <td>
                                                <h4 class="me-4">
                                                    <a
                                                        href="{{ route('admin.book_categories.show', $category->slug) }}">{{ $category->title }}</a>
                                                </h4>
                                            </td>
                                            <td>{{ $category->parent ? $category->parent->title : '--' }} </td>
                                            <td>{{ $category->books->count() }}</td>
                                            <td class="text-right">

                                                <a class="editButton btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                    href="{{ route('admin.book_categories.edit', $category->slug) }}">
                                                    <span class="bi bi-pen"></span></a>
                                                <a class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                    href="{{ route('admin.book_categories.delete', $category->slug) }}">
                                                    <span class="bi bi-trash3"></span></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            <nav aria-label="">
                                <ul class="pagination pagination-circle ">
                                    {{ $bookCategories->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript">
        var route = "{{ route('admin.store') }}";
        $('#search').typeahead({
            source: function(query, process) {
                return $.get(route, {
                    query: query
                }, function(data) {
                    return process(data);
                });
            }
        });
    </script>
@endsection
