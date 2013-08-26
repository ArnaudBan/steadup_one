<?php
/**
 * Add metabox to page
 */
function abso_add_bgcolor_to_page() {

  add_meta_box(
      'abso_page_bgcolor',
      __( 'Background Color', 'steadup' ),
      'abso_bgcolor_metabox_content',
      'page',
      'side',
      'core'
  );

}
add_action( 'add_meta_boxes', 'abso_add_bgcolor_to_page' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function abso_bgcolor_metabox_content( $post ) {

	// Add script
  wp_enqueue_style('wp-color-picker');
  wp_enqueue_script('abso_admin_scripts');

  // Use nonce for verification
  wp_nonce_field( plugin_basename( __FILE__ ), 'abso_steadup_page_bgcolor' );

  $value = get_post_meta( $post->ID, 'steadup_page_bgcolor', true );

  echo '<label for="steadup_page_bgcolor">';
       _e("Color", 'steadup' );
  echo '</label><br/>';
  echo '<input type="text" id="steadup_page_bgcolor" name="steadup_page_bgcolor" value="' . esc_attr( $value ) . '" />';

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function abso_save_pagebgcolor( $post_id ) {

	 if ( ! current_user_can( 'edit_post', $post_id ) )
    return;

  // Secondly we need to check if the user intended to change this value.
  if ( ! isset( $_POST['steadup_page_bgcolor'] ) || ! wp_verify_nonce( $_POST['abso_steadup_page_bgcolor'], plugin_basename( __FILE__ ) ) )
      return;

	 $bgcolor = sanitize_text_field( $_POST['steadup_page_bgcolor'] );

  // Update the meta field in the database.
  update_post_meta( $post_id, 'steadup_page_bgcolor', $bgcolor );

}
add_action( 'save_post', 'abso_save_pagebgcolor' );

?>