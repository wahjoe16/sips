<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DosenImport;
use App\Models\DaftarSeminar;
use App\Models\DaftarSidang;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Maatwebsite\Excel\Facades\Excel;

class DosenController extends Controller
{
    public function loginDosen(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = $request->all();

            $rules = [
                'nik' => 'required',
                'password' => 'required',
            ];

            $customMessage = [
                'nik.required' => 'NIK Tidak Boleh Kosong',
                'password.required' => 'Password Tidak Boleh Kosong',
            ];

            $this->validate($request, $rules, $customMessage);

            if (Auth::guard('dosen')->attempt([
                'nik' => $data['nik'],
                'password' => $data['password'],
            ])) {
                return redirect()->route('dashboardDosen');
            } else {
                return redirect()->back()->with('error_message', 'NIK / Password Tidak Valid');
            }
        }
        return view('dosen.login');
    }

    public function dashboardDosen()
    {
        Session::put('page', 'dasboardDosen');
        return view('dosen.dashboard');
    }

    public function logoutDosen()
    {
        Auth::guard('dosen')->logout();
        return redirect()->route('loginDosen');
    }

    public function viewDosen()
    {
        Session::put('page', 'dosen');
        $dosen = Dosen::get();
        return view('admin.dosen.dosen', compact('dosen'));
    }

    public function addEditDosen(Request $request, $id = null)
    {
        if ($id == null) {
            $title = "Tambah Data Dosen";
            $dosen = new Dosen();
            $message = "Data Dosen Berhasil Ditambahkan";
        } else {
            $title = "Edit Data Dosen";
            $dosen = Dosen::find($id);
            $message = "Data Dosen Berhasil Diupdate";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $rules = [
                'nik' => 'required|unique:dosens',
                'nama' => 'required',
                'program_studi' => 'required',
                'tipe' => 'required',
                'foto' => 'mimes:jpg,jpeg,png,',
            ];

            $customMessage = [
                'nik.required' => 'NIK Tidak Boleh Kosong',
                'nik.unique' => 'NIK Sudah terdaftar',
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'program_studi' => 'Program Studi Tidak Boleh Kosong',
                'tipe' => 'Tipe Tidak Boleh Kosong',
                'foto.mimes' => 'Format Foto Dosen harus JPEG, JPG, PNG',
            ];

            $this->validate($request, $rules, $customMessage);

            if ($request->hasFile('foto')) {
                $foto_tmp = $request->file('foto');
                if ($foto_tmp->isValid()) {
                    $fotoExt = $foto_tmp->getClientOriginalExtension();
                    $fotoName = $data['nama'] . "_" . rand(111, 99999) . "." . $fotoExt;
                    $fotoPath = 'admin/foto/dosen/' . $fotoName;
                    Image::make($foto_tmp)->save($fotoPath);
                    $dosen->foto = $fotoName;
                } elseif (!empty($data['current_foto'])) {
                    $fotoName = $data['current_foto'];
                } else {
                    $fotoName = '';
                }
            }

            $dosen->nik = $data['nik'];
            $dosen->nama = $data['nama'];
            $dosen->password = Hash::make($dosen->nik);
            $dosen->email = $data['email'];
            $dosen->telepon = $data['telepon'];
            $dosen->program_studi = $data['program_studi'];
            $dosen->tipe = $data['tipe'];
            $dosen->save();

            return redirect()->route('viewDosen')->with('success_message', $message);
        }

        return view('admin.dosen.add_edit_dosen', compact('title', 'dosen', 'message'));
    }

    public function updateDosenStatus(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }

            Dosen::where($id, $data['dosen_id'])->update(['status_koordinator' => $status]);
            return response()->json(['status' => $status, 'dosen_id' => $data['dosen_id']]);
        }
    }

    public function pageImportDosen()
    {
        return view('admin.dosen.page_import_dosen');
    }

    public function importDosen()
    {
        $import = new DosenImport();
        Excel::import($import, request()->file('file'));

        if ($import->failures()->isNotEmpty()) {
            return redirect()->route('viewDosen')->withFailures($import->failures());
        }

        return redirect()->route('viewDosen')->with('success_message', 'Sukses Import Data Dosen');
    }

    public function updateProfile(Request $request)
    {
        $dosen = Auth::guard('dosen')->user();
        if ($request->isMethod('POST')) {
            $data = $request->all();

            if ($request->hasFile('foto')) {
                $foto_tmp = $request->file('foto');
                if ($foto_tmp->isValid()) {
                    $extension = $foto_tmp->getClientOriginalExtension();
                    $fotoName = rand(111, 99999) . '.' . $extension;
                    $fotoPath = 'dosen/foto/' . $fotoName;

                    Image::make($foto_tmp)->save($fotoPath);
                }
            } elseif (!empty($data['current_dosen_foto'])) {
                $fotoName = $data['current_dosen_foto'];
            } else {
                $fotoName = '';
            }

            Dosen::where('id', Auth::guard('dosen')->user()->id)->update([
                'nama' => $data['nama'],
                'foto' => $fotoName,
                'telepon' => $data['telepon'],
                'email' => $data['email'],
                'program_studi' => $data['program_studi'],
            ]);

            return redirect()->back()->with('success_message', 'Profil Berhasil diupdate');
        }

        return view('dosen.update_profile', compact('dosen'));
    }

    public function updatePassword(Request $request)
    {
        if ($request->isMethod('POST')) {
            $dosen = Auth::guard('dosen')->user();

            if ($request->has('password') && $request->password != '') {
                if (Hash::check($request->old_password, $dosen->password)) {
                    if ($request->password == $request->password_confirmation) {
                        $dosen->password = bcrypt($request->password);
                    } else {
                        return redirect()->back()->with('error_message', 'Konfirmasi password tidak sesuai');
                    }
                } else {
                    return redirect()->back()->with('error_message', 'Password lama anda salah');
                }
            }

            $dosen->save();
            return redirect()->back()->with('success_message', 'Password anda berhasil diupdate');
        }

        return view('dosen.update_password');
    }
}
