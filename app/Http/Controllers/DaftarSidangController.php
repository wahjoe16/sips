<?php

namespace App\Http\Controllers;

use App\Models\DaftarSidang;
use App\Models\Dosen;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DaftarSidangController extends Controller
{
    // fungsi daftar sidang untuk mahasiswa
    public function daftarSidang($slug, Request $request)
    {
        if ($slug == 'Teknik Pertambangan') {
            Session::put('page', 'daftar_sidang_tambang');
            $dosen = Dosen::where('program_studi', 'Teknik Pertambangan')->get()->toArray();

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
                ];

                $customMessage = [
                    'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                    // 'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                    // 'dosen2_id.required' => 'Dosen Pembimbing 2 Tidak Boleh Kosong',
                    'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                    'syarat_1.required' => 'Transkrip Nilai Harus Diisi',
                    'syarat_2.required' => 'Sertifikat Pesantren Calon Sarjana Harus Diisi',
                    'syarat_1.mimes' => 'Format File Transkrip Nilai Harus PDF',
                    'syarat_2.mimes' => 'Format File Sertifikat Pesantren Calon Sarjana Harus PDF',
                ];

                $this->validate($request, $rules, $customMessage);

                $sidang = new DaftarSidang();
                $sidang->mahasiswa_id = Auth::guard('mahasiswa')->user()->id;
                $sidang->program_studi = Auth::guard('mahasiswa')->user()->program_studi;
                $sidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
                $sidang->dosen1_id = $request['dosen1_id'];
                $sidang->dosen2_id = $request['dosen2_id'];
                $sidang->judul_skripsi = $request['judul_skripsi'];

                // upload syarat 
                $syarat_1 = $request->file('syarat_1');
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $sidang->syarat_1 = $nama_syarat_1;

                // upload syarat 2
                $syarat_2 = $request->file('syarat_2');
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $sidang->syarat_2 = $nama_syarat_2;

                $sidang->save();

                return redirect()->back()->with('success_message', 'Sukses mengajukan pendaftaran sidang');
            }
        } elseif ($slug == 'Teknik Industri') {
            Session::put('page', 'daftar_sidang_ti');
            $dosen = Dosen::where('program_studi', 'Teknik Industri')->get()->toArray();

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

                $sidang = new DaftarSidang();
                $sidang->mahasiswa_id = Auth::guard('mahasiswa')->user()->id;
                $sidang->program_studi = Auth::guard('mahasiswa')->user()->program_studi;
                $sidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
                $sidang->dosen1_id = $request['dosen1_id'];
                $sidang->dosen2_id = $request['dosen2_id'];
                $sidang->judul_skripsi = $request['judul_skripsi'];
                $sidang->tanggal_pengajuan = $request['tanggal_pengajuan'];

                // upload syarat 
                $syarat_1 = $request->file('syarat_1');
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $sidang->syarat_1 = $nama_syarat_1;

                // upload syarat 2
                $syarat_2 = $request->file('syarat_2');
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $sidang->syarat_2 = $nama_syarat_2;

                // upload syarat 3
                $syarat_3 = $request->file('syarat_3');
                $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
                $syarat_3_path = 'mahasiswa/syarat03';
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $sidang->syarat_3 = $nama_syarat_3;

                // upload syarat 
                $syarat_4 = $request->file('syarat_4');
                $ext_syarat_4 = $syarat_4->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName() . "." . $ext_syarat_4;
                $syarat_4_path = 'mahasiswa/syarat04';
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $sidang->syarat_4 = $nama_syarat_4;

                // upload syarat 
                $syarat_5 = $request->file('syarat_5');
                $ext_syarat_5 = $syarat_5->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName() . "." . $ext_syarat_5;
                $syarat_5_path = 'mahasiswa/syarat05';
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $sidang->syarat_5 = $nama_syarat_5;

                // upload syarat 
                $syarat_6 = $request->file('syarat_6');
                $ext_syarat_6 = $syarat_6->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName() . "." . $ext_syarat_6;
                $syarat_6_path = 'mahasiswa/syarat06';
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $sidang->syarat_6 = $nama_syarat_6;

                // upload syarat 
                $syarat_7 = $request->file('syarat_7');
                $ext_syarat_7 = $syarat_7->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_7 = $npm . "_" . $syarat_7->getClientOriginalName() . "." . $ext_syarat_7;
                $syarat_7_path = 'mahasiswa/syarat07';
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $sidang->syarat_7 = $nama_syarat_7;

                // upload syarat 
                $syarat_8 = $request->file('syarat_8');
                $ext_syarat_8 = $syarat_8->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_8 = $npm . "_" . $syarat_8->getClientOriginalName() . "." . $ext_syarat_8;
                $syarat_8_path = 'mahasiswa/syarat08';
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $sidang->syarat_8 = $nama_syarat_8;

                // upload syarat 
                $syarat_9 = $request->file('syarat_9');
                $ext_syarat_9 = $syarat_9->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_9 = $npm . "_" . $syarat_9->getClientOriginalName() . "." . $ext_syarat_9;
                $syarat_9_path = 'mahasiswa/syarat09';
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $sidang->syarat_9 = $nama_syarat_9;

                // upload syarat 
                $syarat_10 = $request->file('syarat_10');
                $ext_syarat_10 = $syarat_10->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_10 = $npm . "_" . $syarat_10->getClientOriginalName() . "." . $ext_syarat_10;
                $syarat_10_path = 'mahasiswa/syarat10';
                $syarat_10->move($syarat_10_path, $nama_syarat_10);
                $sidang->syarat_10 = $nama_syarat_10;

                // upload syarat 
                $syarat_11 = $request->file('syarat_11');
                $ext_syarat_11 = $syarat_11->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_11 = $npm . "_" . $syarat_11->getClientOriginalName() . "." . $ext_syarat_11;
                $syarat_11_path = 'mahasiswa/syarat11';
                $syarat_11->move($syarat_11_path, $nama_syarat_11);
                $sidang->syarat_11 = $nama_syarat_11;

                // upload syarat 
                $syarat_12 = $request->file('syarat_12');
                $ext_syarat_12 = $syarat_12->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_12 = $npm . "_" . $syarat_12->getClientOriginalName() . "." . $ext_syarat_12;
                $syarat_12_path = 'mahasiswa/syarat12';
                $syarat_12->move($syarat_12_path, $nama_syarat_12);
                $sidang->syarat_12 = $nama_syarat_12;

                // // upload syarat 
                // $syarat_13 = $request->file('syarat_13');
                // $ext_syarat_13 = $syarat_13->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_13 = $npm . "_" . $syarat_13->getClientOriginalName() . "." . $ext_syarat_13;
                // $syarat_13_path = 'mahasiswa/syarat13';
                // $syarat_13->move($syarat_13_path, $nama_syarat_13);
                // $sidang->syarat_13 = $nama_syarat_13;

                // // upload syarat 
                // $syarat_14 = $request->file('syarat_14');
                // $ext_syarat_14 = $syarat_14->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_14 = $npm . "_" . $syarat_14->getClientOriginalName() . "." . $ext_syarat_14;
                // $syarat_14_path = 'mahasiswa/syarat14';
                // $syarat_14->move($syarat_14_path, $nama_syarat_14);
                // $sidang->syarat_14 = $nama_syarat_14;

                // // upload syarat 
                // $syarat_15 = $request->file('syarat_15');
                // $ext_syarat_15 = $syarat_15->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_15 = $npm . "_" . $syarat_15->getClientOriginalName() . "." . $ext_syarat_15;
                // $syarat_15_path = 'mahasiswa/syarat15';
                // $syarat_15->move($syarat_15_path, $nama_syarat_15);
                // $sidang->syarat_15 = $nama_syarat_15;

                $sidang->save();

                return redirect()->back()->with('success_message', 'Sukses mengajukan pendaftaran sidang');
            }
        } elseif ($slug == 'Perencanaan Wilayah dan Kota') {
            Session::put('page', 'daftar_sidang_pwk');
            $dosen = Dosen::where('program_studi', 'Perencanaan Wilayah dan Kota')->get()->toArray();

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
                ];

                $customMessage = [
                    'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                    // 'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                    // 'dosen2_id.required' => 'Dosen Pembimbing 2 Tidak Boleh Kosong',
                    'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                    'syarat_1.required' => 'Bukti pembayaran sidang terbuka Harus Diisi',
                    'syarat_2.required' => 'Hasil pemeriksaan resmi turnitin Harus Diisi',
                    'syarat_3.required' => 'Transkip nilai Harus Diisi',

                    'syarat_1.mimes' => 'Format File Bukti pembayaran sidang terbuka Harus PDF',
                    'syarat_2.mimes' => 'Format File Hasil pemeriksaan resmi turnitin Harus PDF',
                    'syarat_3.mimes' => 'Format File Transkip nilai Harus PDF',

                ];

                $this->validate($request, $rules, $customMessage);

                $sidang = new DaftarSidang();
                $sidang->mahasiswa_id = Auth::guard('mahasiswa')->user()->id;
                $sidang->program_studi = Auth::guard('mahasiswa')->user()->program_studi;
                $sidang->tahun_ajaran_id = $request['tahun_ajaran_id'];
                $sidang->dosen1_id = $request['dosen1_id'];
                $sidang->dosen2_id = $request['dosen2_id'];
                $sidang->judul_skripsi = $request['judul_skripsi'];
                $sidang->tanggal_pengajuan = $request['tanggal_pengajuan'];

                // upload syarat 
                $syarat_1 = $request->file('syarat_1');
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/sidang/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $sidang->syarat_1 = $nama_syarat_1;

                // upload syarat 2
                $syarat_2 = $request->file('syarat_2');
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/sidang/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $sidang->syarat_2 = $nama_syarat_2;

                // upload syarat 3
                $syarat_3 = $request->file('syarat_3');
                $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
                $syarat_3_path = 'mahasiswa/sidang/syarat03';
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $sidang->syarat_3 = $nama_syarat_3;

                $sidang->save();

                return redirect()->back()->with('success_message', 'Sukses mengajukan pendaftaran sidang');
            }
        }

        $tahunAjaran = TahunAjaran::get();
        $daftarSidang = DaftarSidang::where('mahasiswa_id', Auth::guard('mahasiswa')->user()->id)->first();
        // dd($daftarSidang);

        return view('mahasiswa.daftar_sidang', compact('slug', 'tahunAjaran', 'dosen', 'daftarSidang', 'sidang'));
    }

    // fungsi lihat daftar sidang untuk dosen
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

    // fungsi show dan approval sidang untuk dosen
    public function showDaftarSidang(Request $request, $id)
    {
        $sidang = DaftarSidang::find($id);
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
            return redirect()->route('viewDaftarSidang', [
                'slug' => 'Perencanaan Wilayah dan Kota',
                'slug' => 'Teknik Industri',
                'slug' => 'Teknik Pertambangan'
            ])->with('success_message', 'Status Approval berhasil ditambahkan');
        }

        return view('dosen.show_daftar_sidang', compact('sidang'));
    }

    public function index($slug)
    {
        Session::put('page', 'rekapDaftarSidang');
        $tahun_ajaran = TahunAjaran::with('semesterx')->get();

        return view('dosen.rekap_daftar_sidang', compact('tahun_ajaran', 'slug'));
    }

    public function data($slug)
    {
        if ($slug == 'Teknik Pertambangan') {
            $rekapSidang = DaftarSidang::select('daftar_sidang.*', 'mahasiswa.npm', 'mahasiswa.nama', 'mahasiswa.program_studi', 'tahun_ajaran.tahun_ajaran')
                ->leftJoin('mahasiswa', 'mahasiswa.id', 'daftar_sidang.mahasiswa_id')
                ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
                ->where([
                    'status' => 1,
                    // 'program_studi' => 'Teknik Pertambangan'
                ])->orderBy('id', 'asc')->get();
        } elseif ($slug == 'Teknik Industri') {
            $rekapSidang = DaftarSidang::select('daftar_sidang.*', 'mahasiswa.npm', 'mahasiswa.nama', 'mahasiswa.program_studi', 'tahun_ajaran.tahun_ajaran')
                ->leftJoin('mahasiswa', 'mahasiswa.id', 'daftar_sidang.mahasiswa_id')
                ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
                ->where([
                    'status' => 1,
                    // 'program_studi' => 'Teknik Industri'
                ])->orderBy('id', 'asc')->get();
        } elseif ($slug == 'Perencanaan Wilayah dan Kota') {
            $rekapSidang = DaftarSidang::select('daftar_sidang.*', 'mahasiswa.npm', 'mahasiswa.nama', 'mahasiswa.program_studi', 'tahun_ajaran.tahun_ajaran')
                ->leftJoin('mahasiswa', 'mahasiswa.id', 'daftar_sidang.mahasiswa_id')
                ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_sidang.tahun_ajaran_id')
                ->where([
                    'status' => 1,
                    // 'program_studi' => 'Perencanaan Wilayah dan Kota'
                ])->orderBy('id', 'asc')->get();
        }

        return datatables()
            ->of($rekapSidang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($rekapSidang) {
                return '<div class="btn-group">
                                <button onclick="showRekapSidang(`' . route('showRekapSidang', $rekapSidang->id) . '`)" class="btn btn-info"><i class="mdi mdi-file-find" style="font-size: 15px;"></i></button>
                            </div>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
