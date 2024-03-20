<?php
  $routes = [
    '/' => 'HomeController@index',
    # Users routes
    '/users' => 'UsersController@index',
    '/users/(?<id>\d+)' => 'UsersController@show',
    '/users/edit/(?<id>\d+)' => 'UsersController@edit',
    '/users/delete/(?<id>\d+)' => 'UsersController@delete',
    '/users/update/(?<id>\d+)' => 'UsersController@update',
    # Sessions
    '/session/signin' => 'SessionController@signin',
    '/session/create' => 'SessionController@create',
    '/session/signup' => 'SessionController@signup',
    '/session/register' => 'SessionController@register',
    '/session/destroy' => 'SessionController@destroy',
    # Messages roues
    '/messages' => 'MessagesController@index',
    '/messages/create' => 'MessagesController@create',
    '/messages/new' => 'MessagesController@new',
    '/messages/(?<id>\d+)' => 'MessagesController@show',
    '/messages/edit/(?<id>\d+)' => 'MessagesController@edit',
    '/messages/delete/(?<id>\d+)' => 'MessagesController@delete',
    '/messages/update/(?<id>\d+)' => 'MessagesController@update',
  ];
?>