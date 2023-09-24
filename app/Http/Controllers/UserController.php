<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Operator';
        $user=User::whereHas('roles', function($q){
            $q->whereIn('name', ['operator']);
        })
        ->whereNotIn('nomor_induk', ['12345678'])
        ->get();

        return view('pages.user.index', [
            'title' => $title,
            'user' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Operator';
        return view('pages.user.form', [
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $image=User::saveImage($request);

        $user=User::create([
            'nomor_induk'=>$request->nomor_induk,
            'name' => $request->name,
            'email' => $request->email,
            'image' => $image,
            'password' => bcrypt($request->password)
        ]);

        $user->assignRole('operator');

        return redirect()->route('operator.user.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title='Operator';
        $user=User::find($id);

        return view('pages.user.form', [
            'user' => $user,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data=[
            'nomor_induk'=>$request->nomor_induk,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        
        $image=User::saveImage($request);

        if ($image) {
            $dataImage['image']=$image;
            User::deleteImage($id);
        }

        User::where('id', $id)->update($data);

        return redirect()->route('operator.user.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user=User::find($id);
        User::deleteImage($id);

        $user->delete();

        return response()->json(['status', 'Data Berhasil Dihapus']);
    }
}
