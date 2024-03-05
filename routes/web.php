<?php

use App\Http\Controllers\AulaController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EsqueceuSenhaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// rota de login
Route::get('/', [LoginController::class,'index'])->name('login');
Route::post('/logar', [LoginController::class,'logar'])->name('logar');
Route::get('/create-user-login', [LoginController::class,'create'])->name('login-create');
Route::post('/store-user-login',[LoginController::class,'store'])->name('login.store');

// rotas recuperar senha
Route::get('/esqueceu-senha',[EsqueceuSenhaController::class,'esqueceuSenhaForm'])->name('esqueceu-senha.form');
Route::post('/esqueceu-senha',[EsqueceuSenhaController::class,'recuperarSenha'])->name('recuperar.senha');
Route::post('/',[LoginController::class, 'index'])->name('password.reset');
Route::get('/reset-password/{token}', [EsqueceuSenhaController::class, 'showResetPassword'])->name('reset-password.show');
Route::post('/recuperar-senha',[EsqueceuSenhaController::class,'recuperarSenhaUpdate'])->name('recuperar-senha.update');

Route::group(['middleware'=>'auth'], function(){

    Route::get('/sair',[LoginController::class,'sair'])->name('sair');

    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');

    //rotas cursos
    Route::get('/index-curso',[CursoController::class,'index'])->name('curso.index');
    Route::get('/show-curso/{cursoId}', [CursoController::class, 'show'])->name('curso.show');
    Route::get('/create-curso',[CursoController::class, 'create'])->name('curso.create');
    Route::post('/store-curso',[CursoController::class,'store'])->name('curso.store');
    Route::get('/edit-curso/{cursoId}', [CursoController::class, 'edit'])->name('curso.edit');
    Route::put('/update-curso/{cursoId}',[CursoController::class,'update'])->name('curso.update');
    Route::delete('/destroy-curso/{cursoId}',[CursoController::class,'destroy'])->name('curso.destroy');
    Route::get('/pdf-curso',[CursoController::class,'gerarPdf'])->name('curso.pdf');

    // rotas aulas
    Route::get('/index-aula/{cursoId}',[AulaController::class,'index'])->name('aula.index');
    Route::get('/show-aula/{aulaId}',[AulaController::class,'show'])->name('aula.show');
    Route::get('/edit-aula/{aulaId}',[AulaController::class,'edit'])->name('aula.edit');
    Route::get('/create-aula/{cursoId}',[AulaController::class,'create'])->name('aula.create');
    Route::post('/store-aula',[AulaController::class,'store'])->name('aula.store');
    Route::get('/edit-aula/{aulaId}', [AulaController::class,'edit'])->name('aula.edit');
    Route::put('/update-aula/{aulaId}', [AulaController::class,'update'])->name('aula.update');
    Route::delete('/destroy-aula/{aulaId}', [AulaController::class,'destroy'])->name('aula.destroy');
    Route::get('/pdf-aula/{cursoId}', [AulaController::class, 'gerarPdf'])->name('aula.pdf');

    // rotas usuarios
    Route::get('/index-usuario',[UserController::class,'index'])->name('usuario.index');
    Route::get('/show-usuario/{usuario}',[UserController::class,'show'])->name('usuario.show');
    Route::get('/create-usuario',[UserController::class,'create'])->name('usuario.create');
    Route::post('/store-usuario',[UserController::class,'store'])->name('usuario.store');
    Route::get('/edit-usuario/{usuario}',[UserController::class,'edit'])->name('usuario.edit');
    Route::put('/update-usuario/{usuario}',[UserController::class,'update'])->name('usuario.update');
    Route::get('/edit-usuario-senha/{usuario}',[UserController::class,'editSenha'])->name('usuario.edit-senha');
    Route::put('/update-usuario-senha/{usuario}',[UserController::class,'updateSenha'])->name('usuario.update-senha');
    Route::delete('/destroy-usuario/{usuario}',[UserController::class,'destroy'])->name('usuario.destroy');
    Route::get('/pdf-usuario',[UserController::class, 'gerarPdf'])->name('usuario-pdf');

    // rotas perfil
    Route::get('/show-perfil',[PerfilController::class,'show'])->name('perfil-show');
    Route::get('/edit-perfil',[PerfilController::class,'edit'])->name('perfil-edit');
    Route::put('/update-perfil',[PerfilController::class,'update'])->name('perfil-update');
    Route::get('/edit-senha-perfil',[PerfilController::class,'editSenha'])->name('edit-senha-perfil');
    Route::put('/update-senha-perfil',[PerfilController::class,'updateSenha'])->name('update-perfil-senha');

    // rotas para tipos de usuarios
    Route::get('/index-role',[RoleController::class,'index'])->name('role-index');
    Route::get('/create-role',[RoleController::class,'create'])->name('role-create');
    Route::post('/store-role',[RoleController::class,'store'])->name('role-store');
    Route::get('/show-role',[RoleController::class,'show'])->name('role-show');
    Route::get('/edit-role/{roleId}',[RoleController::class,'edit'])->name('role-edit');
    Route::put('/update-role/{roleId}',[RoleController::class,'update'])->name('role-update');
    Route::delete('/destroy-role/{roleId}',[RoleController::class,'destroy'])->name('role-destroy');
    Route::get('/pdf-role',[RoleController::class, 'gerarPdf'])->name('role-pdf');

    // rotas par permissões do tipo de usuario
    Route::get('/index-role-permission/{roleId}',[RolePermissionController::class,'index'])->name('role-permission-index');
    Route::get('/update-role-permission/{roleId}/{permissionId}',[RolePermissionController::class,'update'])->name('role-permission-update');

    // rotas para paginas(permisssões)
    Route::get('/index-permission',[PermissionController::class,'index'])->name('permission-index');
    Route::get('/show-permission',[PermissionController::class,'show'])->name('permission-show');
    Route::get('/create-permission',[PermissionController::class,'create'])->name('permission-create');
    Route::post('/store-permission',[PermissionController::class,'store'])->name('permission-store');
    Route::get('/edit-permission/{permission}',[PermissionController::class,'edit'])->name('permission-edit');
    Route::put('/update-permission/{permission}',[PermissionController::class,'update'])->name('permission-update');
    Route::delete('/destroy-permission/{permission}',[PermissionController::class,'destroy'])->name('permission-destroy');
    Route::get('/pdf-permission',[PermissionController::class, 'gerarPdf'])->name('permission-pdf');
});
