<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>

@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left"> Students Exams</h4>
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
                                        <th>Name</th>
                                        <th>Chapitres</th>
                                        <th>Status</th>
                                        <th class="text-right">Review</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($attempts) > 0)
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($attempts as $attempt)
                                            <tr>
                                                <td>{{ $x++ }}</td>
                                                <td>{{ $attempt->user->name }}</td>
                                                <td>{{ $attempt->chapter->title }}</td>
                                                <td>
                                                    @if ($attempt->status == 0)
                                                        <span style="color: red;">En attente</span>
                                                    @else
                                                        <span style="color: green">Approuver</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if ($attempt->status == 0)
                                                        <a href="#" data-toggle="modal" class="reviewExam"
                                                            data-id="{{ $attempt->id }}"
                                                            data-target="#reviwExamModal">Revoir et Approuver</a>
                                                    @else
                                                        Complet
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">
                                                Auncun n'étudiant n'a éffectué un examen
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>


                            <!-- Modal -->
                            <div class="modal fade" role="dialog" id="reviwExamModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="daocument">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Review Exam</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="reviewForm">
                                            @csrf
                                            <input type="hidden" name="attempt_id" id="attempt_id">
                                            <div class="modal-body review-exam">


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit"
                                                    class="btn btn-primary approved-btn">Approuver</button>
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
            $('.reviewExam').click(function() {
                var id = $(this).attr('data-id');



                $('#attempt_id').val(id);
                $.ajax({
                    url: "{{ route('admin.exams.reviewQna') }}",
                    type: "GET",
                    data: {
                        attempt_id: id
                    },
                    success: function(data) {

                        var html = ``;
                        if (data.success == true) {
                            var data = data.data;
                            if (data.length > 0) {
                                for (let i = 0; i < data.length; i++) {

                                    let isCorrect =
                                        '<span style="color:red;" class="me-2 bi bi-x-lg"></span>';
                                    if (data[i]['answers']['is_correct'] == 1) {
                                        isCorrect =
                                            '<span style="color:green;" class="fa fa-check"></span>';
                                    }
                                    let answer = data[i]['answers']['answer'];

                                    html += `
                                        <div class ="row">
                                            <div class="col-sm-12">
                                                <h6>Q( ` + (i + 1) + `).` + data[i]['questions']['question'] + `</h6>
                                                <p>Ans:-` + answer + `` + isCorrect + `</p>
                                            </div>
                                        </div>
                                    `;
                                }

                            } else {
                                html +=
                                    `<h6>l'étudiant n'a pas trouvé toutes les questions</h6>
                                       <p>si vous approuvez cet examen, l'étudiant aura échoué</p>`;
                            }

                        } else {
                            html += `<p>Problème de server</p>`;

                        }

                        $('.review-exam').html(html);
                    }
                });
            });


            //approved exams

            $('#reviewForm').submit(function(event) {
                event.preventDefault();


                $('.approved-btn').html(
                    '<b class="me-2">Patientez SVP</b> <i class=" me-2 fa fa-spinner fa-spin"></i>')

                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.exams.approvedQna') }}",
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
