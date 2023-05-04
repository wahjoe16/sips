<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DaftarSidang;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use App\Imports\MahasiswaImport;
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

    public function daftarSidang($slug, Request $request)
    {
        if ($slug == 'Teknik Pertambangan') {
            Session::put('page', 'daftar_sidang_tambang');
            $daftarSidang = new DaftarSidang;

            if ($request->isMethod('POST')) {
                $data = $request->all();

                $rules = [
                    'tahun_ajaran_id' => 'required',
                    // 'dosen1_id' => 'required',
                    // 'dosen2_id' => 'required',
                    'judul_skripsi' => 'required',
                    // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                    'syarat_1' => 'required|mimes:pdf',
                    'syarat_2' => 'required|mimes:pdf',
                    'syarat_3' => 'required|mimes:pdf',
                    'syarat_4' => 'required|mimes:pdf',
                    'syarat_5' => 'required|mimes:pdf',
                    'syarat_6' => 'required|mimes:pdf',
                    'syarat_7' => 'required|mimes:pdf',
                    'syarat_8' => 'required|mimes:pdf',
                    'syarat_9' => 'required|mimes:pdf',
                    'syarat_10' => 'required|mimes:pdf',
                    'syarat_11' => 'required|mimes:pdf',
                    'syarat_12' => 'required|mimes:pdf',
                    'syarat_13' => 'required|mimes:pdf',
                    'syarat_14' => 'required|mimes:pdf',
                    'syarat_15' => 'required|mimes:pdf',
                ];

                $customMessage = [
                    'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                    // 'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                    // 'dosen2_id.required' => 'Dosen Pembimbing 2 Tidak Boleh Kosong',
                    'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                    'syarat_1.required' => 'Syarat 1 Harus Diisi',
                    'syarat_2.required' => 'Syarat 2 Harus Diisi',
                    'syarat_3.required' => 'Syarat 3 Harus Diisi',
                    'syarat_4.required' => 'Syarat 4 Harus Diisi',
                    'syarat_5.required' => 'Syarat 5 Harus Diisi',
                    'syarat_6.required' => 'Syarat 6 Harus Diisi',
                    'syarat_7.required' => 'Syarat 7 Harus Diisi',
                    'syarat_8.required' => 'Syarat 8 Harus Diisi',
                    'syarat_9.required' => 'Syarat 9 Harus Diisi',
                    'syarat_10.required' => 'Syarat 10 Harus Diisi',
                    'syarat_11.required' => 'Syarat 11 Harus Diisi',
                    'syarat_12.required' => 'Syarat 12 Harus Diisi',
                    'syarat_13.required' => 'Syarat 13 Harus Diisi',
                    'syarat_14.required' => 'Syarat 14 Harus Diisi',
                    'syarat_15.required' => 'Syarat 15 Harus Diisi',
                    'syarat_1.mimes' => 'Format File Syarat 1 Harus PDF',
                    'syarat_2.mimes' => 'Format File Syarat 2 Harus PDF',
                    'syarat_3.mimes' => 'Format File Syarat 3 Harus PDF',
                    'syarat_4.mimes' => 'Format File Syarat 4 Harus PDF',
                    'syarat_5.mimes' => 'Format File Syarat 5 Harus PDF',
                    'syarat_6.mimes' => 'Format File Syarat 6 Harus PDF',
                    'syarat_7.mimes' => 'Format File Syarat 7 Harus PDF',
                    'syarat_8.mimes' => 'Format File Syarat 8 Harus PDF',
                    'syarat_9.mimes' => 'Format File Syarat 9 Harus PDF',
                    'syarat_10.mimes' => 'Format File Syarat 10 Harus PDF',
                    'syarat_11.mimes' => 'Format File Syarat 11 Harus PDF',
                    'syarat_12.mimes' => 'Format File Syarat 12 Harus PDF',
                    'syarat_13.mimes' => 'Format File Syarat 13 Harus PDF',
                    'syarat_14.mimes' => 'Format File Syarat 14 Harus PDF',
                    'syarat_15.mimes' => 'Format File Syarat 15 Harus PDF',
                ];

                $this->validate($request, $rules, $customMessage);

                $daftarSidang = new DaftarSidang;
                $daftarSidang->mahasiswa_id = Auth::guard('mahasiswa')->user()->id;
                $daftarSidang->program_studi = Auth::guard('mahasiswa')->user()->program_studi;
                $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
                $daftarSidang->dosen1_id = $request['dosen1_id'];
                $daftarSidang->dosen2_id = $request['dosen2_id'];
                $daftarSidang->judul_skripsi = $request['judul_skripsi'];
                $daftarSidang->tanggal_pengajuan = $request['tanggal_pengajuan'];

                // upload syarat 
                $syarat_1 = $request->file('syarat_1');
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSidang->syarat_1 = $nama_syarat_1;

                // upload syarat 2
                $syarat_2 = $request->file('syarat_2');
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSidang->syarat_2 = $nama_syarat_2;

                // upload syarat 3
                $syarat_3 = $request->file('syarat_3');
                $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
                $syarat_3_path = 'mahasiswa/syarat03';
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSidang->syarat_3 = $nama_syarat_3;

                // upload syarat 
                $syarat_4 = $request->file('syarat_4');
                $ext_syarat_4 = $syarat_4->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName() . "." . $ext_syarat_4;
                $syarat_4_path = 'mahasiswa/syarat04';
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSidang->syarat_4 = $nama_syarat_4;

                // upload syarat 
                $syarat_5 = $request->file('syarat_5');
                $ext_syarat_5 = $syarat_5->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName() . "." . $ext_syarat_5;
                $syarat_5_path = 'mahasiswa/syarat05';
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSidang->syarat_5 = $nama_syarat_5;

                // upload syarat 
                $syarat_6 = $request->file('syarat_6');
                $ext_syarat_6 = $syarat_6->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName() . "." . $ext_syarat_6;
                $syarat_6_path = 'mahasiswa/syarat06';
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSidang->syarat_6 = $nama_syarat_6;

                // upload syarat 
                $syarat_7 = $request->file('syarat_7');
                $ext_syarat_7 = $syarat_7->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_7 = $npm . "_" . $syarat_7->getClientOriginalName() . "." . $ext_syarat_7;
                $syarat_7_path = 'mahasiswa/syarat07';
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSidang->syarat_7 = $nama_syarat_7;

                // upload syarat 
                $syarat_8 = $request->file('syarat_8');
                $ext_syarat_8 = $syarat_8->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_8 = $npm . "_" . $syarat_8->getClientOriginalName() . "." . $ext_syarat_8;
                $syarat_8_path = 'mahasiswa/syarat08';
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $daftarSidang->syarat_8 = $nama_syarat_8;

                // upload syarat 
                $syarat_9 = $request->file('syarat_9');
                $ext_syarat_9 = $syarat_9->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_9 = $npm . "_" . $syarat_9->getClientOriginalName() . "." . $ext_syarat_9;
                $syarat_9_path = 'mahasiswa/syarat09';
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $daftarSidang->syarat_9 = $nama_syarat_9;

                // upload syarat 
                $syarat_10 = $request->file('syarat_10');
                $ext_syarat_10 = $syarat_10->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_10 = $npm . "_" . $syarat_10->getClientOriginalName() . "." . $ext_syarat_10;
                $syarat_10_path = 'mahasiswa/syarat10';
                $syarat_10->move($syarat_10_path, $nama_syarat_10);
                $daftarSidang->syarat_10 = $nama_syarat_10;

                // upload syarat 
                $syarat_11 = $request->file('syarat_11');
                $ext_syarat_11 = $syarat_11->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_11 = $npm . "_" . $syarat_11->getClientOriginalName() . "." . $ext_syarat_11;
                $syarat_11_path = 'mahasiswa/syarat11';
                $syarat_11->move($syarat_11_path, $nama_syarat_11);
                $daftarSidang->syarat_11 = $nama_syarat_11;

                // upload syarat 
                $syarat_12 = $request->file('syarat_12');
                $ext_syarat_12 = $syarat_12->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_12 = $npm . "_" . $syarat_12->getClientOriginalName() . "." . $ext_syarat_12;
                $syarat_12_path = 'mahasiswa/syarat12';
                $syarat_12->move($syarat_12_path, $nama_syarat_12);
                $daftarSidang->syarat_12 = $nama_syarat_12;

                // upload syarat 
                $syarat_13 = $request->file('syarat_13');
                $ext_syarat_13 = $syarat_13->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_13 = $npm . "_" . $syarat_13->getClientOriginalName() . "." . $ext_syarat_13;
                $syarat_13_path = 'mahasiswa/syarat13';
                $syarat_13->move($syarat_13_path, $nama_syarat_13);
                $daftarSidang->syarat_13 = $nama_syarat_13;

                // upload syarat 
                $syarat_14 = $request->file('syarat_14');
                $ext_syarat_14 = $syarat_14->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_14 = $npm . "_" . $syarat_14->getClientOriginalName() . "." . $ext_syarat_14;
                $syarat_14_path = 'mahasiswa/syarat14';
                $syarat_14->move($syarat_14_path, $nama_syarat_14);
                $daftarSidang->syarat_14 = $nama_syarat_14;

                // upload syarat 
                $syarat_15 = $request->file('syarat_15');
                $ext_syarat_15 = $syarat_15->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_15 = $npm . "_" . $syarat_15->getClientOriginalName() . "." . $ext_syarat_15;
                $syarat_15_path = 'mahasiswa/syarat15';
                $syarat_15->move($syarat_15_path, $nama_syarat_15);
                $daftarSidang->syarat_15 = $nama_syarat_15;

                $daftarSidang->save();

                return redirect()->back()->with('success_message', 'Sukses mengajukan pendaftaran sidang');
            }
        } elseif ($slug == 'Teknik Industri') {
            Session::put('page', 'daftar_sidang_ti');

            if ($request->isMethod('POST')) {
                $data = $request->all();

                $rules = [
                    'tahun_ajaran_id' => 'required',
                    // 'dosen1_id' => 'required',
                    // 'dosen2_id' => 'required',
                    'judul_skripsi' => 'required',
                    // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                    'syarat_1' => 'required|mimes:pdf',
                    'syarat_2' => 'required|mimes:pdf',
                    'syarat_3' => 'required|mimes:pdf',
                    'syarat_4' => 'required|mimes:pdf',
                    'syarat_5' => 'required|mimes:pdf',
                    'syarat_6' => 'required|mimes:pdf',
                    'syarat_7' => 'required|mimes:pdf',
                    'syarat_8' => 'required|mimes:pdf',
                    'syarat_9' => 'required|mimes:pdf',
                    'syarat_10' => 'required|mimes:pdf',
                    'syarat_11' => 'required|mimes:pdf',
                    'syarat_12' => 'required|mimes:pdf',
                    // 'syarat_13' => 'required|mimes:pdf',
                    // 'syarat_14' => 'required|mimes:pdf',
                    // 'syarat_15' => 'required|mimes:pdf',
                ];

                $customMessage = [
                    'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                    // 'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                    // 'dosen2_id.required' => 'Dosen Pembimbing 2 Tidak Boleh Kosong',
                    'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                    'syarat_1.required' => 'Syarat 1 Harus Diisi',
                    'syarat_2.required' => 'Syarat 2 Harus Diisi',
                    'syarat_3.required' => 'Syarat 3 Harus Diisi',
                    'syarat_4.required' => 'Syarat 4 Harus Diisi',
                    'syarat_5.required' => 'Syarat 5 Harus Diisi',
                    'syarat_6.required' => 'Syarat 6 Harus Diisi',
                    'syarat_7.required' => 'Syarat 7 Harus Diisi',
                    'syarat_8.required' => 'Syarat 8 Harus Diisi',
                    'syarat_9.required' => 'Syarat 9 Harus Diisi',
                    'syarat_10.required' => 'Syarat 10 Harus Diisi',
                    'syarat_11.required' => 'Syarat 11 Harus Diisi',
                    'syarat_12.required' => 'Syarat 12 Harus Diisi',
                    'syarat_13.required' => 'Syarat 13 Harus Diisi',
                    'syarat_14.required' => 'Syarat 14 Harus Diisi',
                    'syarat_15.required' => 'Syarat 15 Harus Diisi',
                    'syarat_1.mimes' => 'Format File Syarat 1 Harus PDF',
                    'syarat_2.mimes' => 'Format File Syarat 2 Harus PDF',
                    'syarat_3.mimes' => 'Format File Syarat 3 Harus PDF',
                    'syarat_4.mimes' => 'Format File Syarat 4 Harus PDF',
                    'syarat_5.mimes' => 'Format File Syarat 5 Harus PDF',
                    'syarat_6.mimes' => 'Format File Syarat 6 Harus PDF',
                    'syarat_7.mimes' => 'Format File Syarat 7 Harus PDF',
                    'syarat_8.mimes' => 'Format File Syarat 8 Harus PDF',
                    'syarat_9.mimes' => 'Format File Syarat 9 Harus PDF',
                    'syarat_10.mimes' => 'Format File Syarat 10 Harus PDF',
                    'syarat_11.mimes' => 'Format File Syarat 11 Harus PDF',
                    'syarat_12.mimes' => 'Format File Syarat 12 Harus PDF',
                    // 'syarat_13.mimes' => 'Format File Syarat 13 Harus PDF',
                    // 'syarat_14.mimes' => 'Format File Syarat 14 Harus PDF',
                    // 'syarat_15.mimes' => 'Format File Syarat 15 Harus PDF',
                ];

                $this->validate($request, $rules, $customMessage);

                $daftarSidang = new DaftarSidang;
                $daftarSidang->mahasiswa_id = Auth::guard('mahasiswa')->user()->id;
                $daftarSidang->program_studi = Auth::guard('mahasiswa')->user()->program_studi;
                $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
                $daftarSidang->dosen1_id = $request['dosen1_id'];
                $daftarSidang->dosen2_id = $request['dosen2_id'];
                $daftarSidang->judul_skripsi = $request['judul_skripsi'];
                $daftarSidang->tanggal_pengajuan = $request['tanggal_pengajuan'];

                // upload syarat 
                $syarat_1 = $request->file('syarat_1');
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSidang->syarat_1 = $nama_syarat_1;

                // upload syarat 2
                $syarat_2 = $request->file('syarat_2');
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSidang->syarat_2 = $nama_syarat_2;

                // upload syarat 3
                $syarat_3 = $request->file('syarat_3');
                $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
                $syarat_3_path = 'mahasiswa/syarat03';
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSidang->syarat_3 = $nama_syarat_3;

                // upload syarat 
                $syarat_4 = $request->file('syarat_4');
                $ext_syarat_4 = $syarat_4->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName() . "." . $ext_syarat_4;
                $syarat_4_path = 'mahasiswa/syarat04';
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSidang->syarat_4 = $nama_syarat_4;

                // upload syarat 
                $syarat_5 = $request->file('syarat_5');
                $ext_syarat_5 = $syarat_5->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName() . "." . $ext_syarat_5;
                $syarat_5_path = 'mahasiswa/syarat05';
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSidang->syarat_5 = $nama_syarat_5;

                // upload syarat 
                $syarat_6 = $request->file('syarat_6');
                $ext_syarat_6 = $syarat_6->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName() . "." . $ext_syarat_6;
                $syarat_6_path = 'mahasiswa/syarat06';
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSidang->syarat_6 = $nama_syarat_6;

                // upload syarat 
                $syarat_7 = $request->file('syarat_7');
                $ext_syarat_7 = $syarat_7->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_7 = $npm . "_" . $syarat_7->getClientOriginalName() . "." . $ext_syarat_7;
                $syarat_7_path = 'mahasiswa/syarat07';
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSidang->syarat_7 = $nama_syarat_7;

                // upload syarat 
                $syarat_8 = $request->file('syarat_8');
                $ext_syarat_8 = $syarat_8->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_8 = $npm . "_" . $syarat_8->getClientOriginalName() . "." . $ext_syarat_8;
                $syarat_8_path = 'mahasiswa/syarat08';
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $daftarSidang->syarat_8 = $nama_syarat_8;

                // upload syarat 
                $syarat_9 = $request->file('syarat_9');
                $ext_syarat_9 = $syarat_9->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_9 = $npm . "_" . $syarat_9->getClientOriginalName() . "." . $ext_syarat_9;
                $syarat_9_path = 'mahasiswa/syarat09';
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $daftarSidang->syarat_9 = $nama_syarat_9;

                // upload syarat 
                $syarat_10 = $request->file('syarat_10');
                $ext_syarat_10 = $syarat_10->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_10 = $npm . "_" . $syarat_10->getClientOriginalName() . "." . $ext_syarat_10;
                $syarat_10_path = 'mahasiswa/syarat10';
                $syarat_10->move($syarat_10_path, $nama_syarat_10);
                $daftarSidang->syarat_10 = $nama_syarat_10;

                // upload syarat 
                $syarat_11 = $request->file('syarat_11');
                $ext_syarat_11 = $syarat_11->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_11 = $npm . "_" . $syarat_11->getClientOriginalName() . "." . $ext_syarat_11;
                $syarat_11_path = 'mahasiswa/syarat11';
                $syarat_11->move($syarat_11_path, $nama_syarat_11);
                $daftarSidang->syarat_11 = $nama_syarat_11;

                // upload syarat 
                $syarat_12 = $request->file('syarat_12');
                $ext_syarat_12 = $syarat_12->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_12 = $npm . "_" . $syarat_12->getClientOriginalName() . "." . $ext_syarat_12;
                $syarat_12_path = 'mahasiswa/syarat12';
                $syarat_12->move($syarat_12_path, $nama_syarat_12);
                $daftarSidang->syarat_12 = $nama_syarat_12;

                // // upload syarat 
                // $syarat_13 = $request->file('syarat_13');
                // $ext_syarat_13 = $syarat_13->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_13 = $npm . "_" . $syarat_13->getClientOriginalName() . "." . $ext_syarat_13;
                // $syarat_13_path = 'mahasiswa/syarat13';
                // $syarat_13->move($syarat_13_path, $nama_syarat_13);
                // $daftarSidang->syarat_13 = $nama_syarat_13;

                // // upload syarat 
                // $syarat_14 = $request->file('syarat_14');
                // $ext_syarat_14 = $syarat_14->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_14 = $npm . "_" . $syarat_14->getClientOriginalName() . "." . $ext_syarat_14;
                // $syarat_14_path = 'mahasiswa/syarat14';
                // $syarat_14->move($syarat_14_path, $nama_syarat_14);
                // $daftarSidang->syarat_14 = $nama_syarat_14;

                // // upload syarat 
                // $syarat_15 = $request->file('syarat_15');
                // $ext_syarat_15 = $syarat_15->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_15 = $npm . "_" . $syarat_15->getClientOriginalName() . "." . $ext_syarat_15;
                // $syarat_15_path = 'mahasiswa/syarat15';
                // $syarat_15->move($syarat_15_path, $nama_syarat_15);
                // $daftarSidang->syarat_15 = $nama_syarat_15;

                $daftarSidang->save();

                return redirect()->back()->with('success_message', 'Sukses mengajukan pendaftaran sidang');
            }
        } elseif ($slug == 'Perencanaan Wilayah dan Kota') {
            Session::put('page', 'daftar_sidang_pwk');

            if ($request->isMethod('POST')) {
                $data = $request->all();

                $rules = [
                    'tahun_ajaran_id' => 'required',
                    // 'dosen1_id' => 'required',
                    // 'dosen2_id' => 'required',
                    'judul_skripsi' => 'required',
                    // 'tanggal_pengajuan' => 'required|date_format:m/d/Y',
                    'syarat_1' => 'required|mimes:pdf',
                    'syarat_2' => 'required|mimes:pdf',
                    'syarat_3' => 'required|mimes:pdf',
                    'syarat_4' => 'required|mimes:pdf',
                    'syarat_5' => 'required|mimes:pdf',
                    'syarat_6' => 'required|mimes:pdf',
                    'syarat_7' => 'required|mimes:pdf',
                    'syarat_8' => 'required|mimes:pdf',
                    'syarat_9' => 'required|mimes:pdf',
                    'syarat_10' => 'required|mimes:pdf',
                    // 'syarat_11' => 'required|mimes:pdf',
                    // 'syarat_12' => 'required|mimes:pdf',
                    // 'syarat_13' => 'required|mimes:pdf',
                    // 'syarat_14' => 'required|mimes:pdf',
                    // 'syarat_15' => 'required|mimes:pdf',
                ];

                $customMessage = [
                    'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                    // 'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                    // 'dosen2_id.required' => 'Dosen Pembimbing 2 Tidak Boleh Kosong',
                    'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                    'syarat_1.required' => 'Syarat 1 Harus Diisi',
                    'syarat_2.required' => 'Syarat 2 Harus Diisi',
                    'syarat_3.required' => 'Syarat 3 Harus Diisi',
                    'syarat_4.required' => 'Syarat 4 Harus Diisi',
                    'syarat_5.required' => 'Syarat 5 Harus Diisi',
                    'syarat_6.required' => 'Syarat 6 Harus Diisi',
                    'syarat_7.required' => 'Syarat 7 Harus Diisi',
                    'syarat_8.required' => 'Syarat 8 Harus Diisi',
                    'syarat_9.required' => 'Syarat 9 Harus Diisi',
                    'syarat_10.required' => 'Syarat 10 Harus Diisi',
                    'syarat_11.required' => 'Syarat 11 Harus Diisi',
                    'syarat_12.required' => 'Syarat 12 Harus Diisi',
                    'syarat_13.required' => 'Syarat 13 Harus Diisi',
                    'syarat_14.required' => 'Syarat 14 Harus Diisi',
                    'syarat_15.required' => 'Syarat 15 Harus Diisi',
                    'syarat_1.mimes' => 'Format File Syarat 1 Harus PDF',
                    'syarat_2.mimes' => 'Format File Syarat 2 Harus PDF',
                    'syarat_3.mimes' => 'Format File Syarat 3 Harus PDF',
                    'syarat_4.mimes' => 'Format File Syarat 4 Harus PDF',
                    'syarat_5.mimes' => 'Format File Syarat 5 Harus PDF',
                    'syarat_6.mimes' => 'Format File Syarat 6 Harus PDF',
                    'syarat_7.mimes' => 'Format File Syarat 7 Harus PDF',
                    'syarat_8.mimes' => 'Format File Syarat 8 Harus PDF',
                    'syarat_9.mimes' => 'Format File Syarat 9 Harus PDF',
                    'syarat_10.mimes' => 'Format File Syarat 10 Harus PDF',
                    // 'syarat_11.mimes' => 'Format File Syarat 11 Harus PDF',
                    // 'syarat_12.mimes' => 'Format File Syarat 12 Harus PDF',
                    // 'syarat_13.mimes' => 'Format File Syarat 13 Harus PDF',
                    // 'syarat_14.mimes' => 'Format File Syarat 14 Harus PDF',
                    // 'syarat_15.mimes' => 'Format File Syarat 15 Harus PDF',
                ];

                $this->validate($request, $rules, $customMessage);

                $daftarSidang = new DaftarSidang;
                $daftarSidang->mahasiswa_id = Auth::guard('mahasiswa')->user()->id;
                $daftarSidang->program_studi = Auth::guard('mahasiswa')->user()->program_studi;
                $daftarSidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
                $daftarSidang->dosen1_id = $request['dosen1_id'];
                $daftarSidang->dosen2_id = $request['dosen2_id'];
                $daftarSidang->judul_skripsi = $request['judul_skripsi'];
                $daftarSidang->tanggal_pengajuan = $request['tanggal_pengajuan'];

                // upload syarat 
                $syarat_1 = $request->file('syarat_1');
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSidang->syarat_1 = $nama_syarat_1;

                // upload syarat 2
                $syarat_2 = $request->file('syarat_2');
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSidang->syarat_2 = $nama_syarat_2;

                // upload syarat 3
                $syarat_3 = $request->file('syarat_3');
                $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
                $syarat_3_path = 'mahasiswa/syarat03';
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSidang->syarat_3 = $nama_syarat_3;

                // upload syarat 
                $syarat_4 = $request->file('syarat_4');
                $ext_syarat_4 = $syarat_4->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName() . "." . $ext_syarat_4;
                $syarat_4_path = 'mahasiswa/syarat04';
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSidang->syarat_4 = $nama_syarat_4;

                // upload syarat 
                $syarat_5 = $request->file('syarat_5');
                $ext_syarat_5 = $syarat_5->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName() . "." . $ext_syarat_5;
                $syarat_5_path = 'mahasiswa/syarat05';
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSidang->syarat_5 = $nama_syarat_5;

                // upload syarat 
                $syarat_6 = $request->file('syarat_6');
                $ext_syarat_6 = $syarat_6->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName() . "." . $ext_syarat_6;
                $syarat_6_path = 'mahasiswa/syarat06';
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSidang->syarat_6 = $nama_syarat_6;

                // upload syarat 
                $syarat_7 = $request->file('syarat_7');
                $ext_syarat_7 = $syarat_7->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_7 = $npm . "_" . $syarat_7->getClientOriginalName() . "." . $ext_syarat_7;
                $syarat_7_path = 'mahasiswa/syarat07';
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSidang->syarat_7 = $nama_syarat_7;

                // upload syarat 
                $syarat_8 = $request->file('syarat_8');
                $ext_syarat_8 = $syarat_8->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_8 = $npm . "_" . $syarat_8->getClientOriginalName() . "." . $ext_syarat_8;
                $syarat_8_path = 'mahasiswa/syarat08';
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $daftarSidang->syarat_8 = $nama_syarat_8;

                // upload syarat 
                $syarat_9 = $request->file('syarat_9');
                $ext_syarat_9 = $syarat_9->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_9 = $npm . "_" . $syarat_9->getClientOriginalName() . "." . $ext_syarat_9;
                $syarat_9_path = 'mahasiswa/syarat09';
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $daftarSidang->syarat_9 = $nama_syarat_9;

                // upload syarat 
                $syarat_10 = $request->file('syarat_10');
                $ext_syarat_10 = $syarat_10->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_10 = $npm . "_" . $syarat_10->getClientOriginalName() . "." . $ext_syarat_10;
                $syarat_10_path = 'mahasiswa/syarat10';
                $syarat_10->move($syarat_10_path, $nama_syarat_10);
                $daftarSidang->syarat_10 = $nama_syarat_10;

                // upload syarat 
                // $syarat_11 = $request->file('syarat_11');
                // $ext_syarat_11 = $syarat_11->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_11 = $npm . "_" . $syarat_11->getClientOriginalName() . "." . $ext_syarat_11;
                // $syarat_11_path = 'mahasiswa/syarat11';
                // $syarat_11->move($syarat_11_path, $nama_syarat_11);
                // $daftarSidang->syarat_11 = $nama_syarat_11;

                // // upload syarat 
                // $syarat_12 = $request->file('syarat_12');
                // $ext_syarat_12 = $syarat_12->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_12 = $npm . "_" . $syarat_12->getClientOriginalName() . "." . $ext_syarat_12;
                // $syarat_12_path = 'mahasiswa/syarat12';
                // $syarat_12->move($syarat_12_path, $nama_syarat_12);
                // $daftarSidang->syarat_12 = $nama_syarat_12;

                // // upload syarat 
                // $syarat_13 = $request->file('syarat_13');
                // $ext_syarat_13 = $syarat_13->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_13 = $npm . "_" . $syarat_13->getClientOriginalName() . "." . $ext_syarat_13;
                // $syarat_13_path = 'mahasiswa/syarat13';
                // $syarat_13->move($syarat_13_path, $nama_syarat_13);
                // $daftarSidang->syarat_13 = $nama_syarat_13;

                // // upload syarat 
                // $syarat_14 = $request->file('syarat_14');
                // $ext_syarat_14 = $syarat_14->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_14 = $npm . "_" . $syarat_14->getClientOriginalName() . "." . $ext_syarat_14;
                // $syarat_14_path = 'mahasiswa/syarat14';
                // $syarat_14->move($syarat_14_path, $nama_syarat_14);
                // $daftarSidang->syarat_14 = $nama_syarat_14;

                // // upload syarat 
                // $syarat_15 = $request->file('syarat_15');
                // $ext_syarat_15 = $syarat_15->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_15 = $npm . "_" . $syarat_15->getClientOriginalName() . "." . $ext_syarat_15;
                // $syarat_15_path = 'mahasiswa/syarat15';
                // $syarat_15->move($syarat_15_path, $nama_syarat_15);
                // $daftarSidang->syarat_15 = $nama_syarat_15;

                $daftarSidang->save();

                return redirect()->back()->with('success_message', 'Sukses mengajukan pendaftaran sidang');
            }
        } elseif ($slug == 'Program Profesi Insinyur') {
            Session::put('page', 'daftar_sidang_psppi');

            if ($request->isMethod('POST')) {
                $data = $request->all();
            }
        } elseif ($slug == 'Magister Perencanaan Wilayah dan Kota') {
            Session::put('page', 'daftar_sidang_mpwk');

            if ($request->isMethod('POST')) {
                $data = $request->all();
            }
        }

        $tahunAjaran = TahunAjaran::get();
        $dosen1 = Dosen::get()->toArray();
        $daftarSidang = DaftarSidang::where('mahasiswa_id', Auth::guard('mahasiswa')->user()->id)->first();
        // dd($daftarSidang);

        return view('mahasiswa.daftar_sidang', compact('slug', 'tahunAjaran', 'dosen1', 'daftarSidang'));
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
                'program_studi' => 'required',
                'angkatan' => 'required',
                'foto' => 'mimes:jpg,jpeg,png,',
                // 'email' => 'email',
            ];

            $customMessage = [
                'npm.required' => 'NIK Tidak Boleh Kosong',
                'npm.unique' => 'NPM Sudah Terdaftar',
                'nama.required' => 'Nama Tidak Boleh Kosong',
                'program_studi.required' => 'Program Studi Tidak Boleh Kosong',
                'angkatan.required' => 'Angkatan Tidak Boleh Kosong',
                'foto.mimes' => 'Format Foto Dosen harus JPEG, JPG, PNG',
                // 'email.email' => 'Format Email Harus Benar',
            ];

            $this->validate($request, $rules, $customMessage);

            $mahasiswa->npm = $data['npm'];
            $mahasiswa->nama = $data['nama'];
            $mahasiswa->password = Hash::make($mahasiswa->npm);
            $mahasiswa->email = $data['email'];
            $mahasiswa->telepon = $data['telepon'];
            $mahasiswa->program_studi = $data['program_studi'];
            $mahasiswa->angkatan = $data['angkatan'];
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
