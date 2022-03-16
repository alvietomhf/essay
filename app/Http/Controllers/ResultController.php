<?php

namespace App\Http\Controllers;

use App\Jobs\CalculateSimiliarity;
use App\Models\ClasSubject;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\ExamResultDetail;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ResultController extends Controller
{
    public function storeExam(Request $request, $kelasId, Exam $exam, $siswaId)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'questions' => 'array',
            'questions.*.id' => 'required|integer',
            'questions.*.answer' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }

        try {
            DB::beginTransaction();
    
            $result = ExamResult::create([
                'student_id' => $siswaId,
                'exam_id' => $exam->id,
            ]);
    
            foreach ($input['questions'] as $item) {
                ExamResultDetail::create([
                    'exam_result_id' => $result->id,
                    'question_id' => $item['id'],
                    'answer' => $item['answer'],
                ]);
            }

            DB::commit();
    
            Session::forget('user');

            CalculateSimiliarity::dispatch($result);

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menyelesaikan ujian',
                'url' => route('student.code'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => 'Gagal menyelesaikan ujian',
            ]);
        }
    }

    public function show(Request $request, $kelasId, Exam $exam, $siswaId, $resultId)
    {
        $clasSubject = ClasSubject::where('id', $kelasId)
                                ->with([
                                    'clas',
                                ])
                                ->first();

        $student = Student::where([
                            'id' => $siswaId,
                            'clas_id' => $clasSubject->clas->id,
                        ])->first();

        if (!$student) return response()->json([
            'status' => false,
            'message' => 'Siswa tidak ditemukan', 
        ], 404);

        $result = ExamResult::where([
                            'id' => $resultId,
                            'student_id' => $siswaId,
                            'exam_id' => $exam->id,
                        ])
                        ->with([
                            'details' => function ($q) {
                                $q->orderBy('question_id', 'asc');
                            },
                            'details.question',
                        ])
                        ->withCount([
                            'details',
                        ])
                        ->first();

        return view('exam.detail', compact('kelasId', 'exam', 'student', 'result'));
    }

    public function destroy($kelasId, Exam $exam, $id)
    {
        try {
            $result = ExamResult::find($id);
            if (!$result) {
                return response()->json([
                        'status' => false,
                        'message' => 'Data not found',
                ], 404);
            }

            $result->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus jawaban',
                'url' => route('ujian.show.result', [$kelasId, $exam->slug]),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus jawaban',
            ]);
        }
    }
}
