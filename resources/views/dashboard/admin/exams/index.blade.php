<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>

@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">All Exams</span>
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
                                    <h4 class="mt10">Exams</h4>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="candidate_revew_select style2 text-right">
                                    <ul class="mb0">
                                        <li class="list-inline-item">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#addExamModal">
                                                <span class="bi bi-plus"></span>Add Exam
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
                        <div class="container">
                            <table class="table">
                                <thead class="">
                                    <tr>
                                        <th>#</th>
                                        <th>Exam Name</th>
                                        <th>Chapitre</th>
                                        {{-- <th>Date</th> --}}
                                        <th>Time</th>
                                        <th>Add Q & A</th>
                                        <th class="text-right">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp
                                    @if (count($exams) > 0)
                                        @foreach ($exams as $exam)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $exam->examen_name }}</td>
                                                <td>{{ $exam->chapter->title }}</td>
                                                {{-- <td>{{ $exam->date }}</td> --}}
                                                <td>{{ $exam->time }} Hrs</td>
                                                <td>

                                                    <a class="btn btn-info"
                                                        href="{{ route('admin.tests.create', $exam->chapter, $exam) }}">
                                                        <span class="bi bi-plus"></span>
                                                        Ajouter une
                                                        question</a>
                                                </td>
                                                <td class="text-right">
                                                    {{-- <button
                                                        class="btn btn-soft-primary btn-icon btn-circle btn-sm editButton"
                                                        data-id="{{ $exam->id }}" data-toggle="modal"
                                                        data-target="#editExamModal"><span
                                                            class="bi bi-pen"></span></button> --}}
                                                    <button
                                                        class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete deleteButton"
                                                        data-id="{{ $exam->id }}" data-toggle="modal"
                                                        data-target="#deleteExamModal"><span
                                                            class="bi bi-trash3"></span></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="4">
                                                <h5><a href="#">Aucun Examen pour l'instant</a></h5>
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                            <nav aria-label="">
                                <ul class="pagination pagination-circle ">
                                    {{ $exams->links() }}
                                </ul>
                            </nav>
                            <!-- Modal -->
                            <div class="modal fade" id="addExamModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Ajouter un Examen</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="" id="addExam" class="container">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="from-group">
                                                    <label for="name" class="form-label">Entrer le nom de
                                                        l'examen</label>
                                                    <input type="text" id="name" class="form-control w-100"
                                                        name="examen_name" placeholder="Entrer le nom de l'Examen" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="chapter_id" class="form-label">Selectionner un
                                                        chapitre</label>
                                                    <select class="form-control" name="chapter_id" id="chapter_id" required>
                                                        <option value="">Aucun</option>
                                                        @foreach ($chapters as $chapter)
                                                            <option value="{{ $chapter->id }}">{{ $chapter->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- <br> <input type="date" class="form-control w-100 mt-4"
                                                        name="date" required min="@php echo date('Y-m-d'); @endphp"> --}}
                                                <div class="form-group">
                                                    <label for="time" class="form-label">Entrer la durée du
                                                        test</label>
                                                    <input type="time" class="form-control w-100 mt-4" name="time"
                                                        required>
                                                </div>
                                                {{-- <br> <input type="number" min="1"
                                                        class="form-control w-100 mt-4" name="attempt"
                                                        placeholder="Entrer un Attempt Time" required> --}}
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


                            <!-- Edit Modal -->
                            <div class="modal fade" id="editExamModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Examen</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="" id="editExam" class="container">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="exam_id" id="exam_id">
                                                <div class="form-group">
                                                    <label class="form-label" for="examen_name">Nom de l'examen</label>
                                                    <input type="text" class="form-control w-100" name="examen_name"
                                                        id="examen_name" placeholder="Entrer le nom de l'Examen" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="chapter_id" class="form-label">Selectionner un
                                                        chapitre</label>
                                                    <select class="form-control" name="chapter_id" id="chapter_id"
                                                        required>
                                                        <option value="">Aucun</option>
                                                        @foreach ($chapters as $chapter)
                                                            <option @if ($chapter->id === $exam->chapter_id) Selected @endif
                                                                value="{{ $chapter->id }}">{{ $chapter->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- <br> <input type="date" class="form-control w-100 mt-4" name="date"
                                                    id="date" required min="@php echo date('Y-m-d'); @endphp"> --}}
                                                <div class="form-group">
                                                    <label for="time" class="form-label">Entrer la durée du
                                                        test</label>
                                                    <input type="time" class="form-control " name="time"
                                                        id="time" required>
                                                </div>
                                                {{-- <br> <input type="number" class="form-control w-100 mt-4" min="1"
                                                    name="attempt" id="attempt" required> --}}
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


                            <!-- Delte Modal -->
                            <div class="modal fade" id="deleteExamModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Supprimer l'examen</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="deleteExam" class="container">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="hidden" name="exam_id" id="deleteExamId">
                                                    <p>voulez vous vraiment supprimer cet examen ?</p>
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
    </div>
    <script>
        $(document).ready(function() {
            $("#addExam").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();


                $.ajax({
                    url: "{{ route('admin.exams.addExam', $exam->chapter->slug) }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    },
                });

            });

            $(".editButton").click(function() {
                var id = $(this).attr('data-id');
                $("#exam_id").val(id);

                var url = "{{ route('admin.exams.getExamDetail', 'id') }}";
                url = url.replace('id', id);
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(data) {
                        if (data.success == true) {
                            var exam = data.data;
                            $("#examen_name").val(exam[0].examen_name)
                            $("#chapter_id").val(exam[0].chapter_id)
                            $("#date").val(exam[0].date)
                            $("#time").val(exam[0].time)
                            $("#attempt").val(exam[0].attempt)
                        } else {
                            alert(data.msg);
                        }
                    },
                });
            });
            $("#editExam").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();


                $.ajax({
                    url: "{{ route('admin.exams.updateExam', $exam->chapter->slug) }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    },
                });
            });

            //delete exam

            $(".deleteButton").click(function() {
                var id = $(this).attr('data-id');
                $("#deleteExamId").val(id);
            });


            $("#deleteExam").submit(function(e) {
                e.preventDefault();

                var formData = $(this).serialize();


                $.ajax({
                    url: "{{ route('admin.exams.deleteExam') }}",
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
        });
    </script>
@endsection
