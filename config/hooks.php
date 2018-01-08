<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$hook['post_controller_constructor'][] = array(  'class'    => 'MY_Hooks',

                                    'function' => 'index',

                                    'filename' => 'precontroller.php',

                                    'filepath' => 'hooks');
									



									
									