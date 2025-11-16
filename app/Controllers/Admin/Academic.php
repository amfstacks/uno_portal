<?php
namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\FacultyModel;
use App\Models\DepartmentModel;
use App\Models\CourseModel;
use App\Models\courseAppliedModel;

use App\Traits\CrudTrait;

class Academic extends BaseController
{
    use CrudTrait;

    protected $facultyModel;
    protected $departmentModel;
    protected $courseModel;
    protected $courseAppliedModel;

    public function __construct()
    {
        $this->facultyModel = new FacultyModel();
        $this->departmentModel = new DepartmentModel();
        $this->courseModel = new CourseModel();
        $this->courseAppliedModel = new courseAppliedModel();

        
    }

    // === FACULTIES ===
    public function faculties()
    {
        $data = [
            'faculties' => $this->facultyModel->withDepartments()->where('school_id', session()->get('school_id'))->findAll(),
            'page' => 'faculties'
        ];
        return view('admin/academic/index', $data);
    }

    public function createFaculty()
    {
        $data = [
            'school_id' => session()->get('school_id'),
            'name' => $this->request->getPost('name'),
            'code' => $this->request->getPost('code')
        ];
        // $this->facultyModel->create($data);
        $this->facultyModel->insert(['school_id' => session()->get('school_id'),
            'name' => $this->request->getPost('name'),
            'code' => $this->request->getPost('code')
            ]);
        toast('Faculty created.');
        return redirect()->back();
    }

    public function updateFaculty($id)
    {
        $data = $this->request->getPost(['name', 'code']);
        $this->facultyModel->updateItem($id, $data);
        toast('Faculty updated.');
        return redirect()->back();
    }

    public function deleteFaculty($id)
    {
        $this->facultyModel->deleteItem($id);
        toast('Faculty deleted.');
        return redirect()->back();
    }

    // === DEPARTMENTS ===
    public function departments($facultyId)
    {
        $faculty = $this->facultyModel->find($facultyId);
        $data = [
            'faculty' => $faculty,
            'departments' => $this->departmentModel->withCourses()->where('faculty_id', $facultyId)->findAll(),
            'page' => 'departments'
        ];
        return view('admin/academic/index', $data);
    }
    public function allDepartments()
{
    $data = [
        'departments' => $this->departmentModel
            ->select('departments.*, faculties.name as faculty_name')
            ->join('faculties', 'faculties.id = departments.faculty_id')
            ->where('faculties.school_id', session()->get('school_id'))
            ->findAll(),
        'page' => 'all_departments'
    ];

    return view('admin/academic/departments_all', $data);
}
public function appliedCourses($department_id)
{
    $department = $this->departmentModel->find($department_id);

    if (!$department) {
        return redirect()->back()->with('error', 'Department not found');
    }

    $data = [
        'department' => $department,
        'courses' => $this->courseAppliedModel->getByDepartment($department_id),
        'page' => 'applied_courses'
    ];

    return view('admin/academic/applied_courses', $data);
}
public function createAppliedCourse()
{
    $this->courseAppliedModel->save([
        'department_id' => $this->request->getPost('department_id'),
        'name' => $this->request->getPost('name'),
        'code' => $this->request->getPost('code'),
        'duration' => $this->request->getPost('duration'),
        'level' => $this->request->getPost('level'),
        'school_id' => session()->get('school_id'),
    ]);

    return redirect()->back()->with('success', 'Course added');
}
public function updateAppliedCourse($id)
{
    $this->courseAppliedModel->update($id, [
        'name' => $this->request->getPost('name'),
        'code' => $this->request->getPost('code'),
        'duration' => $this->request->getPost('duration'),
        'level' => $this->request->getPost('level'),
    ]);

    return redirect()->back()->with('success', 'Course updated');
}
public function deleteAppliedCourse($id)
{
    $this->courseAppliedModel->delete($id);
    return redirect()->back()->with('success', 'Course removed');
}





    public function createDepartment()
    {
        $data = [
            'faculty_id' => $this->request->getPost('faculty_id'),
            'name' => $this->request->getPost('name'),
            'code' => $this->request->getPost('code')
        ];
        // $this->departmentModel->create($data);
 $this->departmentModel->insert([ 'faculty_id' => $this->request->getPost('faculty_id'),
            'name' => $this->request->getPost('name'),
            'code' => $this->request->getPost('code')
            ]);
        toast('Department created.');
        return redirect()->back();
    }

    public function updateDepartment($id)
    {
        $data = $this->request->getPost(['name', 'code']);
        $this->departmentModel->updateItem($id, $data);
        toast('Department updated.');
        return redirect()->back();
    }

    public function deleteDepartment($id)
    {
        $this->departmentModel->deleteItem($id);
        toast('Department deleted.');
        return redirect()->back();
    }

    // === COURSES ===
    public function courses($departmentId)
    {
        $department = $this->departmentModel->find($departmentId);
        $faculty = $this->facultyModel->find($department['faculty_id']);
        $data = [
            'department' => $department,
            'faculty' => $faculty,
            'courses' => $this->courseModel->where('department_id', $departmentId)->findAll(),
            'page' => 'courses'
        ];
        return view('admin/academic/index', $data);
    }

    public function createCourse()
    {
        $data = $this->request->getPost(['department_id', 'code', 'title', 'level', 'units', 'session', 'semester']);
        // $this->courseModel->create($data);
        $this->courseModel->insert($data);
        
        toast('Course created.');
        return redirect()->back();
    }

    public function updateCourse($id)
    {
        $data = $this->request->getPost(['code', 'title', 'level', 'units', 'session', 'semester']);
        $this->courseModel->updateItem($id, $data);
        toast('Course updated.');
        return redirect()->back();
    }

    public function deleteCourse($id)
    {
        $this->courseModel->deleteItem($id);
        toast('Course deleted.');
        return redirect()->back();
    }
}