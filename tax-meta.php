<?php
/*
Plugin Name: Tax Meta
Plugin URI: http://example.com/
Description: Demonstration of creating tax meta field.
Version: 1.0
Author: sadat himel
Author URI: http://example.com/
License: GPLv2 or later
Text Domain: tax-meta
Domain Path: /languages
*/

function taxm_load_textdomain(){
    load_plugin_textdomain( 'tax-meta', false, dirname(__FILE__) . "/languages");
}
add_action( 'plugin_loaded', 'taxm_load_textdomain' );


function taxm_bootstrap(){
    $arguments = array(
        'type'              => 'string',
        'description'       => 'Simple meta field for category tax',
        'single'            => true,
        'sanitize_callback' => 'sanitize_text_field',
        'show_in_rest'      => true,
    );
    register_meta('term','taxm_extra_info',$arguments); 
}

add_action( 'init', 'taxm_bootstrap');

function taxm_category_form_fields()
{
?>
    <div class="form-field form-required term-name-wrap form-invalid">
        <label for="tag-name"><?php _e('Extra info','tax-meta'); ?></label>
        <input name="extra-info" id="extra-info" type="text" value="" size="40" aria-required="true">
        <p><?php _e('Some help Text','tax-meta') ?></p>
    </div>
<?php
}
add_action( 'category_add_form_fields', 'taxm_category_form_fields');


function taxm_category_edit_form_fields($term)
{
    $extra_info = get_term_meta( $term->term_id, 'taxm_extra_info', true )
?>
    <tr class="form-field form-required term-name-wrap">
        <th scope="row"><label for="name"><?php _e('Extra info','tax-meta'); ?></label></th>
        <td>
            <input name="extra-info" id="extra-info" type="text" value="<?php echo esc_attr($extra_info) ?>" size="40" aria-required="true">
            <p><?php _e('Some help Text','tax-meta') ?></p>
        </td>
	</tr>
<?php
}
add_action( 'category_edit_form_fields', 'taxm_category_edit_form_fields');


function save_category_meta($term_id)
{
    if(wp_verify_nonce( $_POST['_wpnonce_add-tag'], 'add-tag' )){
        $extra_info = sanitize_text_field($_POST['extra-info']);
        update_term_meta( $term_id, 'taxm_extra_info', $extra_info);
    }
}
add_action( 'create_category', 'save_category_meta');