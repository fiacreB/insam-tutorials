@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">Add Course
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
                                    <h4 class="mt10">Course
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('admin.courses.store', $category->slug) }}" enctype="multipart/form-data"
                            class="container" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="form-label">Titre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Title"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                                <input type="file" accept="image/*" class="" id="image" name="image"
                                    placeholder="Image de presentation">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" name="category_id" value="{{ $category->id }}" />
                            <div class="form-group">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary">Valider</button>
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
