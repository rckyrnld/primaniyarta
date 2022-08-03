<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//frontend routes
$route['web'] = 'main/index';
$route['web/daftar'] = 'main/daftar_user';
$route['web/daftarsukses'] = 'main/daftar_sukses_eks';
$route['web/aktivasisukses'] = 'main/aktivasi_sukses_eks';
$route['web/login'] = 'main/login_eks';
$route['web/logingagal'] = 'main/login_gagal_eks';
$route['web/logout'] = 'main/eks_logout';
$route['akun'] = 'main/akun_beranda';
$route['akun/beranda'] = 'main/akun_beranda';
$route['akun/kategori'] = 'main/akun_kategori_eks';
$route['akun/konfirmasikategori'] = 'main/konfirmasi_kategori_eks';
$route['akun/profil'] = 'main/akun_profil_eks';
$route['akun/ceknpwp'] = 'main/akun_npwp_eks';
$route['akun/resetnpwp'] = 'main/reset_npwp_eks';
$route['akun/sudahterdaftar'] = 'main/sudah_terdaftar_eks';
$route['akun/kontak'] = 'main/akun_kontak_eks';
$route['akun/kontak/:num'] = 'main/akun_kontak_eks/$1';
$route['akun/produk'] = 'main/akun_produk_eks/form';
$route['akun/produk/form'] = 'main/akun_produk_eks/form';
$route['akun/produk/form/:num'] = 'main/akun_produk_eks/form/$1';
$route['akun/produk/survey'] = 'main/akun_produk_eks/survey';
$route['akun/bahanbaku'] = 'main/akun_bahanbaku_eks/form';
$route['akun/bahanbaku/form'] = 'main/akun_bahanbaku_eks/form';
$route['akun/bahanbaku/form/(:num)'] = 'main/akun_bahanbaku_eks/form/$1';
$route['akun/bahanbaku/survey'] = 'main/akun_bahanbaku_eks/survey';
$route['akun/penjualan'] = 'main/akun_penjualan_eks/nilai';
$route['akun/penjualan/nilai'] = 'main/akun_penjualan_eks/nilai';
$route['akun/penjualan/nilai/(:num)'] = 'main/akun_penjualan_eks/nilai/$1';
$route['akun/penjualan/ekspor'] = 'main/akun_penjualan_eks/ekspor';
$route['akun/penjualan/ekspor/(:num)'] = 'main/akun_penjualan_eks/ekspor/$1';
$route['akun/penjualan/survey'] = 'main/akun_penjualan_eks/survey';
$route['akun/kepaladaerah/profil'] = 'main/kepala_daerah_profil';
$route['akun/kepaladaerah/kebijakan'] = 'main/kepala_daerah_kebijakan';
$route['akun/kepaladaerah/kebijakan/(:any)'] = 'main/kepala_daerah_kebijakan/$1';
$route['akun/kepaladaerah/hapuskebijakan/(:any)'] = 'main/kepala_daerah_kebijakan_hapus/$1';
$route['akun/kepaladaerah/kisah'] = 'main/kepala_daerah_kisah';
$route['aktivasi/(:any)'] = 'main/aktivasi/$1';

