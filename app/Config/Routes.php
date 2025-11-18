<?php

// use CodeIgniter\Router\RouteCollection;

// /**
//  * @var RouteCollection $routes
//  */
// $routes->get('/', 'Home::index');

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

// Authentication Routes
$routes->get('/login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Public Routes
$routes->get('/', 'Applicant\Home::index');
$routes->get('apply', 'Applicant\Application::index');
$routes->post('apply/submit', 'Applicant\Application::submit');

// Admin Routes (Protected)
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('toggle/application/(:num)', 'Admin\Dashboard::toggleApplication/$1');
    $routes->post('update-session-status', 'Admin\Dashboard::updateSessionStatus');
    $routes->post('update-session-semester', 'Admin\Dashboard::updateSessionSemester');
    $routes->get('switch-school/(:num)', 'Admin\Dashboard::switchSchool/$1');
    $routes->get('exam-officers', 'Admin\Dashboard::examOfficers');
    $routes->post('exam-officers/create', 'Admin\Dashboard::createExamOfficer');
    $routes->post('setSession', 'Admin\Dashboard::setSession');
    $routes->get('results/activate', 'Admin\Dashboard::activateResults');
    $routes->get('registration/list', 'Admin\Dashboard::registrationList');
    $routes->get('users', 'Admin\UserManagement::index');
    $routes->post('users/create', 'Admin\UserManagement::create');
    $routes->get('users/toggle/(:num)', 'Admin\UserManagement::toggleStatus/$1');
    $routes->get('users/reset-password/(:num)', 'Admin\UserManagement::resetPassword/$1');
});

$routes->group('admin/academic', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('faculties', 'Admin\Academic::faculties');
    // $routes->get('departments', 'Admin\Academic::departments');
    $routes->post('faculties/create', 'Admin\Academic::createFaculty');
    $routes->post('faculties/update/(:num)', 'Admin\Academic::updateFaculty/$1');
    $routes->get('faculties/delete/(:num)', 'Admin\Academic::deleteFaculty/$1');

    $routes->get('departments/(:num)', 'Admin\Academic::departments/$1');
    $routes->get('departments', 'Admin\Academic::allDepartments');
    $routes->post('departments/create', 'Admin\Academic::createDepartment');
    $routes->post('departments/update/(:num)', 'Admin\Academic::updateDepartment/$1');
    $routes->get('departments/delete/(:num)', 'Admin\Academic::deleteDepartment/$1');

    $routes->get('courses/(:num)', 'Admin\Academic::courses/$1');
    $routes->post('courses/create', 'Admin\Academic::createCourse');
    $routes->post('courses/update/(:num)', 'Admin\Academic::updateCourse/$1');
    $routes->get('courses/delete/(:num)', 'Admin\Academic::deleteCourse/$1');

    // COURSES APPLIED UNDER A DEPARTMENT
$routes->get('applied-courses/(:num)', 'Admin\Academic::appliedCourses/$1');
$routes->post('applied-courses/create', 'Admin\Academic::createAppliedCourse');
$routes->post('applied-courses/update/(:num)', 'Admin\Academic::updateAppliedCourse/$1');
$routes->get('applied-courses/delete/(:num)', 'Admin\Academic::deleteAppliedCourse/$1');

});

$routes->group('admin/fees', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('/', 'Admin\FeeStructure::index');
    $routes->post('create', 'Admin\FeeStructure::create');
    $routes->post('update/(:num)', 'Admin\FeeStructure::update/$1');
    $routes->get('delete/(:num)', 'Admin\FeeStructure::delete/$1');
    $routes->get('export', 'Admin\FeeStructure::export');
});
// Student Routes (Protected)
// $routes->group('student', ['filter' => 'role:student'], function ($routes) {
//     $routes->get('dashboard', 'Student\Dashboard::index');
//     $routes->get('courses', 'Student\Dashboard::courses');
//     $routes->get('results', 'Student\Dashboard::results');
//     $routes->get('transcript', 'Student\Dashboard::transcript');
//     $routes->get('documents', 'Student\Dashboard::documents');
//     $routes->get('support', 'Student\Dashboard::support');
// });
$routes->group('student', ['filter' => 'role:student'], function($routes) {
    $routes->get('dashboard', 'Student\Dashboard::index');
    $routes->get('courses/register', 'Student\CourseRegistration::index');
    $routes->post('courses/register/save', 'Student\CourseRegistration::save');
    $routes->get('results', 'Student\Results::index');
    $routes->get('fees', 'Student\Fees::index');
    $routes->get('payments', 'Student\Payments::index');
    $routes->get('transcript', 'Student\Transcript::generate');
    $routes->get('support', 'Student\Support::index');
    $routes->post('support/create', 'Student\Support::create');
});

// Bursary Routes (Protected)
$routes->group('bursary', ['filter' => 'role:bursary'], function ($routes) {
    $routes->get('dashboard', 'Bursary\Dashboard::index');
    $routes->get('stats', 'Bursary\Dashboard::statistics');
    $routes->get('payments', 'Bursary\Dashboard::payments');
    $routes->get('query/(:num)', 'Bursary\Dashboard::queryPayment/$1');
});

// Registration Routes (Protected)
$routes->group('registration', ['filter' => 'role:admin,student'], function ($routes) {
    $routes->get('form', 'Registration\Dashboard::form');
    $routes->post('submit', 'Registration\Dashboard::submit');
});

// Results Routes (Protected)
$routes->group('results', ['filter' => 'role:exam_officer,admin'], function ($routes) {
    $routes->get('upload', 'Results\Dashboard::upload');
    $routes->post('upload', 'Results\Dashboard::uploadResults');
});

// Application Routes (Public for applicants, protected for admins)
$routes->group('application', function ($routes) {
    $routes->get('form', 'Application\Dashboard::form');
    $routes->post('submit', 'Application\Dashboard::submit');
    $routes->group('', ['filter' => 'role:admin'], function ($routes) {
        $routes->get('list', 'Application\Dashboard::list');
        $routes->post('admit', 'Application\Dashboard::admit');
        $routes->post('admit-bulk', 'Application\Dashboard::admitBulk');
    });
});

// Role Filter
$routes->addPlaceholder('role', 'admin|student|bursary|exam_officer');
// $routes->addFilter('role:(:role)', 'RoleFilter:$1');