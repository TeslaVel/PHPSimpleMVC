<?php

  $routes = [
    '/' => 'HomeController@index',
    # Users routes
    '/users' => ['middleware' => 'AuthMiddleware', 'action' => 'UsersController@index'],
    // '/users' => 'UsersController@index',
    '/users/{id}' => 'UsersController@show',
    '/users/edit/{id}' => 'UsersController@edit',
    '/users/delete/{id}' => 'UsersController@delete',
    '/users/update/{id}' => 'UsersController@update',
    # Sessions
    '/session/signin' => 'SessionController@signin',
    '/session/create' => 'SessionController@create',
    '/session/signup' => 'SessionController@signup',
    '/session/register' => 'SessionController@register',
    '/session/destroy' => 'SessionController@destroy',
    # Messages roues
    '/messages' => 'MessagesController@index',
    '/messages/create' => 'MessagesController@create',
    '/messages/{id}' => 'MessagesController@show',
    '/messages/edit/{id}' => 'MessagesController@edit',
    '/messages/delete/{id}' => 'MessagesController@delete',
    '/messages/update/{id}' => 'MessagesController@update',
    # Messages roues
    '/posts' => 'PostsController@index',
    '/posts/create' => 'PostsController@create',
    '/posts/new' => 'PostsController@new',
    '/posts/{id}' => 'PostsController@show',
    '/posts/edit/{id}' => 'PostsController@edit',
    '/posts/delete/{id}' => 'PostsController@delete',
    '/posts/update/{id}' => 'PostsController@update',
  ];