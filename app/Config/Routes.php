<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'MainPage::index');
$routes->get('/developing', 'MainPage::developing');
$routes->post('form/validateStep', 'Getdata::validateStep');
$routes->post('add', 'Getdata::addDataset');
$routes->get('test', 'Getdata::testDatabaseConnection');
$routes->get('testUser', 'Getdata::testManualInsert');
$routes->get('view/(:segment)', 'Viewdata::index/$1');
$routes->get('detail/(:segment)', 'Viewdata::view/$1');

$routes->post('delete', 'Viewdata::delete');
$routes->post('archive', 'Viewdata::archive');
$routes->post('restore', 'Viewdata::restore');
$routes->get('editdata', 'Viewdata::requestAccess');
$routes->post('viewdata/requestAccess', 'Viewdata::requestAccess');
$routes->post('viewdata/viewDetail', 'Viewdata::getDatasetDetails');
$routes->post('viewdata/viewDetail', 'Viewdata::getDatasetDetails');

$routes->get('update/(:segment)', 'Editdata::index/$1');
$routes->post('modify/(:segment)', 'Editdata::updateDatasetSection/$1');




$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('MainPage');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
