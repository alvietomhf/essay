<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function store(Request $request, $kelasId, Exam $exam)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'questions' => 'required|array|min:1',
            'questions.*.title' => 'required|string',
            'questions.*.answer_key' => 'required|string',
            'questions.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'questions.*.title.required' => 'Field is required.',
            'questions.*.title.string' => 'Must be a string.',
            'questions.*.answer_key.required' => 'Field is required.',
            'questions.*.answer_key.string' => 'Must be a string.',
            'questions.*.image.image' => 'Must be an image.',
            'questions.*.image.mimes' => 'Must be a file of type: :values.',
            'questions.*.image.max' => 'Must not be greater than :max kilobytes.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }
        // dd($input);
        try {
            DB::beginTransaction();

            foreach ($input['questions'] as $key => $questionValue) {
                $questionValue['image'] = null;
                if ($request->hasFile('questions.' . $key . '.image')) {
                    $questionValue['image'] = rand() . '.' . $request->questions[$key]['image']->getClientOriginalExtension();
                    Storage::putFileAs('public/images', $request->file('questions.' . $key . '.image'), $questionValue['image']);
                }

                Question::create([
                    'exam_id' => $exam->id,
                    'title' => $questionValue['title'],
                    'answer_key' => $questionValue['answer_key'],
                    'image' => $questionValue['image'],
                ]);
            }

            DB::commit();

            flash('Berhasil menambahkan pertanyaan')->success();

            return response()->json([
                'status' => true,
                'url' => route('ujian.show', [$kelasId, $exam->slug]),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan pertanyaan',
            ]);
        }
    }

    public function update(Request $request, $kelasId, Exam $exam)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'questions' => 'required|array|min:1',
            'questions.*.id' => 'required|integer',
            'questions.*.title' => 'required|string',
            'questions.*.answer_key' => 'required|string',
            'questions.*.image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'questions.*.image_deleted' => 'sometimes|boolean',
            'questions.*.deleted' => 'sometimes|boolean',
        ], [
            'questions.*.id.required' => 'Field is required.',
            'questions.*.id.integer' => 'Must be an integer.',
            'questions.*.title.required' => 'Field is required.',
            'questions.*.title.string' => 'Must be a string.',
            'questions.*.answer_key.required' => 'Field is required.',
            'questions.*.answer_key.string' => 'Must be a string.',
            'questions.*.image.image' => 'Must be an image.',
            'questions.*.image.mimes' => 'Must be a file of type: :values.',
            'questions.*.image.max' => 'Must not be greater than :max kilobytes.',
            'questions.*.image_deleted.boolean' => 'The deleted field must be true or false.',
            'questions.*.deleted.boolean' => 'The deleted field must be true or false.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }
        // dd($input);
        try {
            DB::beginTransaction();

            foreach ($input['questions'] as $key => $questionValue) {
                if ($questionValue['id'] == -1) {
                    $questionValue['image'] = null;
                    if ($request->hasFile('questions.' . $key . '.image')) {
                        $questionValue['image'] = rand() . '.' . $request->questions[$key]['image']->getClientOriginalExtension();
                        Storage::putFileAs('public/images', $request->file('questions.' . $key . '.image'), $questionValue['image']);
                    }

                    Question::create([
                        'exam_id' => $exam->id,
                        'title' => $questionValue['title'],
                        'answer_key' => $questionValue['answer_key'],
                        'image' => $questionValue['image'],
                    ]);
                } else {
                    $question = Question::where('id', $questionValue['id'])->first();

                    if (isset($questionValue['deleted']) && $questionValue['deleted'] == 1) {
                        if (Storage::exists('public/images/' . $question->image)) {
                            Storage::delete('public/images/' . $question->image);
                        }
                        $question->delete();
                    } else {
                        $oldImage = $question->image;
                        if (isset($questionValue['image_deleted']) && $questionValue['image_deleted'] == 1) {
                            if (Storage::exists('public/images/' . $oldImage)) {
                                Storage::delete('public/images/' . $oldImage);
                            }
                            $oldImage = null;
                        }
                        if ($request->hasFile('questions.' . $key . '.image')) {
                            if (Storage::exists('public/images/' . $oldImage)) {
                                Storage::delete('public/images/' . $oldImage);
                            }
                            $image = rand() . '.' . $request->questions[$key]['image']->getClientOriginalExtension();
                            Storage::putFileAs('public/images', $request->file('questions.' . $key . '.image'), $image);
                        } else {
                            $image = $oldImage;
                        }

                        $question->update([
                            'title' => $questionValue['title'],
                            'answer_key' => $questionValue['answer_key'],
                            'image' => $image,
                        ]);
                    }
                }
            }

            DB::commit();

            flash('Berhasil mengedit pertanyaan')->success();

            return response()->json([
                'status' => true,
                'url' => route('ujian.show', [$kelasId, $exam->slug]),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengedit pertanyaan',
            ]);
        }
    }
}
