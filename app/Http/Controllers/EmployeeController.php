<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title='Pengguna';
        $employee=Employee::with('user')->get();

        return view('pages.employee.index', [
            'title' => $title,
            'employee' => $employee
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title='Pengguna';
        $village=Village::all();
        
        return view('pages.employee.form',[
            'title'=> $title,
            'village' => $village
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $image=User::saveImage($request);
        $user=User::create([
            'nomor_induk'=>$request->nomor_induk,
            'name' => $request->name,
            'email' => $request->email,
            'image' => $image,
            'password' => bcrypt($request->password)
        ]);

        $user->assignRole('user');

        $data = [
            'user_id' =>$user->id,
            'village_id'=> $request->village_id,
            'no_telp' => 62 . $request->no_telp,
        ];

        Employee::create($data);

        return redirect()->route('operator.employee.index')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title='Pengguna';
        $employee=Employee::find($id);
        $village=Village::all();

        return view('pages.employee.form', [
            'title' => $title,
            'employee' => $employee,
            'village' => $village
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $data = [
            'village_id'=> $request->village_id,
            'no_telp' => 62 . $request->no_telp,
        ];

        Employee::where('id', $employee->id)->update($data);

        $dataUser = [
            'nomor_induk'=>$request->nomor_induk,
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->password) {
            $dataUser['password']=Hash::make($request->password);
        }

        $image=User::saveImage($request);

        if ($image) {
            $dataUser['image']=$image;
            User::deleteImage($employee->user_id);
        }
        
        User::whereId($employee->user_id)->update($dataUser);

        return redirect()->route('operator.employee.index')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee=Employee::find($id);
        
        User::deleteImage($employee->user_id);

        $employee->delete();

        User::where('id', $employee->user_id)->delete();


        return response()->json(['success', 'Data Berhasil Dihapus']);
    }
}
