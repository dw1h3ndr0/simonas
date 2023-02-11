<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');



Route::group(['middleware' => ['auth','checkRole:admin']], function(){
	
	//Route Petugas
	Route::get('/petugas','PetugasController@index')->name('petugas');
	Route::post('/petugas/tambah','PetugasController@tambah')->name('petugas.tambah');
	Route::get('/petugas/edit','PetugasController@edit')->name('petugas.edit');
	Route::post('/petugas/update','PetugasController@update')->name('petugas.update');
	Route::get('/petugas/{id}/delete','PetugasController@delete')->name('petugas.delete');
	Route::get('petugas/{id}/konfirmasi','PetugasController@konfirmasi')->name('petugas.konfirmasi');
	Route::get('petugas/export_excel', 'PetugasController@export_excel')->name('petugas.export_excel');
	Route::post('petugas/import_excel', 'PetugasController@import_excel')->name('petugas.import_excel');
	Route::get('/petugas/{id}/jabatan', 'PetugasController@getJabatan');

	//Route Supervisor
	Route::get('/supervisor','SupervisorController@index')->name('supervisor');
	Route::post('/supervisor/tambah','SupervisorController@tambah')->name('supervisor.tambah');
	Route::get('/supervisor/edit','SupervisorController@edit')->name('supervisor.edit');
	Route::post('/supervisor/update','SupervisorController@update')->name('supervisor.update');
	Route::get('/supervisor/{id}/delete','SupervisorController@delete')->name('supervisor.delete');
	Route::get('supervisor/{id}/konfirmasi','SupervisorController@konfirmasi')->name('supervisor.konfirmasi');
	Route::get('supervisor/export_excel', 'SupervisorController@export_excel')->name('supervisor.export_excel');
	Route::post('supervisor/import_excel', 'SupervisorController@import_excel')->name('supervisor.import_excel');

	//Route DSBS
	Route::get('/dsbs','DSBSController@index')->name('dsbs');
	Route::get('/dsbs/tambah','DSBSController@tambah')->name('dsbs.tambah');
	Route::post('/dsbs/create','DSBSController@create')->name('dsbs.create');
	Route::get('/dsbs/{id}/edit','DSBSController@edit')->name('dsbs.edit');
	Route::post('/dsbs/{id}/update','DSBSController@update')->name('dsbs.update');
	Route::get('/dsbs/{id}/lihat','DSBSController@lihat')->name('dsbs.lihat');
	Route::get('/dsbs/{id}/delete','DSBSController@delete')->name('dsbs.delete');
	Route::get('dsbs/{id}/konfirmasi','DSBSController@konfirmasi')->name('dsbs.konfirmasi');
	Route::get('dsbs/export_excel', 'DSBSController@export_excel')->name('dsbs.export_excel');
	Route::post('dsbs/import_excel', 'DSBSController@import_excel')->name('dsbs.import_excel');

	//Route Alokasi Petugas
	Route::get('/alokasi','AlokasiController@index')->name('alokasi');
	Route::get('/alokasi/tambah','AlokasiController@tambah')->name('alokasi.tambah');
	Route::post('/alokasi/create','AlokasiController@create')->name('alokasi.create');
	Route::get('/alokasi/{id}/edit','AlokasiController@edit')->name('alokasi.edit');
	Route::post('/alokasi/{id}/update','AlokasiController@update')->name('alokasi.update');
	Route::get('/alokasi/{id}/lihat','AlokasiController@lihat')->name('alokasi.lihat');
	Route::get('/alokasi/{id}/delete','AlokasiController@delete')->name('alokasi.delete');
	Route::get('alokasi/{id}/konfirmasi','AlokasiController@konfirmasi')->name('alokasi.konfirmasi');
	Route::get('alokasi/export_excel', 'AlokasiController@export_excel')->name('alokasi.export_excel');
	Route::get('alokasi/export_petugas', 'AlokasiController@export_petugas')->name('alokasi.export_petugas');
	Route::post('alokasi/import_excel', 'AlokasiController@import_excel')->name('alokasi.import_excel');

	//Route Rekap
	Route::get('/rekap/sampel','RekapController@index_sampel')->name('rekap.sampel');
	Route::get('/rekap/sampel/{kode_kegiatan}/{kode_nks}/refresh','RekapController@refresh_sampel')->name('rekap.sampel.refresh');	
	Route::get('rekap/sampel/export_excel', 'RekapController@export_excel_sampel')->name('rekap.sampel.export_excel');
	Route::get('/rekap/dokumen','RekapController@index_dokumen')->name('rekap.dokumen');
	Route::get('/rekap/dokumen/{kode_kegiatan}/{kode_nks}/refresh','RekapController@refresh_dokumen')->name('rekap.dokumen.refresh');
	Route::get('rekap/dokumen/export_excel', 'RekapController@export_excel_dokumen')->name('rekap.dokumen.export_excel');
	Route::get('/rekap/listing','RekapController@index_listing')->name('rekap.listing');
	Route::get('/rekap/listing/{kode_kegiatan}/{kode_nks}/refresh','RekapController@refresh_listing')->name('rekap.listing.refresh');
	Route::get('rekap/listing/export_excel', 'RekapController@export_excel_listing')->name('rekap.listing.export_excel');

	//Route Pesan
	Route::get('/pesan','PesanController@index')->name('pesan');
	Route::post('/pesan/send', 'PesanController@send')->name('pesan.send');
});


Route::group(['middleware' => ['auth','checkRole:admin,user']], function(){
	
	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');	
	Route::get('/petugas/{id}/profil', 'PetugasController@profil')->name('petugas.profil');	
	Route::post('/petugas/{id}/updateprofil', 'PetugasController@updateprofil')->name('petugas.updateprofil');

	//Rubah Password
	Route::get('/change-password/{id}', 'ChangePasswordController@index')->name('change.password.get');
	Route::post('/change-password/{id}/{page}', 'ChangePasswordController@store')->name('change.password.post');

	//dynamic dropdown pilih wilayah
	Route::get('/kegiatan','KegiatanController@getProvinsi');
	Route::get('/provinsi/{kode_provinsi}','ProvinsiController@getKabupaten');
	Route::get('/kabupaten/{kode_provinsi}/{kode_kabupaten}','KabupatenController@getKecamatan');
	Route::get('/kecamatan/{kode_provinsi}/{kode_kabupaten}/{kode_kecamatan}','KecamatanController@getDesa');
	Route::get('/desa/{kode_kegiatan}/{kode_provinsi}/{kode_kabupaten}/{kode_kecamatan}/{kode_desa}','DesaController@getNKS');

	//Route Sampel
	Route::get('/sampel','SampelController@index')->name('sampel');
	Route::get('/sampel/{kode_kegiatan}/{kode_nks}/{kode_nus}/{page}/edit','SampelController@edit')->name('sampel.edit');
	Route::post('/sampel/{page}/update','SampelController@update')->name('sampel.update');
	Route::get('/sampel/input','SampelController@input')->name('sampel.input');
	Route::get('/sampel/{kode_kegiatan}/{kode_nks}/refresh','SampelController@refresh')->name('sampel.refresh');
	Route::post('sampel/import_excel', 'SampelController@import_excel')->name('sampel.import_excel');
	Route::get('sampel/progres', 'SampelController@progres')->name('sampel.progres');

	//Route Dokumen
	Route::get('/dokumen','DokumenController@index')->name('dokumen');
	Route::get('/dokumen/{kode_kegiatan}/{kode_nks}/{kode_nus}/{page}/edit','DokumenController@edit')->name('dokumen.edit');
	Route::post('/dokumen/{page}/update','DokumenController@update')->name('dokumen.update');
	Route::get('/dokumen/input','DokumenController@input')->name('dokumen.input');
	Route::get('/dokumen/{kode_kegiatan}/{kode_nks}/refresh','DokumenController@refresh')->name('dokumen.refresh');
	Route::post('dokumen/import_excel', 'DokumenController@import_excel')->name('dokumen.import_excel');
	Route::get('dokumen/progres', 'DokumenController@progres')->name('dokumen.progres');

	//Route Listing
	Route::get('/listing','ListingController@index')->name('listing');
	Route::get('/listing/{kode_kegiatan}/{kode_nks}/{page}/edit','ListingController@edit')->name('listing.edit');
	Route::post('/listing/{page}/update','ListingController@update')->name('listing.update');
	Route::get('/listing/input','ListingController@input')->name('listing.input');
	Route::get('/listing/{kode_kegiatan}/{kode_nks}/refresh','ListingController@refresh')->name('listing.refresh');
	Route::post('listing/import_excel', 'ListingController@import_excel')->name('listing.import_excel');
	Route::get('listing/progres', 'ListingController@progres')->name('listing.progres');


});
