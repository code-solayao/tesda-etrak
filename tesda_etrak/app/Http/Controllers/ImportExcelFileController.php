<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Graduate;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportExcelFileController extends Controller
{
    public function index() {
        return view('/import-excel-file/index');
    }

    public function import(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);
        $file = $request->file('file');

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Skip header row and import data
        foreach ($rows as $index => $row) {
            if ($index == 0) continue; // Skip the first row (headers)

            Graduate::create([
                'district' => $row[0]
            ]);
        }

        return back()->with('success', 'Graduates imported successfully!');
    }
}
