<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ExamController extends Controller
{
    public function create($kelasId)
    {
        return view('exam.create', compact('kelasId'));
    }

    public function store(Request $request, $kelasId)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|string|min:3|max:50',
            'description' => 'nullable|string|min:3|max:50',
            'code' => 'required|unique:exams,code'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }

        Exam::create(array_merge(
            $validator->validated(),
            [
                'clas_subject_id' => $kelasId,
                'slug' => Str::slug($request->code) . '-' . Str::uuid()->toString(),
            ]
        ));

        flash('Berhasil menambahkan ujian')->success();

        return response()->json([
            'status' => true,
            'url' => route('kelas-mapel.show', [$kelasId]),
        ]);
    }

    public function show($kelasId, Exam $exam)
    {
        $data = Exam::where('id', $exam->id)
                        ->with([
                            'clasSubject',
                            'clasSubject.clas',
                            'clasSubject.subject',
                            'questions'
                        ])
                        ->withCount(['questions'])
                        ->first();

        return view('exam.show', compact('data', 'kelasId'));
    }

    public function edit($kelasId, Exam $exam)
    {
        return view('exam.edit', compact('exam', 'kelasId'));
    }

    public function update(Request $request, $kelasId, Exam $exam)
    {
        if (!$exam) {
            return response()->json([
                    'status' => false,
                    'message' => 'Data not found',
            ], 404);
        }   

        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required|string|min:3|max:50',
            'description' => 'nullable|string|min:3|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }

        $exam->update($validator->validated());

        flash('Berhasil mengedit ujian')->success();

        return response()->json([
            'status' => true,
            'url' => route('ujian.show', [$kelasId, $exam->slug]),
        ]);
    }

    public function destroy($kelasId, Exam $exam)
    {
        try {
            if (!$exam) {
                return response()->json([
                        'status' => false,
                        'message' => 'Data not found',
                ], 404);
            }

            $exam->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus ujian',
                'url' => route('kelas-mapel.show', [$kelasId]),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus ujian',
            ]);
        }
    }

    public function status(Request $request, $kelasId, Exam $exam)
    {
        try {
            if (!$exam) {
                return response()->json([
                        'status' => false,
                        'message' => 'Data not found',
                ], 404);
            }

            $input = $request->all();
            $validator = Validator::make($input, [
                'value' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $message = $request->value ? 'Berhasil mengaktifkan form ujian' : 'Berhasil menonaktifkan form ujian';

            $exam->update(['is_active' => $request->value]);

            return response()->json([
                'status' => true,
                'message' => $message,
                'url' => route('ujian.show', [$kelasId, $exam->slug]),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengedit status form ujian',
            ]);
        }
    }

    public function mixQuestion(Request $request, $kelasId, Exam $exam)
    {
        try {
            if (!$exam) {
                return response()->json([
                        'status' => false,
                        'message' => 'Data not found',
                ], 404);
            }

            $input = $request->all();
            $validator = Validator::make($input, [
                'value' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $message = $request->value ? 'Berhasil mengacak soal' : 'Berhasil mengurutkan soal';

            $exam->update(['mix_question' => $request->value]);

            return response()->json([
                'status' => true,
                'message' => $message,
                'url' => route('ujian.show', [$kelasId, $exam->slug]),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengedit urutan soal',
            ]);
        }
    }
}
