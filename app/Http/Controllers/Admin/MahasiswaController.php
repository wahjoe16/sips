<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarSidang;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use App\Imports\MahasiswaImport;
use App\Models\DaftarSeminar;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    public function loginMahasiswa(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);

            $rules = [
                'npm' => 'required',
                'password' => 'required',
            ];

            $customMessage = [
                'npm.required' => 'NPM Harus Diisi',
                'password.required' => 'Password Harus Diisi',
            ];

            $this->validate($request, $rules, $customMessage);

            if (Auth::guard('mahasiswa')->attempt([
                'npm' => $data['npm'],
                'password' => $data['password'],
            ])) {
                return redirect()->route('dashboardMahasiswa');
            } else {
                return redirect()->back()->with('error_message', 'NPM / Password Tidak Valid');
            }
        }
        return view('mahasiswa.login');
    }

    public function dashboardMahasiswa()
    {
        return view('mahasiswa.dashboard');
    }

    public function logoutMahasiswa()
    {
        Auth::guard('mahasiswa')->logout();
        return redirect()->route('loginMahasiswa');
    }

    public function viewMahasiswa()
    {
        Session::put('page', 'mahasiswa');
        $mahasiswa = Mahasiswa::get();
        return view('admin.mahasiswa.mahasiswa', compact('mahasiswa'));
    }

    public function addEditMahasiswa(Request $request, $id = null)
    {
        if ($id == '') {
            $title = "Tambah Data Mahasiswa";
            $mahasiswa = new Mahasiswa;
            $message = "Data Mahasiswa Berhasil Ditambah";
        } else {
            $title = "Update Data Mahasiswa";
            $mahasiswa = Mahasiswa::find($id);
            $message = "Data Mahasiswa Berhasil Diupdate";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $rules = [
                'npm' => 'required|unique:mahasiswa',
                'nama' => 'required',
                'foto' => 'mimes:jpg,jpeg,png,',
                // 'email' => 'email',
            ];

            $customMessage = [
                'npm.required' => 'NIK Tidak Boleh Kosong',
                'npm.unique' => 'NPM Sudah Terdaftar',
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'foto.mimes' => 'Format Foto Dosen harus JPEG, JPG, PNG',
                // 'email.email' => 'Format Email Harus Benar',
            ];

            $this->validate($request, $rules, $customMessage);

            $mahasiswa->npm = $data['npm'];
            $mahasiswa->nama = $data['nama'];
            $mahasiswa->password = Hash::make($mahasiswa->npm);
            $mahasiswa->save();

            return redirect()->route('viewMahasiswa')->with('success_message', $message);
        }


        return view('admin.mahasiswa.add_edit_mahasiswa', compact('message', 'title', 'mahasiswa'));
    }

    public function pageImportMahasiswa()
    {
        return view('admin.mahasiswa.page_import_mahasiswa');
    }

    public function importMahasiswa()
    {
        $import = new MahasiswaImport();
        Excel::import($import, request()->file('file'));

        if ($import->failures()->isNotEmpty()) {
            return redirect()->route('viewMahasiswa')->withFailures($import->failures());
        }

        return redirect()->route('viewMahasiswa')->with('success_message', 'Sukses Import Data Mahasiswa');
    }

    public function updateProfile(Request $request)
    {
        $mahasiswa = Auth::guard('mahasiswa')->user();
        if ($request->isMethod('POST')) {
            $data = $request->all();

            if ($request->hasFile('foto')) {
                $foto_tmp = $request->file('foto');
                if ($foto_tmp->isValid()) {
                    $extension = $foto_tmp->getClientOriginalExtension();
                    $fotoName = rand(111, 99999) . '.' . $extension;
                    $fotoPath = 'mahasiswa/foto/' . $fotoName;

                    Image::make($foto_tmp)->save($fotoPath);
                }
            } elseif (!empty($data['current_mahasiswa_foto'])) {
                $fotoName = $data['current_mahasiswa_foto'];
            } else {
                $fotoName = '';
            }

            Mahasiswa::where('id', Auth::guard('mahasiswa')->user()->id)->update([
                'nama' => $data['nama'],
                'foto' => $fotoName,
                'angkatan' => $data['angkatan'],
                'telepon' => $data['telepon'],
                'email' => $data['email'],
                'program_studi' => $data['program_studi'],
            ]);

            return redirect()->back()->with('success_message', 'Profil Berhasil diupdate');
        }

        return view('mahasiswa.update_profile', compact('mahasiswa'));
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $mahasiswa = Auth::guard('mahasiswa')->user();

            if ($request->has('password') && $request->password != '') {
                if (Hash::check($request->old_password, $mahasiswa->password)) {
                    if ($request->password == $request->password_confirmation) {
                        $mahasiswa->password = bcrypt($request->password);
                    } else {
                        return redirect()->back()->with('error_message', 'Konfirmasi password tidak sesuai');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'Password lama anda salah');
                }
            }

            $mahasiswa->save();
            return redirect()->back()->with('success_message', 'Password anda berhasil diupdate');
        }

        return view('mahasiswa.update_password');
    }
}
