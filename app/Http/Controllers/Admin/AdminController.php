<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\DaftarSidang;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function dashboardAdmin()
    {
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }

    public function loginAdmin(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $rules = [
                'nik' => 'required',
                'password' => 'required',
            ];

            $customMessages = [
                'nik.required' => 'NIK Harus Diisi',
                'nik.password' => 'Password Harus Diisi',
            ];

            $this->validate($request, $rules, $customMessages);

            if (Auth::guard('admin')->attempt([
                'nik' => $data['nik'],
                'password' => $data['password'],

            ])) {
                return redirect()->route('dashboardAdmin');
            } else {
                return redirect()->back()->with('error_message', 'NIK / Password Tidak Valid');
            }
        }

        return view('admin.login');
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('loginAdmin');
    }

    public function viewDaftarSidangAll()
    {
        Session::put('page', 'daftarSidang');
        $viewDatarSidang = DaftarSidang::get();
        return view('admin.daftar_sidang', compact('viewDatarSidang'));
    }

    public function updateProfile(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if ($request->isMethod('POST')) {
            $data = $request->all();

            if ($request->hasFile('foto')) {
                $foto_tmp = $request->file('foto');
                if ($foto_tmp->isValid()) {
                    $extension = $foto_tmp->getClientOriginalExtension();
                    $fotoName = rand(111, 99999) . '.' . $extension;
                    $fotoPath = 'admin/foto/' . $fotoName;

                    Image::make($foto_tmp)->save($fotoPath);
                }
            } elseif (!empty($data['current_admin_foto'])) {
                $fotoName = $data['current_admin_foto'];
            } else {
                $fotoName = '';
            }

            Admin::where('id', Auth::guard('admin')->user()->id)->update([
                'name' => $data['name'],
                'foto' => $fotoName,
                'mobile' => $data['mobile'],
                'email' => $data['email'],
            ]);

            return redirect()->back()->with('success_message', 'Profil Berhasil diupdate');
        }

        return view('admin.update_profile', compact('admin'));
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $admin = Auth::guard('admin')->user();

            if ($request->has('password') && $request->password != '') {
                if (Hash::check($request->old_password, $admin->password)) {
                    if ($request->password == $request->password_confirmation) {
                        $admin->password = bcrypt($request->password);
                    } else {
                        return redirect()->back()->with('error_message', 'Konfirmasi password tidak sesuai');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'Password lama salah');
                }
            }

            $admin->save();
            return redirect()->back()->with('success_message', 'Password berhasil diupdate');
        }

        return view('admin.update_password');
    }
}
