<?php
namespace App\Controllers\Results;

use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Dashboard extends BaseController
{
    public function upload()
    {
        if (!in_array(session()->get('role'), ['exam_officer', 'admin'])) {
            return redirect()->to('/login');
        }
        return view('results/upload');
    }

    public function uploadResults()
    {
        $file = $this->request->getFile('excel');
        if ($file->isValid()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
            // Skip header row
            array_shift($data);
            foreach ($data as $row) {
                model('ResultModel')->insert([
                    'student_id' => $row[0],
                    'course_code' => $row[1],
                    'session' => $row[2],
                    'semester' => $row[3],
                    'score' => $row[4],
                    'grade' => $row[5],
                    'uploaded_by' => session()->get('user_id'),
                ]);
            }
            helper('toast');
            toast('Results uploaded successfully', 'success');
        }
        return redirect()->back();
    }
}