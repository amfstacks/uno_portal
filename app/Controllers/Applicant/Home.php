<?php
namespace App\Controllers\Applicant;

use App\Controllers\BaseController;
use App\Models\SchoolModel;

class Home extends BaseController
{
    public function index()
    {
        // $school = model('SchoolModel')->current();
        return view('/landing');
    }
}