@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">Edit video : <span class="text-info"> {{ $lesson->title }}</span>
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
                                    <h4 class="mt10">Edit
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <form id="fileUploadForm" method="POST" action="{{ route('admin.lessons.update', $lesson->slug) }}"
                            enctype="multipart/form-data" class="container">
                            @csrf
                            @if ($lesson->video_path === 'null')
                                <div class="form-group ">
                                    <label class="from-label">Provenance de la video</label>
                                    <select class="form-control aiz-selectpicker" name="video_provider" id="video_provider">
                                        <option value="{{ $lesson->video_provider }}">{{ $lesson->video_provider }}
                                        </option>
                                        {{-- <option value="dailymotion">Dailymotion</option> --}}
                                        {{-- <option value="vimeo">Vimeo</option> --}}
                                    </select>
                                </div>
                                <div class="form-group ">
                                    <label class="from-label">Lien de la video</label>
                                    <input type="text" class="form-control" name="video_link" placeholder="Video Link"
                                        value="{{ $lesson->video_link }}">
                                    <small class="text-muted">Utilisez le lien approprié sans paramètre supplémentaire.
                                        N'utilisez pas de lien de partage.</small>
                                </div>
                                <div class="form-group ">
                                    <label class="from-label">Titre</label>
                                    <input type="text" class="form-control" name="title" placeholder="Titre"
                                        value="{{ $lesson->title }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="editor">Description</label>
                                    <textarea class="form-control" id="editor" name="description">
                                        {{ $lesson->description }}</textarea>
                                </div>
                            @else
                                <div class="form-group">
                                    <label class="from-label">Titre</label>
                                    <input type="text" class="form-control" name="title" placeholder="Titre"
                                        value="{{ $lesson->title }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="editor">Description</label>
                                    <textarea class="form-control" id="editor" name="description">
                                        {{ $lesson->description }}</textarea>
                                </div>
                                <div class="form-group ">
                                    <input type="hidden" class="form-control" name="video_provider"
                                        value="{{ $lesson->video_provider }}" id="video_provider">
                                </div>
                                <div class="form-group ">
                                    <input type="hidden" class="form-control" name="video_link"
                                        value="{{ $lesson->video_link }}">
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="chapter_id" class="form-label">Select Chapter</label>
                                <select class="form-control" name="chapter_id" id="chapter_id">
                                    <option value="">Aucun</option>
                                    @foreach ($chapters as $chapter)
                                        <option @if ($chapter->id === $lesson->chapter_id) selected @endif
                                            value="{{ $chapter->id }}">
                                            {{ $chapter->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"
                                        role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 0%"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Valider" class="form-control btn btn-primary">
                            </div>
                        </form>
                        {{-- <div class="d-flex">
                            <div class=" w-100"><a class="me-2"
                                    href="{{ route('admin.chapters.show', $chapter->slug) }}"><u><b><i>voir les videos du
                                                chapitre</i></b> </u></a></div>
                            <div class="w-100"><a href="{{ route('admin.lessons.createlien', $chapter->slug) }}"
                                    class="btn btn-success mx-5 my-1"> Ajouter un
                                    lien</a></div>


                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/admin/js/jquery.form.js') }}"></script>
    <script src="{{ asset('/admin/js/ckeditor.js') }}"></script>
    <script>
        $(function() {
            $(document).ready(function() {
                $('#fileUploadForm').ajaxForm({
                    beforeSend: function() {
                        var percentage = '0';
                    },
                    uploadProgress: function(event, position, total, percentComplete) {
                        var percentage = percentComplete;
                        $('.progress .progress-bar').css("width", percentage + '%', function() {
                            return $(this).attr("aria-valuenow", percentage) + "%";
                        })
                    },
                    complete: function(xhr) {
                        alert('Update!!');
                        location.reload();
                    }
                });
            });
        });
        ClassicEditor
            .create(document.querySelector('#editor'), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
    </script>
@endsection
