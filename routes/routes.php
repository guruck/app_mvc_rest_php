<?php
 use Src\Route as Route;
//Login
 Route::get(['set' => '/login', 'as' => 'login.entrar'], 'Login@entrar');
 Route::post(['set' => '/login', 'as' => 'login.entrar'], 'Login@entrar');
 Route::get(['set' => '/logout', 'as' => 'login.sair'], 'Login@sair');

//Cliente
 Route::get(['set' => '/cliente', 'as' => 'clientes.index'], 'Cliente@index');
 Route::get(['set' => '/cliente/{id}/show', 'as' => 'clientes.show'], 'Cliente@show');

 //Teste
 Route::get(['set' => '/', 'as' => 'lista.index'], 'Lista@index');
 Route::get(['set' => '/teste', 'as' => 'lista.teste'], 'Lista@teste');
 Route::get(['set' => '/lista', 'as' => 'lista.index'], 'Lista@index');
 Route::get(['set' => '/lista/{id}/show', 'as' => 'lista.show'], 'Lista@show');

  //Menus
  Route::get(['set' => '/batata', 'as' => 'menu.index'], 'Menu@index');
  Route::get(['set' => '/batata/{id}/delete', 'as' => 'menu.delete'], 'Menu@delete');
  Route::get(['set' => '/batata/{id}/edit', 'as' => 'menu.edit'], 'Menu@edit');
  Route::get(['set' => '/batata/new', 'as' => 'menu.novo'], 'Menu@novo');
  Route::post(['set' => '/batata/update', 'as' => 'menu.save'], 'Menu@save');
  Route::post(['set' => '/batata/{id}/update', 'as' => 'menu.update'], 'Menu@update');
  // Route::get(['set' => '/menu/{id}/show', 'as' => 'menu.show'], 'Menu@show');

  //Usuarios
  Route::get(['set' => '/selfpassword/{id}', 'as' => 'usuarios.selfpassword'], 'Usuarios@selfpassword');
  Route::post(['set' => '/selfpassword/update', 'as' => 'usuarios.updateSelfPassword'], 'Usuarios@updateSelfPassword');
  Route::get(['set' => '/accounts', 'as' => 'usuarios.index'], 'Usuarios@index');
  Route::get(['set' => '/accounts/{id}/edit', 'as' => 'usuarios.atualiza'], 'Usuarios@atualiza');
  Route::post(['set' => '/accounts/{id}/update', 'as' => 'usuarios.atualiza'], 'Usuarios@atualiza');
  Route::get(['set' => '/accounts/new', 'as' => 'usuarios.novo'], 'Usuarios@novo');
  Route::post(['set' => '/accounts/update', 'as' => 'usuarios.novo'], 'Usuarios@novo');
  Route::get(['set' => '/accounts/{id}/delete', 'as' => 'usuarios.delete'], 'Usuarios@delete');