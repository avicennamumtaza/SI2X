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
        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:20|unique:users,username',
            'nik' => 'required|string|min:15|max:17',
            'role' => 'required|string|max:20',
            'foto_profil' => 'required|mimes:jpeg,png,jpg,gif,svg',
            'email' => 'required|string|email|max:50|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ],[
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username harus memiliki panjang maksimal :max karakter.',
            'username.unique' => 'Username harus unik',
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.min' => 'NIK harus memiliki panjang minimal :min karakter.',
            'nik.max' => 'NIK harus memiliki panjang maksimal :max karakter.',
            'role.required' => 'Role wajib diisi.',
            'role.string' => 'Role harus berupa teks.',
            'role.max' => 'Role harus memiliki panjang maksimal :max karakter.',
            'foto_profil.required' => 'Foto profil wajib diisi.',
            // 'foto_profil.image' => 'Foto profil harus berupa gambar.',
            'foto_profil.mimes' => 'Foto profil harus berupa JPEG, PNG, JPG, GIV, SVG.',
            // 'foto_profil.max' => 'Foto profil harus berukuran maksimal :max.',
            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.max' => 'Email harus memiliki panjang maksimal :max karakter.',
            'password.required' => 'password wajib diisi.',
            'password.string' => 'password harus berupa teks.',
            'password.min' => 'password harus memiliki panjang minimal :min.', 
        ]);

        $foto_profil = $request->file('foto_profil');
        $foto_profil_ext = $foto_profil->getClientOriginalExtension();;
        $foto_profil_filename = $validated['username'] . date('ymdhis') . "." . $foto_profil_ext;
        
        try{
            Users::create([
                'username' => $validated['username'],
                'nik' => $validated['nik'],
                'role' => $validated['role'],
                'foto_profil' => $foto_profil_filename,
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);
            Alert::success('Registrasi Berhasil', 'Akun Anda telah berhasil dibuat!');
            $foto_profil->move(public_path('Foto Users'), $foto_profil_filename);
            return redirect()->back()->with('success', 'Data User berhasil ditambahkan!');
        } catch(\Exception $e){
            Alert::error('Error', $e->getMessage());
            return redirect()->back();
        }

    }
//     public function store(Request $request)
// {
//     // Validasi input
//     $validated = $request->validate([
//         'username' => 'required|string|max:20|unique:users,username',
//         'nik' => 'required|string|min:15|max:17',
//         'role' => 'required|string|max:20',
//         'foto_profil' => 'required|image|mimes:jpeg,png,jpg',
//         'email' => 'required|string|email|max:50|unique:users,email',
//         'password' => 'required|string|min:6|confirmed',
//     ],[
//         'username.required' => 'Username wajib diisi.',
//         'username.string' => 'Username harus berupa teks.',
//         'username.max' => 'Username harus memiliki panjang maksimal :max karakter.',
//         'username.unique' => 'Username harus unik',
//         'nik.required' => 'NIK wajib diisi.',
//         'nik.string' => 'NIK harus berupa teks.',
//         'nik.min' => 'NIK harus memiliki panjang minimal :min karakter.',
//         'nik.max' => 'NIK harus memiliki panjang maksimal :max karakter.',
//         'role.required' => 'Role wajib diisi.',
//         'role.string' => 'Role harus berupa teks.',
//         'role.max' => 'Role harus memiliki panjang maksimal :max karakter.',
//         'foto_profil.required' => 'Foto profil wajib diisi.',
//         'foto_profil.image' => 'Foto profil harus berupa gambar.',
//         'foto_profil.mimes' => 'Foto profil harus berupa JPEG, PNG, JPG, GIV, SVG.',
//         // 'foto_profil.max' => 'Foto profil harus berukuran maksimal :max.',
//         'email.required' => 'Email wajib diisi.',
//         'email.string' => 'Email harus berupa teks.',
//         'email.max' => 'Email harus memiliki panjang maksimal :max karakter.',
//         'password.required' => 'password wajib diisi.',
//         'password.string' => 'password harus berupa teks.',
//         'password.min' => 'password harus memiliki panjang minimal :min.', 
//     ]);

//     // Debugging: Check if the file is being received
//     if ($request->hasFile('foto_profil')) {
//         $foto_profil = $request->file('foto_profil');
//         $foto_profil_ext = $foto_profil->getClientOriginalExtension();
//         $foto_profil_filename = $validated['username'] . date('ymdhis') . "." . $foto_profil_ext;

//         // Debugging: Check the file extension and type
//         logger()->info('Received file extension: ' . $foto_profil_ext);
//         logger()->info('Received file MIME type: ' . $foto_profil->getMimeType());

//         try {
//             // Store the file
//             $foto_profil->move(public_path('Foto Users'), $foto_profil_filename);

//             // Create the user record
//             Users::create([
//                 'username' => $validated['username'],
//                 'nik' => $validated['nik'],
//                 'role' => $validated['role'],
//                 'foto_profil' => $foto_profil_filename,
//                 'email' => $validated['email'],
//                 'password' => Hash::make($validated['password']),
//             ]);

//             Alert::success('Registrasi Berhasil', 'Akun Anda telah berhasil dibuat!');
//             return redirect()->back()->with('success', 'Data User berhasil ditambahkan!');
//         } catch(\Exception $e) {
//             Alert::error('Error', $e->getMessage());
//             return redirect()->back();
//         }
//     } else {
//         return redirect()->back()->with('error', 'Foto profil tidak ditemukan.');
//     }
// }


    // public function edit(Users $users)
    // {
    //     $users = Users::findOrFail($users->id_user);
    //     return view('users', compact('users'));
    // }

    public function update(Request $request, Users $users)
    {

        // Validasi input
        $validated = $request->validate([
            'username' => 'required|string|max:20|unique:users,username,' . $users->id_user,
            'nik' => 'required|string|min:15|max:17',
            'role' => 'required|string|max:20',
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 'image' untuk validasi file gambar
            'email' => 'required|string|email|max:50|unique:users,email,' .$users->id_user,
            //'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 'image' untuk validasi file gambar
            //'email' => 'required|string|email|max:50|unique:users,email,' . $users->id,
            'password' => 'nullable|string|min:6|confirmed',
        ],[
            'username.required' => 'Username wajib diisi.',
            'username.string' => 'Username harus berupa teks.',
            'username.max' => 'Username harus memiliki panjang maksimal :max karakter.',
            'username.unique' => 'Username harus unik',
            'nik.required' => 'NIK wajib diisi.',
            'nik.string' => 'NIK harus berupa teks.',
            'nik.min' => 'NIK harus memiliki panjang minimal :min karakter.',
            'nik.max' => 'NIK harus memiliki panjang maksimal :max karakter.',
            'role.required' => 'Role wajib diisi.',
            'role.string' => 'Role harus berupa teks.',
            'role.max' => 'Role harus memiliki panjang maksimal :max karakter.',
            'foto_profil.required' => 'Foto profil wajib diisi.',
            'foto_profil.image' => 'Foto profil harus berupa gambar.',
            'foto_profil.mimes' => 'Foto profil harus berupa JPEG, PNG, JPG, GIV, SVG.',
            'foto_profil.max' => 'Foto profil harus berukuran maksimal :max.',
            'email.required' => 'Email wajib diisi.',
            'email.string' => 'Email harus berupa teks.',
            'email.max' => 'Email harus memiliki panjang maksimal :max karakter.',
            'password.required' => 'password wajib diisi.',
            'password.string' => 'password harus berupa teks.',
            'password.min' => 'password harus memiliki panjang minimal :min.', 
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

            return redirect()->route('users.manage')->with('success', 'Data user berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Update gagal: ' . $e->getMessage());
        }
    }
    
    public function destroy($id)
    {
        $user = Users::findOrFail($id);
        File::delete(public_path('Foto Users') . '/' . $user->foto_profil);
        $user->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus!');
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
            'password' => 'nullable|string|min:6|confirmed',
            //'password' => 'nullable|string|min:6|confirmed'
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