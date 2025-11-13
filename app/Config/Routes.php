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

// Admin Routes (Protected)
$routes->group('admin', ['filter' => 'role:admin'], function ($routes) {
    $routes->get('dashboard', 'Admin\Dashboard::index');
    $routes->get('toggle-application/(:num)', 'Admin\Dashboard::toggleApplication/$1');
    $routes->get('switch-school/(:num)', 'Admin\Dashboard::switchSchool/$1');
    $routes->get('exam-officers', 'Admin\Dashboard::examOfficers');
    $routes->post('exam-officers/create', 'Admin\Dashboard::createExamOfficer');
    $routes->post('setSession', 'Admin\Dashboard::setSession');
    $routes->get('results/activate', 'Admin\Dashboard::activateResults');
    $routes->get('registration/list', 'Admin\Dashboard::registrationList');
});

// Student Routes (Protected)
$routes->group('student', ['filter' => 'role:student'], function ($routes) {
    $routes->get('dashboard', 'Student\Dashboard::index');
    $routes->get('courses', 'Student\Dashboard::courses');
    $routes->get('results', 'Student\Dashboard::results');
    $routes->get('transcript', 'Student\Dashboard::transcript');
    $routes->get('documents', 'Student\Dashboard::documents');
    $routes->get('support', 'Student\Dashboard::support');
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