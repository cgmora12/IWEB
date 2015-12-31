<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';

/* Rutas personalizadas, para hacerlo un poco más API REST
 * Lo de la izquierda es la URL del navegador - Lo de la derecha es el método del controlador al cual se llamará
 */
$route['vistoEnLasRedes/aportaciones/(:num)'] = "/vistoEnLasRedes/verAportacion/$1";
$route['vistoEnLasRedes/aportaciones/(:num)/comentarAportacion'] = "/vistoEnLasRedes/comentarAportacion/$1";
$route['vistoEnLasRedes/aportaciones/enviarAportacion'] = "/vistoEnLasRedes/enviarAportacion";
$route['vistoEnLasRedes/aportaciones/guardarAportacion'] = "/vistoEnLasRedes/guardarAportacion";
$route['vistoEnLasRedes/aportaciones/(:num)/reportarAportacion'] = "/vistoEnLasRedes/reportarAportacion/$1";
$route['vistoEnLasRedes/aportaciones/(:num)/guardarReporteAportacion'] = "/vistoEnLasRedes/guardarReporteAportacion/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */