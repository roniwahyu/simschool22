<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::attemptRegister');
$routes->get('/forgot-password', 'AuthController::forgotPassword');
$routes->post('/forgot-password', 'AuthController::attemptForgotPassword');
$routes->get('/reset-password', 'AuthController::resetPassword');
$routes->post('/reset-password', 'AuthController::attemptResetPassword');

// Dashboard Routes
$routes->group('dashboard', function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('stats', 'Dashboard::stats');
});

// Students Management Routes
$routes->group('students', function ($routes) {
    $routes->get('/', 'Students::index');
    $routes->get('create', 'Students::create');
    $routes->post('store', 'Students::store');
    $routes->get('edit/(:num)', 'Students::edit/$1');
    $routes->post('update/(:num)', 'Students::update/$1');
    $routes->delete('delete/(:num)', 'Students::delete/$1');
    $routes->get('view/(:num)', 'Students::view/$1');
    $routes->post('bulk-delete', 'Students::bulkDelete');
    $routes->get('export', 'Students::export');
});

// Classes Management Routes
$routes->group('classes', function ($routes) {
    $routes->get('/', 'Classes::index');
    $routes->get('create', 'Classes::create');
    $routes->post('store', 'Classes::store');
    $routes->get('edit/(:num)', 'Classes::edit/$1');
    $routes->post('update/(:num)', 'Classes::update/$1');
    $routes->delete('delete/(:num)', 'Classes::delete/$1');
    $routes->get('sections/(:num)', 'Classes::getSections/$1');
});

// Sections Management Routes
$routes->group('sections', function ($routes) {
    $routes->get('/', 'Sections::index');
    $routes->get('create', 'Sections::create');
    $routes->post('store', 'Sections::store');
    $routes->get('edit/(:num)', 'Sections::edit/$1');
    $routes->post('update/(:num)', 'Sections::update/$1');
    $routes->delete('delete/(:num)', 'Sections::delete/$1');
});

// Rooms Management Routes
$routes->group('rooms', function ($routes) {
    $routes->get('/', 'Rooms::index');
    $routes->get('create', 'Rooms::create');
    $routes->post('store', 'Rooms::store');
    $routes->get('edit/(:num)', 'Rooms::edit/$1');
    $routes->post('update/(:num)', 'Rooms::update/$1');
    $routes->delete('delete/(:num)', 'Rooms::delete/$1');
    $routes->get('schedule/(:num)', 'Rooms::schedule/$1');
});

// Academic Management Routes
$routes->group('academic', function ($routes) {
    $routes->get('/', 'Academic::index');
    $routes->get('sessions', 'Academic::sessions');
    $routes->post('sessions/store', 'Academic::storeSessions');
    $routes->get('subjects', 'Academic::subjects');
    $routes->post('subjects/store', 'Academic::storeSubjects');
});

// Module Generator Routes
$routes->group('module-generator', function ($routes) {
    $routes->get('/', 'Whatsapp::index');
    $routes->get('create', 'ModuleGenerator::create');
    $routes->post('generate', 'ModuleGenerator::generate');
    $routes->get('form-builder', 'ModuleGenerator::formBuilder');
    $routes->post('save-form', 'ModuleGenerator::saveForm');
});