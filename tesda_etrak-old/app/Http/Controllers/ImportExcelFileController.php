<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Graduate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportExcelFileController extends Controller
{
    public function index() {
        return view('/import-excel-file/index');
    }

    public function import_excel_file(Request $request)
    {
        // Validate file input
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);

        $file = $request->file('file');

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rowIterator = $sheet->getRowIterator();

        // Skip first row (header)
        $firstRow = true;
        $batchData = [];
        $batchSize = 10; // Process 500 rows at a time

        DB::beginTransaction();

        try {
            foreach ($rowIterator as $row) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }

                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(true);

                $rowData = [];
                foreach ($cellIterator as $cell) {
                    $rowData[] = $cell->getValue();
                }

                // Ensure correct number of columns before inserting
                if (count($rowData) >= 3) {
                    $district = strip_tags($rowData[0]);
                    $city = strip_tags($rowData[1]);
                    $tvi = strip_tags($rowData[2]);
                    $qualification_title = strip_tags($rowData[3]);
                    $sector = strip_tags($rowData[4]);
                    $last_name = strip_tags($rowData[5]);
                    $first_name = strip_tags($rowData[6]);
                    $middle_name = strip_tags($rowData[7]);
                    $extension_name = strip_tags($rowData[8]);
                    $full_name = strip_tags($rowData[9]);
                    $contact_number = strip_tags($rowData[10]);
                    $email = strip_tags($rowData[11]);
                    $scholarship_type = strip_tags($rowData[12]);
                    $training_status = strip_tags($rowData[13]);
                    $assessment_result = strip_tags($rowData[14]);
                    $employment_before_training = strip_tags($rowData[15]);
                    $occupation = strip_tags($rowData[16]);
                    $employer_name = strip_tags($rowData[17]);
                    $employment_type = strip_tags($rowData[18]);
                    $address = strip_tags($rowData[19]);
                    $date_hired = strip_tags($rowData[20]);
                    $allocation = strip_tags($rowData[21]);
                    $verification_means = strip_tags($rowData[22]);
                    $verification_date = strip_tags($rowData[23]);
                    $verification_status = strip_tags($rowData[24]);
                    $follow_up_date_1 = strip_tags($rowData[25]);
                    $response_status = strip_tags($rowData[26]);
                    $not_interested_reason = strip_tags($rowData[27]);
                    $referral_status = strip_tags($rowData[28]);
                    $company_name = strip_tags($rowData[29]);
                    $company_address = strip_tags($rowData[30]);
                    $job_title = strip_tags($rowData[31]);
                    $employment_status = strip_tags($rowData[32]);
                    $hired_date = strip_tags($rowData[33]);
                    $remarks = strip_tags($rowData[34]);
                    $count = strip_tags($rowData[35]);
                    $no_of_graduates = strip_tags($rowData[36]);
                    $no_of_employed = strip_tags($rowData[37]);
                    $verification = strip_tags($rowData[38]);
                    $job_vacancies = strip_tags($rowData[39]);
                    $no_referral_reason = strip_tags($rowData[40]);

                    $batchData[] = [
                        'created_at' => now(), 
                        'updated_at' => now(), 
                        'district' => $district, 
                        'city' => $city, 
                        'tvi' => $tvi, 
                        'qualification_title' => $qualification_title, 
                        'sector' => $sector, 
                        'last_name' => $last_name, 
                        'first_name' => $first_name, 
                        'middle_name' => $middle_name, 
                        'extension_name' => $extension_name, 
                        'full_name' => $full_name, 
                        'sex' => null, 
                        'birthdate' => null, 
                        'contact_number' => $contact_number, 
                        'email' => $email, 
                        'scholarship_type' => $scholarship_type, 
                        'address' => $address, 
                        'allocation' => $allocation, 
                        'verification_means' => $verification_means, 
                        'verification_date' => $verification_date, 
                        'verification_status' => $verification_status, 
                        'follow_up_date_1' => $follow_up_date_1, 
                        'follow_up_date_2' => $follow_up_date_1, 
                        'response_status' => $response_status, 
                        'not_interested_reason' => $not_interested_reason, 
                        'referral_status' => $referral_status, 
                        'referral_date' => null, 
                        'no_referral_reason' => $no_referral_reason, 
                        'invalid_contact' => null, 
                        'company_name' => $company_name, 
                        'company_address' => $company_address, 
                        'job_title' => $job_title, 
                        'employment_status' => $employment_status, 
                        'hired_date' => $hired_date, 
                        'submitted_documents_date' => null, 
                        'interview_date' => null, 
                        'not_hired_reason' => null, 
                        'training_status' => $training_status, 
                        'assessment_result' => $assessment_result, 
                        'employment_before_training' => $employment_before_training, 
                        'occupation' => $occupation, 
                        'employer_name' => $employer_name, 
                        'employment_type' => $employment_type, 
                        'date_hired' => $date_hired, 
                        'remarks' => $remarks, 
                        'count' => $count, 
                        'no_of_graduates' => $no_of_graduates, 
                        'no_of_employed' => $no_of_employed, 
                        'verification' => $verification, 
                        'job_vacancies' => $job_vacancies
                    ];
                }

                // Insert batch into database
                if (count($batchData) >= $batchSize) {
                    Graduate::insert($batchData);
                    $batchData = []; // Reset batch
                }
            }

            // Insert remaining data
            if (!empty($batchData)) {
                Graduate::insert($batchData);
            }

            DB::commit();

            return redirect()->route('view-records')->with('success', 'Graduates imported successfully!');
        } 
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('import-excel-file-page')->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /*public function import_excel_file(Request $request) {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
        ]);
        $file = $request->file('file');

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rowIterator = $sheet->getRowIterator();

        // Skip first row (header)
        $firstRow = true;
        $batchData = [];
        $batchSize = 10; // Process 500 rows at a time

        DB::beginTransaction();

        try {
            foreach ($rowIterator as $row) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }

                $cellIterator = $row->getCellIterator();
                $cellIterator->setIterateOnlyExistingCells(true);

                $row = [];
                foreach ($cellIterator as $cell) {
                    $row[] = $cell->getValue();
                }

                // Ensure correct number of columns before inserting
                $numberOfColumns = 42;
                if (count($row) >= $numberOfColumns) {
                    $district = strip_tags($row[0]);
                    $city = strip_tags($row[1]);
                    $tvi = strip_tags($row[2]);
                    $qualification_title = strip_tags($row[3]);
                    $sector = strip_tags($row[4]);
                    $last_name = strip_tags($row[5]);
                    $first_name = strip_tags($row[6]);
                    $middle_name = strip_tags($row[7]);
                    $extension_name = strip_tags($row[8]);
                    $full_name = strip_tags($row[9]);
                    $contact_number = strip_tags($row[10]);
                    $email = strip_tags($row[11]);
                    $scholarship_type = strip_tags($row[12]);
                    $training_status = strip_tags($row[13]);
                    $assessment_result = strip_tags($row[14]);
                    $employment_before_training = strip_tags($row[15]);
                    $occupation = strip_tags($row[16]);
                    $employer_name = strip_tags($row[17]);
                    $employment_type = strip_tags($row[18]);
                    $address = strip_tags($row[19]);
                    $date_hired = strip_tags($row[20]);
                    $allocation = strip_tags($row[21]);
                    $verification_means = strip_tags($row[22]);
                    $verification_date = strip_tags($row[23]);
                    $verification_status = strip_tags($row[24]);
                    $follow_up_date_1 = strip_tags($row[25]);
                    $response_status = strip_tags($row[26]);
                    $not_interested_reason = strip_tags($row[27]);
                    $referral_status = strip_tags($row[28]);
                    $company_name = strip_tags($row[29]);
                    $company_address = strip_tags($row[30]);
                    $job_title = strip_tags($row[31]);
                    $employment_status = strip_tags($row[32]);
                    $hired_date = strip_tags($row[33]);
                    $remarks = strip_tags($row[34]);
                    $count = strip_tags($row[35]);
                    $no_of_graduates = strip_tags($row[36]);
                    $no_of_employed = strip_tags($row[37]);
                    $verification = strip_tags($row[38]);
                    $job_vacancies = strip_tags($row[39]);
                    $no_referral_reason = strip_tags($row[40]);

                    $batchData[] = [
                        'created_at' => now(), 
                        'updated_at' => now(), 
                        'district' => $district, 
                        'city' => $city, 
                        'tvi' => $tvi, 
                        'qualification_title' => $qualification_title, 
                        'sector' => $sector, 
                        'last_name' => $last_name, 
                        'first_name' => $first_name, 
                        'middle_name' => $middle_name, 
                        'extension_name' => $extension_name, 
                        'full_name' => $full_name, 
                        'sex' => null, 
                        'birthdate' => null, 
                        'contact_number' => $contact_number, 
                        'email' => $email, 
                        'scholarship_type' => $scholarship_type, 
                        'address' => $address, 
                        'allocation' => $allocation, 
                        'verification_means' => $verification_means, 
                        'verification_date' => $verification_date, 
                        'verification_status' => $verification_status, 
                        'follow_up_date_1' => $follow_up_date_1, 
                        'follow_up_date_2' => $follow_up_date_1, 
                        'response_status' => $response_status, 
                        'not_interested_reason' => $not_interested_reason, 
                        'referral_status' => $referral_status, 
                        'referral_date' => null, 
                        'no_referral_reason' => $no_referral_reason, 
                        'invalid_contact' => null, 
                        'company_name' => $company_name, 
                        'company_address' => $company_address, 
                        'job_title' => $job_title, 
                        'employment_status' => $employment_status, 
                        'hired_date' => $hired_date, 
                        'submitted_documents_date' => null, 
                        'interview_date' => null, 
                        'not_hired_reason' => null, 
                        'training_status' => $training_status, 
                        'assessment_result' => $assessment_result, 
                        'employment_before_training' => $employment_before_training, 
                        'occupation' => $occupation, 
                        'employer_name' => $employer_name, 
                        'employment_type' => $employment_type, 
                        'date_hired' => $date_hired, 
                        'remarks' => $remarks, 
                        'count' => $count, 
                        'no_of_graduates' => $no_of_graduates, 
                        'no_of_employed' => $no_of_employed, 
                        'verification' => $verification, 
                        'job_vacancies' => $job_vacancies
                    ];
                }

                // Insert batch into database 
                if (count($batchData) >= $batchSize) {
                    Graduate::insert($batchData);
                    $batchData = [];
                }
            }

            // Insert remaining data
            if (!empty($batchData)) {
                Graduate::insert($batchData);
            }

            DB::commit();

            return redirect()->route('view-records')->with('success', 'Graduates imported successfully!');
        } 
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('import-excel-file-page')->with('error', 'Import failed: ' . $e->getMessage());
        }
    }*/

    /*public function import_excel_file(Request $request) {
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

            $district = strip_tags($row[0]);
            $city = strip_tags($row[1]);
            $tvi = strip_tags($row[2]);
            $qualification_title = strip_tags($row[3]);
            $sector = strip_tags($row[4]);
            $last_name = strip_tags($row[5]);
            $first_name = strip_tags($row[6]);
            $middle_name = strip_tags($row[7]);
            $extension_name = strip_tags($row[8]);
            $full_name = strip_tags($row[9]);
            $contact_number = strip_tags($row[10]);
            $email = strip_tags($row[11]);
            $scholarship_type = strip_tags($row[12]);
            $training_status = strip_tags($row[13]);
            $assessment_result = strip_tags($row[14]);
            $employment_before_training = strip_tags($row[15]);
            $occupation = strip_tags($row[16]);
            $employer_name = strip_tags($row[17]);
            $employment_type = strip_tags($row[18]);
            $address = strip_tags($row[19]);
            $date_hired = strip_tags($row[20]);
            $allocation = strip_tags($row[21]);
            $verification_means = strip_tags($row[22]);
            $verification_date = strip_tags($row[23]);
            $verification_status = strip_tags($row[24]);
            $follow_up_date_1 = strip_tags($row[25]);
            $response_status = strip_tags($row[26]);
            $not_interested_reason = strip_tags($row[27]);
            $referral_status = strip_tags($row[28]);
            $company_name = strip_tags($row[29]);
            $company_address = strip_tags($row[30]);
            $job_title = strip_tags($row[31]);
            $employment_status = strip_tags($row[32]);
            $hired_date = strip_tags($row[33]);
            $remarks = strip_tags($row[34]);
            $count = strip_tags($row[35]);
            $no_of_graduates = strip_tags($row[36]);
            $no_of_employed = strip_tags($row[37]);
            $verification = strip_tags($row[38]);
            $job_vacancies = strip_tags($row[39]);
            $no_referral_reason = strip_tags($row[40]);

            Graduate::create([
                'district' => $district, 
                'city' => $city, 
                'tvi' => $tvi, 
                'qualification_title' => $qualification_title, 
                'sector' => $sector, 
                'last_name' => $last_name, 
                'first_name' => $first_name, 
                'middle_name' => $middle_name, 
                'extension_name' => $extension_name, 
                'full_name' => $full_name, 
                'sex' => null, 
                'birthdate' => null, 
                'contact_number' => $contact_number, 
                'email' => $email, 
                'scholarship_type' => $scholarship_type, 
                'address' => $address, 
                'allocation' => $allocation, 
                'verification_means' => $verification_means, 
                'verification_date' => $verification_date, 
                'verification_status' => $verification_status, 
                'follow_up_date_1' => $follow_up_date_1, 
                'follow_up_date_2' => $follow_up_date_1, 
                'response_status' => $response_status, 
                'not_interested_reason' => $not_interested_reason, 
                'referral_status' => $referral_status, 
                'referral_date' => null, 
                'no_referral_reason' => $no_referral_reason, 
                'invalid_contact' => null, 
                'company_name' => $company_name, 
                'company_address' => $company_address, 
                'job_title' => $job_title, 
                'employment_status' => $employment_status, 
                'hired_date' => $hired_date, 
                'submitted_documents_date' => null, 
                'interview_date' => null, 
                'not_hired_reason' => null, 
                'training_status' => $training_status, 
                'assessment_result' => $assessment_result, 
                'employment_before_training' => $employment_before_training, 
                'occupation' => $occupation, 
                'employer_name' => $employer_name, 
                'employment_type' => $employment_type, 
                'date_hired' => $date_hired, 
                'remarks' => $remarks, 
                'count' => $count, 
                'no_of_graduates' => $no_of_graduates, 
                'no_of_employed' => $no_of_employed, 
                'verification' => $verification, 
                'job_vacancies' => $job_vacancies
            ]);
        }

        return redirect()->route('view-records')->with('success', 'Graduates imported successfully!');
    }*/
}
