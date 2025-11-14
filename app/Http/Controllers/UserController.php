<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function getUsers()
    {
        return DataTables::of(
            User::select('id', 'first_name', 'last_name', 'email', 'is_active', 'created_at')
        )
            ->editColumn('created_at', function ($row) {
                return Carbon::parse($row->created_at)->format('d-m-Y h:i A');
            })
            ->make(true);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:6|confirmed',
            'is_active'  => 'nullable'
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => bcrypt($request->password),
            'password_string' => $request->password,
            'is_active'  => $request->is_active ? 1 : 0,
        ]);

        $user->assignRole('user');

        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        return view('users.view', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Base validation
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => "required|email|unique:users,email,$id",
            'is_active'  => 'nullable'
        ];

        // If reset password is checked
        if ($request->reset_password) {
            $rules['password'] = 'required|min:6|confirmed';
        }

        $request->validate($rules);

        // Update user fields
        $user->first_name = $request->first_name;
        $user->last_name  = $request->last_name;
        $user->email      = $request->email;
        $user->is_active  = $request->is_active ? 1 : 0;

        // If reset password checkbox is checked
        if ($request->reset_password) {
            $user->password = bcrypt($request->password);
            $user->password_string = $request->password;
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }


    public function delete($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }



    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportPdf()
    {
        $users = User::all();
        $pdf = Pdf::loadView('users.export-pdf', compact('users'));
        return $pdf->download('users.pdf');
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_active = $request->status;
        $user->save();

        return response()->json(['success' => true]);
    }
}
