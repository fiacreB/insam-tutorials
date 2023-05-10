<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>

@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">All Students</h4>
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
                                    <h4 class="mt10">Students</h4>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="candidate_revew_select style2 text-right">
                                    <ul class="mb0">
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
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    @if (Auth::user()->is_super_admin)
                                        <th class="text-right">Options</th>
                                    @endif
                                </thead>
                                <tbody>
                                    @php
                                        $x = 1;
                                    @endphp
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $x++ }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            @if (Auth::user()->is_super_admin)
                                                <td class="text-right">
                                                    <button type="button" data-id="{{ $student->id }}"
                                                        class="deleteButton btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                        data-toggle="modal" data-target="#deleteStudentModal">
                                                        <span class="bi bi-trash3"></span>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="">
                            <ul class="pagination pagination-circle ">
                                {{ $students->links() }}
                            </ul>
                        </nav>
                        {{-- Delete Modal --}}
                        <div class="modal fade" id="deleteStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title me-5 " id="exampleModalLabel">Delete Student</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form id="deleteStudent">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row  ">
                                                <div class="col">
                                                    <p>voulez vous vraiment supprimer l'Etudiant ?</p>
                                                    <input type="hidden" name="id" id="student_id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Non</button>
                                            <button type="submit" class="btn btn-danger updateButton">Oui
                                            </button>
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
    <script>
        //delete student
        $(document).ready(function() {

            $(".deleteButton").click(function() {
                var id = $(this).attr('data-id');
                $("#student_id").val(id);
            });

            $("#deleteStudent").submit(function(e) {
                e.preventDefault();

                var fromData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.delete') }}",
                    type: "POST",
                    data: fromData,
                    success: function(data) {

                        if (data.success) {
                            location.reload();

                        } else {
                            alert(data.msg)
                        }

                    }
                });
            });
        });
    </script>
@endsection
