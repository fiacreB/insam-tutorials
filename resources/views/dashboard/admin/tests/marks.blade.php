<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>

@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left"> Test Notes</h4>
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
                                    <h4 class="mt10">Notes</h4>
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
                                    <th>Chapitres</th>
                                    <th>Notes/Q</th>
                                    <th>Total de notes</th>
                                    <th>Notes de passage</th>
                                    <th>Edit</th>
                                </thead>
                                <tbody>

                                    @if (count($chapters) > 0)
                                        @php
                                            $x = 1;
                                        @endphp
                                        @foreach ($chapters as $chapter)
                                            <tr>
                                                <td>{{ $x++ }}</td>
                                                <td>{{ $chapter->title }}</td>
                                                <td>{{ $chapter->marks }}</td>
                                                <td>{{ count($chapter->questions) * $chapter->marks }}</td>
                                                <td>{{ $chapter->pass_marks }}</td>
                                                <td><button
                                                        class="btn btn-soft-primary btn-icon btn-circle btn-sm editMarks"
                                                        data-id="{{ $chapter->id }}" data-marks="{{ $chapter->marks }}"
                                                        data-toggle="modal" data-target="#editMarksModal"
                                                        data-pass-marks="{{ $chapter->pass_marks }}"
                                                        data-totalq="{{ count($chapter->questions) }}"><span
                                                            class="bi bi-pen"></span></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">aucun chapitre disponible</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>


                            <!-- Modal -->
                            <div class="modal fade" id="editMarksModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Notes</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="" id="editMarks">
                                            @csrf

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <label>Notes/Q</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="hidden" name="exam_id" id="exam_id">
                                                        <input type="text" name="marks"
                                                            placeholder="Entrer la Note par question"
                                                            onkeypress="return event.charCode>=48 && event.charCode <= 57 || event.charCode==46"
                                                            required id="marks">
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-sm-3">
                                                        <label> Notes Total</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="marks" disabled
                                                            placeholder="Note Total" id="tmarks">
                                                    </div>
                                                </div>

                                                <div class="row mt-3">
                                                    <div class="col-sm-3">
                                                        <label>Notes de passage</label>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" name="pass_marks"
                                                            placeholder="Entrer la note de passage"
                                                            onkeypress="return event.charCode>=48 && event.charCode <= 57 || event.charCode==46"
                                                            required id="pass_marks">
                                                    </div>
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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            var totalQna = 0;
            $('.editMarks').click(function() {
                var exam_id = $(this).attr('data-id');
                var marks = $(this).attr('data-marks');
                var totalq = $(this).attr('data-totalq');

                $('#marks').val(marks);
                $('#exam_id').val(exam_id);
                $('#tmarks').val((marks * totalq).toFixed(1));

                totalQna = totalq;

                $('#pass_marks').val($(this).attr('data-pass-marks'));
            });

            $('#marks').keyup(function() {
                $('#tmarks').val(($(this).val() * totalQna).toFixed(1));

            });


            $('#pass_marks').keyup(function() {
                $('.pass-error').remove();
                var tmarks = $('#marks').val();
                var pmarks = $(this).val();

                if (parseFloat(pmarks) >= parseFloat(tmarks)) {
                    $(this).parent().append(
                        '<p style="color:red;" class= "pass-error">Les notes de passage doivent etres inférieures aux notes totales </p>'
                    );
                    setTimeout(() => {
                        $('.pass-error').remove();
                    }, 2000);
                }
            });

            $('#editMarks').submit(function(event) {
                event.preventDefault();

                $('.pass-error').remove();
                var tmarks = $('#marks').val();
                var pmarks = $('pass_marks').val();

                if (parseFloat(pmarks) >= parseFloat(tmarks)) {
                    $('pass_marks').parent().append(
                        '<p style="color:red;" class= "pass-error">Les notes de passage doivent etres inférieures aux notes totales </p>'
                    );
                    setTimeout(() => {
                        $('.pass-error').remove();
                    }, 2000);

                    return false;
                }
                var formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('admin.tests.updateMarks') }}",
                    type: "POST",
                    data: formData,
                    success: function(data) {
                        if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                })
            });
        });
    </script>
@endsection
