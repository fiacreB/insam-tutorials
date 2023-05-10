<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>

@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')

    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">All Admins</h4>
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
                                    <h4 class="mt10">Amins</h4>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="candidate_revew_select style2 text-right">
                                    <ul class="mb0">
                                        <li class="list-inline-item">
                                            <button type="button" class="btn btn-primary py-2" data-toggle="modal"
                                                data-target="#addStudentModal">
                                                <span class="bi bi-plus"></span>
                                                Add admin
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
                        <table class="table aiz-table mb-0">
                            <thead class="">
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-right">Options</th>

                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td class="text-right">
                                            <button type="button" data-id="{{ $admin->id }}"
                                                data-name="{{ $admin->name }}" data-email="{{ $admin->email }}"
                                                class="editButton btn btn-soft-primary btn-icon btn-circle btn-sm"
                                                data-toggle="modal" data-target="#editStudentModal">
                                                <span class="bi bi-pen"></span>
                                            </button>
                                            <button type="button" data-id="{{ $admin->id }}"
                                                class="deleteButton btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"
                                                data-toggle="modal" data-target="#deleteStudentModal">
                                                <span class="bi bi-trash3"></span>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{-- <nav aria-label="">
                            <ul class="pagination pagination-circle ">
                                {{ $admins->links() }}
                            </ul>
                        </nav> --}}

                        <!-- Modal -->
                        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title me-5 " id="exampleModalLabel">Add Admin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form id="addStudent">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row  ">
                                                <div class="col">
                                                    <input type="text" class="form-control w-100" name="name"
                                                        placeholder="Entrer le nom " required>
                                                </div>
                                            </div>
                                            <div class="row  ">
                                                <div class="col mt-4">
                                                    <input type="email" class="form-control w-100" name="email"
                                                        placeholder="Entrer l'Email " required>
                                                </div>
                                            </div>
                                            <div class="row  ">
                                                <div class="col mt-4">
                                                    <input type="hidden" name="role" class="form-select"
                                                        aria-label="Default select example" value="admin">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add Admin</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Edit Modal -->
                        <div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">

                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title me-5 " id="exampleModalLabel">Edit Admin</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form id="editStudent">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row  ">
                                                <div class="col">
                                                    <input type="hidden" name="id" id="id">
                                                    <input type="text" class="form-control w-100" name="name"
                                                        id="name" placeholder="Entrer le nom de l'etudiant" required>
                                                </div>
                                            </div>
                                            <div class="row  ">
                                                <div class="col mt-4">
                                                    <input type="email" class="form-control w-100" name="email"
                                                        id="email" placeholder="Entrer l'Email de l'etudiant"
                                                        required>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary updateButton">update
                                                Admin</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Delete Modal --}}
                        <div class="modal fade" id="deleteStudentModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title me-5 " id="exampleModalLabel">Delete Admin</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>

                                    </div>
                                    <form id="deleteStudent">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row  ">
                                                <div class="col">
                                                    <p>voulez vous vraiment supprimer cet Administrateur ?</p>
                                                    <input type="hidden" name="id" id="admin_id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Non</button>
                                            <button type="submit" class="btn btn-danger updateButton">Oui</button>
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
    <script>
        $(document).ready(function() {
            $("#addStudent").submit(function(e) {
                e.preventDefault();

                var fromData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.addadmin') }}",
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

            //edit button  click and show values
            $(".editButton").click(function() {
                $("#id").val($(this).attr('data-id'));
                $("#name").val($(this).attr('data-name'));
                $("#email").val($(this).attr('data-email'));
            });
            $("#editStudent").submit(function(e) {
                e.preventDefault();
                $(".updateButton").prop('disabled', true)
                var fromData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.edit') }}",
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

            $(".deleteButton").click(function() {
                var id = $(this).attr('data-id');
                $("#admin_id").val(id);
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
