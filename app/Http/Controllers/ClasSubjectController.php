<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use App\Models\ClasSubject;
use App\Models\Exam;
use App\Models\Season;
use App\Models\Subject;
use Illuminate\Http\Request;

class ClasSubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clas = Clas::all();
        $subject = Subject::all();
        $season = Season::all();

        return view('class_subject.create', compact('clas', 'subject', 'season'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $color = ['#EAC4D5', '#FFC09F', '#FFEE93', '#33CC99', '#99CCCC', '#809BCE'];

        $data = ClasSubject::where([
                    ['clas_id', '=', $request->clas_id],
                    ['subject_id', '=', $request->subject_id],
                    ['season_id', '=', $request->season_id],
                ])
                ->first();
        
        if ($data) {
            flash('Gagal menambahkan. Kelas tersebut sudah dibuat!')->error();
            return redirect()->route('dashboard');
        }

        ClasSubject::create(array_merge(
            $input,
            [
            'user_id' => auth()->user()->id,
            'color' => $request->color ?? $color[array_rand($color)],
            ]
        ));

        flash('Berhasil menambahkan kelas')->success();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ClasSubject::where('id', $id)->with(['clas', 'subject'])->first();
        $exams = Exam::where('clas_subject_id', $id)->get();
        $examsCount = Exam::where('clas_subject_id', $id)->count();

        return view('class_subject.show', compact('data', 'exams', 'examsCount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $clas = Clas::all();
        $subject = Subject::all();
        $season = Season::all();

        $data = ClasSubject::where('id', $id)->first();

        return view('class_subject.edit', compact('data', 'clas', 'subject', 'season'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clasSubject = ClasSubject::find($id);
        $input = $request->all();

        $data = ClasSubject::where([
                    ['clas_id', '=', $request->clas_id],
                    ['subject_id', '=', $request->subject_id],
                    ['season_id', '=', $request->season_id],
                ])
                ->first();

        if (isset($data) && $data->id != $id) {
            flash('Gagal mengubah. Kelas tersebut sudah dibuat!')->error();
            return redirect()->route('kelas-mapel.show', [$id]);
        }

        $clasSubject->update($input);

        flash('Berhasil mengedit kelas')->success();

        return redirect()->route('kelas-mapel.show', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $clasSubject = ClasSubject::find($id);
            if (!$clasSubject) {
                return response()->json([
                        'status' => false,
                        'message' => 'Data not found',
                ], 404);
            }

            $clasSubject->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus kelas',
                'url' => route('dashboard'),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus kelas',
            ]);
        }
    }
}
