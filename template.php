<?php
/**
 * @file
 * Provides overrides and additions to aid the theme.
 */



/**
 * Implements hook_css_alter().
 *
 * Remove all the unused css files.
 */
function namu_css_alter(&$css) {

  $exclude = theme_get_setting('exclude');
  if ( !$exclude['css'] )  {
    return ;
  } else {
    $exclude = array_flip($exclude['css']);
  }
  //dsm($css) ;
  $css = array_diff_key($css, $exclude);
}


function namu_menu_link__menu_namu_taxonomy_menu($variables) {
  $element = $variables ['element'];
  $sub_menu = '';

  $element ['#attributes']['class'][] = 'item' ;
  $element ['#localized_options']['attributes']['class'][] ='item' ;

  $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
  if ( $element ['#below']) {
    $sub_menu = drupal_render($element ['#below']);
    return '<div ' . drupal_attributes($element ['#attributes']) . '>' . $output . $sub_menu . "</div>\n";
  }

  return  $output ;
}

function namu_menu_link__main_menu($variables) {
  $element = $variables ['element'];
  $sub_menu = '';


  $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);

  if ( $element ['#below']) {
    $sub_menu =  drupal_render($element ['#below']);
    $output = l($element ['#title'], $element ['#href'], $element ['#localized_options']);
    return '<div class="column"><div class="ui menu secondary no border pointing vertical fluid"><div class="item header">' . $output . '</div>' . $sub_menu . "</div></div>\n";
  }
  $element['#localized_options']['html'] = TRUE ;
  $element['#localized_options']['attributes']['class'][] = 'item' ;

  $output = l('<i class="angle right icon"></i>'.$element ['#title'], $element ['#href'], $element ['#localized_options']);
  return   $output ;
}


function namu_panels_default_style_render_region($vars) {
    $output = '';
    $output .= implode('', $vars['panes']);
    return $output;
}


function namu_ds_pre_render_alter(&$layout_render_array, $context, &$vars) {
  if ( $context['entity_type'] == 'node' ) {
    $vars['layout_wrapper'] = 'article' ;
  }
}

/** * Remove the comment filters' tips */
function namu_filter_tips($tips, $long = FALSE, $extra = '') {   return ''; }
/** * Remove the comment filter's more information tips link */
function namu_filter_tips_more_info () {   return ''; }

function namu_links__system_main_menu($variables) {
  $html = '' ;
  $html .= '<div id="menu-content" class="menu-content" style="display:none"><div class="ui container">' ;
  $mobiles = menu_block_block_view('mobile-menu') ;
  if ( $mobiles ) {
	  if ( module_exists('search_api_page') ) {
	    $search = search_api_page_block_view('namu_default_search_page');
	    $html .= render($search['content']) ;
	  }
    $mobiles = drupal_render($mobiles['content']) ;
    $mobiles = '<div class="ui stackable three column grid">' . $mobiles . '</div>' ;
  }
  $html .= $mobiles ;

  $html .= '</div></div>';

  return $html;
}


function namu_menu_tree__main_menu($variables) {
  return  $variables ['tree']  ;
}

function namu_menu_tree__menu_namu_taxonomy_menu($variables) {
  return '<div class="ui fluid vertical menu">' . $variables ['tree'] . '</div>' ;
}

function namu_preprocess_page(&$vars) {
  $bg = variable_get('website_background',false);
  if ( $bg && ($bg = file_load($bg)) ) {
    $vars['bg'] = file_create_url( $bg->uri );
  }
  if ( !is_array($vars['main_menu']) ) return ;
  $primary_links = theme('links__system_main_menu',array('links' => $vars['main_menu'])) ;
  $vars['primary_links'] = $primary_links;
  if ( module_exists('bean') ) {
    $day = date('N') ;
    
	$special = namu_isSpecial();
	switch( $special ) {
		case 1: 
			$day = 'special' ;
			$info = $special;
			break;
		case -1: 
			$day = 'special' ;
			$info = $special;
			break;
		default:
			break;
    }
    $query = new EntityFieldQuery();
    $query->entityCondition('entity_type', 'bean')
          ->propertyCondition('label', '%' . $day, 'LIKE') ;
    $result = $query->execute();
    if ( isset($result['bean']) ) {
      $id = array_keys( $result['bean']);
      $id = array_pop($id) ;
      $bean = entity_load_single('bean',$id) ;
      if ( $bean ) $vars['page']['header_first'] = entity_view('bean',array($bean));
    }
  }
  if ( module_exists('search_api_page') ) {
    $search = search_api_page_block_view('namu_default_search_page');
    $search = render($search['content']) ;
    $vars['page']['header_second'] = array('search' => array('#markup' => $search)) ;
  }

  $map_link = variable_get('website_map_header_link',FALSE);
  if ( $map_link ) {
    $vars['map_link'] = url($map_link) ;
  }

  //$vars['page']['content']['media_check'] = array('#markup' => '<div class="ui container"><div class="media-check ui grid wide four columns"><div class="mobile only column">MOBILE</div><div class="tablet only column">TABLET</div><div class="widescreen only column">NORMAL</div><div class="large screen only column">VERY LARGE</div></div></div>');
}

function namu_preprocess_html(&$vars)
{
  // add custom class to the body tag
  if ( module_exists('page_manager') && page_manager_get_current_page () == FALSE ) {
    $vars['classes_array'][] = 'with-body-padding' ;
  }
}

function namu_button($variables) {
  $element = $variables ['element'];
  $element ['#attributes']['type'] = 'submit';
  element_set_attributes($element, array('id', 'name', 'value'));
  $element ['#attributes']['class'][] = 'ui';
  $element ['#attributes']['class'][] = 'button';

  $element ['#attributes']['class'][] = 'form-' . $element ['#button_type'];
  if (!empty($element ['#attributes']['disabled'])) {
    $element ['#attributes']['class'][] = 'form-button-disabled';
  }
  return '<input' . drupal_attributes($element ['#attributes']) . ' />';
}


function namu_form_element($variables) {
  $element = &$variables ['element'];
  $output = '' ;

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed by form_builder().
  $element += array(
      '#title_display' => 'before',
  );

  // Add element #id for #type 'item'.
  if (isset($element ['#markup']) && !empty($element ['#id'])) {
    $attributes ['id'] = $element ['#id'];
  }
  // Add element's #type and #name as class to aid with JS/CSS selectors.
  $attributes ['class'] = array('form-item');
  if (!empty($element ['#type'])) {
    $attributes ['class'][] = 'form-type-' . strtr($element ['#type'], '_', '-');
  }
  if (!empty($element ['#name'])) {
    $attributes ['class'][] = 'form-item-' . strtr($element ['#name'], array(' ' => '-', '_' => '-', '[' => '-', ']' => ''));
  }
  // Add a class for disabled elements to facilitate cross-browser styling.
  if (!empty($element ['#attributes']['disabled'])) {
    $attributes ['class'][] = 'form-disabled';
  }
  $attributes ['class'][] = 'field';
  if ( !isset($element['#plain']) ) $output = '<div' . drupal_attributes($attributes) . '>' . "\n";

  // If #title is not set, we don't display any label or required marker.
  if (!isset($element ['#title'])) {
    $element ['#title_display'] = 'none';
  }
  $prefix = isset($element ['#field_prefix']) ? '<span class="field-prefix">' . $element ['#field_prefix'] . '</span> ' : '';
  $suffix = isset($element ['#field_suffix']) ? ' <span class="field-suffix">' . $element ['#field_suffix'] . '</span>' : '';

  switch ($element ['#title_display']) {
    case 'before':
    case 'invisible':
      $output .= ' ' . theme('form_element_label', $variables);
      $output .= ' ' . $prefix . $element ['#children'] . $suffix . "\n";
      break;

    case 'after':
      $output .= ' ' . $prefix . $element ['#children'] . $suffix;
      $output .= ' ' . theme('form_element_label', $variables) . "\n";
      break;

    case 'none':
    case 'attribute':
      // Output no label and no required marker, only the children.
      $output .= ' ' . $prefix . $element ['#children'] . $suffix . "\n";
      break;
  }

  if (!empty($element ['#description'])) {
    $output .= '<div class="description">' . $element ['#description'] . "</div>\n";
  }

  if ( !isset($element['#plain']) ) $output .= "</div>\n";

  return $output;
}

function namu_form($variables) {
  $element = $variables ['element'];
  if (isset($element ['#action'])) {
    $element ['#attributes']['action'] = drupal_strip_dangerous_protocols($element ['#action']);
  }
  element_set_attributes($element, array('method', 'id'));
  if (empty($element ['#attributes']['accept-charset'])) {
    $element ['#attributes']['accept-charset'] = "UTF-8";
  }

  $element ['#attributes']['class'][] = 'ui';
  $element ['#attributes']['class'][] = 'form';

  // Anonymous DIV to satisfy XHTML compliance.
  return '<form' . drupal_attributes($element ['#attributes']) . '>' . $element ['#children'] . '</form>';
}

function namu_table($variables) {
  $header = $variables ['header'];
  $rows = $variables ['rows'];
  $attributes = $variables ['attributes'];
  $caption = $variables ['caption'];
  $colgroups = $variables ['colgroups'];
  $sticky = $variables ['sticky'];
  $empty = $variables ['empty'];
  $attributes['class'][] = 'ui' ;
  $attributes['class'][] = 'table';

  // Add sticky headers, if applicable.
  if (count($header) && $sticky) {
    drupal_add_js('misc/tableheader.js');
    // Add 'sticky-enabled' class to the table to identify it for JS.
    // This is needed to target tables constructed by this function.
    $attributes ['class'][] = 'sticky-enabled';
  }

  $output = '<table' . drupal_attributes($attributes) . ">\n";

  if (isset($caption)) {
    $output .= '<caption>' . $caption . "</caption>\n";
  }

  // Format the table columns:
  if (count($colgroups)) {
    foreach ($colgroups as $number => $colgroup) {
      $attributes = array();

      // Check if we're dealing with a simple or complex column
      if (isset($colgroup ['data'])) {
        foreach ($colgroup as $key => $value) {
          if ($key == 'data') {
            $cols = $value;
          }
          else {
            $attributes [$key] = $value;
          }
        }
      }
      else {
        $cols = $colgroup;
      }

      // Build colgroup
      if (is_array($cols) && count($cols)) {
        $output .= ' <colgroup' . drupal_attributes($attributes) . '>';
        $i = 0;
        foreach ($cols as $col) {
          $output .= ' <col' . drupal_attributes($col) . ' />';
        }
        $output .= " </colgroup>\n";
      }
      else {
        $output .= ' <colgroup' . drupal_attributes($attributes) . " />\n";
      }
    }
  }

  // Add the 'empty' row message if available.
  if (!count($rows) && $empty) {
    $header_count = 0;
    foreach ($header as $header_cell) {
      if (is_array($header_cell)) {
        $header_count += isset($header_cell ['colspan']) ? $header_cell ['colspan'] : 1;
      }
      else {
        $header_count++;
      }
    }
    $rows [] = array(array('data' => $empty, 'colspan' => $header_count, 'class' => array('empty', 'message')));
  }

  // Format the table header:
  if (count($header)) {
    $ts = tablesort_init($header);
    // HTML requires that the thead tag has tr tags in it followed by tbody
    // tags. Using ternary operator to check and see if we have any rows.
    $output .= (count($rows) ? ' <thead><tr>' : ' <tr>');
    foreach ($header as $cell) {
      $cell = tablesort_header($cell, $header, $ts);
      $output .= _theme_table_cell($cell, TRUE);
    }
    // Using ternary operator to close the tags based on whether or not there are rows
    $output .= (count($rows) ? " </tr></thead>\n" : "</tr>\n");
  }
  else {
    $ts = array();
  }

  // Format the table rows:
  if (count($rows)) {
    $output .= "<tbody>\n";
    $flip = array('even' => 'odd', 'odd' => 'even');
    $class = 'even';
    foreach ($rows as $number => $row) {
      // Check if we're dealing with a simple or complex row
      if (isset($row ['data'])) {
        $cells = $row ['data'];
        $no_striping = isset($row ['no_striping']) ? $row ['no_striping'] : FALSE;

        // Set the attributes array and exclude 'data' and 'no_striping'.
        $attributes = $row;
        unset($attributes ['data']);
        unset($attributes ['no_striping']);
      }
      else {
        $cells = $row;
        $attributes = array();
        $no_striping = FALSE;
      }
      if (count($cells)) {
        // Add odd/even class
        if (!$no_striping) {
          $class = $flip [$class];
          $attributes ['class'][] = $class;
        }

        // Build row
        $output .= ' <tr' . drupal_attributes($attributes) . '>';
        $i = 0;
        foreach ($cells as $cell) {
          $cell = tablesort_cell($cell, $header, $ts, $i++);
          $output .= _theme_table_cell($cell);
        }
        $output .= " </tr>\n";
      }
    }
    $output .= "</tbody>\n";
  }

  $output .= "</table>\n";
  return $output;
}



function namu_menu_tree__menu_block__1($variables) {
  return '<div class="content"><div class="ui menu secondary pointing">' . $variables ['tree'] . '</div></div>';
}

function namu_menu_link__menu_block__1($variables) {
  $element = $variables['element'];
  $sub_menu = '';


  $element['#localized_options']['attributes']['class'][] = 'item' ;

  $element['#attributes']['class'][] = 'menu-' . $element['#original_link']['mlid'];

  if ($element['#below']) {
    $sub_menu = drupal_render($element['#below']);
  }

  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return $output . $sub_menu ;
}

function namu_links__comment($variables) {
//   dsm($variables) ;
}

function namu_menu_local_task($variables) {
  $link = $variables ['element']['#link'];
  $link_text = $link ['title'];

  if (!empty($variables ['element']['#active'])) {
    // Add text to indicate active tab for non-visual users.
    $active = '<span class="element-invisible">' . t('(active tab)') . '</span>';

    // If the link does not contain HTML already, check_plain() it now.
    // After we set 'html'=TRUE the link will not be sanitized by l().
    if (empty($link ['localized_options']['html'])) {
      $link ['title'] = check_plain($link ['title']);
    }
    $link ['localized_options']['html'] = TRUE;
    $link_text = t('!local-task-title!active', array('!local-task-title' => $link ['title'], '!active' => $active));
  }

  return '<div class="item ' . (!empty($variables ['element']['#active']) ? 'active' : '') . '">' . l($link_text, $link ['href'], $link ['localized_options']) . "</div>\n";
}

function namu_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables ['primary'])) {
    $variables ['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables ['primary']['#prefix'] .= '<div class="ui vertical menu fluid">';
    $variables ['primary']['#suffix'] = '</div>';
    $output .= drupal_render($variables ['primary']);
  }
  if (!empty($variables ['secondary'])) {
    $variables ['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables ['secondary']['#prefix'] .= '<div class="ui vertical menu fluid">';
    $variables ['secondary']['#suffix'] = '</div>';
    $output .= drupal_render($variables ['secondary']);
  }

  return $output;
}


function namu_date_display_range($variables) {
  $date1 = $variables['date1'];
  $date2 = $variables['date2'];
  $timezone = $variables['timezone'];
  $attributes_start = $variables['attributes_start'];
  $attributes_end = $variables['attributes_end'];
  $show_remaining_days = $variables['show_remaining_days'];

  $start_date = '<span class="date-display-start"' . drupal_attributes($attributes_start) . '>' . $date1 . '</span>';
  $end_date = '<span class="date-display-end"' . drupal_attributes($attributes_end) . '>' . $date2 . $timezone . '</span>';

  // If microdata attributes for the start date property have been passed in,
  // add the microdata in meta tags.
  if (!empty($variables['add_microdata'])) {
    $start_date .= '<meta' . drupal_attributes($variables['microdata']['value']['#attributes']) . '/>';
    $end_date .= '<meta' . drupal_attributes($variables['microdata']['value2']['#attributes']) . '/>';
  }

  // Wrap the result with the attributes.
  $output = '<span class="date-display-range">' . t('!start-date to !end-date', array(
      '!start-date' => $start_date,
      '!end-date' => $end_date,
  )) . '</span>';

  // Add remaining message and return.
  return $output . $show_remaining_days;
}


/** FACET API **/
function namu_facetapi_title($variables) {
  return t('@title:', array('@title' => drupal_strtolower($variables['title'])));
}

function namu_facetapi_link_inactive($variables) {
  // Builds accessible markup.
  // @see http://drupal.org/node/1316580
  $accessible_vars = array(
      'text' => $variables['text'],
      'active' => FALSE,
  );
  $accessible_markup = theme('facetapi_accessible_markup', $accessible_vars);

  // Sanitizes the link text if necessary.
  $sanitize = empty($variables['options']['html']);
  $variables['text'] = ($sanitize) ? check_plain($variables['text']) : $variables['text'];

  // Adds count to link if one was passed.
  if (isset($variables['count'])) {
    $variables['text'] .= ' ' . theme('facetapi_count', $variables);
  }

  // Resets link text, sets to options to HTML since we already sanitized the
  // link text and are providing additional markup for accessibility.
  $variables['text'] .= $accessible_markup;
  $variables['options']['html'] = TRUE;
  return theme_link($variables);
}

function namu_facetapi_count($variables) {
  return '(' . (int) $variables['count'] . ')';
}

function namu_facetapi_link_active($variables) {

  // Sanitizes the link text if necessary.
  $sanitize = empty($variables['options']['html']);
  $link_text = ($sanitize) ? check_plain($variables['text']) : $variables['text'];

  // Theme function variables fro accessible markup.
  // @see http://drupal.org/node/1316580
  $accessible_vars = array(
      'text' => $variables['text'],
      'active' => TRUE,
  );

  // Builds link, passes through t() which gives us the ability to change the
  // position of the widget on a per-language basis.
  $replacements = array(
      '!facetapi_deactivate_widget' => theme('facetapi_deactivate_widget', $variables),
      '!facetapi_accessible_markup' => theme('facetapi_accessible_markup', $accessible_vars),
  );
  $variables['text'] = t('!facetapi_deactivate_widget !facetapi_accessible_markup', $replacements);
  $variables['options']['html'] = TRUE;
  return theme_link($variables) . $link_text;

}

/* 
Changed by Falko 2015-12-08
function namu_isHoliday(){
  $day = date('d');
  $month  = date('m');
  $year  = date('Y');

  // Convert parameters in real format
  if(strlen($day) == 1) {
    $day = "0$day";
  }
  if(strlen($month) == 1) {
    $month = "0$month";
  }

  // calculate the week
  $date = getdate(mktime(0, 0, 0, $month, $day, $year));

  //Berliner holidays

  $holidays[] = "0101"; // Neujahr
  $holidays[] = "0105"; // Tag der Arbeit
  $holidays[] = "0310"; // Tag der Deutschen Einheit
  $holidays[] = "2512"; // Erster Weihnachtstag
  $holidays[] = "2612"; // Zweiter Weihnachtstag
  $holidays[] = "0112"; // TEST

  function get_easter_datetime($year) {
    $days = easter_days($year);
    return mktime(0, 0, 0, 3, 21+$days,$year);
  }


  $days = 60 * 60 * 24;
  $eastersunday = get_easter_datetime($year);
  $holidays[] = date("dm", $eastersunday - 2 * $days);  // Karfreitag
  $holidays[] = date("dm", $eastersunday + 1 * $days);  // Ostermontag
  $holidays[] = date("dm", $eastersunday + 39 * $days); // Himmelfahrt
  $holidays[] = date("dm", $eastersunday + 50 * $days); // Pfingstmontag

  // Check if holiday
  $code = $day.$month;
  if(in_array($code, $holidays)) {
    return true;
  } else {
    return false;
  }
}*/



/*
	@description	Check if the date is secial opening or closing day
	@returns 		1  special open,  0  normal,  -1  special closing*/
function namu_isSpecial(){
  $day = date('d');
  $month  = date('m');
  $year  = date('Y');

  // Convert parameters in real format
  if(strlen($day) == 1) {
    $day = "0$day";
  }
  if(strlen($month) == 1) {
    $month = "0$month";
  }

// @TODO:  make this configurable in the admin UI

  //Special open day
  $opened["2015-12-21"] = "9.30 &ndash; 18.00";
  $opened["2015-12-26"] = "10.00 &ndash; 18.00";
  $opened["2015-12-28"] = "9.30 &ndash; 18.00";
  $opened["2016-01-01"] = "10.00 &ndash; 18.00";
  
  //Special closing day
  $closed[] = "2015-12-16";
  $closed[] = "2015-12-24";
  $closed[] = "2015-12-25";
  $closed[] = "2015-12-31";


  // Check if special day
  $code = $year."-".$month."-".$day;

  if(@in_array($code, $closed)) {
    return -1;
  }
  else if(@in_array($code, @array_keys($opened)))
  { return 1;
  }else
	return 0;
  
}

function namu_breadcrumb($variables) {
  $breadcrumb = $variables['breadcrumb'];

  if (!empty($breadcrumb)) {
    // Provide a navigational heading to give context for breadcrumb links to
    // screen-reader users. Make the heading invisible with .element-invisible.
    $output = '<h2 class="element-invisible">' . t('You are here') . '</h2>';

    $output .= '<div class="breadcrumb">' . implode(' / ', $breadcrumb) . '</div>';
    return $output;
  }
}


function namu_theme() {
  $items = array();
	
  $items['user_login'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'yourtheme') . '/templates',
    'template' => 'user-login',
    'preprocess functions' => array(
       'yourtheme_preprocess_user_login'
    ),
  );
  $items['user_register_form'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'yourtheme') . '/templates',
    'template' => 'user-register-form',
    'preprocess functions' => array(
      'yourtheme_preprocess_user_register_form'
    ),
  );
  $items['user_pass'] = array(
    'render element' => 'form',
    'path' => drupal_get_path('theme', 'yourtheme') . '/templates',
    'template' => 'user-pass',
    'preprocess functions' => array(
      'yourtheme_preprocess_user_pass'
    ),
  );
  return $items;
}


function namu_preprocess_user_login(&$vars) {
  $vars['intro_text'] = t('This is my awesome login form');
}

function namu_preprocess_user_register_form(&$vars) {
  $vars['intro_text'] = t('This is my super awesome reg form');
}

function namu_preprocess_user_pass(&$vars) {
  $vars['intro_text'] = t('This is my super awesome request new password form');
}

