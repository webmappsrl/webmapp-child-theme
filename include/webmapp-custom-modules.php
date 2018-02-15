<?php/** * Created by PhpStorm. * User: lucabaroncini * Date: 19/10/17 * Time: 09:09 */class Webmapp_Custom_Module_Portfolio extends ET_Builder_Module {	function init() {		$this->name       = esc_html__( 'Webmapp Portfolio', 'et_builder' );		$this->slug       = 'et_pb_webmapp_portfolio';		$this->fb_support = TRUE;		$this->whitelisted_fields = [			'fullwidth',			'post_type',            'order',            'orderby',            'posts_number',			'include_categories',            'column',			'show_title',			'show_categories',			'show_pagination',			'background_layout',			'admin_label',			'module_id',			'module_class',		];		$this->fields_defaults = [			'fullwidth'         => [ 'off' ],			'post_type'         => [ 'route' ],			'posts_number'      => [ 1, 'add_default_setting' ],			'show_title'        => [ 'on' ],			'show_categories'   => [ 'on' ],			'show_pagination'   => [ 'off' ],			'background_layout' => [ 'dark' ],			'column'            => [ 'wm-column-1' ],		];		$this->main_css_element   = '%%order_class%% .et_pb_portfolio_item';		$this->advanced_options   = [			'fonts'      => [				'title'   => [					'label' => esc_html__( 'Title', 'et_builder' ),					'css'   => [						'main'      => "{$this->main_css_element} h2, {$this->main_css_element} h2 a",						'important' => 'all',					],				],				'caption' => [					'label' => esc_html__( 'Meta', 'et_builder' ),					'css'   => [						'main' => "{$this->main_css_element} .post-meta, {$this->main_css_element} .post-meta a",					],				],			],			'background' => [				'settings' => [					'color' => 'alpha',				],			],			'border'     => [],		];		$this->custom_css_options = [			'portfolio_image'     => [				'label'    => esc_html__( 'Portfolio Image', 'et_builder' ),				'selector' => '.et_portfolio_image',			],/*			'overlay'             => [				'label'    => esc_html__( 'Overlay', 'et_builder' ),				'selector' => '.et_overlay',			],			'overlay_icon'        => [				'label'    => esc_html__( 'Overlay Icon', 'et_builder' ),				'selector' => '.et_overlay:before',			],*/			'portfolio_title'     => [				'label'    => esc_html__( 'Portfolio Title', 'et_builder' ),				'selector' => '.et_pb_portfolio_item h2',			],			'portfolio_post_meta' => [				'label'    => esc_html__( 'Portfolio Post Meta', 'et_builder' ),				'selector' => '.et_pb_portfolio_item .post-meta',			],		];	}	function get_fields() {		$types = [];		foreach ( get_post_types( [ 'public' => TRUE ], 'names' ) as $post_type ) {			$types[ $post_type ] = $post_type;		}		$fields = [			'fullwidth'           => [				'label'            => esc_html__( 'Layout', 'et_builder' ),				'type'             => 'select',				'option_category'  => 'layout',				'options'          => [					'on'  => esc_html__( 'Fullwidth', 'et_builder' ),					'off' => esc_html__( 'Grid', 'et_builder' ),				],				'description'      => esc_html__( 'Choose your desired portfolio layout style.', 'et_builder' ),				'computed_affects' => [					'__poi',				],			],			'type'                => [				'label'           => esc_html__( 'Post type', 'et_builder' ),				'type'            => 'select',				'option_category' => 'basic_option',				'options'         => $types,				'description'     => esc_html__( 'Post type dysplayed', 'et_builder' ),			],			'orderby'             => [				'label'           => esc_html__( 'Order by', 'et_builder' ),				'type'            => 'select',				'option_category' => 'basic_option',				'options'         => [					'title'    => 'Titolo',					'name'     => 'Slug',					'date'     => 'Data',					'modified' => 'Data modifica',					'rand'     => 'Random',				],				'description'     => esc_html__( 'Ordine di visualizzazione', 'et_builder' ),			],			'order'               => [				'label'           => esc_html__( 'Order', 'et_builder' ),				'type'            => 'select',				'option_category' => 'basic_option',				'options'         => [					'ASC'  => 'Ascendente',					'DESC' => 'Discendente',				],				'description'     => esc_html__( 'Ordine di visualizzazione', 'et_builder' ),			],			'posts_number'        => [				'label'            => esc_html__( 'Posts Number', 'et_builder' ),				'type'             => 'text',				'option_category'  => 'configuration',				'description'      => esc_html__( 'Define the number of pois that should be displayed per page.', 'et_builder' ),				'computed_affects' => [					'__poi',				],			],			'column'        => [				'label'            => esc_html__( 'Numero di colonne', 'et_builder' ),				'type'             => 'select',				'option_category'  => 'basic_option',				'options'         => [					'wm-column-1'  => '1',					'wm-column-2'  => '2',					'wm-column-3'  => '3',					'wm-column-4'  => '4',				],				'description'      => esc_html__( 'Define the number of columns', 'et_builder' ),			],			'include_categories'  => [				'label'            => esc_html__( 'Include Categories', 'et_builder' ),				'renderer'         => 'et_builder_include_webmapp_categories_option',				'option_category'  => 'basic_option',				'description'      => esc_html__( 'Select the categories that you would like to include in the feed.', 'et_builder' ),				'computed_affects' => [					'__poi',				],				'taxonomy_name'    => 'webmapp_category',			],			'show_title'          => [				'label'           => esc_html__( 'Show Title', 'et_builder' ),				'type'            => 'yes_no_button',				'option_category' => 'configuration',				'options'         => [					'on'  => esc_html__( 'Yes', 'et_builder' ),					'off' => esc_html__( 'No', 'et_builder' ),				],				'description'     => esc_html__( 'Turn poi titles on or off.', 'et_builder' ),			],			'show_categories'     => [				'label'           => esc_html__( 'Show Categories', 'et_builder' ),				'type'            => 'yes_no_button',				'option_category' => 'configuration',				'options'         => [					'on'  => esc_html__( 'Yes', 'et_builder' ),					'off' => esc_html__( 'No', 'et_builder' ),				],				'description'     => esc_html__( 'Turn the category links on or off.', 'et_builder' ),			],			'show_pagination'     => [				'label'           => esc_html__( 'Show Pagination', 'et_builder' ),				'type'            => 'yes_no_button',				'option_category' => 'configuration',				'options'         => [					'on'  => esc_html__( 'Yes', 'et_builder' ),					'off' => esc_html__( 'No', 'et_builder' ),				],				'description'     => esc_html__( 'Enable or disable pagination for this feed.', 'et_builder' ),			],			'background_layout'   => [				'label'           => esc_html__( 'Text Color', 'et_builder' ),				'type'            => 'select',				'option_category' => 'color_option',				'options'         => [					'light' => esc_html__( 'Dark', 'et_builder' ),					'dark'  => esc_html__( 'Light', 'et_builder' ),				],				'description'     => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'et_builder' ),			], /*			'zoom_icon_color'     => [				'label'        => esc_html__( 'Zoom Icon Color', 'et_builder' ),				'type'         => 'color',				'custom_color' => TRUE,				'tab_slug'     => 'advanced',			],			'hover_overlay_color' => [				'label'        => esc_html__( 'Hover Overlay Color', 'et_builder' ),				'type'         => 'color-alpha',				'custom_color' => TRUE,				'tab_slug'     => 'advanced',			],			'hover_icon'          => [				'label'               => esc_html__( 'Hover Icon Picker', 'et_builder' ),				'type'                => 'text',				'option_category'     => 'configuration',				'class'               => [ 'et-pb-font-icon' ],				'renderer'            => 'et_pb_get_font_icon_list',				'renderer_with_field' => TRUE,				'tab_slug'            => 'advanced',			],*/			'disabled_on'         => [				'label'           => esc_html__( 'Disable on', 'et_builder' ),				'type'            => 'multiple_checkboxes',				'options'         => [					'phone'   => esc_html__( 'Phone', 'et_builder' ),					'tablet'  => esc_html__( 'Tablet', 'et_builder' ),					'desktop' => esc_html__( 'Desktop', 'et_builder' ),				],				'additional_att'  => 'disable_on',				'option_category' => 'configuration',				'description'     => esc_html__( 'This will disable the module on selected devices', 'et_builder' ),			],			'admin_label'         => [				'label'       => esc_html__( 'Admin Label', 'et_builder' ),				'type'        => 'text',				'description' => esc_html__( 'This will change the label of the module in the builder for easy identification.', 'et_builder' ),			],			'module_id'           => [				'label'           => esc_html__( 'CSS ID', 'et_builder' ),				'type'            => 'text',				'option_category' => 'configuration',				'tab_slug'        => 'custom_css',				'option_class'    => 'et_pb_custom_css_regular',			],			'module_class'        => [				'label'           => esc_html__( 'CSS Class', 'et_builder' ),				'type'            => 'text',				'option_category' => 'configuration',				'tab_slug'        => 'custom_css',				'option_class'    => 'et_pb_custom_css_regular',			],			'__projects'               => [				'type'                => 'computed',				'computed_callback'   => [					'ET_Builder_Module_Portfolio',					'get_portfolio_item',				],				'computed_depends_on' => [					'posts_number',					'include_categories',					'fullwidth',				],			],		];		return $fields;	}	/**	 * Get portfolio objects for portfolio module	 *	 * @param array  arguments that affect et_pb_portfolio query	 * @param array  passed conditional tag for update process	 * @param array  passed current page params	 *	 * @return array portfolio item data	 */	static function get_portfolio_item( $args = [], $conditional_tags = [], $current_page = [] ) {		global $et_fb_processing_shortcode_object;		$global_processing_original_value = $et_fb_processing_shortcode_object;		$defaults = [			'posts_number'       => 1,			'include_categories' => 0,			'fullwidth'          => 'off',			'type'               => 'route',			'order'              => 'ASC',			'orderby'            => 'title'		];		$args = wp_parse_args( $args, $defaults );		// Native conditional tag only works on page load. Data update needs $conditional_tags data		$is_front_page = et_fb_conditional_tag( 'is_front_page', $conditional_tags );		$is_search     = et_fb_conditional_tag( 'is_search', $conditional_tags );		// Prepare query arguments		$query_args = [			'posts_per_page' => (int) $args['posts_number'],			'post_type'      => $args['type'],			'orderby'        => $args['orderby'],			'order'          => $args['order'],			'post_status'    => 'publish',		];		// Conditionally get paged data		if ( defined( 'DOING_AJAX' ) && isset( $current_page['paged'] ) ) {			$et_paged = intval( $current_page['paged'] );		} else {			$et_paged = $is_front_page ? get_query_var( 'page' ) : get_query_var( 'paged' );		}		if ( $is_front_page ) {			$paged = $et_paged;		}		if ( ! is_search() ) {			$query_args['paged'] = $et_paged;		}		// Passed categories parameter		if ( '' !== $args['include_categories'] ) {			$query_args['tax_query'] = [				[					'taxonomy' => 'webmapp_category',					'field'    => 'id',					'terms'    => explode( ',', $args['include_categories'] ),					'operator' => 'IN',				],			];		}		// Get portfolio query		$query = new WP_Query( $query_args );		// Format portfolio output, and add supplementary data		$width     = 'on' === $args['fullwidth'] ? 1080 : 400;		$width     = (int) apply_filters( 'et_pb_portfolio_image_width', $width );		$height    = 'on' === $args['fullwidth'] ? 9999 : 284;		$height    = (int) apply_filters( 'et_pb_portfolio_image_height', $height );		$classtext = 'on' === $args['fullwidth'] ? 'et_pb_post_main_image' : '';		$titletext = get_the_title();		// Loop portfolio item data and add supplementary data		if ( $query->have_posts() ) {			$post_index = 0;			while ( $query->have_posts() ) {				$query->the_post();				$categories = [];				$categories_object = get_the_terms( get_the_ID(), 'webmapp_category' );				if ( ! empty( $categories_object ) ) {					foreach ( $categories_object as $category ) {						$categories[] = [							'id'        => $category->term_id,							'label'     => $category->name,							'permalink' => get_term_link( $category ),						];					}				}				// need to disable processnig to make sure get_thumbnail() doesn't generate errors				$et_fb_processing_shortcode_object = FALSE;				// Get thumbnail				$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, FALSE, 'Blogimage' );				$et_fb_processing_shortcode_object = $global_processing_original_value;				// Append value to query post				$query->posts[ $post_index ]->post_permalink  = get_permalink();				$query->posts[ $post_index ]->post_thumbnail  = print_thumbnail( $thumbnail['thumb'], $thumbnail['use_timthumb'], $titletext, $width, $height, '', FALSE, TRUE );				$query->posts[ $post_index ]->post_categories = $categories;				$query->posts[ $post_index ]->post_class_name = get_post_class( '', get_the_ID() );				$post_index ++;			}			$query->posts_next = [				'label' => esc_html__( '&laquo; Older Entries', 'et_builder' ),				'url'   => next_posts( $query->max_num_pages, FALSE ),			];			$query->posts_prev = [				'label' => esc_html__( 'Next Entries &raquo;', 'et_builder' ),				'url'   => ( $et_paged > 1 ) ? previous_posts( FALSE ) : '',			];			// Added wp_pagenavi support			$query->wp_pagenavi = function_exists( 'wp_pagenavi' ) ? wp_pagenavi( [				'query' => $query,				'echo'  => FALSE,			] ) : FALSE;		}		wp_reset_postdata();		return $query;	}	function shortcode_callback( $atts, $content = NULL, $function_name ) {		$module_id           = $this->shortcode_atts['module_id'];		$type                = $this->shortcode_atts['post_type'];		$order               = $this->shortcode_atts['order'];		$orderby             = $this->shortcode_atts['orderby'];		$module_class        = $this->shortcode_atts['module_class'];		$fullwidth           = $this->shortcode_atts['fullwidth'];		$posts_number        = $this->shortcode_atts['posts_number'];		$include_categories  = $this->shortcode_atts['include_categories'];		$show_title          = $this->shortcode_atts['show_title'];		$show_categories     = $this->shortcode_atts['show_categories'];		$show_pagination     = $this->shortcode_atts['show_pagination'];		$background_layout   = $this->shortcode_atts['background_layout'];		/*$zoom_icon_color     = $this->shortcode_atts['zoom_icon_color'];		$hover_overlay_color = $this->shortcode_atts['hover_overlay_color'];		$hover_icon          = $this->shortcode_atts['hover_icon'];*/		$column              = $this->shortcode_atts['column'];		global $paged;		$module_class = ET_Builder_Element::add_module_order_class( $module_class, $function_name );		/* Set inline style		if ( '' !== $zoom_icon_color ) {			ET_Builder_Element::set_style( $function_name, [				'selector'    => '%%order_class%% .et_overlay:before',				'declaration' => sprintf(					'color: %1$s !important;',					esc_html( $zoom_icon_color )				),			] );		}		if ( '' !== $hover_overlay_color ) {			ET_Builder_Element::set_style( $function_name, [				'selector'    => '%%order_class%% .et_overlay',				'declaration' => sprintf(					'background-color: %1$s;					border-color: %1$s;',					esc_html( $hover_overlay_color )				),			] );		} */		$container_is_closed = FALSE;		// Get loop data		$portfolio = self::get_portfolio_item( [			'posts_number'       => $posts_number,			'include_categories' => $include_categories,			'fullwidth'          => $fullwidth,            'type'               => $type,            'order'              => $order,            'orderby'            => $orderby		] );		ob_start();		if ( $portfolio->have_posts() ) {			while ( $portfolio->have_posts() ) {				$portfolio->the_post();				// Get $post data of current loop				global $post;				array_push( $post->post_class_name, 'et_pb_portfolio_item' );				if ( 'on' !== $fullwidth ) {					array_push( $post->post_class_name, 'et_pb_grid_item' );					array_push( $post->post_class_name, $column );				}				?>                <div id="post-<?php echo esc_attr( $post->ID ); ?>"                     class="<?php echo esc_attr( join( $post->post_class_name, ' ' ) ); ?>">					<?php if ( '' !== $post->post_thumbnail ) { ?>                        <a href="<?php echo esc_url( $post->post_permalink ); ?>"                           title="<?php echo esc_attr( get_the_title() ); ?>">							<?php if ( 'on' === $fullwidth ) { ?>                                <img                                    src="<?php echo esc_url( $post->post_thumbnail ); ?>"                                    alt="<?php echo esc_attr( get_the_title() ); ?>"                                    width="1080" height="9999"/>							<?php } else { ?>                                <span class="et_portfolio_image">								<img                                    src="<?php echo esc_url( $post->post_thumbnail ); ?>"                                    alt="<?php echo esc_attr( get_the_title() ); ?>"                                    width="400" height="284"/>									<?php// echo $overlay; ?>							</span>							<?php } ?>                        </a>					<?php }					$activities = get_the_terms($post->ID, 'activity');					if (!empty($activities)) {						foreach ( $activities as $activity ) {							$icon = get_field('icon', $activity->taxonomy . '_' . $activity->term_id);							echo '<div class="wm-activities"><span class="' . $icon . '"> </span> ' . $activity->name . '</div>';						}					}					if ( 'on' === $show_title ) { ?>                        <h2>                            <a href="<?php echo esc_url( $post->post_permalink ); ?>"                               title="<?php echo esc_attr( get_the_title() ); ?>">								<?php echo esc_html( get_the_title() ); ?>                            </a>                        </h2>					<?php } ?>					<?php if ( 'on' === $show_categories  ) : ?>                        <p class="post-meta">							<?php							$where_terms = get_the_terms($post->ID, 'where');							if (!empty($where_terms)) {                                foreach ( $where_terms as $where ) {                                    echo '<span class="wm-where">' . $where->name . ' ' . '</span>';                                }							}							$themes = get_the_terms($post->ID, 'theme');							if (!empty($themes)) {								foreach ( $themes as $theme ) {									$icon = get_field('icon', $theme->taxonomy . '_' . $theme->term_id);									echo ' <span class="' . $icon . '"></span> ';								}							}							$who_terms = get_the_terms($post->ID, 'who');							if (!empty($who_terms)) {								foreach ( $who_terms as $who ) {									$icon = get_field('icon', $who->taxonomy . '_' . $who->term_id);									echo ' <span class="' . $icon . '"></span> ';								}							}							$seasons = get_the_terms($post->ID, 'when');							if (!empty($seasons)) {								foreach ( $seasons as $season ) {									$icon = get_field('icon', $season->taxonomy . '_' . $season->term_id);									echo ' <span class="' . $icon . '"></span> ';								}							}							?>                        </p>					<?php endif; ?>                </div><!-- .et_pb_portfolio_item -->				<?php			}			if ( 'on' === $show_pagination && ! is_search() ) {				if ( function_exists( 'wp_pagenavi' ) ) {					wp_pagenavi( [ 'query' => $portfolio ] );				} else {					$next_posts_link_html = $prev_posts_link_html = '';					if ( ! empty( $portfolio->posts_next['url'] ) ) {						$next_posts_link_html = sprintf(							'<div class="alignleft">								<a href="%1$s">%2$s</a>							</div>',							esc_url( $portfolio->posts_next['url'] ),							esc_html( $portfolio->posts_next['label'] )						);					}					if ( ! empty( $portfolio->posts_prev['url'] ) ) {						$prev_posts_link_html = sprintf(							'<div class="alignright">								<a href="%1$s">%2$s</a>							</div>',							esc_url( $portfolio->posts_prev['url'] ),							esc_html( $portfolio->posts_prev['label'] )						);					}					printf(						'<div class="pagination clearfix">							%1$s							%2$s						</div>',						$next_posts_link_html,						$prev_posts_link_html					);				}			}		} else {			if ( et_is_builder_plugin_active() ) {				include( ET_BUILDER_PLUGIN_DIR . 'includes/no-results.php' );			} else {				get_template_part( 'includes/no-results', 'index' );			}		}		// Reset post data		wp_reset_postdata();		$posts = ob_get_contents();		ob_end_clean();		$class = " et_pb_module et_pb_bg_layout_{$background_layout}";		$output = sprintf(			'<div%5$s class="%1$s%3$s%6$s">				%2$s			%4$s',			( 'on' === $fullwidth ? 'et_pb_portfolio' : 'et_pb_portfolio_grid clearfix' ),			$posts,			esc_attr( $class ),			( ! $container_is_closed ? '</div> <!-- .et_pb_portfolio -->' : '' ),			( '' !== $module_id ? sprintf( ' id="%1$s"', esc_attr( $module_id ) ) : '' ),			( '' !== $module_class ? sprintf( ' %1$s', esc_attr( $module_class ) ) : '' )		);		return $output;	}}new Webmapp_Custom_Module_Portfolio;if ( ! function_exists( 'et_builder_include_webmapp_categories_option' ) ) :	function et_builder_include_webmapp_categories_option( $args = [] ) {		$defaults = apply_filters( 'et_builder_include_categories_defaults', [			'use_terms' => TRUE,			'term_name' => 'webmapp_category',		] );		$args = wp_parse_args( $args, $defaults );		$output = "\t" . "<% var et_pb_include_categories_temp = typeof et_pb_include_categories !== 'undefined' ? et_pb_include_categories.split( ',' ) : []; %>" . "\n";		if ( $args['use_terms'] ) {			$cats_array = get_terms( $args['term_name'] );		} else {			$cats_array = get_categories( apply_filters( 'et_builder_get_categories_args', 'hide_empty=0' ) );		}		if ( empty( $cats_array ) ) {			$output = '<p>' . esc_html__( "You currently don't have any projects assigned to a category.", 'et_builder' ) . '</p>';		}		foreach ( $cats_array as $category ) {			$contains = sprintf(				'<%%= _.contains( et_pb_include_categories_temp, "%1$s" ) ? checked="checked" : "" %%>',				esc_html( $category->term_id )			);			$output .= sprintf(				'%4$s<label><input type="checkbox" name="et_pb_include_categories" value="%1$s"%3$s> %2$s</label><br/>',				esc_attr( $category->term_id ),				esc_html( $category->name ),				$contains,				"\n\t\t\t\t\t"			);		}		$output = '<div id="et_pb_include_categories">' . $output . '</div>';		return apply_filters( 'et_builder_include_webmapp_categories_option_html', $output );	}endif;class Webmapp_Custom_Category_list extends ET_Builder_Module {	function init() {		$this->name       = esc_html__( 'Webmapp Category list', 'et_builder' );		$this->slug       = 'et_pb_webmapp_category_list';		$this->fb_support = TRUE;		$this->whitelisted_fields = [			'taxonomy',			'object_ids',			'orderby',			'order',			'hide_empty',			'include',			'exclude',			'exclude_tree',			'number',			'name',		];		$this->fields_defaults = [			'taxonomy'               => 'theme',			'object_ids'             => null,			'orderby'                => 'name',			'order'                  => 'ASC',			'hide_empty'             => '1',			'include'                => array(),			'exclude'                => array(),			'exclude_tree'           => array(),			'number'                 => '',			'offset'                 => '',			'fields'                 => 'all',			'name'                   => '',		];	}	function get_fields() {		$fields = [			'taxonomy'          => [				'label'       => esc_html__( 'Taxonomy name', 'webmapp-child-theme' ),				'type'        => 'text',				'description' => esc_html__( 'Write here the name of taxonomy.', 'webmapp-child-theme' ),				'toggle_slug' => 'admin_label',			],			'orderby'             => [				'label'           => esc_html__( 'Order by', 'et_builder' ),				'type'            => 'select',				'option_category' => 'basic_option',				'options'         => [					'name'     => 'Nome',					'term_id'  => 'ID',					'count'  => 'Numero di elementi associati',				],				'description'     => esc_html__( 'Ordine di visualizzazione', 'et_builder' ),			],			'order'               => [				'label'           => esc_html__( 'Order', 'et_builder' ),				'type'            => 'select',				'option_category' => 'basic_option',				'options'         => [					'ASC'  => 'Ascendente',					'DESC' => 'Discendente',				],				'description'     => esc_html__( 'Ordine di visualizzazione', 'et_builder' ),			],			'number'        => [				'label'            => esc_html__( 'Posts Number', 'et_builder' ),				'type'             => 'text',				'option_category'  => 'configuration',				'description'      => esc_html__( 'Define the number of categories that should be displayed.', 'et_builder' ),			],		];		return $fields;	}	// Don't add text-shadow fields since they already are via font-options	protected function _add_additional_text_shadow_fields() {}	function shortcode_callback( $atts, $content = NULL, $function_name ) {		$taxonomy = $this->shortcode_atts['taxonomy'];		$object_ids = $this->shortcode_atts['object_ids'];		$orderby = $this->shortcode_atts['orderby'];		$order = $this->shortcode_atts['order'];		$hide_empty = $this->shortcode_atts['hide_empty'];		$include = $this->shortcode_atts['include'];		$exclude = $this->shortcode_atts['exclude'];		$exclude_tree = $this->shortcode_atts['exclude_tree'];		$number = $this->shortcode_atts['number'];		$name = $this->shortcode_atts['name'];		$args = array(            'taxonomy' => $taxonomy,            'hide_empty' => true,        );        $terms = get_terms($atts);		$output = 'test';		return $output;	}	public function _add_additional_shadow_fields() {	}	protected function _add_additional_border_fields() {		return false;	}	function process_advanced_border_options( $function_name ) {		return false;	}}new Webmapp_Custom_Category_list;