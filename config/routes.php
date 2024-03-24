<?php

Router::group(array('before'=>'Test'),function(){
  Router::get('/', 'HomeController@index');
});
Router::group(array('before'=>'Auth'),function(){
  Router::get('/users', 'UsersController@index');
  Router::get('/users/{id}', 'UsersController@show');
  Router::get('/users/edit/{id}', 'UsersController@edit');
  Router::post('/users/delete/{id}', 'UsersController@delete');
  Router::post('/users/update/{id}', 'UsersController@update');

  Router::get('/messages', 'MessagesController@index');
  Router::post('/messages/create', 'MessagesController@create');
  Router::get('/messages/{id}', 'MessagesController@show');
  Router::get('/messages/edit/{id}', 'MessagesController@edit');
  Router::post('/messages/delete/{id}', 'MessagesController@delete');
  Router::post('/messages/update/{id}', 'MessagesController@update');

  Router::get('/posts', 'PostsController@index');
  Router::post('/posts/create', 'PostsController@create');
  Router::get('/posts/{id}', 'PostsController@show');
  Router::get('/posts/edit/{id}', 'PostsController@edit');
  Router::post('/posts/delete/{id}', 'PostsController@delete');
  Router::post('/posts/update/{id}', 'PostsController@update');

});

Router::get('/session/signin', 'SessionController@signin');
Router::post('/session/create', 'SessionController@create');
Router::get('/session/signup', 'SessionController@signup');
Router::post('/session/register', 'SessionController@register');
Router::post('/session/destroy', 'SessionController@destroy');