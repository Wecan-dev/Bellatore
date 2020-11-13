<?php
/**
 * Template for displaying global default template Our team element.
 *
 * This template can be overridden by copying it to yourtheme/physc-builder/our-team/our-team.php.
 *
 * @author      Physcodes
 * @package     PhyscBuilders/Templates
 * @version     1.0.0
 * @author      Physcodes
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

/**
 * @var $params array - shortcode params
 */

if ( !$params['ourteam_tab'] ) {
    return;
}


$data= '';
$ourteam_tab    = $params['ourteam_tab'];
echo '<div class="ourteam-1"><div class="ourteam-content">';

echo '<div class="sc-ourteam owl-carousel owl-theme"' . $data . '>';
foreach ( $ourteam_tab as $value ) {
    $website_url = $value['link_author'];
    if ( $website_url ) {
        $before_link = '<a href="' . $website_url . '">';
        $after_link  = '</a>';
    }
    ?>
    <div class="item">
            <?php
            if ( isset( $value['thumbnail_image'] ) ) {
                $thumbnail_id = (int) $value['thumbnail_image'];
                echo '<div class="images">' . wp_get_attachment_image( $thumbnail_id, 'full' ) . '</div>';
            }
            if ( isset( $value['text_1'] ) ) {
                if(isset( $value['text_1_color'] )){
                    $color_text1 = $value['text_1_color'];
                }
                echo $before_link.'<h5 style="color: '.$color_text1.'; ">'. $value['text_1'] .'</h5>' . $after_link;
            }
            if ( isset( $value['text_2'] ) ) {
                if(isset( $value['text_2_color'] )){
                    $color_text2 = $value['text_2_color'];
                }
                echo '<span class="regency" style="color: '.$color_text2.';">' . $value['text_2'] . '</span>';
            } ?>
    </div>
    <?php
}
echo '</div></div>';
echo '</div>';

?>
