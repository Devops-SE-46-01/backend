<?php

namespace App\Http\Controllers;

use App\Export\RecruitationExport;
use App\Models\Recruitation;
use Maatwebsite\Excel\Facades\Excel;

class RecruitationController extends Controller
{
    public function index()
    {
        $data['recruitations'] = Recruitation::whereYear('created_at', '2024')->orderBy('name', 'ASC')->get();
        return view('admin.recruitation.index', $data);
    }

    public function update(Recruitation $recruitation)
    {
        if($recruitation->is_accepted == 0) {
            $recruitation->is_accepted = 1;
	} else if ($recruitation->is_accepted == 1) {
	    $recruitation->is_accepted = 2;
	} else if ($recruitation->is_accepted == 2) {
            $recruitation->is_accepted = 3;
	} else {
           
	}

        $recruitation->save();
        return redirect()->route('recruitations.index')->with('success', 'Action successfully completed.');
    }

    public function export()
    {
        return Excel::download(new RecruitationExport, 'recruitation.xlsx');
    }
}
