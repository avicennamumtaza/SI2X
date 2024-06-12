<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use Illuminate\Support\Facades\File;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function profil()
    {
        $users = auth()->user();
        return view('auth.rw.profil', compact('users'));
    }

    public function updateProfil(Request $request, Users $users)
    {

        $validated = $request->validate([
            'username' => 'required|string|max:20',
            //'nik' => 'required|string|min:15|max:17',
            'email' => 'required|string|email|max:50',
            //'foto_profil' => 'nullable|mimes:png,jpg,jpeg',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        try {
            $users->update([
                'username' => $validated['username'],
                //'foto_profil' => $validated['foto_profil'],
                'email' => $validated['email'],
            ]);

            if (!empty($validated['password'])) {
                $users->password = Hash::make($validated['password']);
                $users->save();
            }

            return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update gagal: ' . $e->getMessage());
        }
    }

    public function changePassword(Request $request, Users $users)
    {
        $request->validate([
            'new_password' => 'required|min:8|confirmed', // Konfirmasi password baru
        ]);

        $users->password = Hash::make($request->new_password);
        $users->save();

        return redirect()->route('profil')->with('success', 'Password berhasil diubah.');
    }

    public function updateFotoProfil(Request $request, Users $users)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:20',
            'foto_profil' => 'required|mimes:png,jpg,jpeg',
        ]);
    
        $foto_profil = $request->file('foto_profil');
        $foto_profil_ext = $foto_profil->getClientOriginalExtension();
        $foto_profil_filename = $validated['username'] . date('ymdhis') . "." . $foto_profil_ext;
    
        if ($foto_profil) {
            try {
                $this->hapusFotoProfil($users);
                $path_foto = 'Foto Profil';
                $path = $foto_profil->storeAs($path_foto, $foto_profil_filename, 'public');
                $users->update([
                    'foto_profil' => $path, 
                ]);
                return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Update gagal: ' . $e->getMessage());
            }
        }
    }
    


    private function hapusFotoProfil($users)
    {
        if ($users->foto_profil) {
            $foto_profil_path = storage_path('app/public/' . $users->foto_profil);
            if (File::exists($foto_profil_path)) {
                File::delete($foto_profil_path);
            }
        }
    }
}