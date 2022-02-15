<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::role('teacher')->get();

        return view('teacher.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teacher.create');
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
        $validator = Validator::make($input, [
            'name' => 'required|string|min:2|max:50',
            'username' => 'required|alpha_dash|min:2|max:50|unique:users,username',
            'email' => 'required|string|email|unique:users,email',
            'phone' => 'required|string|min:8|max:15|unique:users,phone',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }

        $data = User::create(array_merge(
            $validator->validated(),
            [
                'password' => Hash::make($request->password),
            ]
        ));
        $data->assignRole('teacher');

        flash('Berhasil menambahkan guru')->success();

        return response()->json([
            'status' => true,
            'url' => route('admin.guru.index'),
        ]);
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
        $data = User::find($id);

        return view('teacher.edit', compact('data'));
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
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                    'status' => false,
                    'message' => 'Data not found',
            ], 404);
        }   

        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|string|min:2|max:50',
            'username' => 'required|alpha_dash|min:2|max:50|unique:users,username,' . $id,
            'email' => 'required|string|email|unique:users,email,' . $id,
            'phone' => 'required|string|min:8|max:15|unique:users,phone,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation error',
                'data' => $validator->errors(),
            ], 400);
        }

        $password = $request->password ? Hash::make($request->password) : $user->password;

        $user->update(array_merge(
            $validator->validated(),
            [
                'password' => $password,
            ]
        ));

        flash('Berhasil mengedit guru')->success();

        return response()->json([
            'status' => true,
            'url' => route('admin.guru.index'),
        ]);
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
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                        'status' => false,
                        'message' => 'Data not found',
                ], 404);
            }

            if ($user->avatar) {
                if (Storage::exists('public/images/' . $user->avatar)) {
                    Storage::delete('public/images/' . $user->avatar);
                }
            }

            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus guru',
                'url' => route('admin.guru.index'),
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menghapus guru',
            ]);
        }
    }
}
