<?php
/**
* Implements hook_preprocess_page().
*/

function nnmx_preprocess_page(&$variables) {
  // Get the entire main menu tree
  $main_menu_tree = menu_tree_all_data('main-menu');
  //array_push($menu_mod[602]['#attributes']['class'], 'case-prueba');
  // Add the rendered output to the $main_menu_expanded variable
  $variables['main_menu_expanded'] = menu_tree_output($main_menu_tree);
}

/**
* Implements hook_preprocess_html().
*/
function nnmx_preprocess_html(&$vars) {
//agregar clase a body /*refinar este snippet cuando se definan las secciones*/
//con este snippet se asignaran las clases para cambio de color por seccion
//TODO- agregar condicionales para la seleccion de clases adecuadas
//$vars['classes_array'][] = 'style-deportes';
//$vars['classes_array'][] = 'style-estilo';
//$vars['classes_array'][] = 'style-roja';
//$vars['classes_array'][] = 'style-cultura';
//$vars['classes_array'][] = 'style-permanentes';

// Move JS files "$scripts" to page bottom for perfs/logic.
// Add JS files that *needs* to be loaded in the head in a new "$head_scripts" scope.
// For instance the Modernizr lib.
$path = drupal_get_path('theme', 'nnmx');
//drupal_add_js($path . '/js/modernizr.min.js', array('scope' => 'head_scripts', 'weight' => -1, 'preprocess' => FALSE));
//drupal_add_js($path . '/js/pollyfills/html5shiv.js', array('scope' => 'head_scripts', 'weight' => -1, 'preprocess' => FALSE));
}

/**
* Implements hook_process_html().
*/
function nnmx_process_html(&$vars) {
$vars['head_scripts'] = drupal_get_js('head_scripts');
}
// Change menu ul class
function nnmx_menu_tree__main_menu(&$vars) {
  return '<ul class="menu-responsive">' . $vars['tree'] . '</ul>';
 }

 // change li menu class
 function nnmx_menu_link(&$vars){  
  if ($vars['element']['#theme']== 'menu_link__main_menu')  
    {  
      $vars['element']['#attributes']['class'][] = 'cosas';  
    }    
  return theme_menu_link($vars);  
}   