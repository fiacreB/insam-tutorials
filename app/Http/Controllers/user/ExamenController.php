<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Exam;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\ExamAnswer;
use App\Models\ExamAttempt;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ExamenController extends Controller
{
    public function test(Category $category, Chapter $chapter)
    {

        $categories = Category::all();

        $chapters = Chapter::all();

        $lesson = Lesson::all();
        $questions = Question::with('answers')->get();

        return view('layout-frontend.categories.test', compact('questions', 'category', 'chapters', 'categories', 'lesson'));
    }
    public function examen(Request $request, Chapter $chapter, Question $question, Exam $exam, Category $category)
    {
        $categories = Category::all();

        $chapters = Chapter::all();

        $lesson = Lesson::all();
        $questions = Question::with('answers')->get();
        $exams = Exam::all();

        $attemptData =  ExamAnswer::where('attempt_id', $request->attempt_id)->with(['questions', 'answers'])->get();
        $attempts = ExamAttempt::with('chapter')->orderBy('updated_at')->get();



        return view('frontend.exam-test.index', compact('attemptData', 'exams', 'exam', 'chapter', 'questions', 'lesson', 'categories', 'chapters', 'category', 'attempts'));
    }

    public function examSubmit(Request $request, Chapter $chapter, ExamAttempt $attempt)
    {
        $chapters = Chapter::all();
        $user_id = ExamAttempt::where('user_id', '=', Auth::user()->id)->first();
        $chapter_id = ExamAttempt::where('chapter_id', '=', $chapter->id)->first();
        $slug = Str::slug('insam_tutorials%342', $request->chapter_id, '32@5%-');
        if (!($user_id && $chapter_id)) {

            $first = Chapter::where('id', '>', $request->chapter->id)->where('course_id', $chapter->course_id)->first();

            if ($first == null) {
                $last = Chapter::where('id', $request->chapter->id)->first();
                $attempt_id  =  ExamAttempt::insertGetId([
                    'chapter_id' => $chapter->id,
                    'slug' => $slug,
                    'user_id' => Auth::user()->id,
                    'valid' => $last->id,

                ]);
            } else {
                $attempt_id  =  ExamAttempt::insertGetId([
                    'chapter_id' => $chapter->id,
                    'slug' => $slug,
                    'user_id' => Auth::user()->id,
                    'valid' => $first->id,

                ]);
            }

            $questioncount = count($request->q);
            $slugexams = Str::slug('insam_tutorials%342', $request->chapter_id, '32@5%-');

            if ($questioncount > 0) {
                for ($i = 0; $i < $questioncount; $i++) {

                    if (!empty($request->input('ans_' . $i + 1))) {
                        ExamAnswer::insert([
                            'attempt_id' => $attempt_id,
                            'slug' => $slugexams,
                            'question_id' => $request->q[$i],
                            'answer_id' => request()->input('ans_' . $i + 1),
                        ]);
                    }
                }
            }
            $categories = Category::all();
            $chapters = Chapter::all();
            $lesson = Lesson::all();
            $attempts = ExamAttempt::all();
            $questions = Question::all();
            return view('frontend.exam-test.valid-test', compact('questions', 'attempt', 'chapter', 'attempts', 'chapters', 'lesson', 'categories'));
        } else {
            $categories = Category::all();
            $chapters = Chapter::all();
            $lesson = Lesson::all();
            $attempts = ExamAttempt::all();
            $questions = Question::all();
            return view('frontend.exam-test.valid-test', compact('questions', 'attempt', 'chapter', 'attempts', 'chapters', 'lesson', 'categories'));
        }
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

    public function resultDashboard(Chapter $chapter, Request $request)

    {
        $categories = Category::all();

        $chapters = Chapter::all();

        $lesson = Lesson::all();
        $questions = Question::with('answers')->get();
        $attempts = ExamAttempt::where('user_id', Auth()->user()->id)->with('chapter')->orderBy('updated_at')->get();
        foreach ($questions as $question) {
        }
        return view('frontend.exam-test.resultats', compact('attempts', 'questions', 'question', 'chapter', 'chapters', 'lesson', 'request', 'categories'));
    }


    // public function reviewStudentQna(Request $request)
    // {

    //     $categories = Category::all();

    //     $chapters = Chapter::all();

    //     $lesson = Lesson::all();
    //     $questions = Question::all();
    //     try {
    //         $attemptData = ExamAnswer::where('attempt_id', $request->attempt_id)->with(['questions', 'answers'])->get();
    //         return response()->json(['success' => true, 'msg' => 'Q&A Data', 'data' => $attemptData, 'chapters' => $chapters, 'questions' => $questions]);
    //     } catch (\Throwable $e) {
    //         return response()->json(['success' => false, 'msg' => $e->getMessage()]);
    //     }
    // }
    public function deleteTest(Chapter $chapter, Category $category, ExamAttempt $attempt)
    {
        $categories = Category::all();

        $chapters = Chapter::all();

        $lesson = Lesson::all();
        $questions = Question::all();
        $attempt = $attempt->where('status', 0)->where('user_id', Auth::user()->id)->first();
        $attempt->delete();

        return back();
    }
}
