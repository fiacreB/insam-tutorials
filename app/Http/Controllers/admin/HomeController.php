<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $students = User::where('role', null)->paginate(10);
        return view('dashboard.admin.students.index', compact('students'));
    }

    //add new admin
    public function adminDashboard(Request $request)
    {
        $query = $request->get('query');
        $admin_search = User::where('name', 'LIKE', '%' . $query . '%')->get();
        if ($request->has('search')) {
            $admins = User::all();
            $admin_search = $request->search;
            $admins =  User::where('name', 'like', '%' . $admin_search . '%');
        } else {
            $admins = User::where([['role', '=', 'admin'], ['is_super_admin', '=', null]])->get();
        }
        return view('dashboard.admin.add-admin', compact('admins', 'admin_search'));
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


    public function allCreate(Request $request)
    {
        dd($request);
        return view('dashboard.admin.bibliotheque.books.all-create');
    }


    public function settingDashboard()
    {
        $user = Auth::user();
        return view('dashboard.admin.settings', compact('user'));
    }

    public function settingUpdate(Request $request, User $user)
    {
        $slug = Str::slug($request->name, '-');
        if ($request->has('image')) {
            $filename = $request->name . '.' . $request->image->extension();
            $image_path = $request->image->storeAs(
                "users",
                $filename,
                'public'
            );

            $user->name = $request->name;
            $user->email = $request->email;
            $user->image = $image_path;
            $user->password = Hash::make($request->password);
            $user->slug = $slug;
            $user->save();
        } else {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->slug = $slug;
            $user->save();
        }
        if ($request->password) {
            Auth::logout();
            return redirect()->route('login');
        } else {
            return back()->with('success', 'Update Success');
        }
    }
}
