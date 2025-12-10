<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $users = [
            ['id' => 1, 'username' => 'student1', 'password' => '1234', 'role' => 'student'],
            ['id' => 2, 'username' => 'teacher1', 'password' => '1234', 'role' => 'teacher'],
            ['id' => 3, 'username' => 'staff1',   'password' => '1234', 'role' => 'staff'],
            ['id' => 4, 'username' => 'admin',    'password' => 'admin123', 'role' => 'admin'],
        ];

        foreach ($users as $user) {
            if ($user['username'] === $request->username &&
                $user['password'] === $request->password) {

                session([
                    'user_id'  => $user['id'],
                    'username' => $user['username'],
                    'role'     => $user['role'],
                    'logged_in'=> true
                ]);

                return match ($user['role']) {
                    'student' => redirect('/student/dashboard'),
                    'teacher' => redirect('/teacher'),
                    'staff'   => redirect('/staff/dashboard'),
                    'admin'   => redirect('/admin/dashboard'),
                };
            }
        }

        return back()->withErrors(['login' => 'Invalid username or password']);
    }

    public function logout()
    {
        session()->flush();
        return redirect('/')->with('success', 'You have been logged out.');
    }
}
