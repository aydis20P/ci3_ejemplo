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
$route['construye'] = 'start';
$route['destruye'] = 'start/destruye';
$route['reinicia'] = 'start/reinicia';
$route['music/canciones'] = 'music/get_canciones';
$route['music/usuarios'] = 'music/get_usuarios';
$route['music/usuarios_cancion'] = 'music/get_usuarios_cancion';
$route['music/usuarios_cancion/create'] = 'music/create_usuario_cancion';
$route['music/usuarios_cancion/delete/(:any)'] = 'music/delete_usuario_cancion/$1';
$route['music/playlist_usuario/(:any)'] = 'music/get_playlist_usuario/$1';
$route['music/usuarios_cancion/(:any)'] = 'music/get_usuario_cancion/$1';
$route['music/canciones/(:any)'] = 'music/get_cancion/$1';
$route['music/usuarios/(:any)'] = 'music/get_usuario';
$route['music/usuarios/(:any)/(:any)'] = 'music/get_usuario';
$route['music'] = 'music';
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
