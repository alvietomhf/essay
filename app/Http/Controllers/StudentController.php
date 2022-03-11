<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use App\Models\ClasSubject;
use App\Models\Exam;
use App\Models\ExamResult;
use App\Models\Question;
use App\Models\Season;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class StudentController extends Controller
{
    public function code()
    {
        return view('student.code');
    }

    public function index($kelasId)
    {
        $data = Student::where('clas_id', $kelasId)->get();
        $clas = Clas::where('id', $kelasId)->first();

        return view('student.index', compact('data', 'clas'));
    }

    public function create($kelasId)
    {
        return view('student.create', compact('kelasId'));
    }

    public function store(Request $request, $kelasId)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'number' => ['required', 'digits_between:4,4', Rule::unique('students')->where(function ($q) use ($kelasId) {
                return $q->where('clas_id', $kelasId);
            })],
            'name' => 'required|string|min:3|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }

        Student::create(array_merge(
            $validator->validated(),
            [
                'clas_id' => $kelasId,
            ]
        ));

        flash('Berhasil menambahkan siswa')->success();

        return response()->json([
            'status' => true,
            'url' => route('admin.kelas-siswa.index', [$kelasId]),
        ]);
    }

    public function edit($kelasId, $id)
    {
        $data = Student::find($id);

        return view('student.edit', compact('data', 'kelasId'));
    }

    public function update(Request $request, $kelasId, $id)
    {
        $student = Student::find($id);
        if (!$student) {
            return response()->json([
                    'status' => false,
                    'message' => 'Data not found',
            ], 404);
        }   

        $input = $request->all();
        $validator = Validator::make($input, [
            'number' => ['required', 'digits_between:4,4', Rule::unique('students')->ignore($id)->where(function ($q) use ($kelasId) {
                return $q->where('clas_id', $kelasId);
            })],
            'name' => 'required|string|min:3|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }

        $student->update($validator->validated());

        flash('Berhasil mengedit siswa')->success();

        return response()->json([
            'status' => true,
            'url' => route('admin.kelas-siswa.index', [$kelasId]),
        ]);
    }

    public function destroy($kelasId, $id)
    {
        try {
            $student = Student::find($id);
            if (!$student) {
                return response()->json([
                        'status' => false,
                        'message' => 'Data not found',
                ], 404);
            }

            $student->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus siswa',
                'url' => route('admin.kelas-siswa.index', [$kelasId]),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus siswa',
            ]);
        }
    }

    public function showExam($kelasId, Exam $exam, $siswaId)
    {
        $data = Exam::where('id', $exam->id)
                        ->with([
                            'clasSubject',
                            'clasSubject.clas',
                            'clasSubject.subject',
                            'questions' => function ($q) use ($exam) {
                                if ($exam->mix_question) {
                                    $q->inRandomOrder();
                                }
                            },
                        ])
                        ->withCount(['questions'])
                        ->first();

        if ($kelasId != $data->clas_subject_id) return abort(404);

        $student = Student::find($siswaId);

        return view('student.exam', compact('data', 'kelasId', 'student'));
    }

    public function joinExam(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'number' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }

        $exam = Exam::where('code', $input['code'])
                    ->with([
                        'clasSubject',
                    ])
                    ->first();

        if (!$exam) return response()->json([
            'status' => false,
            'message' => 'Kode ujian salah', 
        ], 422);

        if (!$exam->is_active) return response()->json([
            'status' => false,
            'message' => 'Ujian belum aktif', 
        ], 422);

        $student = Student::where([
                            'number' => $input['number'],
                            'clas_id' => $exam->clasSubject->clas_id,
                        ])->first();

        if (!$student) return response()->json([
            'status' => false,
            'message' => 'Nomor ujian tidak ditemukan',  
        ], 422);

        $result = ExamResult::where([
                            'student_id' => $student->id,
                            'exam_id' => $exam->id,
                        ])->first();
        
        if ($result) return response()->json([
            'status' => false,
            'message' => 'Anda sudah mengerjakan ujian ini',  
        ], 422);

        Session::put('user', $student->id);

        return response()->json([
            'status' => true,
            'url' => route('student.exam.show', [$exam->clas_subject_id, $exam->slug, $student->id]),
        ]);
    }
}
