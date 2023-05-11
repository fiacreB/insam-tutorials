<script src="{{ asset('/assets-frontend/js/jquery.min.js') }}"></script>
@extends('frontend.partials.main')
@section('content')
    <style>
        .tablebody {
            background: rgba(78, 93, 142, 0.644)
        }
    </style>






    <h2 class="container text-blue">Mes Résultats</h2>
    @foreach ($questions as $question)
    @endforeach
    <table class="table table-hover table-bordered container">
        <thead class="text-with h3  col-xs-1 text-center bg-success">

            <th>#</th>
            <th style="max-width: 70%">Chapitre</th>
            <th>Resultat</th>
            <th>Note</th>
            <th>Status</th>
            <th>Revoir et approuver</th>
        </thead>

        <tbody class="h5 tablebody">
            @if (count($attempts) > 0)
                @php
                    $x = 1;
                    $questioncount = count($chapter->questions);
                @endphp
                @foreach ($attempts as $attempt)
                    <tr>
                        <td class="text-info">{{ $x++ }}</td>
                        <td class="text-secondary">{{ $attempt->chapter->chapter }}</td>
                        <td class="text-white">
                            @if ($attempt->status == 0)
                                Non déclaré
                            @else
                                @if ($attempt->marks >= $attempt->chapter->pass_marks)
                                    <span style="color: green;">Passer</span>
                                @else
                                    <span style="color: red;">Echouer</span>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($attempt->status == 0)
                                <p class="text-white">En attente</p>
                            @else
                                @if ($attempt->marks >= $attempt->chapter->pass_marks)
                                    <span style="color: green;">
                                        <b>
                                            <h3>{{ $attempt->marks }}/{{ $attempt->chapter->marks * $questioncount }}</h3>
                                        </b>
                                    </span>
                                @else
                                    <span style="color: red;">
                                        <b>
                                            <h3>{{ $attempt->marks }}</h3>
                                        </b>
                                    </span>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if ($attempt->status == 0)
                                <span style="color: red;">En attente</span>
                            @else
                                <a href="#" data-id="{{ $attempt->id }}" class="reviewExam  text-success"
                                    data-bs-toggle="modal" data-bs-target="#reviewQnaModal">Revoir mes Q & A </a>
                            @endif
                        </td>
                        <td>
                            @if ($attempt->status == 0)
                                <a href="#" data-bs-toggle="modal" class="reviewExam text-success"
                                    data-id="{{ $attempt->id }}" data-bs-target="#reviwExamModal">Revoir et Approuver</a>
                            @else
                                @if ($attempt->marks >= $attempt->chapter->pass_marks)
                                    <span style="color: rgb(1, 11, 25);">Vous pouvez passer au chapitre suivant </span>
                                @else
                                    <a href="{{ route('layout-frontend.categories.deleteTest', $chapter->slug) }}"
                                        class="deleteButton btn btn-danger ">Reprendre le test</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4">vous n'avez fait aucun test </td>
                </tr>
            @endif
        </tbody>
    </table>



    <!-- Modal -->
    <div class="modal fade" role="dialog" id="reviewQnaModal" tabindex="-1" aria-labelledby="exampleModalToggleLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="daocument">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Review Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body review-qna">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade " role="dialog" id="explainationModal" tabindex="-1" aria-labelledby="exampleModalToggleLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="daocument">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalToggleLabel">Bonne reponse</h5>
                    <button type="button" class="btn-close"data-bs-toggle="modal" data-bs-target="#reviewQnaModal"
                        aria-label="Close"></button>
                </div>

                <div class="modal-body " id="showAnswers">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                        data-bs-target="#reviewQnaModal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!--confirm Modal -->
    <div class="modal fade " role="dialog" id="reviwExamModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="daocument">
            <div class="modal-content">
                <div class="modal-header bg">
                    <h5 class="modal-title" id="exampleModalLabel">Review Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="reviewForm">
                    @csrf
                    <input type="hidden" name="attempt_id" id="attempt_id">

                    <div class="modal-body review-exam bg">


                    </div>
                    <div class="modal-footer bg">
                        <a href="{{ route('layout-frontend.categories.deleteTest', $chapter->slug) }}"
                            class="btn btn-danger">Reprendre</a>
                        <button type="submit" class="btn btn-primary approved-btn">Je confirme</button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    <script>
        $(document).ready(function() {
            $('.reviewExam').click(function() {
                var id = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('resultStudentQna') }}",
                    type: "GET",
                    data: {
                        attempt_id: id
                    },
                    success: function(data) {
                        var html = '';
                        if (data.success == true) {

                            var data = data.data;
                            if (data.length > 0) {

                                for (let i = 0; i < data.length; i++) {

                                    let is_correct =
                                        '<span style="color:red;" class="me-2 bi bi-x-lg"></span>';
                                    if (data[i]['answers']['is_correct'] == 1) {
                                        is_correct =
                                            '<span style="color:green;" class="fa fa-check"></span>';
                                    }

                                    let answer = data[i]['answers']['answer'];
                                    html += `
                                        <div class= "row">
                                            <div class="col-sm-12">
                                                <h6 class="text-primary">Q(` + (i + 1) + `).` + data[i]['questions'][
                                            'question'
                                        ] +
                                        `</h6>
                                                <p class=" me-2 "> <b class=" me-2 "><u class="text-success">Reponse:</u>-</b>` +
                                        answer + `  ` +
                                        is_correct + `</p> `;

                                    if (data[i]['answers']['is_correct'] == 0) {
                                        html +=
                                            `<p><a href="#" class="ansButton text-danger mt-0" data-bs-toggle="modal"
                                    data-bs-target="#explainationModal" data="` +
                                            {{ $question->id }} +
                                            `" >Voir la bonne raponse</a></p>`;
                                    }

                                    html += `
                                                    </div>
                                            </div>
                                                    `;
                                }

                            } else {

                                html +=
                                    ` < h6 > Vous n 'avez pas repondu à toutes les questions !</h6>`;
                            }

                        } else {
                            html += `<p>Problème du côté du serveur.</p>`;
                        }
                        $('.review-qna').html(html);
                    }
                });
            });


            $('.ansButton').click(function() {
                let questions = @json($question);
                let dataid = $(this).attr('data');
                let html = ``;

                for (let i = 0; i < questions.length; i++) {
                    if (questions[i]['id'] == dataid) {

                        let answersLength = questions[i]['answers'].length;
                        for (let j = 0; j < answersLength; j++) {

                            let is_correct = `<p class="text-danger">NON</p>`;


                            if (questions[i]['answers'][j]['is_correct'] == 1) {
                                is_correct = `<p class="text-success">OUI</p>`;

                            }
                            html += `<tr>
                                <td class="text-info"> ` + (j + 1) + `</td>
                                <td> ` + questions[i]['answers'][j]['answer'] + `</td>
                                <td> ` + is_correct + `</td>

                                </tr>
                                `;
                        }


                    }
                }


                $('#showAnswers').html(html);

            });


        });


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

                                    let answer = data[i]['answers']['answer'];

                                    html += `
                                        <div class ="row">
                                            <div class="col-sm-12">
                                                <h6 class="text-primary">Q( ` + (i + 1) + `).` + data[i]['questions'][
                                            'question'
                                        ] + `</h6>
                                                <span class="me-2"></span><p><u class="text-success">Reponse:</u>-` +
                                        answer + `</p>
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
