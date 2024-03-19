<?php
  $routes = [
    '/' => 'HomeController@index',
    '/users' => 'UsersController@index',
    '/users/create' => 'UsersController@create',
    '/users/new' => 'UsersController@new',
    '/users/(?<id>\d+)' => 'UsersController@show',
    '/users/edit/(?<id>\d+)' => 'UsersController@edit',
    '/users/delete/(?<id>\d+)' => 'UsersController@delete',
    '/users/update/(?<id>\d+)' => 'UsersController@update',
    # Messages
    '/messages' => 'MessagesController@index',
    '/messages/create' => 'MessagesController@create',
    '/messages/new' => 'MessagesController@new',
    '/messages/(?<id>\d+)' => 'MessagesController@show',
    '/messages/edit/(?<id>\d+)' => 'MessagesController@edit',
    '/messages/delete/(?<id>\d+)' => 'MessagesController@delete',
    '/messages/update/(?<id>\d+)' => 'MessagesController@update',
  ];
?>