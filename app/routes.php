<?php

$routes[] = ['/', 'HomeController@index'];
$routes[] = ['/index', 'HomeController@index'];
$routes[] = ['/posts', 'PostsController@index'];
$routes[] = ['/posts/{id}/show', 'PostsController@show'];

return $routes;