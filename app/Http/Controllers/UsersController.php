<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\Users;
use Illuminate\Foundation\Auth\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{

    public function list(UsersDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.users');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:20|unique:users,username',
            'nik' => 'required|string|min:15|max:17',
            'role' => 'required|string|max:20',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 'image' untuk validasi file gambar
            'email' => 'required|string|email|max:50|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            // Tambahkan validasi untuk input lainnya jika diperlukan
        ]);

        try{
            Users::create([
                'username' => $validated['username'],
                'nik' => $validated['nik'],
                'role' => $validated['role'],
                'foto_profil' => $validated['foto_profil'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
            return redirect()->back()->with('success', 'Data User berhasil ditambahkan!');
        } catch(\Exception $e){
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }

    }

    // public function edit(Users $users)
    // {
    //     $users = Users::findOrFail($users->id_user);
    //     return view('users', compact('users'));
    // }

    public function update(Request $request, Users $users)
    {

        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:20|unique:users,username,' . $users->id,
            'nik' => 'required|string|min:15|max:17',
            'role' => 'required|string|max:20',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 'image' untuk validasi file gambar
            'email' => 'required|string|email|max:50|unique:users,email,' . $users->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        

        // Update user
        try {
            $users->update([
                'username' => $validated['username'],
                'nik' => $validated['nik'],
                'role' => $validated['role'],
                'foto_profil' => $validated['foto_profil'],
                'email' => $validated['email'],
            ]);

            // Hanya update password jika field tersebut diisi
            if (!empty($validated['password'])) {
                $users->password = Hash::make($validated['password']);
                $users->save();
            }

            return redirect()->route('users.manage')->with('success', 'User berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update gagal: ' . $e->getMessage());
        }
    }
    
    public function destroy(Users $users)
    {
        $users->delete();

        return redirect()->back()
        ->with('success', 'User berhasil dihapus.');
    }

    public function profil() {
        $user = auth()->user();
        return view('auth.rw.profil', compact('user'));
    }
    
    public function updateProfil(Request $request, Users $users)
    {

        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:20',
            'nik' => 'required|string|min:15|max:17',
            'email' => 'required|string|email|max:50',
            'password' => 'nullable|string|min:6|confirmed'
        ]);     

        // Update user
        try {
            $users->update([
                'username' => $validated['username'],
                'foto_profil' => $validated['foto_profil'],
                'email' => $validated['email'],
            ]);

            // Hanya update password jika field tersebut diisi
            if (!empty($validated['password'])) {
                $users->password = Hash::make($validated['password']);
                $users->save();
            }

            return redirect()->back()->with('success', 'User berhasil diupdate!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update gagal: ' . $e->getMessage());
        }
    }
    
    public function changePassword(Request $request, User $user)
    {
        // Validasi request
        $request->validate([
            'new_password' => 'required|min:8|confirmed', // Konfirmasi password baru
        ]);

        // Setel password baru
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Redirect kembali ke halaman profil dengan pesan sukses
        return redirect()->route('profil')->with('success', 'Password berhasil diubah.');
    }
}