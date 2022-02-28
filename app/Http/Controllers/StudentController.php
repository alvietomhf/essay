<?php

namespace App\Http\Controllers;

use App\Models\ClasSubject;
use App\Models\Season;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function code()
    {
        return view('student.code');
    }

    public function clas()
    {
        $data = Season::with(['clasSubjectsAll' => function ($q) {
                    $q->with([
                        'clas',
                        'subject'
                    ]);
                }])
                ->withCount(['clasSubjectsAll'])
                ->get();

        $kelasMapelCount = ClasSubject::count();

        return view('student.class', compact('data', 'kelasMapelCount'));
    }

    public function index($kelasId)
    {
        $data = Student::where('clas_subject_id', $kelasId)->get();
        $clasSubject = ClasSubject::where('id', $kelasId)->with(['clas', 'subject', 'season'])->first();

        return view('student.index', compact('data', 'clasSubject'));
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
                return $q->where('clas_subject_id', $kelasId);
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
                'clas_subject_id' => $kelasId,
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
                return $q->where('clas_subject_id', $kelasId);
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
}
