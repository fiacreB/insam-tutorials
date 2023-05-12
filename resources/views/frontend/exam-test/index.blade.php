<script src="{{ asset('/admin/js/jquery.min.js') }}"></script>
@extends('frontend.partials.main')
@section('title', 'exam Test ')
@section('content')
    @if ($chapter->questions->count() > 0)

        @if ($chapter->first == 'first')
            <div>
                <form action="{{ route('layout-frontend.categories.examSubmit', $chapter->slug) }}" method="POST">
                    @csrf
                    <table class="table table-hover table-bordered container">
                        <h3 class="container"><b class="me-2"> Test de connaissance du</b><b class="text-info">
                                {{ $chapter->title }}</b>
                        </h3>
                        <thead class="text-white  col-xs-1 text-center">
                            <th><b class="h4"> Pour chacune des questions, selectionner la bonne reponse.
                                </b>
                                @foreach ($chapter->exams as $exam)
                                    <b>
                                        <h2 class="text-danger time">{{ $exam->time }}</h2>
                                    </b>
                                    @php
                                        $time = explode(':', $exam->time);
                                    @endphp
                                @endforeach
                            </th>

                        </thead>
                        <tbody>
                            @php
                                $questioncount = 1;
                            @endphp
                            @if ($chapter->questions->count() > 0)
                                <input type="hidden" name="exam_id" value="{{ $chapter->id }}">

                                @forelse ($chapter->questions as $question)
                                    <tr>
                                        <td class="container text-primary h5" style="max-width: 70%"> <u>
                                                <b>{{ $questioncount++ }}. {{ $question->question }}</b></u>
                                            <input type="hidden" name="q[]" value="{{ $question->id }}">
                                            <input type="hidden" name="ans_{{ $questioncount - 1 }}"
                                                id="ans_{{ $questioncount - 1 }}">
                                        </td>
                                    </tr>
                                    @php $answercount =1; @endphp
                                    @foreach ($question->answers as $answer)
                                        <tr>
                                            <td class="container  " style="max-width: 70%">
                                                <div class="form-group form-check">
                                                    <input type="radio" name="radio_{{ $questioncount - 1 }}"
                                                        value="{{ $answer->id }}" data-id="{{ $questioncount - 1 }}"
                                                        class=" select_ans form-check-input me-3" id="exampleCheck1"
                                                        required>
                                                    <label class="form-check-label h6 " for="exampleCheck1"><b
                                                            class="me-2 text-white">{{ $answercount++ }})</b>{{ $answer->answer }}</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                @empty
                                    <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                                        <div class="course-item">
                                            <div class="course-content">
                                                <h4><a href="#" class="text-center text-danger mt-4">Aucun test
                                                        pour
                                                        l'instant</a>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                @endforelse
                            @else
                                <h4 class="text-center mt-4 text-danger">pas de test pour l'instant</h4>
                            @endif
                        </tbody>

                    </table>
                    @if ($chapter->questions->count() > 0)
                        <div class="me-4 mx-4 py-4 text-center">
                            <input class="btn btn-primary" type="submit" value="soumettre mes réponses">
                        </div>
                    @else
                    @endif
                </form>
            </div>
            <script>
                $(document).ready(function() {
                    $('.select_ans').click(function() {
                        var no = $(this).attr('data-id');
                        $('#ans_' + no).val($(this).val());
                    });


                    var time = @json($time);
                    $('.time').text(time[0] + ':' + time[1] + ':00 Left time');

                    var seconds = 59;
                    var hours = parseInt(time[0]);
                    var minutes = parseInt(time[1]);


                    var timer = setInterval(() => {

                        if (hours == 0 && minutes == 0 && seconds == 0) {
                            clearInterval(timer);
                            $('#exam_form').submit();
                        }
                        if (seconds <= 0) {
                            minutes--;
                            seconds = 59;
                        }

                        if (minutes <= 0 && hours != 0) {
                            hours--;
                            minutes = 59;
                            seconds = 59;
                        }

                        let tempHours = hours.toString().length > 1 ? hours :
                            '0' + hours;

                        let tempMinutes = minutes.toString().length > 1 ? minutes :

                            '0' + minutes;

                        let tempSeconds = seconds.toString().length > 1 ? seconds :
                            '0' + seconds;
                        $('.time').text(tempHours + ':' + tempMinutes + ':' + tempSeconds +
                            ' Left time');

                        seconds--;

                    }, 1000);

                });

                function isValid() {
                    var result = true;
                    var questionlength = parseInt("{{ $questioncount }}") - 1;
                    $('.error_msg').remove();

                    for (let i = 1; i <= questionlength; i++) {
                        if ($('#ans_' + i).val() == "") {
                            result = false;
                            $('#ans_' + i).parent().append(
                                '<span style="color:red;" class="error_msg">Veuillez selectionner une reponse</>');
                            setTimeout(() => {
                                $('.error_msg').remove();
                            }, 5000);
                        }
                    }
                    return result;
                }
            </script>
        @else
            @foreach ($attempts as $attempt)
                @if ($attempt->marks >= $attempt->chapter->pass_marks)
                    @if ($attempt->valid == $chapter->id)
                        <div>
                            <form action="{{ route('layout-frontend.categories.examSubmit', $chapter->slug) }}"
                                method="POST" id="exam_form">
                                @csrf
                                <table class="table table-hover table-bordered container">
                                    <h3 class="container"><b class="me-2"> Test de connaissance du</b><b
                                            class="text-info">
                                            {{ $chapter->chapter }}</b>
                                    </h3>
                                    <thead class="text-with  col-xs-1 text-center">
                                        <th><b class="h4"> Pour chacune des questions, selectionner la bonne
                                                reponse.
                                            </b>
                                            @foreach ($chapter->exams as $exam)
                                                <b>
                                                    <h2 class="text-danger time">{{ $exam->time }}</h2>
                                                </b>
                                                @php
                                                    $time = explode(':', $exam->time);
                                                @endphp
                                            @endforeach
                                        </th>

                                    </thead>
                                    <tbody>
                                        @php
                                            $questioncount = 1;
                                        @endphp
                                        <input type="hidden" name="exam_id" value="{{ $chapter->id }}">

                                        @forelse ($chapter->questions as $question)
                                            <tr>
                                                <td class="container text-primary h5" style="max-width: 70%"> <u>
                                                        <b>{{ $questioncount++ }}. {{ $question->question }}</b></u>
                                                    <input type="hidden" name="q[]" value="{{ $question->id }}">
                                                    <input type="hidden" name="ans_{{ $questioncount - 1 }}"
                                                        id="ans_{{ $questioncount - 1 }}">
                                                </td>
                                            </tr>
                                            @php $answercount =1; @endphp
                                            @foreach ($question->answers as $answer)
                                                <tr>
                                                    <td class="container  " style="max-width: 70%">
                                                        <div class="form-group form-check">
                                                            <input type="radio" name="radio_{{ $questioncount - 1 }}"
                                                                value="{{ $answer->id }}"
                                                                data-id="{{ $questioncount - 1 }}"
                                                                class=" select_ans form-check-input me-3"
                                                                id="exampleCheck1">
                                                            <label class="form-check-label h6" for="exampleCheck1"><b
                                                                    class="me-2">{{ $answercount++ }})</b>{{ $answer->answer }}</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        @empty
                                            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
                                                <div class="course-item">
                                                    <div class="course-content">
                                                        <h4><a href="#" class="text-center text-danger">Aucun test
                                                                pour
                                                                l'instant</a></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforelse

                                    </tbody>

                                </table>

                                <div class="me-4 mx-4 py-4 text-center">
                                    <input class="btn btn-primary" type="submit" value="soumettre mes réponses">
                                </div>
                            </form>
                        </div>
                        <script>
                            $(document).ready(function() {
                                $('.select_ans').click(function() {
                                    var no = $(this).attr('data-id');
                                    $('#ans_' + no).val($(this).val());
                                });


                                var time = @json($time);
                                $('.time').text(time[0] + ':' + time[1] + ':00 Left time');

                                var seconds = 59;
                                var hours = parseInt(time[0]);
                                var minutes = parseInt(time[1]);


                                var timer = setInterval(() => {

                                    if (hours == 0 && minutes == 0 && seconds == 0) {
                                        clearInterval(timer);
                                        $('#exam_form').submit();
                                    }
                                    if (seconds <= 0) {
                                        minutes--;
                                        seconds = 59;
                                    }

                                    if (minutes <= 0 && hours != 0) {
                                        hours--;
                                        minutes = 59;
                                        seconds = 59;
                                    }

                                    let tempHours = hours.toString().length > 1 ? hours :
                                        '0' + hours;

                                    let tempMinutes = minutes.toString().length > 1 ? minutes :

                                        '0' + minutes;

                                    let tempSeconds = seconds.toString().length > 1 ? seconds :
                                        '0' + seconds;
                                    $('.time').text(tempHours + ':' + tempMinutes + ':' + tempSeconds +
                                        ' Left time');

                                    seconds--;

                                }, 1000);

                            });

                            function isValid() {
                                var result = true;
                                var questionlength = parseInt("{{ $questioncount }}") - 1;
                                $('.error_msg').remove();

                                for (let i = 1; i <= questionlength; i++) {
                                    if ($('#ans_' + i).val() == "") {
                                        result = false;
                                        $('#ans_' + i).parent().append(
                                            '<span style="color:red;" class="error_msg">Veuillez selectionner une reponse</>');
                                        setTimeout(() => {
                                            $('.error_msg').remove();
                                        }, 5000);
                                    }
                                }
                                return result;
                            }
                        </script>
                    @endif
                @endif
            @endforeach

        @endif
    @else
        <h4 class="text-center">Pas de test pour l'instant</h4>
    @endif
@endsection
