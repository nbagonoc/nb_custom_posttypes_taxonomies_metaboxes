<?php

function nb_custom_post_types(){
    //testimonials
    $labels = array(
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'menu_name'          => 'Testimonials',
        'name_admin_bar'     => 'Testimonial',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Testimonial',
        'new_item'           => 'New Testimonial',
        'edit_item'          => 'Edit Testimonial',
        'view_item'          => 'View Testimonial',
        'all_items'          => 'All Testimonials',
        'search_items'       => 'Search Testimonials',
        'parent_item_colon'  => 'Parent Testimonials:',
        'not_found'          => 'No testimonials found.',
        'not_found_in_trash' => 'No testimonials found in Trash.',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-format-status',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonials' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail' )
    );
    register_post_type('testimonial', $args);
    //reviews
    $labels = array(
        'name'               => 'Reviews',
        'singular_name'      => 'Review',
        'menu_name'          => 'Reviews',
        'name_admin_bar'     => 'Review',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Review',
        'new_item'           => 'New Review',
        'edit_item'          => 'Edit Review',
        'view_item'          => 'View Review',
        'all_items'          => 'All Reviews',
        'search_items'       => 'Search Reviews',
        'parent_item_colon'  => 'Parent Reviews:',
        'not_found'          => 'No reviews found.',
        'not_found_in_trash' => 'No reviews found in Trash.',
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_icon'          => 'dashicons-star-filled',
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'reviews' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'author' ),
        'taxonomies'         => array('category','post-tag')
    );
    register_post_type('review', $args);
}
add_action('init','nb_custom_post_types');

function my_rewrite_flush() {
    // First, we "add" the custom post type via the above written function.
    // Note: "add" is written with quotes, as CPTs don't get added to the DB,
    // They are only referenced in the post_type column with a post entry, 
    // when you add a post of this CPT.
    nb_custom_post_types();

    // ATTENTION: This is *only* done during plugin activation hook in this example!
    // You should *NEVER EVER* do this on every page load!!
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'my_rewrite_flush' );

function nb_custom_taxonomies(){
    // Type of Product/Service taxonomy
    $labels = array(
        'name'              => 'Type of Products/Services',
        'singular_name'     => 'Type of Product/Service',
        'search_items'      => 'Search Types of Products/Services',
        'all_items'         => 'All Types of Products/Services',
        'parent_item'       => 'Parent Type of Product/Service',
        'parent_item_colon' => 'Parent Type of Product/Service:',
        'edit_item'         => 'Edit Type of Product/Service',
        'update_item'       => 'Update Type of Product/Service',
        'add_new_item'      => 'Add New Type of Product/Service',
        'new_item_name'     => 'New Type of Product/Service Name',
        'menu_name'         => 'Type of Product/Service',
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'product-types' ),
    );
    register_taxonomy( 'product-type', array( 'review' ), $args );
    
    // Mood taxonomy (non-hierarchical)
    $labels = array(
        'name'                       => 'Moods',
        'singular_name'              => 'Mood',
        'search_items'               => 'Search Moods',
        'popular_items'              => 'Popular Moods',
        'all_items'                  => 'All Moods',
        'parent_item'                => null,
        'parent_item_colon'          => null,
        'edit_item'                  => 'Edit Mood',
        'update_item'                => 'Update Mood',
        'add_new_item'               => 'Add New Mood',
        'new_item_name'              => 'New Mood Name',
        'separate_items_with_commas' => 'Separate moods with commas',
        'add_or_remove_items'        => 'Add or remove moods',
        'choose_from_most_used'      => 'Choose from the most used moods',
        'not_found'                  => 'No moods found.',
        'menu_name'                  => 'Moods',
    );
    $args = array(
        'hierarchical'          => false,
        'labels'                => $labels,
        'show_ui'               => true,
        'show_admin_column'     => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'rewrite'               => array( 'slug' => 'moods' ),
    );
    register_taxonomy( 'mood', array( 'review', 'post' ), $args );
    
    // Price Range taxonomy
    $labels = array(
        'name'              => 'Price Ranges',
        'singular_name'     => 'Price Range',
        'search_items'      => 'Search Price Ranges',
        'all_items'         => 'All Price Ranges',
        'parent_item'       => 'Parent Price Range',
        'parent_item_colon' => 'Parent Price Range:',
        'edit_item'         => 'Edit Price Range',
        'update_item'       => 'Update Price Range',
        'add_new_item'      => 'Add New Price Range',
        'new_item_name'     => 'New Price Range',
        'menu_name'         => 'Price Range',
    );
    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array( 'slug' => 'prices' ),
    );
    register_taxonomy( 'price', array( 'review' ), $args );
}
add_action('init','nb_custom_taxonomies');


// META BOXES
// register meta box
function nb_option_add_meta_box() {
	$post_types = array( 'post', 'review' );
	foreach ( $post_types as $post_type ) {
		add_meta_box(
			'nb_option_meta_box',         // Unique ID of meta box
			'Option',         // Title of meta box
			'nb_option_display_meta_box', // Callback function
			$post_type                   // Post type
		);
	}
}
add_action( 'add_meta_boxes', 'nb_option_add_meta_box' );

// display meta box
function nb_option_display_meta_box( $post ) {
	$value = get_post_meta( $post->ID, 'nb_option_meta_key', true );
	wp_nonce_field( basename( __FILE__ ), 'nb_option_meta_box_nonce' );
	?>
	<label for="nb-option-meta-box">Field Description</label>
	<select id="nb-option-meta-box" name="nb-option-meta-box">
		<option value="">Select option...</option>
		<option value="option-1" <?php selected( $value, 'option-1' ); ?>>Option 1</option>
		<option value="option-2" <?php selected( $value, 'option-2' ); ?>>Option 2</option>
		<option value="option-3" <?php selected( $value, 'option-3' ); ?>>Option 3</option>
	</select>
<?php
}
// save meta box
function nb_option_save_meta_box( $post_id ) {
	$is_autosave = wp_is_post_autosave( $post_id );
	$is_revision = wp_is_post_revision( $post_id );
	$is_valid_nonce = false;
	if ( isset( $_POST[ 'nb_option_meta_box_nonce' ] ) ) {
		if ( wp_verify_nonce( $_POST[ 'nb_option_meta_box_nonce' ], basename( __FILE__ ) ) ) {
			$is_valid_nonce = true;
		}
	}
	if ( $is_autosave || $is_revision || !$is_valid_nonce ) return;
	if ( array_key_exists( 'nb-option-meta-box', $_POST ) ) {
		update_post_meta(
			$post_id,                                            // Post ID
			'nb_option_meta_key',                                // Meta key
			sanitize_text_field( $_POST[ 'nb-option-meta-box' ] ) // Meta value
		);
	}
}
add_action( 'save_post', 'nb_option_save_meta_box' );