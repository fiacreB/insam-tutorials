<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard.admin.index');
    }

    public function studentsDashboard()
    {
        $students = User::where('role', null)->get();
        return view('admin.students.index', compact('students'));
    }
    //add new admin
    public function adminDashboard()
    {
        $admins = User::where([['role', '=', 'admin'], ['is_super_admin', '=', null]])->paginate(10);
        return view('dashboard.admin.add-admin', compact('admins'));
    }


    public function store(Request $request)
    {
        $slug = Str::slug($request->name, '-');

        try {

            $password = Str::random(8);
            User::insert([
                'name' => $request->name,
                'slug' => $slug,
                'email' => $request->email,
                'role' => $request->role,
                'password' => Hash::make($password)
            ]);

            $url = URL::to('/');

            $data['url'] = $url;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['role'] = $request->role;
            $data['password'] = $password;
            $data['title'] = "vous avez été enregistrer comme Administrateur  dans IUE/Insam";
            Mail::send('admin.mail.registrationMail', ['data' => $data], function ($message) use ($data) {

                $message->to($data['email'])->subject($data['title']);
            });
            return response()->json(['success' => true, 'msg' => 'Admin ajouter avec success']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        try {

            $user = User::find($request->id);

            $user->name = $request->name;
            $user->email = $request->email;

            $user->save();

            $url = URL::to('/');

            $data['url'] = $url;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['title'] = "Update Admin Profile dans IUE/Insam";
            Mail::send('admin.mail.upadateProfileMail', ['data' => $data], function ($message) use ($data) {

                $message->to($data['email'])->subject($data['title']);
            });
            return response()->json(['success' => true, 'msg' => 'Admin mis à jour avec success']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }


    public function delete(Request $request)
    {

        try {
            User::where('id', $request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'supprimer avec success ']);
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
}
