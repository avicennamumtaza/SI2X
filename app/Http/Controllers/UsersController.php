<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\Users;
use Illuminate\Foundation\Auth\User;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class UsersController extends Controller
{

    public function list(UsersDataTable $dataTable)
    {
        return $dataTable->render('auth.rw.users');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:20|unique:users,username',
            'nik' => 'required|string|min:15|max:17|unique:users,nik',
            'role' => 'required',
            'foto_profil' => 'required|mimes:png,jpg,jpeg',
            'email' => 'required|string|email|max:50|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username harus memiliki panjang maksimal :max karakter.',
            'username.unique' => 'Username sudah digunakan!',
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.min' => 'NIK harus memiliki panjang minimal :min karakter.',
            'nik.max' => 'NIK harus memiliki panjang maksimal :max karakter.',
            'nik.unique' => 'NIK sudah digunakan!',
            'role.required' => 'Role wajib diisi.',
            'foto_profil.required' => 'Foto profil wajib diisi.',
            'foto_profil.mimes' => 'Foto profil harus berupa JPEG, PNG, JPG, GIV, SVG.',
            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.email' => 'Email harus berupa email.',
            'email.max' => 'Email harus memiliki panjang maksimal :max karakter.',
            'email.unique' => 'Email sudah digunakan!',
            'password.required' => 'password wajib diisi.',
            'password.string' => 'password harus berupa teks.',
            'password.min' => 'password harus memiliki panjang minimal :min.',
        ]);

        // Validasi manual NIK
        $nikExistsInRt = \App\Models\Rt::where('nik_rt', $validated['nik'])->exists();
        $nikExistsInRw = \App\Models\Rw::where('nik_rw', $validated['nik'])->exists();
    
        if (!$nikExistsInRt && !$nikExistsInRw) {
            return redirect()->back()->withErrors(['nik' => 'NIK harus ada di tabel RT atau RW.'])->withInput();
        }

        $foto_profil = $request->file('foto_profil');
        $foto_profil_ext = $foto_profil->getClientOriginalExtension();
        $foto_profil_filename = $validated['username'] . date('ymdhis') . "." . $foto_profil_ext;

        try {
            Users::create([
                'username' => $validated['username'],
                'nik' => $validated['nik'],
                'role' => $validated['role'],
                'foto_profil' => $foto_profil_filename,
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
            Alert::success('Registrasi Berhasil', 'Akun berhasil dibuat!');
            $path_foto = 'Foto Profil';
            $foto_profil->storeAs($path_foto, $foto_profil_filename, 'public');
            return redirect()->back()->with('success', 'Data User berhasil ditambahkan!');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    public function update(Request $request, Users $users)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:20',
            'nik' => 'required|string|min:15|max:17',
            'role' => 'required',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 'image' untuk validasi file gambar
            'email' => 'nullable|string|email|max:50',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username harus memiliki panjang maksimal :max karakter.',
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.min' => 'NIK harus memiliki panjang minimal :min karakter.',
            'nik.max' => 'NIK harus memiliki panjang maksimal :max karakter.',
            'role.required' => 'Role wajib diisi.',
            'foto_profil.image' => 'Foto profil harus berupa gambar.',
            'foto_profil.mimes' => 'Foto profil harus berupa JPEG, PNG, JPG, GIV, SVG.',
            'foto_profil.max' => 'Foto profil harus berukuran maksimal :max.',
            'email.string' => 'Email harus berupa teks.',
            'email.max' => 'Email harus memiliki panjang maksimal :max karakter.',
            'password.string' => 'password harus berupa teks.',
            'password.min' => 'password harus memiliki panjang minimal :min.',
        ]);

        $foto_profil = $request->file('foto_profil');

        if ($foto_profil) {
            $this->hapusFotoProfil($users);
            $foto_profil_ext = $foto_profil->getClientOriginalExtension();
            $foto_profil_filename = $validated['username'] . date('ymdhis') . "." . $foto_profil_ext;
            $foto_profil->move(public_path('Foto Profil'), $foto_profil_filename);
            $users->update([
                'foto_profil' => $foto_profil_filename,
            ]);
        }

        try {
            $users->update([
                'username' => $validated['username'],
                'nik' => $validated['nik'],
                'role' => $validated['role'],
            ]);
            if (!empty($validated['password'])) {
                $users->password = Hash::make($validated['password']);
                $users->save();
            }
            Alert::success('Perubahan data Berhasil', 'Akun Anda telah berhasil diubah!');
            return redirect()->route('users.manage')->with('success', 'Data berhasil diperbarui!');
        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }
    }

    private function hapusFotoProfil($users)
    {
        $foto_profil_path = public_path('Foto Profil') . '/' . $users->foto_profil;
        if (File::exists($foto_profil_path)) {
            File::delete($foto_profil_path);
        }
    }

    public function destroy($id)
    {
        $user = Users::findOrFail($id);
        File::delete(public_path('Foto Profil') . '/' . $user->foto_profil);
        $user->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
    }
}