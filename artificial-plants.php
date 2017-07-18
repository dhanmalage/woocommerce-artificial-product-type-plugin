<?php
 /**
 * WooCommerce Artificial Product Type
 *
 * This file is read by WordPress to generate the plugin information in the
 * plugin admin area. This file also includes all of the dependencies used by
 * the plugin, and defines a function that starts the plugin.
 *
 * @link              http://whenalive.com
 * @package           GreenLeaf
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Artificial Product Type
 * Plugin URI:        http://whenalive.com
 * Description:       Registering Artificial product type
 * Version:           1.0.0
 * Author:            Dhananjaya Maha Malage
 * Author URI:        https://whenalive.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
/**
 * Register the artificial product type after init
 */
function register_artificial_plant_product_type() {
	/**
	 * This should be in its own separate file.
	 */
	class WC_Product_Artificial_Plant extends WC_Product {
		public function __construct( $product ) {
			$this->product_type = 'artificial_plant';
			parent::__construct( $product );
		}
	}
			
}
add_action( 'plugins_loaded', 'register_artificial_plant_product_type' );

/**
 * enque required css and js.
 */
	
function artificial_plant_enqueue_script() {   
    wp_enqueue_script( 'artificial-plant-script', plugin_dir_url( __FILE__ ) . 'js/artificial-plant.js', '', '' );
	wp_enqueue_style('artificial-plant-css', plugin_dir_url( __FILE__ ) . '/css/styles.css', array(), '0.1.0', 'all');
	
	global $post; $woocommerce; $product;
	
	if(function_exists( 'wp_enqueue_media' )){
		wp_enqueue_media();
	}else{
		
		wp_enqueue_style('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		
	}
}
add_action('admin_enqueue_scripts', 'artificial_plant_enqueue_script');


/**
 * Add to product type drop down.
 */
function add_artificial_plant_product( $types ){
	// Key should be exactly the same as in the class
	$types[ 'artificial_plant' ] = __( 'Artificial Plant' );
	return $types;
}
add_filter( 'product_type_selector', 'add_artificial_plant_product' );
/**
 * Show pricing fields for artificial_plant product.
 */
function artificial_plant_custom_js() {
	if ( 'product' != get_post_type() ) :
		return;
	endif;
	?><script type='text/javascript'>
		jQuery( document ).ready( function() {
			//for Price tab
            jQuery('.product_data_tabs .general_tab').addClass('show_if_artificial_plant').show();
            jQuery('#general_product_data .pricing').addClass('show_if_artificial_plant').show();
			//variations
            jQuery('.variations_options').addClass('show_if_artificial_plant').show();
            jQuery('.enable_variation').addClass('show_if_artificial_plant').show();
            //for Inventory tab
            jQuery('.inventory_options').addClass('show_if_artificial_plant').show();
            jQuery('#inventory_product_data ._manage_stock_field').addClass('show_if_artificial_plant').show();
            jQuery('#inventory_product_data ._sold_individually_field').parent().addClass('show_if_artificial_plant').show();
            jQuery('#inventory_product_data ._sold_individually_field').addClass('show_if_artificial_plant').show();
		});
	</script><?php
}
add_action( 'admin_footer', 'artificial_plant_custom_js' );
/**
 * Add a custom product tab.
 */
function artificial_product_tabs( $tabs) {
	$tabs['artificial'] = array(
		'label'		=> __( 'Artificial Plant', 'woocommerce' ),
		'target'	=> 'artificial_options',
		'class'		=> array( 'show_if_artificial_plant', 'show_if_variable_artificial_plant'  ),
	);
	return $tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'artificial_product_tabs' );

function get_products_from_category_by_slug( $category_slug ) {

    $products_IDs = new WP_Query( array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'fields' => 'ids', 
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category_slug,
                'operator' => 'IN',
            )
        )
    ) );

    return $products_IDs;
}

/**
 * Contents of the rental options product tab.
 */
function artificial_options_product_tab_content() {
	global $post; $woocommerce; $product;
			
	?><div id='artificial_options' class='panel woocommerce_options_panel'><?php
		?>
		<div class='options_group'>
		<?php
			// Custom fields will be created here...
			
			
			
			
			
						
			echo '<p><strong>Plant 1</strong></p>';
			// Custom field Type
			?>						
			<p class="form-field custom_field_type">
				<label for="custom_field_type"><?php echo __( 'Plant 1 image', 'woocommerce' ); ?></label>
				<span class="wrap">
					<?php $plant_1_img = get_post_meta( $post->ID, '_plant_1_image', true ); ?>	
					<img class="plant_1_image " src="<?php echo $plant_1_img; ?>" height="100" width="100"/>				
					<input placeholder="<?php _e( 'Plant 1 image', 'woocommerce' ); ?>" class="plant_1_image_url" type="hidden" name="_plant_1_image" value="<?php echo $plant_1_img; ?>" step="any" min="0" style="width: 300px;" />					
				</span>
				<span class="artificial-img-desc"><a href="#" class="plant_1_image_upload">Upload</a> <?php _e( ' upload plant 1 image', 'woocommerce' ); ?></span>
			</p>			
			<?php
			// Plant Name Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_plant_name_artificial_1',
							'label'       => __( 'Plant Name', 'woocommerce' ),
							'placeholder' => 'Ex: Agleonema Friedman',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the plant name.', 'woocommerce' )
					)
			);
			
			// Vase Type Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_vase_type_artificial_1',
							'label'       => __( 'Vase Type', 'woocommerce' ),
							'placeholder' => 'Ex: Ovation Tall Vase',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the type of Vase.', 'woocommerce' )
					)
			);

			// Light Level Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_light_level_artificial_1',
							'label'       => __( 'Light Level', 'woocommerce' ),
							'placeholder' => 'Ex: Hard Light',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the Light Level.', 'woocommerce' )
					)
			);

			// Plant Width Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_width_multi_artificial_1',
							'label'             => __( 'Width', 'woocommerce' ),
							'placeholder'       => 'Width',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter width in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Height Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_height_multi_artificial_1',
							'label'             => __( 'Height ', 'woocommerce' ),
							'placeholder'       => 'Height',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter height in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Length Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_length_multi_artificial_1',
							'label'             => __( 'Length ', 'woocommerce' ),
							'placeholder'       => 'Length',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter length in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Height
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_height_artificial_1',
							'label'             => __( 'Plant Height', 'woocommerce' ),
							'placeholder'       => 'Plant Height',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter the plant height in cm', 'woocommerce' )

					)
			);
			
			echo '<hr>';
			
			echo '<p><strong>Plant 2</strong></p>';
			// Custom field Type
			?>						
			<p class="form-field custom_field_type">
				<label for="custom_field_type"><?php echo __( 'Plant 2 image', 'woocommerce' ); ?></label>
				<span class="wrap">
					<?php $plant_2_img = get_post_meta( $post->ID, '_plant_2_image', true ); ?>	
					<img class="plant_2_image " src="<?php echo $plant_2_img; ?>" height="100" width="100"/>				
					<input placeholder="<?php _e( 'Plant 2 image', 'woocommerce' ); ?>" class="plant_2_image_url" type="hidden" name="_plant_2_image" value="<?php echo $plant_2_img; ?>" step="any" min="0" style="width: 300px;" />					
				</span>
				<span class="artificial-img-desc"><a href="#" class="plant_2_image_upload">Upload</a> <?php _e( ' upload plant 2 image', 'woocommerce' ); ?></span>
			</p>			
			<?php	
			// Plant Name Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_plant_name_artificial_2',
							'label'       => __( 'Plant Name', 'woocommerce' ),
							'placeholder' => 'Ex: Agleonema Friedman',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the plant name.', 'woocommerce' )
					)
			);			
			// Vase Type Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_vase_type_artificial_2',
							'label'       => __( 'Vase Type', 'woocommerce' ),
							'placeholder' => 'Ex: Ovation Tall Vase',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the type of Vase.', 'woocommerce' )
					)
			);

			// Light Level Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_light_level_artificial_2',
							'label'       => __( 'Light Level', 'woocommerce' ),
							'placeholder' => 'Ex: Hard Light',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the Light Level.', 'woocommerce' )
					)
			);

			// Plant Width Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_width_multi_artificial_2',
							'label'             => __( 'Width', 'woocommerce' ),
							'placeholder'       => 'Width',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter width in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Height Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_height_multi_artificial_2',
							'label'             => __( 'Height ', 'woocommerce' ),
							'placeholder'       => 'Height',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter height in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Length Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_length_multi_artificial_2',
							'label'             => __( 'Length ', 'woocommerce' ),
							'placeholder'       => 'Length',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter length in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Height
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_height_artificial_2',
							'label'             => __( 'Plant Height', 'woocommerce' ),
							'placeholder'       => 'Plant Height',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter the plant height in cm', 'woocommerce' )

					)
			);
			
			echo '<hr>';
			
			echo '<p><strong>Plant 3</strong></p>';
			// Custom field Type
			?>						
			<p class="form-field custom_field_type">
				<label for="custom_field_type"><?php echo __( 'Plant 3 image', 'woocommerce' ); ?></label>
				<span class="wrap">
					<?php $plant_3_img = get_post_meta( $post->ID, '_plant_3_image', true ); ?>	
					<img class="plant_3_image " src="<?php echo $plant_3_img; ?>" height="100" width="100"/>				
					<input placeholder="<?php _e( 'Plant 3 image', 'woocommerce' ); ?>" class="plant_3_image_url" type="hidden" name="_plant_3_image" value="<?php echo $plant_3_img; ?>" step="any" min="0" style="width: 300px;" />					
				</span>
				<span class="artificial-img-desc"><a href="#" class="plant_3_image_upload">Upload</a> <?php _e( ' upload plant 3 image', 'woocommerce' ); ?></span>
			</p>			
			<?php	
			// Plant Name Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_plant_name_artificial_3',
							'label'       => __( 'Plant Name', 'woocommerce' ),
							'placeholder' => 'Ex: Agleonema Friedman',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the plant name.', 'woocommerce' )
					)
			);
			// Vase Type Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_vase_type_artificial_3',
							'label'       => __( 'Vase Type', 'woocommerce' ),
							'placeholder' => 'Ex: Ovation Tall Vase',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the type of Vase.', 'woocommerce' )
					)
			);

			// Light Level Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_light_level_artificial_3',
							'label'       => __( 'Light Level', 'woocommerce' ),
							'placeholder' => 'Ex: Hard Light',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the Light Level.', 'woocommerce' )
					)
			);

			// Plant Width Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_width_multi_artificial_3',
							'label'             => __( 'Width', 'woocommerce' ),
							'placeholder'       => 'Width',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter width in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Height Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_height_multi_artificial_3',
							'label'             => __( 'Height ', 'woocommerce' ),
							'placeholder'       => 'Height',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter height in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Length Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_length_multi_artificial_3',
							'label'             => __( 'Length ', 'woocommerce' ),
							'placeholder'       => 'Length',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter length in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Height
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_height_artificial_3',
							'label'             => __( 'Plant Height', 'woocommerce' ),
							'placeholder'       => 'Plant Height',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter the plant height in cm', 'woocommerce' )

					)
			);
			
			echo '<hr>';
			
			echo '<p><strong>Plant 4</strong></p>';
			// Custom field Type
			?>						
			<p class="form-field custom_field_type">
				<label for="custom_field_type"><?php echo __( 'Plant 4 image', 'woocommerce' ); ?></label>
				<span class="wrap">
					<?php $plant_4_img = get_post_meta( $post->ID, '_plant_4_image', true ); ?>	
					<img class="plant_4_image " src="<?php echo $plant_4_img; ?>" height="100" width="100"/>				
					<input placeholder="<?php _e( 'Plant 4 image', 'woocommerce' ); ?>" class="plant_4_image_url" type="hidden" name="_plant_4_image" value="<?php echo $plant_4_img; ?>" step="any" min="0" style="width: 300px;" />					
				</span>
				<span class="artificial-img-desc"><a href="#" class="plant_4_image_upload">Upload</a> <?php _e( ' upload plant 4 image', 'woocommerce' ); ?></span>
			</p>			
			<?php
			// Plant Name Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_plant_name_artificial_4',
							'label'       => __( 'Plant Name', 'woocommerce' ),
							'placeholder' => 'Ex: Agleonema Friedman',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the plant name.', 'woocommerce' )
					)
			);
			// Vase Type Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_vase_type_artificial_4',
							'label'       => __( 'Vase Type', 'woocommerce' ),
							'placeholder' => 'Ex: Ovation Tall Vase',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the type of Vase.', 'woocommerce' )
					)
			);

			// Light Level Field
			woocommerce_wp_text_input(
					array(
							'id'          => '_light_level_artificial_4',
							'label'       => __( 'Light Level', 'woocommerce' ),
							'placeholder' => 'Ex: Hard Light',
							'desc_tip'    => 'true',
							'description' => __( 'Enter the Light Level.', 'woocommerce' )
					)
			);

			// Plant Width Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_width_multi_artificial_4',
							'label'             => __( 'Width', 'woocommerce' ),
							'placeholder'       => 'Width',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter width in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Height Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_height_multi_artificial_4',
							'label'             => __( 'Height ', 'woocommerce' ),
							'placeholder'       => 'Height',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter height in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Length Multiply
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_length_multi_artificial_4',
							'label'             => __( 'Length ', 'woocommerce' ),
							'placeholder'       => 'Length',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter length in cm', 'woocommerce' ),
							'type'              => 'number',
							'custom_attributes' => array(
									'step' 	=> 'any',
									'min'	=> '0'
							)
					)
			);

			// Plant Height
			woocommerce_wp_text_input(
					array(
							'id'                => '_plant_height_artificial_4',
							'label'             => __( 'Plant Height', 'woocommerce' ),
							'placeholder'       => 'Plant Height',
							'desc_tip'    		=> 'true',
							'description'       => __( 'Enter the plant height in cm', 'woocommerce' )

					)
			);
			
			echo '<hr>';
			
		?>
		</div>

	</div><?php
}
add_action( 'woocommerce_product_data_panels', 'artificial_options_product_tab_content' );
/**
 * Save the custom fields.
 */
function save_artificial_option_field( $post_id ) {
	
	if ( isset( $_POST['_plant_name_artificial_1'] ) ) : update_post_meta( $post_id, '_plant_name_artificial_1', sanitize_text_field( $_POST['_plant_name_artificial_1'] ) ); endif;
	if ( isset( $_POST['_plant_name_artificial_2'] ) ) : update_post_meta( $post_id, '_plant_name_artificial_2', sanitize_text_field( $_POST['_plant_name_artificial_2'] ) ); endif;
	if ( isset( $_POST['_plant_name_artificial_3'] ) ) : update_post_meta( $post_id, '_plant_name_artificial_3', sanitize_text_field( $_POST['_plant_name_artificial_3'] ) ); endif;
	if ( isset( $_POST['_plant_name_artificial_4'] ) ) : update_post_meta( $post_id, '_plant_name_artificial_4', sanitize_text_field( $_POST['_plant_name_artificial_4'] ) ); endif;
	
	if ( isset( $_POST['_plant_1_image'] ) ) : update_post_meta( $post_id, '_plant_1_image', sanitize_text_field( $_POST['_plant_1_image'] ) ); endif;
	if ( isset( $_POST['_plant_2_image'] ) ) : update_post_meta( $post_id, '_plant_2_image', sanitize_text_field( $_POST['_plant_2_image'] ) ); endif;
	if ( isset( $_POST['_plant_3_image'] ) ) : update_post_meta( $post_id, '_plant_3_image', sanitize_text_field( $_POST['_plant_3_image'] ) ); endif;
	if ( isset( $_POST['_plant_4_image'] ) ) : update_post_meta( $post_id, '_plant_4_image', sanitize_text_field( $_POST['_plant_4_image'] ) ); endif;
	
	if ( isset( $_POST['_vase_type_artificial_1'] ) ) : update_post_meta( $post_id, '_vase_type_artificial_1', sanitize_text_field( $_POST['_vase_type_artificial_1'] ) ); endif;
	if ( isset( $_POST['_vase_type_artificial_2'] ) ) : update_post_meta( $post_id, '_vase_type_artificial_2', sanitize_text_field( $_POST['_vase_type_artificial_2'] ) ); endif;
	if ( isset( $_POST['_vase_type_artificial_3'] ) ) : update_post_meta( $post_id, '_vase_type_artificial_3', sanitize_text_field( $_POST['_vase_type_artificial_3'] ) ); endif;
	if ( isset( $_POST['_vase_type_artificial_4'] ) ) : update_post_meta( $post_id, '_vase_type_artificial_4', sanitize_text_field( $_POST['_vase_type_artificial_4'] ) ); endif;
	
	if ( isset( $_POST['_light_level_artificial_1'] ) ) : update_post_meta( $post_id, '_light_level_artificial_1', sanitize_text_field( $_POST['_light_level_artificial_1'] ) ); endif;
	if ( isset( $_POST['_light_level_artificial_2'] ) ) : update_post_meta( $post_id, '_light_level_artificial_2', sanitize_text_field( $_POST['_light_level_artificial_2'] ) ); endif;
	if ( isset( $_POST['_light_level_artificial_3'] ) ) : update_post_meta( $post_id, '_light_level_artificial_3', sanitize_text_field( $_POST['_light_level_artificial_3'] ) ); endif;
	if ( isset( $_POST['_light_level_artificial_4'] ) ) : update_post_meta( $post_id, '_light_level_artificial_4', sanitize_text_field( $_POST['_light_level_artificial_4'] ) ); endif;
	
	if ( isset( $_POST['_plant_width_multi_artificial_1'] ) ) : update_post_meta( $post_id, '_plant_width_multi_artificial_1', sanitize_text_field( $_POST['_plant_width_multi_artificial_1'] ) ); endif;
	if ( isset( $_POST['_plant_width_multi_artificial_2'] ) ) : update_post_meta( $post_id, '_plant_width_multi_artificial_2', sanitize_text_field( $_POST['_plant_width_multi_artificial_2'] ) ); endif;
	if ( isset( $_POST['_plant_width_multi_artificial_3'] ) ) : update_post_meta( $post_id, '_plant_width_multi_artificial_3', sanitize_text_field( $_POST['_plant_width_multi_artificial_3'] ) ); endif;
	if ( isset( $_POST['_plant_width_multi_artificial_4'] ) ) : update_post_meta( $post_id, '_plant_width_multi_artificial_4', sanitize_text_field( $_POST['_plant_width_multi_artificial_4'] ) ); endif;
	
	if ( isset( $_POST['_plant_height_multi_artificial_1'] ) ) : update_post_meta( $post_id, '_plant_height_multi_artificial_1', sanitize_text_field( $_POST['_plant_height_multi_artificial_1'] ) ); endif;
	if ( isset( $_POST['_plant_height_multi_artificial_2'] ) ) : update_post_meta( $post_id, '_plant_height_multi_artificial_2', sanitize_text_field( $_POST['_plant_height_multi_artificial_2'] ) ); endif;
	if ( isset( $_POST['_plant_height_multi_artificial_3'] ) ) : update_post_meta( $post_id, '_plant_height_multi_artificial_3', sanitize_text_field( $_POST['_plant_height_multi_artificial_3'] ) ); endif;
	if ( isset( $_POST['_plant_height_multi_artificial_4'] ) ) : update_post_meta( $post_id, '_plant_height_multi_artificial_4', sanitize_text_field( $_POST['_plant_height_multi_artificial_4'] ) ); endif;
	
	if ( isset( $_POST['_plant_length_multi_artificial_1'] ) ) : update_post_meta( $post_id, '_plant_length_multi_artificial_1', sanitize_text_field( $_POST['_plant_length_multi_artificial_1'] ) ); endif;
	if ( isset( $_POST['_plant_length_multi_artificial_2'] ) ) : update_post_meta( $post_id, '_plant_length_multi_artificial_2', sanitize_text_field( $_POST['_plant_length_multi_artificial_2'] ) ); endif;
	if ( isset( $_POST['_plant_length_multi_artificial_3'] ) ) : update_post_meta( $post_id, '_plant_length_multi_artificial_3', sanitize_text_field( $_POST['_plant_length_multi_artificial_3'] ) ); endif;
	if ( isset( $_POST['_plant_length_multi_artificial_4'] ) ) : update_post_meta( $post_id, '_plant_length_multi_artificial_4', sanitize_text_field( $_POST['_plant_length_multi_artificial_4'] ) ); endif;
	
	if ( isset( $_POST['_plant_height_artificial_1'] ) ) : update_post_meta( $post_id, '_plant_height_artificial_1', sanitize_text_field( $_POST['_plant_height_artificial_1'] ) ); endif;
	if ( isset( $_POST['_plant_height_artificial_2'] ) ) : update_post_meta( $post_id, '_plant_height_artificial_2', sanitize_text_field( $_POST['_plant_height_artificial_2'] ) ); endif;
	if ( isset( $_POST['_plant_height_artificial_3'] ) ) : update_post_meta( $post_id, '_plant_height_artificial_3', sanitize_text_field( $_POST['_plant_height_artificial_3'] ) ); endif;
	if ( isset( $_POST['_plant_height_artificial_4'] ) ) : update_post_meta( $post_id, '_plant_height_artificial_4', sanitize_text_field( $_POST['_plant_height_artificial_4'] ) ); endif;
	
}
add_action( 'woocommerce_process_product_meta_artificial_plant', 'save_artificial_option_field'  );
add_action( 'woocommerce_process_product_meta_variable_artificial_plant', 'save_artificial_option_field'  );
/**
 * Hide Attributes data panel.
 */
 /*
function hide_product_info_data_panel( $tabs) {
	$tabs['product_write_panel_extra_tab']['class'][] = 'hide_if_simple_artificial hide_if_variable_artificial';
	return $tabs;
}
add_filter( 'woocommerce_product_data_tabs', 'hide_product_info_data_panel' );
*/