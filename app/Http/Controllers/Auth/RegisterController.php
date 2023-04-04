<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function showRegistrationForm(Request $request)
    {
        $query = DB::table('users');

        // Filter data by gender
        if ($request->gender) {
            $query->where('gender', $request->gender);
        }

        // Filter data by hobby
        if ($request->hobby) {
            $query->where('hobby', 'like', '%' . $request->hobby . '%');
        }

        // Search data by name or email
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        // Sort data by name, gender, or email
        if ($request->sort_by && $request->sort_direction) {
            $query->orderBy($request->sort_by, $request->sort_direction);
        }

        $registrations = $query->get();
        return view('register.index', compact('registrations'));
    }

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required|regex:/[A-Z][a-z]+/',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'hobby' => 'required|array|min:1',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'username' => 'required|max:10|unique:users,username',
            'password' => 'required|min:7',
        ];

        $message = [
            'name.regex' => 'Huruf depan harus kapital',
            'hobby.min' => 'Pilih minimal satu hobi',
            'email' => 'Format email harus benar',
            'phone' => 'Mohon hanya masukan angka',
            'password.min' => 'Password minimal 7 karakter' 
        ];

        $validatedData = $request->validate($rules, $message);

        $registration = new User();
        $registration->name = $validatedData['name'];
        $registration->gender = $validatedData['gender'];
        $registration->hobby = implode(',   ', $validatedData['hobby']);
        $registration->email = $validatedData['email'];
        $registration->phone = $validatedData['phone'];
        $registration->username = $validatedData['username'];
        $registration->password = bcrypt($validatedData['password']);
        $registration->save();

        return redirect()->route('register.create')->with('success', 'Registrasi berhasil!');
    }

    public function destroy($id)
    {
        $registration = User::find($id);
        $registration->delete();

        return redirect()->route('register.create')
            ->with('success', 'Data berhasil dihapus.');
    }

}
