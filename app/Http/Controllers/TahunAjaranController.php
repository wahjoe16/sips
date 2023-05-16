<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TahunAjaranController extends Controller
{
    // fungsi view tahun ajaran
    public function viewTahunAjaran()
    {
        Session::put('page', 'tahun_ajaran');
        $tahun_ajaran = TahunAjaran::get();
        return view('admin.tahun_ajaran.tahun_ajaran', compact('tahun_ajaran'));
    }

    // fungsi tambah dan edit tahun ajaran
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
}
