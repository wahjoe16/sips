<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarSidang;
use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function dashboardAdmin()
    {
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

    public function viewTahunAjaran()
    {
        Session::put('page', 'tahun_ajaran');
        $tahun_ajaran = TahunAjaran::get();
        return view('admin.tahun_ajaran.tahun_ajaran', compact('tahun_ajaran'));
    }

    public function addEditTahunAjaran(Request $request, $id = null)
    {
        if ($id == '') {
            $title = "Tambah data Tahun Ajaran";
            $tahun_ajaran = new TahunAjaran;
            $message = 'Sukses Menambahkan Data Tahun Ajaran';
        } else {
            $title = 'Edit data Tahun Ajaran';
            $tahun_ajaran = TahunAjaran::find($id);
            $message = 'Sukses Mengupdate Data Tahun Ajaran';
        }

        if ($request->isMethod('POST')) {
            $data = $request->all();

            $rules = [
                'semester_id' => 'required',
                'tahun_ajaran' => 'required',
            ];

            $customMessages = [
                'semester_id.required' => 'Semester Tidak Boleh Kosong',
                'tahun_ajaran.required' => 'Tahun Ajaran Tidak Boleh Kosong',
            ];

            $this->validate($request, $rules, $customMessages);

            $tahun_ajaran->semester_id = $data['semester_id'];
            $tahun_ajaran->tahun_ajaran = $data['tahun_ajaran'];
            $tahun_ajaran->save();

            return redirect()->route('viewTahunAjaran')->with('success_message', $message);
        }

        $semester = Semester::get();

        return view('admin.tahun_ajaran.add_edit_tahun_ajaran', compact('tahun_ajaran', 'title', 'message', 'semester'));
    }

    public function viewSemester()
    {
        Session::put('page', 'semester');
        $semester = Semester::get();
        return view('admin.semester.semester', compact('semester'));
    }

    public function addEditSemester(Request $request, $id = null)
    {
        if ($id == '') {
            $title = "Tambah data Semester";
            $semester = new Semester;
            $message = 'Sukses Menambahkan Data Semester';
        } else {
            $title = 'Edit data Semester';
            $semester = Semester::find($id);
            $message = 'Sukses Mengupdate Data Semester';
        }

        if ($request->isMethod('POST')) {
            $data = $request->all();

            $rules = [
                'semester' => 'required',
            ];

            $customMessages = [
                'semester.required' => 'Data Semester Tidak Boleh Kosong',
            ];

            $this->validate($request, $rules, $customMessages);

            $semester->semester = $data['semester'];
            $semester->save();

            return redirect()->route('viewSemester')->with('success_message', $message);
        }

        return view('admin.semester.add_edit_semester', compact('semester', 'title', 'message'));
    }

    public function viewDaftarSidangAll()
    {
        Session::put('page', 'daftarSidang');
        $viewDatarSidang = DaftarSidang::get();
        return view('admin.daftar_sidang', compact('viewDatarSidang'));
    }
}
