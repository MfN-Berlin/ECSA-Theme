<?php
/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 */
?>
<?php //print $doctype; ?>
<?php //print $html; ?>
<!DOCTYPE html>
<html>
<head<?php //print $rdf->profile; ?>>



  <?php print $head; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">

  <title><?php print $head_title; ?></title>
  <link href='http://fonts.googleapis.com/css?family=Fontdiner+Swanky' rel='stylesheet' type='text/css'>
  <?php print $styles; ?>
  <?php print $scripts; ?>

	<!--[if lte IE 9]>
		<link rel="stylesheet" type="text/css" href="<?php global $base_url; print $base_url;?>/<?php print drupal_get_path('theme','band') ?>/ie9/ie9.css" />
	<![endif]-->



	<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="<?php global $base_url; print $base_url; print base_path().drupal_get_path('theme','band'); ?>/js/html5shiv-printshiv.min.js"></script>
	<![endif]-->

	<!--[if (gte IE 6)&(lte IE 8)]>
    <script type="text/javascript" src="<?php global $base_url; print $base_url; print base_path().drupal_get_path('theme','band'); ?>/js/selectivizr-min.js" />"></script>
	<![endif]-->

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

</head>
<body class="<?php print $classes; ?>" <?php print $attributes;?>>

  <?php // Prompt IE users to install Chrome Frame ?>
  <?php //print $prompt_cf; ?>

  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>

</body>
</html>
