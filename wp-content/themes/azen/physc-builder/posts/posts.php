<?php
/**
 * Template for displaying default template Posts element.
 *
 * This template can be overridden by copying it to yourtheme/physc-builder/posts/categories.php.
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
$layout = $params['layout'];
$length = $params['length'];
$speed = $params['speed'];
$title = $params['title'];
$element_tag = $params['element_tag'];
$title_color = $params['title_color'];
$category = $params['category'];
$number = $params['number'];
$item_on_row = $params['item_on_row'];
$show_date = $params['show_date'];
$show_author = $params['show_author'];
$azen_animation = $params['el_class'] ? ' ' . $params['el_class'] : '';
$azen_animation .= ' sc-posts-' . $layout;

$sort_post = !empty($params['sort_post']) ? $params['sort_post'] : 'date';
$order_post = !empty($params['order_post']) ? $params['order_post'] : 'DESC';

$query_atts['posts_per_page'] = $number;
if ($category) {
    $cats_id = explode(',', $category);
    $query_atts['tax_query'] = array(
        array(
            'taxonomy' => 'category',
            'field' => 'term_id',
            'terms' => $cats_id
        )
    );
}
$query_atts['orderby'] = $sort_post;
$query_atts['order'] = $order_post;


$the_query = new WP_Query(apply_filters('builder-press/posts-query', $query_atts));

?>

<?php if ($the_query->have_posts()) {
    $data = '';
    echo '<div class="sc-list-posts' . $azen_animation . '">';
    $size_images = 'full';
    $style_title = $title_color ? ' style="color:' . $title_color . '"' : '';
    if ($title) {
        echo '<' . $element_tag . ' class="special-heading"' . $style_title . '>' . $title . '</' . $element_tag . '>';
    }
    if ($layout == 'layout_2') {
        wp_enqueue_script('slick');
        $data = ' data-item="' . $item_on_row . '"';
        $data .= ' data-speed="' . $speed . '"';
    }
    echo '<div class="row inner-list-posts"' . $data . '>';

    while ($the_query->have_posts()) {
        $the_query->the_post();
        if ($layout == 'layout_1') {
            $class = 'list-item col-xl-' . (12 / $item_on_row) . ' col-lg-' . (12 / $item_on_row) . ' col-md-' . (12 / $item_on_row) . ' col-sm-12 col-12';
            ?>
            <div <?php post_class($class); ?>>
                <div class="news-details">
                    <?php
                    echo '<div class="info">';

                    if (has_post_thumbnail()) {
                        echo '<div class="post-formats-wrapper"><a href="' . esc_url(get_permalink()) . '" title="' . the_title_attribute('echo=0') . '">';
                        $link_image = bp_custom_image_size(300, 225, get_the_post_thumbnail_url(get_the_ID(), 'full'));
                        echo '<img src="' . esc_url($link_image) . '" alt="' . the_title_attribute('echo=0') . '">';
                        echo '</a></div>';
                    }
                    if ($show_date == 'true' || $show_author == 'true') {
                        echo '<div class="date">';
                        if ($show_author == 'true' && get_the_author()) {
                            printf(
                                '<div><a class="url fn n" href="%1$s">' . esc_html__('By', 'azen') . ' %2$s</a></div>',
                                esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                                get_the_author()
                            );
                        }
                        if ($show_date == 'true') {
                            echo '<div class="time">' . get_the_date() . '</div>';
                        }

                        echo '</div>';
                    };
                    the_title(sprintf('<h4 class="post-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h4>');
                    echo '</div>';
                    ?>
                </div>
            </div>
            <?php
        } else {
            echo '<div class=gird-item>'; ?>
            <div class="news-details">
                <?php
                if (has_post_thumbnail()) {
                    echo '<div class="post-formats-wrapper"><a href="' . esc_url(get_permalink()) . '" title="' . the_title_attribute('echo=0') . '">';
                    $link_image = bp_custom_image_size(380, 240, get_the_post_thumbnail_url(get_the_ID(), 'full'));
                    echo '<img src="' . esc_url($link_image) . '" alt="' . the_title_attribute('echo=0') . '">';
                    echo '</a></div>';
                }
                echo '<div class="info">';
                the_title(sprintf('<h4 class="post-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h4>');
                if ($length || $length != '0') {
                    echo '<div class="post-excerpt">' . azen_excerpt($length) . '</div>';
                }
                if ($show_date == 'true' || $show_author == 'true') {
                    echo '<div class="date">';
                    if ($show_author == 'true' && get_the_author()) {
                        printf(
                            '<div><a class="url fn n" href="%1$s">' . esc_html__('By', 'azen') . ' %2$s</a></div>',
                            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                            get_the_author()
                        );
                    }
                    if ($show_date == 'true') {
                        echo '<div class="time">' . get_the_date() . '</div>';
                    }
                    echo '</div>';
                };
                echo '</div>';
                ?>
            </div>
            <?php echo '</div>';
        }

    }

    echo '</div>';

    echo '</div>';
    wp_reset_postdata();
    ?>
<?php } ?>