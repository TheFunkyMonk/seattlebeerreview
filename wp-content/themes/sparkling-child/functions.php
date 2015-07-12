<?php
// Add your custom functions here

add_action( 'wp_enqueue_scripts', 'sparkling_enqueue_styles', 15 );
function sparkling_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

add_action( 'widgets_init', function() {
  register_widget( 'my_recent_posts' );
});

// Custom widgets
require_once(get_stylesheet_directory() . '/inc/widgets/my-recent-posts.php');


// Custom main menu items
add_filter('wp_nav_menu_items','add_my_terms');

function add_my_terms($items) {
  global $post;

  // Styles
  $items .= '<li class="menu-item menu-item-has-children dropdown"><a title="Styles" href="#" data-toggle="dropdown" class="dropdown-toggle">Styles <span class="caret"></span></a><ul role="menu" class=" dropdown-menu">';
  $terms = get_terms('style');
  foreach ($terms as $term) {
  $items .= '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
  }
  $items .= '</ul></li>';

  // Breweries
  $items .= '<li class="menu-item menu-item-has-children dropdown"><a title="Breweries" href="#" data-toggle="dropdown" class="dropdown-toggle">Breweries <span class="caret"></span></a><ul role="menu" class=" dropdown-menu">';
  $terms = get_terms('brewery');
  foreach ($terms as $term) {
  $items .= '<li><a href="' . get_term_link($term) . '">' . $term->name . '</a></li>';
  }
  $items .= '</ul></li>';
  return $items;
}

/**
 * Featured image slider, displayed on front page for static page and blog
 */
function sparkling_featured_slider() {
  if ( is_front_page() && of_get_option( 'sparkling_slider_checkbox' ) == 1 ) {
    echo '<div class="flexslider">';
      echo '<ul class="slides">';

        $count = of_get_option( 'sparkling_slide_number' );
        $slidecat =of_get_option( 'sparkling_slide_categories' );

        $query = new WP_Query( array( 'cat' =>$slidecat,'posts_per_page' =>$count ) );
        if ($query->have_posts()) :
          while ($query->have_posts()) : $query->the_post();

          echo '<li><a href="'. get_permalink() .'">';
            if ( (function_exists( 'has_post_thumbnail' )) && ( has_post_thumbnail() ) ) :
              echo get_the_post_thumbnail();
            endif;

              echo '<div class="flex-caption">';
                  include( get_stylesheet_directory() . '/get-score.php');
                  if ( get_the_title() != '' ) echo '<h2 class="entry-title">' . get_the_title();
                  $brewery = get_the_terms( $post->ID, 'brewery' ); echo(' - ' . $brewery[0]->name);
                  echo '<span>' . $totalScore / 10 ?> -
                  <?php if ( $totalScore >= 90 ) { ?>
                    Outstanding</h2>
                  <?php } elseif ( $totalScore >= 76 ) { ?>
                    Excellent</h2>
                  <?php } elseif ( $totalScore >= 60 ) { ?>
                    Very Good</h2>
                  <?php } elseif ( $totalScore >= 42 ) { ?>
                    Good</h2>
                  <?php } elseif ( $totalScore >= 28 ) { ?>
                    Fair</h2>
                  <?php } else { ?>
                    Problematic</h2>
                  <?php }
                  if ( get_the_title() != '' ) echo '</span></h2>';
                  if ( get_the_excerpt() != '' ) echo '<div class="excerpt">' . get_the_excerpt() .'</div>';
              echo '</div>';

              endwhile;
            endif;

          echo '</a></li>';
      echo '</ul>';
    echo ' </div>';
  }
}

// Customize excerpt truncation
function custom_excerpt_more( $more ) {
  return '...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );


// Custom taxonomies
add_action( 'init', 'create_custom_taxonomies', 0 );

function create_custom_taxonomies() {
  register_taxonomy( 'style', 'post', array( 'hierarchical' => false, 'label' => __('Style', 'sparkling'), 'query_var' => 'style', 'rewrite' => array( 'slug' => __('style', 'sparkling') ) ) );
  register_taxonomy( 'abv', 'post', array( 'hierarchical' => false, 'label' => __('ABV', 'sparkling'), 'query_var' => 'abv', 'rewrite' => array( 'slug' => __('abv', 'sparkling') ) ) );
  register_taxonomy( 'brewery', 'post', array( 'hierarchical' => false, 'label' => __('Brewery', 'sparkling'), 'query_var' => 'brewery', 'rewrite' => array( 'slug' => __('breweries', 'sparkling') ) ) );
  register_taxonomy( 'location', 'post', array( 'hierarchical' => false, 'label' => __('Location', 'sparkling'), 'query_var' => 'location', 'rewrite' => array( 'slug' => __('locations', 'sparkling') ) ) );
  register_taxonomy( 'availability', 'post', array( 'hierarchical' => false, 'label' => __('Availability', 'sparkling'), 'query_var' => 'availability', 'rewrite' => array( 'slug' => __('availability', 'sparkling') ) ) );
}

?>
