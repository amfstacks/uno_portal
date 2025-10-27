<?php
namespace App\Controllers\Application;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function form()
    {
        return view('application/form');
    }

    public function submit()
    {
        $data = $this->request->getPost(['full_name', 'email', 'phone', 'course_applied']);
        model('ApplicationModel')->save($data);
        helper('toast');
        toast('Application submitted successfully', 'success');
        return redirect()->to('/');
    }

    public function list()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
        $applications = model('ApplicationModel')->findAll();
        return view('application/list', compact('applications'));
    }

    public function admit()
    {
        $id = $this->request->getPost('id');
        model('ApplicationModel')->update($id, ['status' => 'admitted']);
        helper('toast');
        toast('Applicant admitted', 'success');
        return redirect()->back();
    }

    public function admitBulk()
    {
        $file = $this->request->getFile('excel');
        if ($file->isValid()) {
            $spreadsheet = IOFactory::load($file->getTempName());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray();
            array_shift($data);
            foreach ($data as $row) {
                model('ApplicationModel')->insert([
                    'full_name' => $row[0],
                    'email' => $row[1],
                    'phone' => $row[2],
                    'course_applied' => $row[3],
                    'status' => 'admitted',
                ]);
            }
            helper('toast');
            toast('Bulk admission successful', 'success');
        }
        return redirect()->back();
    }
}