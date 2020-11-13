<?php
/**
 * Template for displaying global default template Testimonials element.
 *
 * This template can be overridden by copying it to yourtheme/physc-builder/testimonials/testimonials.php.
 *
 * @author      Physcodes
 * @package     PhyscBuilders/Templates
 * @version     1.0.0
 * @author      Physcodes
 */

/**
 * Prevent loading this file directly
 */
defined('ABSPATH') || exit;

/**
 * @var $params array - shortcode params
 */

if (!$params['testimonials']) {
    return;
}

// global params
$data = '';

$testimonials = $params['testimonials'];
$title = $params['title'];
$show_arrows_testimonials = $params['show_arrows_testimonials'];
$show_dots_testimonials = $params['show_dots_testimonials'];
$element_tag = $params['element_tag'];
$phys_builder_animation = $params['el_class'] ? ' ' . $params['el_class'] : '';

$data .= $show_arrows_testimonials ? ' data-arrows ="' . $show_arrows_testimonials . '"' : '';
$data .= $show_dots_testimonials ? ' data-dots ="' . $show_dots_testimonials . '"' : '';

echo '<div class="testimonials-hp-azen' . esc_attr($phys_builder_animation) . '">
<div class="testimonials-content">';
if ($title) {
    echo '<' . $element_tag . ' class="special-heading">' . $title . '</' . $element_tag . '>';
}
echo '<div class="sc-testimonials owl-carousel owl-loaded owl-drag owl-theme"' . $data . '>';

foreach ($testimonials as $testimonial) {
    $website_url = $testimonial['website'];
    if ($website_url) {
        $before_link = '<a href="' . $website_url . '">';
        $after_link = '</a>';
    }
    ?>
    <div class="item">
        <div class="testimonials-detail">
            <i class="fa fa-quote-left "></i>
            <?php
            if (isset($testimonial['content'])) {
                echo '<p>' . $testimonial['content'] . '</p>';
            }
            if (isset($testimonial['name'])) {
                echo '<h5>' .esc_html__('BY','azen'). $before_link . $testimonial['name'] . $after_link . '</h5>';
            }
            if (isset($testimonial['works'])) {
                echo '<span class="regency">' . $testimonial['works'] . '</span>';
            } ?>
        </div>
    </div>
    <?php
}

echo '</div></div></div>';
?>
