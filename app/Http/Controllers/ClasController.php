<?php

namespace App\Http\Controllers;

use App\Models\Clas;
use Illuminate\Http\Request;

class ClasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Clas::all();

        return view('class.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('class.create');
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

        Clas::create($input);

        flash('Berhasil menambahkan kelas')->success();

        return redirect()->route('admin.kelas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Clas::find($id);

        return view('class.edit', compact('data'));
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
        $clas = Clas::find($id);
        $input = $request->all();

        $clas->update($input);

        flash('Berhasil mengedit kelas')->success();

        return redirect()->route('admin.kelas.index');
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
            $clas = Clas::find($id);
            if (!$clas) {
                return response()->json([
                        'status' => false,
                        'message' => 'Data not found',
                ], 404);
            }

            $clas->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus kelas',
                'url' => route('admin.kelas.index'),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus kelas',
            ]);
        }
    }
}
