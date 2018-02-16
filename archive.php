<?php get_header(); ?>

    <div id="main-content">
        <?php if ( is_tax() ) :

	        $tax = get_queried_object();
	        $featured_image = get_field( 'featured_image', $tax->taxonomy . '_' . $tax->term_id );

	        if ( !empty($featured_image) ) : ?>
                <div class="wm-featured-image" style="background: url('<?php echo $featured_image['sizes']['et-pb-post-main-image-fullwidth']; ?>')"></div>
    <?php   endif; ?>
            <div class="container wm-intro-tax">
                <?php
                $icon = get_field('icon', $tax->taxonomy . '_' . $tax->term_id );
                if (!empty($icon)){
                    echo '<div class="wm-tax-icon"><span class="' . $icon . '"> </span> ' . $tax->name . '</div>';
                }

                $title = get_field( 'title', $tax->taxonomy . '_' . $tax->term_id );
                $description = term_description(  $tax->term_id, $tax->taxonomy );

                if ( !empty($title) ){
                    echo '<h2>' . $title . '</h2>';
                }
                if ( !empty($description) ){
                    echo $description;
                } ?>
            </div>
        <?php endif; ?>

        <div class="container">
            <div id="content-area" class="clearfix">
                <div class="et_pb_column">
                    <div id="area" class="et_pb_portfolio_grid ">
						<?php
						if ( have_posts() ) :
							while ( have_posts() ) : the_post();
								global $post;
								$class = [
									'wm-column-3',
									'et_pb_post',
									'et_pb_grid_item',
									'et_pb_portfolio_item',
								];

								$post_thumbnail = get_the_post_thumbnail_url( $post->ID, array(510, 287));
								if ( empty( $post_thumbnail ) ) {
									$url_img = get_stylesheet_directory_uri() . '/img/placeholder.jpg';
								} else {
									$url_img = esc_url( $post_thumbnail );
								}
								?>


                                <div
                                    id="<?php the_ID(); ?>" <?php post_class( $class ); ?>>

                                    <a href="<?php the_permalink(); ?>"
                                       title="Mavignola – Pinzolo">
							                                <span
                                                                class="et_portfolio_image">
								<img
                                    src="<?php echo $url_img; ?>"
                                    alt="<?php echo esc_attr( get_the_title() ); ?>"
                                    width="510" height="287"/>

							</span>
                                    </a>
									<?php
									$activities = get_the_terms( get_the_ID(), 'activity' );
									if ( !empty($activities) && count($activities) === 1 ) {
										$icon = get_field('icon', $activities[0]->taxonomy . '_' . $activities[0]->term_id);
										if (!empty($icon)){
											echo '<div class="wm-activity"><span class="' . $icon . '"> </span> ' . $activities[0]->name . '</div>';
										} else {
											echo '<div class="wm-activity">' . $activities[0]->name . '</div>';
										}

									} else {
										foreach ( $activities as $activity ) {
											$icon = get_field( 'icon', $activity->taxonomy . '_' . $activity->term_id );
											if ( ! empty( $icon ) ) {
												echo '<div class="wm-activities"><span class="' . $icon . '"> </span></div>';
											}
										}
									}
									?>
                                    <h2>
                                        <a href="<?php the_permalink(); ?>"
                                           title="<?php the_title(); ?>">
											<?php the_title(); ?></a>
                                    </h2>


                                    <p class="post-meta">
										<?php
										$where_terms = get_the_terms( get_the_ID(), 'where' );
										if ( ! empty( $where_terms ) ) {
											foreach ( $where_terms as $where ) {
												echo '<span class="wm-where">' . $where->name . ' ' . '</span>';
											}
										}
										$themes = get_the_terms( get_the_ID(), 'theme' );
										if ( ! empty( $themes ) ) {
											foreach ( $themes as $theme ) {

												$icon = get_field( 'icon', $theme->taxonomy . '_' . $theme->term_id );
												echo ' <span title="' . $theme->name . '"  class="' . $icon . '"></span> ';
											}
										}
										$who_terms = get_the_terms( get_the_ID(), 'who' );
										if ( ! empty( $who_terms ) ) {
											foreach ( $who_terms as $who ) {

												$icon = get_field( 'icon', $who->taxonomy . '_' . $who->term_id );
												echo ' <span title="' . $who->name . '"  class="' . $icon . '"></span> ';
											}
										}
										$seasons = get_the_terms( get_the_ID(), 'when' );
										if ( ! empty( $seasons ) ) {
											foreach ( $seasons as $season ) {

												$icon = get_field( 'icon', $season->taxonomy . '_' . $season->term_id );
												echo ' <span title="' . $season->name . '"  class="' . $icon . '"></span> ';
											}
										}

										?>
                                    </p>

                                </div>
							<?php endwhile;

							if ( function_exists( 'wp_pagenavi' ) ) {
								wp_pagenavi();
							} else {
								get_template_part( 'includes/navigation', 'archive' );
							}
						else :
							get_template_part( 'includes/no-results', 'archive' );
						endif;
						?>
                    </div> <!-- #area -->
                </div>

				<?php // get_sidebar(); ?>
            </div> <!-- #content-area -->
        </div> <!-- .container -->
    </div> <!-- #main-content -->

<?php get_footer(); ?>