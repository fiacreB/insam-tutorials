<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Models\ExamAttempt;
use Faker\Provider\Lorem;
use App\Models\Chapter;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;



class TestController extends Controller
{
    public function index()
    {
        $chapters = Chapter::with('exams')->get();
        $exams = Exam::orderBy('created_at', 'desc')->with('chapter')->paginate(10);
        return view('dashboard.admin.exams.index', compact('exams', 'chapters'));
    }
    public function create(Chapter $chapter)
    {
        $questions = Question::with('answers')->get();

        return view('dashboard.admin.tests.create', compact('questions', 'chapter'));
    }

    //add Q&A

    public function store(Request $request, Question $question, chapter $chapter)
    {
        $slug = Str::slug($request->question, '-');

        try {

            $questionId = Question::insertGetId([
                'question' => $request->question,
                'chapter_id' => $chapter->id,
                'slug' => $slug,


            ]);

            foreach ($request->answers as $answer) {
                $sluganswer = Str::slug($request->answer, '-');

                $is_correct = 0;
                if ($request->is_correct ==  $answer) {
                    $is_correct = 1;
                }
                Answer::insert([
                    'question_id' => $questionId,
                    'slug' => $sluganswer,
                    'answer' => $answer,
                    'is_correct' => $is_correct,
                ]);
            }
            return response()->json(['success' => true, 'msg' => 'Ajouter avec succes! 👌  🚨🚨❗
            Veuillez svp modifier le nombre de point par question pour ce chapitre avant de continuer.
            Il suffit de cliquer sur le bouton « ajouter ou modifier le nombre de point » qui se
            trouve en haut de la page de question ou vous vous trouvez et de sélectionner par la suite le
            chapitre dans le quel vous venez d’ajouter la question, puis
            de définir ou redéfinir(si cela existe déjà) le nombre de point par question. MERCI❗🚨🚨']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
    public function getQnaDetails(Request $request)
    {
        $qna =   Question::where('id', $request->qid)->with('answers')->get();
        return response()->json(['data' => $qna]);
    }

    public function deleteAns(Request $request)
    {
        Answer::where('id', $request->id)->delete();

        return response()->json(['success' => true, 'msg' => 'reponse supprimer avec succes!']);
    }

    public function destroy(Question $question, chapter $chapter)
    {
        $id = $question->chapters_id;
        $question->delete();
        return back()->with('success', 'Deleted');
    }
    public function updateQna(Request $request)
    {
        $slug = Str::slug($request->answer, '-');

        try {

            Question::where('id', $request->question_id)->update([
                'question' => $request->question
            ]);


            //old answer update
            if (isset($request->answers)) {
                foreach ($request->answers as $key => $value) {

                    $is_correct = 0;

                    if ($request->is_correct == $value) {

                        $is_correct = 1;
                    }
                    Answer::where('id', $key)
                        ->update([
                            'question_id' => $request->question_id,
                            'answer' => $value,
                            'slug' => $slug,
                            'is_correct' => $is_correct
                        ]);
                }
            }

            //new answers added
            if (isset($request->new_answers)) {
                foreach ($request->new_answers as $answer) {

                    $is_correct = 0;

                    if ($request->is_correct == $answer) {

                        $is_correct = 1;
                    }
                    Answer::insert([
                        'question_id' => $request->question_id,
                        'answer' => $answer,
                        'slug' => $slug,
                        'is_correct' => $is_correct

                    ]);
                }
            }

            return response()->json(['success' => false, 'msg' => 'Q&A.. mis à jour avec succes!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    // exam dashboard load

    public function examDashboard(Chapter $chapter, Exam $exam)
    {
        $chapters = Chapter::all();
        $exams = Exam::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.admin.exams.create', compact('chapter', 'chapters', 'exams', 'exam'));
    }


    // add exams

    public function addExam(Request $request, Chapter $chapter)
    {
        $slug = Str::slug($request->examen_name, '-');
        $chapter_id = Exam::where('chapter_id', '=', $request->chapter_id)->first();
        if (!($chapter_id)) {
            try {
                Exam::insert([
                    'examen_name' => $request->examen_name,
                    'chapter_id' => $request->chapter_id,
                    'slug' => $slug,

                    // 'date' => $request->date,
                    'time' => $request->time,
                    // 'attempt' => $request->attempt,
                ]);
                return response()->json(['success' => true, 'msg' => 'Exam ajouter avec succes !']);
            } catch (\Exception $e) {
                return response()->json(['success' => false, 'msg' => $e->getMessage()]);
            }
        } else {
            return response()->json(['success' => false, 'msg' => 'un test pour ce chapitre existe déjà 😥😥']);
        }
    }


    public function getExamDetail($id)
    {
        try {
            $exam =  Exam::where('id', $id)->get();
            return response()->json(['success' => true, 'data' => $exam]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }


    public function updateExam(Request $request)
    {
        try {
            $exam =  Exam::find($request->exam_id);
            $exam->examen_name = $request->examen_name;
            $exam->chapter_id = $request->chapter_id;
            $exam->date = $request->date;
            $exam->time = $request->time;
            $exam->attempt = $request->attempt;
            $exam->save();
            return response()->json(['success' => true, 'msg' => 'Examen mis à jour avec successs !']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }


    public function deleteExam(Request $request)
    {

        try {
            Exam::where('id', $request->exam_id)->delete();
            return response()->json(['success' => true, 'msg' => 'Examen supprimer avec successs !']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function loadMarks()
    {
        $questions =  Question::all();
        $chapters = Chapter::with('questions')->get();
        return view('dashboard.admin.tests.marks', compact('chapters', 'questions'));
    }

    public function updateMarks(Request $request)
    {

        try {
            Chapter::where('id', $request->exam_id)->update([
                'marks' => $request->marks,
                'pass_marks' => $request->pass_marks
            ]);
            return response()->json(['success' => true, 'msg' => 'Marks mis à jour avec successs !']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function reviewExams(Chapter $chapter, Exam $exam)
    {
        $attempts =   ExamAttempt::with(['user', 'chapter'])->orderBy('id')->get();
        return view('dashboard.admin.exams.review-exams', compact('attempts', 'chapter'));
    }

    public function reviewQna(Request $request)
    {

        try {
            $attemptData =  ExamAnswer::where('attempt_id', $request->attempt_id)->with(['questions', 'answers'])->get();

            return response()->json(['success' => true, 'data' => $attemptData]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function approvedQna(Request $request)
    {
        try {
            $attemptId = $request->attempt_id;
            $examData = ExamAttempt::where('id', $attemptId)->with(['user', 'chapter'])->get();
            foreach ($examData as $exam) {
                $marks =  $exam->chapter->marks;
            }

            $attemptData =  ExamAnswer::where('attempt_id', $attemptId)->with('answers')->get();

            $totalMarks = 0;
            if (count($attemptData) > 0) {

                foreach ($attemptData as $attempt) {
                    if ($attempt->answers->is_correct == 1) {
                        $totalMarks += $marks;
                    }
                }
            }
            ExamAttempt::where('id', $attemptId)->update([
                'status' => 1,
                'marks' => $totalMarks
            ]);
            return response()->json(['success' => true, 'msg' => 'Aprouver avec success']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function deleteTest(ExamAttempt $examAttempt, Chapter $chapter, Category $category)
    {
        $categories = Category::all();

        $chapters = Chapter::all();

        $lesson = Lesson::all();
        $questions = Question::all();

        $attempts = ExamAttempt::where('user_id', Auth()->user()->id)->with('chapter')->delete();

        return view('layout-frontend.categories.examen', compact('category', 'attempts', 'chapter', 'categories', 'chapters', 'lesson', 'questions'));
    }
}
