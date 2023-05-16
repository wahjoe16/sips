<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SemesterController extends Controller
{
    // fungsi semester
    public function viewSemester()
    {
        Session::put('page', 'semester');
        $semester = Semester::get();
        return view('admin.semester.semester', compact('semester'));
    }

    // fungsi tambah dan edit semester
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
}
