<?php

/*
* FUNCIONES PARA LLAMAR AL MENU PRINCIPAL
*/
//funciones para llamar el arbol de menu con active trail 
function menu_tree_active_trail(&$tree_data, $menu_item) {
  foreach($tree_data as &$item) {
    if(!empty($item['link']) && $item['link']['href'] == $menu_item['href']) {
      $item['link']['in_active_trail'] = TRUE;
      return TRUE;
    } elseif(!empty($item['below'])) {
      if(menu_tree_active_trail($item['below'], $menu_item)) {
        $item['link']['in_active_trail'] = TRUE;
        return TRUE;
      }
    }
  }
  return FALSE;
}

function menu_tree_all_data_with_active_trail($menu_name) {
  $menu_item = menu_get_item();
  $menu_tree = menu_tree_all_data($menu_name);
  menu_tree_active_trail($menu_tree, $menu_item);
  return $menu_tree;
}

// Sobre escribimos funciones de menu para agregar clases al arbol del menu principal (main_menu)
// Change menu ul class
function nnmx_menu_tree__main_menu(&$vars) {
  return '<ul class="menu-responsive">' . $vars['tree'] . '</ul>';
 }

 // change li menu class
 function nnmx_menu_link(&$vars){  
  if ($vars['element']['#theme']== 'menu_link__main_menu')  
    {  
      //$vars['element']['#attributes']['class'][] = 'cosas';  
    }    
  return theme_menu_link($vars);  
}   
//Fin de las funciones de menu


/**
* Implements hook_preprocess().
*/
function nnmx_preprocess(&$vars) {

/* El siguiente procedimiento asigna a la variable main_menu_expanded el menu principal completamente construido.
*/
// obtenemos el arbol del menu
  $main_menu_tree = menu_tree_all_data_with_active_trail('main-menu');
  // agregamos el menu rendereado (construido con el marcado html apropiado) y lo agregamos a la variable de tema main_menu_expanded
  $vars['main_menu_expanded'] = menu_tree_output($main_menu_tree);


/*si no es nodo buscamos en la url para agregar la clase adecuada para cada seccion *Esto se hace asi ya que si es nodo 
buscaremos los terminos de taxonomia para agregar la clase de seccion esto con la finalidad de no depender de la url ya que 
en ciertas ocaciones puede estar erronea y para no afectar el SEO no se puede cambiar*
*/
//clases: style-deportes, style-estilo, style-roja, style-cultura, style-permanentes
  if (arg(0) != 'node' && !is_numeric(arg(1))) {
    $path_section = explode("/", current_path());
    if(count($path_section) > 1) {
      switch($path_section[1]) {
        case 'deporte':
          $vars['classes_array'][] = 'style-deportes';
          $vars['logo'] = $GLOBALS['base_path'] . drupal_get_path('theme', 'nnmx') . '/images/verde.png';
        break;
        case 'fama':
          $vars['classes_array'][] = 'style-estilo';
          $vars['logo'] = $GLOBALS['base_path'] . drupal_get_path('theme', 'nnmx') . '/images/rosa.png';
        break;
        case 'arte':
          $vars['classes_array'][] = 'style-cultura';
          $vars['logo'] = $GLOBALS['base_path'] . drupal_get_path('theme', 'nnmx') . '/images/naranja.png';
        break;
        case 'rojas':
          $vars['classes_array'][] = 'style-roja';
          $vars['logo'] = $GLOBALS['base_path'] . drupal_get_path('theme', 'nnmx') . '/images/roja.png';
        break;
      }
    }
  } else {
    $temp_node = node_load(arg(1));
    if(!empty($temp_node->field_edicion))
    foreach($temp_node->field_edicion['und'] as $item) {
      switch($item['taxonomy_term']->name) {
        case 'Deportes':
          $vars['classes_array'][] = 'style-deportes';
          $vars['logo'] = $GLOBALS['base_path'] . drupal_get_path('theme', 'nnmx') . '/images/verde.png';
        break;
        case 'Fama':
          $vars['classes_array'][] = 'style-estilo';
          $vars['logo'] = $GLOBALS['base_path'] . drupal_get_path('theme', 'nnmx') . '/images/rosa.png';
        break;
        case 'Cultura':
          $vars['classes_array'][] = 'style-cultura';
          $vars['logo'] = $GLOBALS['base_path'] . drupal_get_path('theme', 'nnmx') . '/images/naranja.png';
        break;
        case 'Roja':
          $vars['classes_array'][] = 'style-roja';
          $vars['logo'] = $GLOBALS['base_path'] . drupal_get_path('theme', 'nnmx') . '/images/roja.png';
        break;
      }
    }
  }


/* En esta funcion es donde agregamos script al scope head_script con el que agrupamos los scripts que forzosamente 
* se deben cargar en la cabecera.
*/
$path = drupal_get_path('theme', 'nnmx');
//drupal_add_js($path . '/js/modernizr.min.js', array('scope' => 'head_scripts', 'weight' => -1, 'preprocess' => FALSE));
drupal_add_js($path . '/js/pollyfills/html5shiv.js', array('scope' => 'head_scripts', 'weight' => -1, 'preprocess' => FALSE));
}

/**
* Implements hook_process_html().
*/
function nnmx_process_html(&$vars) {

/* Agregamos los scripts que tienen scope head_script a la variable de plantilla $head_scripts para que posteriormente
* puedan ser llamados dentro de la etiqueta <head>
*/
$vars['head_scripts'] = drupal_get_js('head_scripts');
}


//cambia la clase del sidebar content dependiendo de si hay 1 o 2 sidebars
function nnmx_check_sidebars($sb1, $sb2) {
  $r = 'col4';
  if(!$sb1 || !$sb2) {
    $r = 'col8';
  }

  if(!$sb1 && !$sb2) {
    $r = 'col12';
  }

  return $r;
}


//funcion custom breadcrumbs para el sitio
function nnmx_breadcrums() {
  $output = '<div class="breadcrumbs"><a href="' . url() . '">Inicio</a><span> >> </span>';
  if (arg(0) == 'node' && is_numeric(arg(1))) {
    $temp_node = node_load(arg(1));
    if(!empty($temp_node->field_edicion))
      $crumbs_raw = array();
      foreach($temp_node->field_edicion['und'] as $item) {
        array_push($crumbs_raw, $item['taxonomy_term']->name);
      }
      if(in_array('Oaxaca', $crumbs_raw)) {
        $output .= '<a href="' . url('oaxaca') . '">Oaxaca</a><span> >> </span>';
        if(in_array('Deportes', $crumbs_raw)) {
          $output .= '<a href="' . url('oaxaca/deporte') . '">Deportes</a><span> >> </span>';
        } elseif(in_array('Fama', $crumbs_raw)) {
          $output .= '<a href="' . url('oaxaca/fama') . '">Estilo</a><span> >> </span>';
        } elseif(in_array('Cultura', $crumbs_raw)) {
          $output .= '<a href="' . url('oaxaca/arte') . '">Cultura</a><span> >> </span>';
        } elseif(in_array('Roja', $crumbs_raw)) {
          $output .= '<a href="' . url('oaxaca/rojas') . '">Roja</a><span> >> </span>';
        }
      } elseif(in_array('Cuenca', $crumbs_raw)) {
        $output .= '<a href="' . url('cuenca') . '">Cuenca</a><span> >> </span>';
        if(in_array('Deportes', $crumbs_raw)) {
          $output .= '<a href="' . url('cuenca/deporte') . '">Deportes</a><span> >> </span>';
        } elseif(in_array('Fama', $crumbs_raw)) {
          $output .= '<a href="' . url('cuenca/fama') . '">Sociales</a><span> >> </span>';
        } elseif(in_array('Cultura', $crumbs_raw)) {
          $output .= '<a href="' . url('cuenca/arte') . '">Cultura</a><span> >> </span>';
        } elseif(in_array('Roja', $crumbs_raw)) {
          $output .= '<a href="' . url('cuenca/rojas') . '">Roja</a><span> >> </span>';
        }
      } elseif(in_array('Chiapas', $crumbs_raw)) {
        $output .= '<a href="' . url('chiapas') . '">Chiapas</a><span> >> </span>';
        if(in_array('Deportes', $crumbs_raw)) {
          $output .= '<a href="' . url('chiapas/deporte') . '">Deportes</a><span> >> </span>';
        } elseif(in_array('Fama', $crumbs_raw)) {
          $output .= '<a href="' . url('chiapas/fama') . '">Sociales</a><span> >> </span>';
        } elseif(in_array('Cultura', $crumbs_raw)) {
          $output .= '<a href="' . url('chiapas/arte') . '">Cultura</a><span> >> </span>';
        } elseif(in_array('Roja', $crumbs_raw)) {
          $output .= '<a href="' . url('chiapas/rojas') . '">Roja</a><span> >> </span>';
        }
      } elseif(in_array('Istmo', $crumbs_raw)) {
        $output .= '<a href="' . url('istmo') . '">Istmo</a><span> >> </span>';
        if(in_array('Deportes', $crumbs_raw)) {
          $output .= '<a href="' . url('istmo/deporte') . '">Deportes</a><span> >> </span>';
        } elseif(in_array('Fama', $crumbs_raw)) {
          $output .= '<a href="' . url('istmo/fama') . '">Sociales</a><span> >> </span>';
        } elseif(in_array('Cultura', $crumbs_raw)) {
          $output .= '<a href="' . url('istmo/arte') . '">Cultura</a><span> >> </span>';
        } elseif(in_array('Roja', $crumbs_raw)) {
          $output .= '<a href="' . url('istmo/rojas') . '">Roja</a><span> >> </span>';
        }
      }
  }
  $output .= '<span>' . $temp_node->title . '</span></div>';
  return $output;
}