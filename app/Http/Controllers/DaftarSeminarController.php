<?php

namespace App\Http\Controllers;

use App\Models\DaftarSeminar;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DaftarSeminarController extends Controller
{
    // fungsi pendaftaran seminar untuk mahasiswa
    public function daftarSeminar($slug, Request $request)
    {
        if ($slug == 'Teknik Pertambangan') {
            Session::put('page', 'daftar_seminar_tambang');
            $title = "Daftar Kolokium Skripsi";
            $daftarSeminar = new DaftarSeminar();

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
                    'syarat_14' => 'required|mimes:docx,doc',
                ];

                $customMessage = [
                    'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                    // 'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                    // 'dosen2_id.required' => 'Dosen Pembimbing 2 Tidak Boleh Kosong',
                    'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                    'syarat_1.required' => 'Bukti pembayaran kolokium skripsi harus diisi',
                    'syarat_2.required' => 'Sertifikat TOEFL harus diisi',
                    'syarat_3.required' => 'Formulir nilai bimbingan skripsi harus diisi',
                    'syarat_4.required' => 'Formulir kemajuan bimbingan skripsi harus diisi',
                    'syarat_5.required' => 'Formulir persetujuan kolokium skripsi harus diisi',
                    'syarat_6.required' => 'Formulir kesediaan menghadiri kolokium skripsi harus diisi',
                    'syarat_7.required' => 'Pas foto ukuran 4 x 6 sebanyak 2 lembar harus diisi',
                    'syarat_8.required' => 'Kartu Tanda Mahasiswa harus diisi',
                    'syarat_9.required' => 'Bukti pembayaran kuliah harus diisi',
                    'syarat_10.required' => 'Bukti perwalian harus diisi',
                    'syarat_11.required' => 'Bukti bebas pinjaman perpustakaan harus diisi',
                    'syarat_12.required' => 'Keterangan menghadiri kolokium skripsi (7 kali) harus diisi',
                    'syarat_13.required' => 'Draft skripsi (PDF) Harus Diisi',
                    'syarat_14.required' => 'Draft skripsi (DOCX) Harus Diisi',
                    'syarat_1.mimes' => 'Format File Bukti pembayaran Kolokium Skripsi harus PDF',
                    'syarat_2.mimes' => 'Format File Sertifikat TOEFL harus PDF',
                    'syarat_3.mimes' => 'Format File Formulir nilai bimbingan skripsi harus PDF',
                    'syarat_4.mimes' => 'Format File Formulir kemajuan bimbingan skripsi harus PDF',
                    'syarat_5.mimes' => 'Format File Formulir persetujuan kolokium skripsi harus PDF',
                    'syarat_6.mimes' => 'Format File Formulir kesediaan menghadiri kolokium skripsi harus PDF',
                    'syarat_7.mimes' => 'Format File Pas foto ukuran 4 x 6 sebanyak 2 lembar harus PDF',
                    'syarat_8.mimes' => 'Format File Kartu Tanda Mahasiswa harus PDF',
                    'syarat_9.mimes' => 'Format File Bukti pembayaran kuliah harus PDF',
                    'syarat_10.mimes' => 'Format File Bukti perwalian harus PDF',
                    'syarat_11.mimes' => 'Format File Bukti bebas pinjaman perpustakaan harus PDF',
                    'syarat_12.mimes' => 'Format File Keterangan menghadiri kolokium skripsi (7 kali) harus PDF',
                    'syarat_13.mimes' => 'Format File Draft skripsi Harus PDF',
                    'syarat_14.mimes' => 'Format File Draft skripsi Harus DOCX',
                ];

                $this->validate($request, $rules, $customMessage);

                $daftarSeminar = new DaftarSeminar();
                $daftarSeminar->mahasiswa_id = Auth::guard('mahasiswa')->user()->id;
                $daftarSeminar->program_studi = Auth::guard('mahasiswa')->user()->program_studi;
                $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
                $daftarSeminar->dosen1_id = $request['dosen1_id'];
                $daftarSeminar->dosen2_id = $request['dosen2_id'];
                $daftarSeminar->judul_skripsi = $request['judul_skripsi'];

                // upload syarat 
                $syarat_1 = $request->file('syarat_1');
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/seminar/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSeminar->syarat_1 = $nama_syarat_1;

                // upload syarat 2
                $syarat_2 = $request->file('syarat_2');
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/seminar/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSeminar->syarat_2 = $nama_syarat_2;

                // upload syarat 3
                $syarat_3 = $request->file('syarat_3');
                $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
                $syarat_3_path = 'mahasiswa/seminar/syarat03';
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSeminar->syarat_3 = $nama_syarat_3;

                // upload syarat 
                $syarat_4 = $request->file('syarat_4');
                $ext_syarat_4 = $syarat_4->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName() . "." . $ext_syarat_4;
                $syarat_4_path = 'mahasiswa/seminar/syarat04';
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSeminar->syarat_4 = $nama_syarat_4;

                // upload syarat 
                $syarat_5 = $request->file('syarat_5');
                $ext_syarat_5 = $syarat_5->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName() . "." . $ext_syarat_5;
                $syarat_5_path = 'mahasiswa/seminar/syarat05';
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSeminar->syarat_5 = $nama_syarat_5;

                // upload syarat 
                $syarat_6 = $request->file('syarat_6');
                $ext_syarat_6 = $syarat_6->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName() . "." . $ext_syarat_6;
                $syarat_6_path = 'mahasiswa/seminar/syarat06';
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSeminar->syarat_6 = $nama_syarat_6;

                // upload syarat 
                $syarat_7 = $request->file('syarat_7');
                $ext_syarat_7 = $syarat_7->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_7 = $npm . "_" . $syarat_7->getClientOriginalName() . "." . $ext_syarat_7;
                $syarat_7_path = 'mahasiswa/seminar/syarat07';
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSeminar->syarat_7 = $nama_syarat_7;

                // upload syarat 
                $syarat_8 = $request->file('syarat_8');
                $ext_syarat_8 = $syarat_8->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_8 = $npm . "_" . $syarat_8->getClientOriginalName() . "." . $ext_syarat_8;
                $syarat_8_path = 'mahasiswa/seminar/syarat08';
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $daftarSeminar->syarat_8 = $nama_syarat_8;

                // upload syarat 
                $syarat_9 = $request->file('syarat_9');
                $ext_syarat_9 = $syarat_9->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_9 = $npm . "_" . $syarat_9->getClientOriginalName() . "." . $ext_syarat_9;
                $syarat_9_path = 'mahasiswa/seminar/syarat09';
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $daftarSeminar->syarat_9 = $nama_syarat_9;

                // upload syarat 
                $syarat_10 = $request->file('syarat_10');
                $ext_syarat_10 = $syarat_10->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_10 = $npm . "_" . $syarat_10->getClientOriginalName() . "." . $ext_syarat_10;
                $syarat_10_path = 'mahasiswa/seminar/syarat10';
                $syarat_10->move($syarat_10_path, $nama_syarat_10);
                $daftarSeminar->syarat_10 = $nama_syarat_10;

                // upload syarat 
                $syarat_11 = $request->file('syarat_11');
                $ext_syarat_11 = $syarat_11->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_11 = $npm . "_" . $syarat_11->getClientOriginalName() . "." . $ext_syarat_11;
                $syarat_11_path = 'mahasiswa/seminar/syarat11';
                $syarat_11->move($syarat_11_path, $nama_syarat_11);
                $daftarSeminar->syarat_11 = $nama_syarat_11;

                // upload syarat 
                $syarat_12 = $request->file('syarat_12');
                $ext_syarat_12 = $syarat_12->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_12 = $npm . "_" . $syarat_12->getClientOriginalName() . "." . $ext_syarat_12;
                $syarat_12_path = 'mahasiswa/seminar/syarat12';
                $syarat_12->move($syarat_12_path, $nama_syarat_12);
                $daftarSeminar->syarat_12 = $nama_syarat_12;

                // upload syarat 
                $syarat_13 = $request->file('syarat_13');
                $ext_syarat_13 = $syarat_13->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_13 = $npm . "_" . $syarat_13->getClientOriginalName() . "." . $ext_syarat_13;
                $syarat_13_path = 'mahasiswa/seminar/syarat13';
                $syarat_13->move($syarat_13_path, $nama_syarat_13);
                $daftarSeminar->syarat_13 = $nama_syarat_13;

                // upload syarat 
                $syarat_14 = $request->file('syarat_14');
                $ext_syarat_14 = $syarat_14->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_14 = $npm . "_" . $syarat_14->getClientOriginalName() . "." . $ext_syarat_14;
                $syarat_14_path = 'mahasiswa/seminar/syarat14';
                $syarat_14->move($syarat_14_path, $nama_syarat_14);
                $daftarSeminar->syarat_14 = $nama_syarat_14;

                $daftarSeminar->save();

                return redirect()->back()->with('success_message', 'Sukses mengajukan pendaftaran sidang');
            }
        } elseif ($slug == 'Teknik Industri') {
            $title = "Daftar Seminar Skripsi";
            Session::put('page', 'daftar_seminar_ti');

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

                $daftarSeminar = new DaftarSeminar();
                $daftarSeminar->mahasiswa_id = Auth::guard('mahasiswa')->user()->id;
                $daftarSeminar->program_studi = Auth::guard('mahasiswa')->user()->program_studi;
                $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
                $daftarSeminar->dosen1_id = $request['dosen1_id'];
                $daftarSeminar->dosen2_id = $request['dosen2_id'];
                $daftarSeminar->judul_skripsi = $request['judul_skripsi'];
                $daftarSeminar->tanggal_pengajuan = $request['tanggal_pengajuan'];

                // upload syarat 
                $syarat_1 = $request->file('syarat_1');
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/seminar/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSeminar->syarat_1 = $nama_syarat_1;

                // upload syarat 2
                $syarat_2 = $request->file('syarat_2');
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/seminar/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSeminar->syarat_2 = $nama_syarat_2;

                // upload syarat 3
                $syarat_3 = $request->file('syarat_3');
                $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
                $syarat_3_path = 'mahasiswa/seminar/syarat03';
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSeminar->syarat_3 = $nama_syarat_3;

                // upload syarat 
                $syarat_4 = $request->file('syarat_4');
                $ext_syarat_4 = $syarat_4->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName() . "." . $ext_syarat_4;
                $syarat_4_path = 'mahasiswa/seminar/syarat04';
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSeminar->syarat_4 = $nama_syarat_4;

                // upload syarat 
                $syarat_5 = $request->file('syarat_5');
                $ext_syarat_5 = $syarat_5->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName() . "." . $ext_syarat_5;
                $syarat_5_path = 'mahasiswa/seminar/syarat05';
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSeminar->syarat_5 = $nama_syarat_5;

                // upload syarat 
                $syarat_6 = $request->file('syarat_6');
                $ext_syarat_6 = $syarat_6->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName() . "." . $ext_syarat_6;
                $syarat_6_path = 'mahasiswa/seminar/syarat06';
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSeminar->syarat_6 = $nama_syarat_6;

                // upload syarat 
                $syarat_7 = $request->file('syarat_7');
                $ext_syarat_7 = $syarat_7->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_7 = $npm . "_" . $syarat_7->getClientOriginalName() . "." . $ext_syarat_7;
                $syarat_7_path = 'mahasiswa/seminar/syarat07';
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSeminar->syarat_7 = $nama_syarat_7;

                // upload syarat 
                $syarat_8 = $request->file('syarat_8');
                $ext_syarat_8 = $syarat_8->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_8 = $npm . "_" . $syarat_8->getClientOriginalName() . "." . $ext_syarat_8;
                $syarat_8_path = 'mahasiswa/seminar/syarat08';
                $syarat_8->move($syarat_8_path, $nama_syarat_8);
                $daftarSeminar->syarat_8 = $nama_syarat_8;

                // upload syarat 
                $syarat_9 = $request->file('syarat_9');
                $ext_syarat_9 = $syarat_9->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_9 = $npm . "_" . $syarat_9->getClientOriginalName() . "." . $ext_syarat_9;
                $syarat_9_path = 'mahasiswa/seminar/syarat09';
                $syarat_9->move($syarat_9_path, $nama_syarat_9);
                $daftarSeminar->syarat_9 = $nama_syarat_9;

                // upload syarat 
                $syarat_10 = $request->file('syarat_10');
                $ext_syarat_10 = $syarat_10->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_10 = $npm . "_" . $syarat_10->getClientOriginalName() . "." . $ext_syarat_10;
                $syarat_10_path = 'mahasiswa/seminar/syarat10';
                $syarat_10->move($syarat_10_path, $nama_syarat_10);
                $daftarSeminar->syarat_10 = $nama_syarat_10;

                // upload syarat 
                $syarat_11 = $request->file('syarat_11');
                $ext_syarat_11 = $syarat_11->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_11 = $npm . "_" . $syarat_11->getClientOriginalName() . "." . $ext_syarat_11;
                $syarat_11_path = 'mahasiswa/seminar/syarat11';
                $syarat_11->move($syarat_11_path, $nama_syarat_11);
                $daftarSeminar->syarat_11 = $nama_syarat_11;

                // upload syarat 
                $syarat_12 = $request->file('syarat_12');
                $ext_syarat_12 = $syarat_12->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_12 = $npm . "_" . $syarat_12->getClientOriginalName() . "." . $ext_syarat_12;
                $syarat_12_path = 'mahasiswa/seminar/syarat12';
                $syarat_12->move($syarat_12_path, $nama_syarat_12);
                $daftarSeminar->syarat_12 = $nama_syarat_12;

                // // upload syarat 
                // $syarat_13 = $request->file('syarat_13');
                // $ext_syarat_13 = $syarat_13->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_13 = $npm . "_" . $syarat_13->getClientOriginalName() . "." . $ext_syarat_13;
                // $syarat_13_path = 'mahasiswa/seminar/syarat13';
                // $syarat_13->move($syarat_13_path, $nama_syarat_13);
                // $daftarSeminar->syarat_13 = $nama_syarat_13;

                // // upload syarat 
                // $syarat_14 = $request->file('syarat_14');
                // $ext_syarat_14 = $syarat_14->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_14 = $npm . "_" . $syarat_14->getClientOriginalName() . "." . $ext_syarat_14;
                // $syarat_14_path = 'mahasiswa/seminar/syarat14';
                // $syarat_14->move($syarat_14_path, $nama_syarat_14);
                // $daftarSeminar->syarat_14 = $nama_syarat_14;

                // // upload syarat 
                // $syarat_15 = $request->file('syarat_15');
                // $ext_syarat_15 = $syarat_15->getClientOriginalExtension();
                // // $npm = Auth::guard('mahasiswa')->user()->npm;
                // $nama_syarat_15 = $npm . "_" . $syarat_15->getClientOriginalName() . "." . $ext_syarat_15;
                // $syarat_15_path = 'mahasiswa/seminar/syarat15';
                // $syarat_15->move($syarat_15_path, $nama_syarat_15);
                // $daftarSeminar->syarat_15 = $nama_syarat_15;

                $daftarSeminar->save();

                return redirect()->back()->with('success_message', 'Sukses mengajukan pendaftaran sidang');
            }
        } elseif ($slug == 'Perencanaan Wilayah dan Kota') {
            $title = "Daftar Sidang Pembahasan";
            Session::put('page', 'daftar_seminar_pwk');

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

                ];

                $customMessage = [
                    'tahun_ajaran_id.required' => 'Tahun Ajaran Tidak Boleh Kosong',
                    // 'dosen1_id.required' => 'Dosen Pembimbing 1 Tidak Boleh Kosong',
                    // 'dosen2_id.required' => 'Dosen Pembimbing 2 Tidak Boleh Kosong',
                    'judul_skripsi.required' => 'Judul Skripsi Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.required' => 'Tanggal Pengajuan Tidak Boleh Kosong',
                    // 'tanggal_pengajuan.date_format' => 'Format Tanggal Pengajuan Harus Benar',
                    'syarat_1.required' => 'Bukti pembayaran sidang pembahasan Harus Diisi',
                    'syarat_2.required' => 'Sertifikat pesantren mahasiswa baru dan sarjana Harus Diisi',
                    'syarat_3.required' => 'Transkrip nilai Harus Diisi',
                    'syarat_4.required' => 'Sertifikat TOEFL Harus Diisi',
                    'syarat_5.required' => 'Bukti bebas pinjaman perpustakaan Harus Diisi',
                    'syarat_6.required' => 'Bukti bebas koperasi mahasiswa Harus Diisi',
                    'syarat_7.required' => 'Sertifikat SKKFT Harus Diisi',
                    'syarat_1.mimes' => 'Format File Bukti pembayaran sidang pembahasan Harus PDF',
                    'syarat_2.mimes' => 'Format File Sertifikat pesantren mahasiswa baru dan sarjana Harus PDF',
                    'syarat_3.mimes' => 'Format File Transkrip nilai Harus PDF',
                    'syarat_4.mimes' => 'Format File Sertifikat TOEFL Harus PDF',
                    'syarat_5.mimes' => 'Format File Bukti bebas pinjaman perpustakaan Harus PDF',
                    'syarat_6.mimes' => 'Format File Bukti bebas koperasi mahasiswa Harus PDF',
                    'syarat_7.mimes' => 'Format File Sertifikat SKKFT Harus PDF',
                ];

                $this->validate($request, $rules, $customMessage);

                $daftarSeminar = new DaftarSeminar();
                $daftarSeminar->mahasiswa_id = Auth::guard('mahasiswa')->user()->id;
                $daftarSeminar->program_studi = Auth::guard('mahasiswa')->user()->program_studi;
                $daftarSeminar->tahun_ajaran_id = $request['tahun_ajaran_id'];
                $daftarSeminar->dosen1_id = $request['dosen1_id'];
                $daftarSeminar->dosen2_id = $request['dosen2_id'];
                $daftarSeminar->judul_skripsi = $request['judul_skripsi'];

                // upload syarat 
                $syarat_1 = $request->file('syarat_1');
                $ext_syarat_1 = $syarat_1->getClientOriginalExtension();
                $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_1 = $npm . "_" . $syarat_1->getClientOriginalName() . "." . $ext_syarat_1;
                $syarat_1_path = 'mahasiswa/seminar/syarat01';
                $syarat_1->move($syarat_1_path, $nama_syarat_1);
                $daftarSeminar->syarat_1 = $nama_syarat_1;

                // upload syarat 2
                $syarat_2 = $request->file('syarat_2');
                $ext_syarat_2 = $syarat_2->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_2 = $npm . "_" . $syarat_2->getClientOriginalName() . "." . $ext_syarat_2;
                $syarat_2_path = 'mahasiswa/seminar/syarat02';
                $syarat_2->move($syarat_2_path, $nama_syarat_2);
                $daftarSeminar->syarat_2 = $nama_syarat_2;

                // upload syarat 3
                $syarat_3 = $request->file('syarat_3');
                $ext_syarat_3 = $syarat_3->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_3 = $npm . "_" . $syarat_3->getClientOriginalName() . "." . $ext_syarat_3;
                $syarat_3_path = 'mahasiswa/seminar/syarat03';
                $syarat_3->move($syarat_3_path, $nama_syarat_3);
                $daftarSeminar->syarat_3 = $nama_syarat_3;

                // upload syarat 
                $syarat_4 = $request->file('syarat_4');
                $ext_syarat_4 = $syarat_4->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_4 = $npm . "_" . $syarat_4->getClientOriginalName() . "." . $ext_syarat_4;
                $syarat_4_path = 'mahasiswa/seminar/syarat04';
                $syarat_4->move($syarat_4_path, $nama_syarat_4);
                $daftarSeminar->syarat_4 = $nama_syarat_4;

                // upload syarat 
                $syarat_5 = $request->file('syarat_5');
                $ext_syarat_5 = $syarat_5->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_5 = $npm . "_" . $syarat_5->getClientOriginalName() . "." . $ext_syarat_5;
                $syarat_5_path = 'mahasiswa/seminar/syarat05';
                $syarat_5->move($syarat_5_path, $nama_syarat_5);
                $daftarSeminar->syarat_5 = $nama_syarat_5;

                // upload syarat 
                $syarat_6 = $request->file('syarat_6');
                $ext_syarat_6 = $syarat_6->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_6 = $npm . "_" . $syarat_6->getClientOriginalName() . "." . $ext_syarat_6;
                $syarat_6_path = 'mahasiswa/seminar/syarat06';
                $syarat_6->move($syarat_6_path, $nama_syarat_6);
                $daftarSeminar->syarat_6 = $nama_syarat_6;

                // upload syarat 
                $syarat_7 = $request->file('syarat_7');
                $ext_syarat_7 = $syarat_7->getClientOriginalExtension();
                // $npm = Auth::guard('mahasiswa')->user()->npm;
                $nama_syarat_7 = $npm . "_" . $syarat_7->getClientOriginalName() . "." . $ext_syarat_7;
                $syarat_7_path = 'mahasiswa/seminar/syarat07';
                $syarat_7->move($syarat_7_path, $nama_syarat_7);
                $daftarSeminar->syarat_7 = $nama_syarat_7;

                $daftarSeminar->save();

                return redirect()->back()->with('success_message', 'Sukses mengajukan pendaftaran sidang');
            }
        }

        $tahunAjaran = TahunAjaran::get();
        $dosen1 = Dosen::get()->toArray();
        $mhs = Auth::guard('mahasiswa')->user();
        $daftarSeminar = DaftarSeminar::where('mahasiswa_id', Auth::guard('mahasiswa')->user()->id)->first();
        // dd($mhs);

        return view('mahasiswa.daftar_seminar', compact('slug', 'tahunAjaran', 'dosen1', 'daftarSeminar', 'title', 'mhs'));
    }

    // fungsi lihat daftar seminar untuk dosen
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

    // fungsi show dan approval seminar untuk dosen
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

    // fungsi lihat rekap daftar seminar yang telah di approve dosen
    public function index($slug)
    {
        Session::put('page', 'rekapDaftarSeminar');
        $tahun_ajaran = TahunAjaran::with('semesterx')->get();

        return view('dosen.rekap_daftar_seminar', compact('tahun_ajaran', 'slug'));
    }

    public function data($slug)
    {
        if ($slug == 'Teknik Pertambangan') {
            $rekapSeminar = DaftarSeminar::select('daftar_seminar.*', 'mahasiswa.npm', 'mahasiswa.nama', 'mahasiswa.program_studi', 'tahun_ajaran.tahun_ajaran')
                ->leftJoin('mahasiswa', 'mahasiswa.id', 'daftar_seminar.mahasiswa_id')
                ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
                ->where([
                    'status' => 1,
                    // 'program_studi' => 'Teknik Pertambangan'
                ])->orderBy('id', 'asc')->get();
        } elseif ($slug == 'Teknik Industri') {
            $rekapSeminar = DaftarSeminar::select('daftar_seminar.*', 'mahasiswa.npm', 'mahasiswa.nama', 'mahasiswa.program_studi', 'tahun_ajaran.tahun_ajaran')
                ->leftJoin('mahasiswa', 'mahasiswa.id', 'daftar_seminar.mahasiswa_id')
                ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
                ->where([
                    'status' => 1,
                    // 'program_studi' => 'Teknik Industri'
                ])->orderBy('id', 'asc')->get();
        } elseif ($slug == 'Perencanaan Wilayah dan Kota') {
            $rekapSeminar = DaftarSeminar::select('daftar_seminar.*', 'mahasiswa.npm', 'mahasiswa.nama', 'mahasiswa.program_studi', 'tahun_ajaran.tahun_ajaran')
                ->leftJoin('mahasiswa', 'mahasiswa.id', 'daftar_seminar.mahasiswa_id')
                ->leftJoin('tahun_ajaran', 'tahun_ajaran.id', 'daftar_seminar.tahun_ajaran_id')
                ->where([
                    'status' => 1,
                    // 'program_studi' => 'Perencanaan Wilayah dan Kota'
                ])->orderBy('id', 'asc')->get();
        }

        return datatables()
            ->of($rekapSeminar)
            ->addIndexColumn()
            ->addColumn('aksi', function ($rekapSeminar) {
                return '<div class="btn-group">
                                <button onclick="showRekapSeminar(`' . route('showRekapSeminar', $rekapSeminar->id) . '`)" class="btn btn-info"><i class="mdi mdi-file-find" style="font-size: 15px;"></i></button>
                            </div>';
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
}
