<?php
/**
 * @file shortcode-gplusone-button.php
 *
 * HTML output for the [gplusone-button] shortcode.
 *
 * Available variables
 * - $attributes - An array of values for each of the settings
 *      * url
 *      * size
 *      * annotation
 *      * callback
 */

$html_attributes = array();
// Loop through and set up the data attributes
foreach( $attributes as $key => $value ) {
  if ( !empty($value) ) {
    $html_attributes[] = 'data-' . $key . '="' . $value .'"';
  }
}
?>

<div class="g-plusone" <?php echo implode(' ', $html_attributes); ?>></div>