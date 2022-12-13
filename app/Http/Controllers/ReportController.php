<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    function show_report(Request $request){
        $id=$request['id'];
        $report=Report::where('file_id',$id);
        return $report;

    }
}
