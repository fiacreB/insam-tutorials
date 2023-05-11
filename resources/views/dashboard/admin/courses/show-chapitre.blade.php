<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>

@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')

    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">Tous les chapitres de : <span class="text-info">{{ $course->title }}</span>
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
                                    <h4 class="mt10">Chapitres</h4>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="candidate_revew_select style2 text-right">
                                    <ul class="mb0">
                                        <li class="list-inline-item">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#addchapterModal">
                                                <span class="bi bi-plus"></span> Ajouter un chapitre
                                            </button>
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
                        <table class="table">
                            <thead class="">

                                <tr>
                                    <th>#</th>
                                    <th>chapitre</th>
                                    <th>Add videos</th>
                                    <th class="text-right">Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @forelse ($course->chapters as $chapter)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $chapter->title }}</td>
                                        <td>
                                            <a href="{{ route('admin.chapters.show', $chapter->slug) }}"
                                                class="btn btn-info">Ajouter
                                                les videos</a>
                                        </td>
                                        <td class="text-right">
                                            <button class="btn btn-soft-primary btn-icon btn-circle btn-sm editButton"
                                                data-id="{{ $chapter->id }}" data-chapter="{{ $chapter->title }}"
                                                data-first="{{ $chapter->first }}"
                                                data-description="{{ $chapter->description }}" data-toggle="modal"
                                                data-target="#editchapterModal"><span class="bi bi-pen"></span></button>
                                            <button
                                                class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete deleteButton"
                                                data-id="{{ $chapter->id }}" data-toggle="modal"
                                                data-target="#deletechapterModal"><span
                                                    class="bi bi-trash3"></span></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr colspan="4">
                                        <h3><a href="#">Aucun chapitre pour l'instant</a></h3>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <nav aria-label="">
                            <ul class="pagination pagination-circle ">
                                {{ $chapters->links() }}
                            </ul>
                        </nav>

                        <!-- Modal -->
                        <div class="modal fade" id="addchapterModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter un chapitre</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="addChapter" class="container">
                                        @csrf

                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="chapter" class="form-label">Chapitre</label>
                                                <input id="title" type="text" class="form-control" name="title"
                                                    placeholder="Entrer le nom du chapitre" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="description" class="form-label">description</label>
                                                <textarea class="form-control" name="description" id="description" placeholder="Description" required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <select name="first" id="first" required>
                                                    <option value="No">No</option>
                                                    <option value="first">first</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Edite Chapter Model --}}
                        <div class="modal fade" id="editchapterModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit le Chapitre</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="editChapter" class="container">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="chapter" class="form-label">Chapitre</label>
                                                <input type="text" class="form-control  " name="title"
                                                    placeholder="Entrer le nom du chapter" required id="edit_chapter">
                                                <input class="form-control  " type="hidden" name="id"
                                                    id="edit_chapter_id">
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="form-label">Description</label>
                                                <textarea class="form-control" name="description" id="edit_description" placeholder="Description" required></textarea>
                                                <input type="hidden" name="id" id="edit_description_id">
                                            </div>
                                            <div class="form-group">
                                                <select name="first" id="edit_first" required>
                                                    <option value="No">No</option>
                                                    <option value="first">first</option>
                                                </select>
                                                <input class="form-control  " type="hidden" name="id"
                                                    id="edit_first_id">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Delete Chapter Model --}}
                        <div class="modal fade" id="deletechapterModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete chapitre</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form id="deleteChapter" class="container">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <p>voulez vous vraiment supprimer ce chapitre ?</p>
                                                <input type="hidden" name="id" id="delete_chapter_id">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('/assets-admin/js/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#addChapter").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.chapters.store', $course->slug) }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {
                            location.reload();
                        } else {
                            location.reload();
                            alert(data.msg);
                        }
                    }
                });
            });

            //edit chapter

            $(".editButton").click(function() {
                var chapter_id = $(this).attr('data-id');
                var chapter = $(this).attr('data-chapter');
                var first = $(this).attr('data-first');
                var description = $(this).attr('data-description');
                $("#edit_chapter").val(chapter);
                $("#edit_first").val(first);
                $("#edit_description").val(description);
                $("#edit_chapter_id").val(chapter_id);
                $("#edit_first_id").val(chapter_id);
                $("#edit_description_id").val(chapter_id);
            });


            $("#editChapter").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.chapters.edit', $course->slug) }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            });

            //delete chapter

            $(".deleteButton").click(function() {
                var chapter_id = $(this).attr('data-id');
                $("#delete_chapter_id").val(chapter_id);

            });

            $("#deleteChapter").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.chapters.deleteChapter', $course->slug) }}",
                    type: "GET",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            });
        });
        ClassicEditor
            .create(document.querySelector('#edit_description'), {
                // toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(err => {
                console.error(err.stack);
            });
        ClassicEditor
            .create(document.querySelector('#description'), {
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
