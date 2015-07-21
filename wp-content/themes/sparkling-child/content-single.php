<?php
/**
 * @package sparkling
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php the_post_thumbnail( 'sparkling-featured', array( 'class' => 'single-featured' )); ?>
	<div class="post-inner-content">
		<header class="entry-header page-header">

      <h1 class="entry-title "><?php the_title(); ?> - <?php $brewery = get_the_terms($post->ID, 'brewery'); echo $brewery[0]->name; ?></h1>

      <div class="entry-meta beer-info">
        <p>
          <span><strong>Style:</strong> <?php $term = get_the_terms($post->ID, 'style'); echo $term[0]->name; ?></span><span>|</span>
          <span><strong> ABV:</strong> <?php $term = get_the_terms($post->ID, 'abv'); echo $term[0]->name; ?>%</span><span>|</span>
          <span><strong> Availability:</strong> <?php $term = get_the_terms($post->ID, 'availability'); echo $term[0]->name; ?></span><span>|</span>
          <span><strong> Location:</strong> <?php $term = get_the_terms($post->ID, 'location'); echo $term[0]->name . ', ' . $term[1]->name; ?></span>
        </p>
      </div>

			<div class="entry-meta">
				<?php sparkling_posted_on(); ?>

				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'sparkling' ) );
					if ( $categories_list && sparkling_categorized_blog() ) :
				?>
				<span class="cat-links"><i class="fa fa-folder-open-o"></i>
					<?php printf( __( ' %1$s', 'sparkling' ), $categories_list ); ?>
				</span>
				<?php endif; // End if categories ?>
				<?php edit_post_link( __( 'Edit', 'sparkling' ), '<i class="fa fa-pencil-square-o"></i><span class="edit-link">', '</span>' ); ?>

			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
        <hr>
      <?php if (get_field('appearance_review')) { ?>
        <h2>Appearance</h2>
        <?php the_field('appearance_review'); ?>
        <p><strong>Appearance Rating: <?php the_field('appearance_rating'); ?> / 3</strong></p>
        <hr>
      <?php } ?>
      <?php if (get_field('aroma_review')) { ?>
        <h2>Aroma</h2>
        <?php the_field('aroma_review'); ?>
        <p><strong>Aroma Rating: <?php the_field('aroma_rating'); ?> / 12</strong></p>
        <hr>
      <?php } ?>
      <?php if (get_field('flavor_review')) { ?>
        <h2>Flavor</h2>
        <?php the_field('flavor_review'); ?>
        <p><strong>Flavor Rating: <?php the_field('flavor_rating'); ?> / 20</strong></p>
        <hr>
      <?php } ?>
      <?php if (get_field('mouthfeel_review')) { ?>
        <h2>Mouthfeel</h2>
        <?php the_field('mouthfeel_review'); ?>
        <p><strong>Mouthfeel Rating: <?php the_field('mouthfeel_rating'); ?> / 5</strong></p>
        <hr>
      <?php } ?>
      <?php if (get_field('overall_review')) { ?>
        <h2>Overall</h2>
        <?php the_field('overall_review'); ?>
        <p><strong>Overall Rating: <?php the_field('overall_rating'); ?> / 10</strong></p>
      <?php } ?>
			<?php
				wp_link_pages( array(
					'before'            => '<div class="page-links">'.__( 'Pages:', 'sparkling' ),
					'after'             => '</div>',
					'link_before'       => '<span>',
					'link_after'        => '</span>',
					'pagelink'          => '%',
					'echo'              => 1
	       		) );
	    	?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">

	    	<?php if(has_tag()) : ?>
	      <!-- tags -->
	      <div class="tagcloud">

	          <?php
	              $tags = get_the_tags(get_the_ID());
	              foreach($tags as $tag){
	                  echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a> ';
	              } ?>

	      </div>
	      <!-- end tags -->
	      <?php endif; ?>

		</footer><!-- .entry-meta -->
	</div>

  <div class="post-inner-content secondary-content-box final-score">
    <?php include 'final-score.php' ?>
  </div>

	<?php if (get_the_author_meta('description')) :  ?>
		<div class="post-inner-content secondary-content-box">
      <!-- author bio -->
      <div class="author-bio content-box-inner">

        <!-- avatar -->
        <div class="avatar">
            <?php echo get_avatar(get_the_author_meta('ID') , '60'); ?>
        </div>
        <!-- end avatar -->

        <!-- user bio -->
        <div class="author-bio-content">

          <h4 class="author-name"><a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author_meta('display_name'); ?></a></h4>
          <p class="author-description">
              <?php echo get_the_author_meta('description'); ?>
          </p>

        </div><!-- end .author-bio-content -->

      </div><!-- end .author-bio  -->

		</div>
		<?php endif; ?>

</article><!-- #post-## -->
