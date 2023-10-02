<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user=Auth::user();

        return view('pages.profile.index', [
            'user' => $user
        ]);
    }

    public function update(ProfileRequest $request, $id)
    {
        $data = [
            'nomor_induk' => $request->nomor_induk,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $image=User::saveImage($request);

        if ($image) {
            # code...
            $data['image'] = $image;
            User::deleteImage($id);
        }

        User::where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Data Berhasil DiUbah!');
    }
}
