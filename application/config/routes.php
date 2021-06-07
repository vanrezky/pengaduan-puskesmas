<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['backend'] = 'backend/dashboard';
$route['backend/pasien/add'] = 'backend/pasien/data';
$route['backend/pasien/edit/(:any)'] = 'backend/pasien/data/$1';
$route['backend/pasien/update/(:any)'] = 'backend/pasien/save/$1';
$route['backend/pasien/jenis-save'] = 'backend/pasien/jenisSave';
$route['backend/pasien/jenis-save/(:any)'] = 'backend/pasien/jenisSave/$1';
$route['backend/pasien/jenis-delete/(:any)'] = 'backend/pasien/jenisDelete/$1';
$route['backend/pasien/jenis-get/(:any)'] = 'backend/tps/jenisGet/$1';

$route['backend/pengguna'] = 'backend/user';
$route['backend/pengguna/add'] = 'backend/user/data';
$route['backend/pengguna/edit/(:any)'] = 'backend/user/data/$1';
$route['backend/pengguna/save'] = 'backend/user/save';
$route['backend/pengguna/save/(:any)'] = 'backend/user/save/$1';
$route['backend/pengguna/update/(:any)'] = 'backend/user/save/$1';
$route['backend/pengguna/delete/(:any)'] = 'backend/user/delete/$1';


$route['backend/berita/add'] = 'backend/berita/data';
$route['backend/berita/edit/(:any)'] = 'backend/berita/data/$1';
$route['backend/berita/save'] = 'backend/berita/save';
$route['backend/berita/save/(:any)'] = 'backend/berita/save/$1';
$route['backend/berita/update/(:any)'] = 'backend/berita/save/$1';

$route['backend/berita/kategori/save'] = 'backend/berita/kategori_save';
$route['backend/berita/kategori/update/(:any)'] = 'backend/berita/kategori_save/$1';
$route['backend/berita/kategori/delete/(:any)'] = 'backend/berita/kategori_delete/$1';

$route['backend/pengaduan/kategori/save'] = 'backend/pengaduan/kategori_save';
$route['backend/pengaduan/kategori/update/(:any)'] = 'backend/pengaduan/kategori_save/$1';
$route['backend/pengaduan/kategori/delete/(:any)'] = 'backend/pengaduan/kategori_delete/$1';


$route['pengaduan'] = 'home/pengaduan';
$route['pengaduan/cek'] = 'home/pengaduan_cek';
$route['pengaduan/save'] = 'home/pengaduan_save';
$route['berita'] = 'home/berita';
$route['berita/(:num)'] = 'home/berita/$1';
$route['berita/(:any)'] = 'home/beritaSingle/$1';

$route['pdf/(:any)'] = 'cetak/index/$1';


$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
