<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use App\Models\ClasSubject;
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

        return view('class_subject.create', compact('clas', 'subject'));
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

        $data = ClasSubject::where([
                    ['clas_id', '=', $request->clas_id],
                    ['subject_id', '=', $request->subject_id],
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

        return view('class_subject.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
