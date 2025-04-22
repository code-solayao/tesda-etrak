<?php

namespace App\Jobs;

use App\Models\Graduate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Validator;

class ProcessSheetChunk implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    protected $rows;

    /**
     * Create a new job instance.
     */
    public function __construct(array $rows)
    {
        $this->rows = $rows;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->rows as $row) {
            $validator = Validator::make($row, [
                'district' => ['nullable', 'string', 'max:50'], 
                'city' => ['nullable', 'string', 'max:50'], 
                'tvi' => ['nullable', 'string', 'max:255'], 
                'qualification_title' => ['nullable', 'string', 'max:255'], 
                'sector' => ['nullable', 'string', 'max:255'], 
                'last_name' => ['required', 'string', 'max:255'], 
                'first_name' => ['required', 'string', 'max:255'], 
                'middle_name' => ['nullable', 'string', 'max:255'], 
                'extension_name' => ['nullable', 'string', 'max:50'], 
                'full_name' => ['required', 'string', 'max:255'], 
                'sex' => ['nullable', 'string', 'max:50'], 
                'birthdate' => ['nullable', 'string', 'max:50'], 
                'contact_number' => ['nullable', 'string', 'min:13', 'max:16'], 
                'email' => ['nullable', 'email', 'max:255'], 
                'address' => ['nullable', 'string', 'max:255'], 
                'scholarship_type' => ['nullable', 'string', 'max:50'], 
                'training_status' => ['nullable', 'string', 'max:50'], 
                'assessment_result' => ['nullable', 'string', 'max:255'], 
                'employment_before_training' => ['nullable', 'string', 'max:50'], 
                'occupation' => ['nullable', 'string', 'max:255'], 
                'employer_name' => ['nullable', 'string', 'max:255'], 
                'employment_type' => ['nullable', 'string', 'max:255'], 
                'work_address' => ['nullable', 'string', 'max:255'], 
                'date_hired' => ['nullable', 'string', 'max:50'], 
                'allocation' => ['nullable', 'string', 'max:50'], 
                'verification_means' => ['nullable', 'string', 'max:50'], 
                'verification_date' => ['nullable', 'string', 'max:50'], 
                'verification_status' => ['nullable', 'string', 'max:50'], 
                'follow_up_date_1' => ['nullable', 'string', 'max:50'], 
                'response_status' => ['nullable', 'string', 'max:50'], 
                'not_interested_reason' => ['nullable', 'string', 'max:255'], 
                'referral_status' => ['nullable', 'string', 'max:10'], 
                'company_name' => ['nullable', 'string', 'max:255'], 
                'company_address' => ['nullable', 'string', 'max:255'], 
                'job_title' => ['nullable', 'string', 'max:255'], 
                'employment_status' => ['nullable', 'string', 'max:255'], 
                'hired_date' => ['nullable', 'string', 'max:50'], 
                'not_hired_reason' => ['nullable', 'string', 'max:50'], 
                'count' => ['nullable', 'string', 'max:10'], 
                'no_of_graduates' => ['nullable', 'string', 'max:10'], 
                'no_of_employed' => ['nullable', 'string', 'max:10'], 
                'verification' => ['nullable', 'string', 'max:50'], 
                'job_vacancies' => ['nullable', 'string', 'max:10'], 
                'remarks' => ['nullable', 'string', 'max:255'], 
                'application_status' => ['nullable', 'string', 'max:255']
            ]);

            if ($validator->fails()) {
                continue;
            }

            $sanitized = [
                'district' => trim($row['district'] ?? ''), 
                'city' => trim($row['city'] ?? ''), 
                'tvi' => trim($row['tvi'] ?? ''), 
                'qualification_title' => trim($row['qualification_title'] ?? ''), 
                'sector' => trim($row['sector'] ?? ''), 
                'last_name' => trim($row['last_name']), 
                'first_name' => trim($row['first_name']), 
                'middle_name' => trim($row['middle_name'] ?? ''), 
                'extension_name' => trim($row['extension_name'] ?? ''), 
                'full_name' => trim($row['full_name']), 
                'sex' => trim($row['sex'] ?? ''), 
                'birthdate' => trim($row['birthdate'] ?? ''), 
                'contact_number' => trim($row['contact_number'] ?? ''), 
                'email' => strtolower(trim($row['email'] ?? '')), 
                'address' => trim($row['address'] ?? ''), 
                'scholarship_type' => trim($row['scholarship_type'] ?? ''), 
                'training_status' => trim($row['training_status'] ?? ''), 
                'assessment_result' => trim($row['assessment_result'] ?? ''), 
                'employment_before_training' => trim($row['employment_before_training'] ?? ''), 
                'occupation' => trim($row['occupation'] ?? ''), 
                'employer_name' => trim($row['employer_name'] ?? ''), 
                'employment_type' => trim($row['employment_type'] ?? ''), 
                'work_address' => trim($row['work_address'] ?? ''), 
                'date_hired' => trim($row['date_hired'] ?? ''), 
                'allocation' =>  trim($row['allocation'] ?? ''), 
                'verification_means' => trim($row['verification_means'] ?? ''), 
                'verification_date' => trim($row['verification_date'] ?? ''), 
                'verification_status' => trim($row['verification_status'] ?? ''), 
                'follow_up_date_1' => trim($row['follow_up_date_1'] ?? ''), 
                'response_status' => trim($row['response_status'] ?? ''), 
                'not_interested_reason' => trim($row['not_interested_reason'] ?? ''), 
                'referral_status' => trim($row['referra_status'] ?? ''), 
                'company_name' => trim($row['company_name'] ?? ''), 
                'company_address' => trim($row['company_address'] ?? ''), 
                'job_title' => trim($row['job_title'] ?? ''), 
                'employment_status' => trim($row['employment_status'] ?? ''), 
                'hired_date' => trim($row['hired_date'] ?? ''), 
                'not_hired_reason' => trim($row['not_hired_reason'] ?? ''), 
                'count' => trim($row['count'] ?? ''), 
                'no_of_graduates' => trim($row['no_of_graduates'] ?? ''), 
                'no_of_employed' => trim($row['no_of_employed'] ?? ''), 
                'verification' => trim($row['verification'] ?? ''), 
                'job_vacancies' => trim($row['job_vacancies'] ?? ''), 
                'remarks' => trim($row['remarks'] ?? ''), 
                'application_status' => trim($row['application_status'] ?? '')
            ];

            Graduate::updateOrInsert(
                ['district' => $sanitized['district']], 
                ['city' => $sanitized['city']], 
                ['tvi' => $sanitized['tvi']], 
                ['qualification_title' => $sanitized['qualification_title']], 
                ['sector' => $sanitized['sector']], 
                ['last_name' => $sanitized['last_name']], 
                ['first_name' => $sanitized['first_name']], 
                ['middle_name' => $sanitized['middle_name']], 
                ['extension_name' => $sanitized['extension_name']], 
                ['full_name' => $sanitized['full_name']], 
                ['sex' => $sanitized['sex']], 
                ['birthdate' => $sanitized['birthdate']], 
                ['contact_number' => $sanitized['contact_number']], 
                ['email' => $sanitized['email']], 
                ['address' => $sanitized['address']], 
                ['scholarship_type' => $sanitized['scholarship_type']], 
                ['training_status' => $sanitized['training_status']], 
                ['assessment_result' => $sanitized['assessment_result']], 
                ['employment_before_training' => $sanitized['employment_before_training']], 
                ['occupation' => $sanitized['occupation']], 
                ['employer_name' => $sanitized['employer_name']], 
                ['employment_type' => $sanitized['employment_type']], 
                ['work_address' => $sanitized['work_address']], 
                ['date_hired' => $sanitized['date_hired']], 
                ['allocation' => $sanitized['allocation']], 
                ['verification_means' => $sanitized['verification_means']], 
                ['verification_date' => $sanitized['verification_date']], 
                ['verification_status' => $sanitized['verification_status']], 
                ['follow_up_date_1' => $sanitized['follow_up_date_1']], 
                ['follow_up_date_2' => ''], 
                ['response_status' => $sanitized['response_status']], 
                ['not_interested_reason' => $sanitized['not_interested_reason']], 
                ['referral_status' => $sanitized['referral_status']], 
                ['referral_date' => ''], 
                ['no_referral_reason' => ''], 
                ['invalid_contact' => ''], 
                ['company_name' => $sanitized['company_name']], 
                ['company_address' => $sanitized['company_address']], 
                ['job_title' => $sanitized['job_title']], 
                ['employment_status' => $sanitized['employment_status']], 
                ['hired_date' => $sanitized['hired_date']], 
                ['submitted_documents_date' => ''], 
                ['interview_date' => ''], 
                ['not_hired_reason' => $sanitized['not_hired_reason']], 
                ['count' => $sanitized['count']], 
                ['no_of_graduates' => $sanitized['no_of_graduates']], 
                ['no_of_employed' => $sanitized['no_of_employed']], 
                ['verification' => $sanitized['verification']], 
                ['job_vacancies' => $sanitized['job_vacancies']], 
                ['remarks' => $sanitized['remarks']], 
                ['application_status' => $sanitized['application_status']], 
                ['withdrawn_reason' => '']
            );
        }
    }
}
