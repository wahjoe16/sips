<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DosenImport;
use App\Models\DaftarSeminar;
use App\Models\DaftarSidang;
use App\Models\Dosen;
use App\Models\Mahasiswa;
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

    public function viewDaftarSeminar($slug)
    {
        Session::put('page', 'viewDaftarSeminar');

        if ($slug == 'Teknik Pertambangan') {
            $title = 'Kolokium Skripsi';
            $daftarSeminar = DaftarSeminar::where([
                'program_studi' => 'Teknik Pertambangan',
                'status' => 0
            ])->get();
        } elseif ($slug == 'Teknik Industri') {
            $title = 'Seminar';
            $daftarSeminar = DaftarSeminar::where([
                'program_studi' => 'Teknik Industri',
                'status' => 0
            ])->get();
        } elseif ($slug == 'Perencanaan Wilayah dan Kota') {
            $title = 'Sidang Pembahasan';
            $daftarSeminar = DaftarSeminar::where([
                'program_studi' => 'Perencanaan Wilayah dan Kota',
                'status' => 0
            ])->get();
        }
        return view('dosen.daftar_seminar', compact('slug', 'daftarSeminar', 'title'));
    }

    public function showDaftarSeminar(Request $request, $id)
    {
        $seminar = DaftarSeminar::find($id);
        // dd($seminar);

        if ($request->isMethod('POST')) {
            $request->validate([
                'status' => 'required',
                'keterangan' => 'required_if:status,2'
            ], [
                'keterangan.required_if' => 'Keterangan harus diisi',
                'status.required' => 'Status approval harus diverifikasi'
            ]);

            $seminar->fill($request->input());
            $seminar->save();
            return redirect()->route('viewDaftarSeminar', [
                'slug' => 'Perencanaan Wilayah dan Kota',
                'slug' => 'Teknik Industri',
                'slug' => 'Teknik Pertambangan'
            ])->with('success_message', 'Status Approval berhasil ditambahkan');
        }

        return view('dosen.show_daftar_seminar', compact('seminar'));
    }

    public function rekapDaftarSeminar($slug)
    {
        Session::put('page', 'rekapDaftarSeminar');

        if ($slug == 'Teknik Pertambangan') {
            $title = 'Data Kolokium Skripsi';
            $rekapSeminar = DaftarSeminar::where([
                'program_studi' => 'Teknik Pertambangan',
                'status' => 1
            ])->get();
        } elseif ($slug == 'Teknik Industri') {
            $title = 'Data Seminar Skripsi';
            $rekapSeminar = DaftarSeminar::where([
                'program_studi' => 'Teknik Industri',
                'status' => 1
            ])->get();
        } elseif ($slug == 'Perencanaan Wilayah dan Kota') {
            $title = 'Data Sidang Pembahasan';
            $rekapSeminar = DaftarSeminar::where([
                'program_studi' => 'Perencanaan Wilayah dan Kota',
                'status' => 1
            ])->get();
        }

        return view('dosen.rekap_daftar_seminar', compact('slug', 'rekapSeminar', 'title'));
    }

    public function viewDaftarSidang($slug)
    {
        Session::put('page', 'viewDaftarSidang');

        if ($slug == 'Teknik Pertambangan') {
            $daftarSidang = DaftarSidang::where([
                'program_studi' => 'Teknik Pertambangan',
                'status' => 0
            ])->get();
        } elseif ($slug == 'Teknik Industri') {
            $daftarSidang = DaftarSidang::where([
                'program_studi' => 'Teknik Industri',
                'status' => 0
            ])->get();
        } elseif ($slug == 'Perencanaan Wilayah dan Kota') {
            $daftarSidang = DaftarSidang::where([
                'program_studi' => 'Perencanaan Wilayah dan Kota',
                'status' => 0
            ])->get();
        }

        return view('dosen.daftar_sidang', compact('slug', 'daftarSidang'));
    }

    public function showDaftarSidang(Request $request, $id)
    {
        $sidang = DaftarSidang::find($id)->with('mahasiswa')->first();
        // dd($sidang);

        if ($request->isMethod('POST')) {
            $request->validate([
                'status' => 'required',
                'keterangan' => 'required_if:status,2'
            ], [
                'keterangan.required_if' => 'Keterangan harus diisi',
                'status.required' => 'Status approval harus diverifikasi'
            ]);

            $sidang->fill($request->input());
            $sidang->save();
            return redirect()->route('dashboardDosen')->with('success_message', 'Status Approval berhasil ditambahkan');
        }

        return view('dosen.show_daftar_sidang', compact('sidang'));
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
