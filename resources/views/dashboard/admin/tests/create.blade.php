<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>

@extends('dashboard.admin.layout.main')
@section('title', 'Admin | UIEs/Insam_tutorias')
@section('content')
    <div class="col">
        <div class="row">
            <div class="col-lg-12">
                <nav class="breadcrumb_widgets" aria-label="breadcrumb mb30">
                    <h4 class="title float-left">Toutes les questions du: <span class="text-info">{{ $chapter->title }}</span>
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
                                    <h4 class="mt10">Questions</h4>
                                </div>
                            </div>
                            <div class="col-xl-8">
                                <div class="candidate_revew_select style2 text-right">
                                    <ul class="mb0">
                                        <li class="list-inline-item">
                                            <a class="btn btn-info" href="{{ route('admin.tests.loadMarks') }}"><u><b>
                                                        Modifier
                                                        le nombre de Point pour ce test
                                                    </b> </u></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#addQnaModal">
                                                <span class="bi bi-plus"></span>
                                                Ajouter Q&A
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
                                        <th>Question</th>
                                        <th>Answers</th>
                                        <th class="text-right">Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $x = 1;
                                    @endphp
                                    @forelse ($chapter->questions as $question)
                                        <tr>
                                            <td>{{ $x++ }}</td>
                                            <td class="" style="max-width: 70%">{{ $question->question }}</td>
                                            <td>
                                                <a href="#" class="text-primary ansButton" data="{{ $question->id }}"
                                                    data-toggle="modal" data-target="#showAnsModal">voir la
                                                    reponse</a>
                                            </td>

                                            <td class="text-right">
                                                <button class="btn btn-soft-primary btn-icon btn-circle btn-sm editButton"
                                                    data-id="{{ $question->id }}" data-toggle="modal"
                                                    data-target="#editQnaModal"><span class="bi bi-pen"></span></button>
                                                <a href="{{ route('admin.tests.delete', $question->slug) }}"
                                                    class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete deleteButton"><span
                                                        class="bi bi-trash3"></span></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center">
                                                <h3><a href="#">Aucun test pour l'instant</a></h3>
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                            <!-- Modal -->
                            <div class="modal fade" id="addQnaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="row d-flex">
                                                <div class="col text-left ">
                                                    <h5 class="modal-title me-5 " id="exampleModalLabel">Add Question &
                                                        Answers</h5>
                                                </div>
                                                <div class=" text-right mt-2 pl-4">
                                                    <button id="addAnswer" class=" btn btn-info">Add
                                                        answer</button>
                                                </div>
                                            </div>
                                        </div>
                                        <form id="addQna" class="container">
                                            @csrf
                                            <div class="modal-body addModalAnswers">
                                                <div class="form-group">
                                                    <label for="question" class="form-label"> Question</label>
                                                    <input type="text" class="form-control w-100" name="question"
                                                        id="question" placeholder="Entrer la question" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <span class="error" style="color: red;"></span>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- edite Q&A Modal -->
                            <div class="modal fade" id="editQnaModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="row d-flex">
                                                <div class="col text-left ">
                                                    <h5 class="modal-title me-5 " id="exampleModalLabel">Update Q&A</h5>
                                                </div>
                                                <div class=" text-right mt-2 pl-4">
                                                    <button id="addEditAnswer" class=" btn btn-info">Add
                                                        answer</button>
                                                </div>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form id="editQna" class="container">
                                            @csrf
                                            <div class="modal-body editModalAnswers">
                                                <div class="form-group">
                                                    <label for="question" class="form-label">Question</label>
                                                    <input type="hidden" name="question_id" id="question_id">
                                                    <input type="text" class="form-control w-100" name="question"
                                                        id="question" placeholder="Entrer la question" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <span class="editError" style="color: red;"></span>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!--skow answer Modal -->
                            <div class="modal fade" id="showAnsModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title me-5 " id="exampleModalLabel">voir la reponse</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <th>#</th>
                                                    <th>Answer</th>
                                                    <th>correct</th>
                                                </thead>
                                                <tbody class="container-fluid w-89" id="showAnswers">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <span class="error" style="color: red;"></span>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                                <!-- end table - responsive -->
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // form submittion

            $('#addQna').submit(function(e) {
                e.preventDefault();

                if ($(".answers").length < 2) {
                    $(".error").text(" SVP entrer au minimum deux réponses. ")
                    setTimeout(function() {
                        $(".error").text("");

                    }, 2000);
                } else {
                    var checkIsCorrect = false;

                    for (let i = 0; i < $(".is_correct").length; i++) {
                        if ($(".is_correct:eq(" + i + ")").prop('checked') == true) {
                            checkIsCorrect = true;
                            $(".is_correct:eq(" + i + ")").val($(".is_correct:eq(" + i + ")").next().find(
                                'input').val());
                        }
                    }

                    if (checkIsCorrect) {
                        var formData = $(this).serialize();
                        $.ajax({
                            url: "{{ route('admin.tests.store', $chapter->slug) }}",
                            type: "POST",
                            data: formData,
                            success: function(data) {
                                if (data.success == true) {
                                    alert(data.msg);
                                    location.reload();
                                } else {
                                    alert(data.msg);
                                }
                            }
                        });
                    } else {
                        $(".error").text(" Selectionner la bonne reponse. ")
                        setTimeout(function() {
                            $(".error").text(" ");

                        }, 2000);
                    }

                }


            });

            // ajouter une reponse
            $("#addAnswer").click(function() {
                if ($(".answers").length >= 6) {
                    $(".error").text(" le maximun de reponses est 6. ")
                    setTimeout(function() {
                        $(".error").text(" ");

                    }, 2000);
                } else {
                    var html =

                        `<div class="w-100 mt-3 d-flex answers ">
<input type="radio" name="is_correct" class="is_correct me-2">
<div class="col me-2">
<input type="text" class="  form-control " name="answers[]"
placeholder="Entrer une reponse" required>
</div>
<button  class="btn btn-danger " id="removeButton" >Remove</button>
</div>`;

                    $(".addModalAnswers").append(html);
                }
            });

            $(document).on("click", "#removeButton", function() {
                $(this).parent().remove();
            });
            //show answers code

            $('.ansButton').click(function() {
                let questions = @json($questions);
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
            //edite or update Q & A
            $("#addEditAnswer").click(function() {
                if ($(".editAnswers").length >= 6) {
                    $(".editError").text(" le maximun de reponses est 6. ")
                    setTimeout(function() {
                        $(".editError").text(" ");

                    }, 2000);
                } else {
                    var html =

                        `<div class="w-100 mt-3 d-flex editAnswers ">
<input type="radio" name="is_correct" class="edit_is_correct me-2">
<div class="col me-2">
<input type="text" class="  form-control " name="new_answers[]"
placeholder="Entrer une reponse" required>
</div>
<button  class="btn btn-danger " id="removeButton" >Remove</button>
</div>`;

                    $(".editModalAnswers").append(html);
                }

            });

            $(".editButton").click(function() {
                var qid = $(this).attr('data-id');

                $.ajax({
                    url: "{{ route('admin.tests.getQnaDetails', $chapter->slug) }}",
                    type: "GET",
                    data: {
                        qid: qid
                    },
                    success: function(data) {
                        console.log(data);
                        var qna = data.data[0];
                        $("#question_id").val(qna['id']);
                        $("#question").val(qna['question']);

                        $(".editAnswers").remove();
                        var html = '';

                        for (let i = 0; i < qna['answers'].length; i++) {

                            var checked = '';

                            if (qna['answers'][i]['is_correct'] == 1) {
                                checked = 'checked';
                            }

                            html += `
<div class="w-100 mt-3 d-flex editAnswers ">
<input type="radio" name="is_correct" class="edit_is_correct me-2" ` + checked + `>
<div class="col me-2">
<input type="text" class="  form-control " name="answers[` +
                                qna['answers'][i]['id'] + `]"
placeholder="Entrer une reponse" value ="` + qna['answers'][i]['answer'] +
                                `" required>
</div>
<button  class="btn btn-danger removeAnswer  removeButton"  data-id="` + qna['answers']
                                [i]['id'] + `" >Remove</button>
</div>
`;
                        }
                        $(".editModalAnswers").append(html);
                    }
                });
            });

            // update Q&A submition

            $('#editQna').submit(function(e) {
                e.preventDefault();

                if ($(".editAnswers").length < 2) {
                    $(".ediError").text(" SVP entrer au minimum deux réponses. ")
                    setTimeout(function() {
                        $(".editError").text("");

                    }, 2000);
                } else {
                    var checkIsCorrect = false;

                    for (let i = 0; i < $(".edit_is_correct").length; i++) {
                        if ($(".edit_is_correct:eq(" + i + ")").prop('checked') == true) {
                            checkIsCorrect = true;
                            $(".edit_is_correct:eq(" + i + ")").val($(".edit_is_correct:eq(" + i + ")")
                                .next()
                                .find(
                                    'input').val());
                        }
                    }

                    if (checkIsCorrect) {

                        var formData = $(this).serialize();
                        $.ajax({
                            url: "{{ route('admin.tests.updateQna', $chapter->slug) }}",
                            type: "POST",
                            data: formData,
                            success: function(data) {
                                if (data.success == true) {
                                    location.reload();
                                } else {

                                    alert(data.msg);
                                    location.reload();

                                }
                            }
                        });


                    } else {
                        $(".editError").text(" Selectionner la bonne reponse. ")
                        setTimeout(function() {
                            $(".editError").text(" ");

                        }, 2000);
                    }

                }
            });


            //remove answer

            $(document).on('click', '.removeAnswer', function() {
                var ansId = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('admin.tests.deleteAns', $chapter->slug) }}",
                    type: "GET",
                    data: {
                        id: ansId
                    },
                    success: function(data) {
                        if (data.success == true) {
                            location.reload();
                        } else {
                            alert(data.msg);
                            location.reload();

                        }
                    }
                });
            });


            //delete chapter


        });
    </script>
@endsection
