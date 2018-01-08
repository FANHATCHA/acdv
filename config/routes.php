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

//$route['default_controller'] = "admin/login";
$explodeurl = explode('/',$_SERVER['REQUEST_URI']);
//print_r($explodeurl);
if(isset($explodeurl[1]) && !empty($explodeurl[1]) && $explodeurl[1] !='admin' && count($explodeurl) == '2')
{
$route['(:any)']			 				= "page/view/$1"; 
}
else if(isset($explodeurl[1]) && !empty($explodeurl[1]) && ($explodeurl[1] !='admin' && $explodeurl[1] !='home' && $explodeurl[1] !='contact' && $explodeurl[1] != 'category' && $explodeurl[1] != 'type-de-voyage' &&  $explodeurl[1] != 'ajaxcall' && $explodeurl[1] != 'destination' && count($explodeurl) != '2' && count($explodeurl) == '3'))
{

$route['(:any)']			 				= "infospratiques/view/$1";
}
else
{
$route['default_controller'] 				= "home";
}
$route['default_controller'] 				= "home";
$route['404_override']					    = 'error_404';
$route['destination/(:any)'] 				= "destination/view/$1";
$route['type-de-voyage/(:any)'] 			= "tags/view/$1";
$route['(:any)/voyages/(:any)']			    = "voyages/view/$1";
$route['infos-pratiques(:any)/(:any)']		= "infospratiques/view/$1";
$route['(:any)/infos-pratiques']			= "infospratiqueslending/view/$1";
$route['blog/(:any)']						= "frontblog/view/$1";
$route['category/blog/(:any)'] 				= "frontblog/categoryview/$1";

$route['contactez-nous'] 					= "contact/index/$1";
$route['category/blog'] 					= "frontblog/index/$1";
$route['liste-de-mariage']   				= "maries/view/$1";
$route['avis-clients']    	 				= "clientreview/view/$1";
$route['qui-sommes-nous']  					= "quisommesnous/view/$1";
$route['demandededevis'] 	 				= "demandededevis/view/$1";
$route['lavis-de-nos-clients']    	 		= "clientreview/view/$1";
$route['promodemandededevis'] 	 			= "promodemandededevis/view/$1";


//$route['notre-agence/qui-sommes-nous']   = "quisommesnous/view/$1";
//$route['notre-agence/maries-et-mariage'] = "maries/view/$1";	
//$route['faq']  				 		 	  = 'page/view/$1';
//$route['infos-legales']   				  = 'page/view/$1';
//$route['ils-parlent-de-nous']    			  = 'page/view/$1';
//$route['credits-photos']   				  = 'page/view/$1';
//$route['partenaires']  			 		  = 'page/view/$1';
//$route['janvier'] 						  = "page/view/$1";
//$route['confirmation-envoi-message']   	  = "page/view/$1";
//$route['confirmation-demande-de-devis']     = "page/view/$1";




/* End of file routes.php */
/* Location: ./application/config/routes.php */