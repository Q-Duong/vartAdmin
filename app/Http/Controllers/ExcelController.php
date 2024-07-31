<?php

namespace App\Http\Controllers;

use App\Exports\ExcelExportEnRegister;
use App\Exports\ExcelExportENReport;
use App\Exports\ExcelExportVnRegister;
use App\Exports\ExcelExportVNReport;
use App\Imports\RegistersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        Excel::import(new RegistersImport, $request->file('file'));

        return redirect()->back()->with('success', 'Registers imported successfully.');
    }
    public function export(Request $request)
    {
        switch ($request->export_type) {
            case ('vnrp'):
                return Excel::download(new ExcelExportVNReport($request->conference_id), 'ReportVN.xlsx');
                break;
            case ('enrp'):
                return Excel::download(new ExcelExportENReport($request->conference_id), 'ReportEN.xlsx');
                break;
            case ('vnrt'):
                return Excel::download(new ExcelExportVnRegister($request->conference_id), 'RegisterVN.xlsx');
                break;
            case ('enrt'):
                return Excel::download(new ExcelExportEnRegister($request->conference_id), 'RegisterEN.xlsx');
                break;
            default:
                return Redirect::back();
        }
    }
}
