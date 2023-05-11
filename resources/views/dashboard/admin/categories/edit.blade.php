@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">Edit <span class="ml-3  text-info">{{ $category->title }}</span>
                    </h4>
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Dashboard</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-12">
                <div class="my_course_content_container">
                    <div class="my_course_content mb30">
                        <div class="my_course_content_header">
                            <div class="col-xl-4">
                                <div class="instructor_search_result style2">
                                    <h4 class="mt10">Category
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('admin.categories.update', $category->slug) }}" class="container"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $category->title }}">
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                                <input type="file" accept="image/*" class="" id="image" name="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" aria-label="With textarea">{{ $category->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/assets-admin/js/ckeditor.js') }}"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#description'), {})
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>
@endsection
