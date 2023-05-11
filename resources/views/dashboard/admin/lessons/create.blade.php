@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">Add Video
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
                                    <h4 class="mt10">Video
                                    </h4>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="candidate_revew_select style2 text-right">
                                    <ul class="mb0">
                                        <li class="list-inline-item">
                                            <a href="{{ route('admin.lessons.createlien', $chapter->slug) }}"
                                                class="btn btn-primary"><span class="bi bi-plus"></span>Video link</a>
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
                        <form id="fileUploadForm" method="POST" action="{{ route('admin.lessons.store', $chapter) }}"
                            enctype="multipart/form-data" class="container">
                            @csrf
                            <div class="form-group col-md-12">
                                <label for="title" class="form-label">Videos <span class="text-danger">*</span></label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" accept="video/*" multiple class="custom-file-input"
                                            id="video" value="link" name="videos[]" placeholder="Video">
                                        <label class="custom-file-label">Choose file</label>
                                    </div>
                                </div>
                                @error('videos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                        <div class=" container text-left py-3">
                            <a href="{{ route('admin.chapters.show', $chapter->slug) }}" class="text-info">Toutes les
                                videos du
                                chapitre</a>
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
                            alert('Aouter avec success!!');
                            location.reload();
                        }
                    });
                });
            });

            ClassicEditor.create(document.querySelector('#editor'), {
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
