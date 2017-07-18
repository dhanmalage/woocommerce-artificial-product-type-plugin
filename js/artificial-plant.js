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
jQuery(document).ready(function($) {
	$('.plant_1_image_upload').click(function(e) {
		e.preventDefault();

		var custom_uploader = wp.media({
			title: 'Artificial Image 1',
			button: {
				text: 'Upload Image'
			},
			multiple: false  // Set this to true to allow multiple files to be selected
		})
		.on('select', function() {
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$('.plant_1_image').attr('src', attachment.url);
			$('.plant_1_image_url').val(attachment.url);

		})
		.open();
	});
	
	$('.plant_2_image_upload').click(function(e) {
		e.preventDefault();

		var custom_uploader = wp.media({
			title: 'Artificial Image 2',
			button: {
				text: 'Upload Image'
			},
			multiple: false  // Set this to true to allow multiple files to be selected
		})
		.on('select', function() {
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$('.plant_2_image').attr('src', attachment.url);
			$('.plant_2_image_url').val(attachment.url);

		})
		.open();
	});
	
	$('.plant_3_image_upload').click(function(e) {
		e.preventDefault();

		var custom_uploader = wp.media({
			title: 'Artificial Image 3',
			button: {
				text: 'Upload Image'
			},
			multiple: false  // Set this to true to allow multiple files to be selected
		})
		.on('select', function() {
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$('.plant_3_image').attr('src', attachment.url);
			$('.plant_3_image_url').val(attachment.url);

		})
		.open();
	});
	
	$('.plant_4_image_upload').click(function(e) {
		e.preventDefault();

		var custom_uploader = wp.media({
			title: 'Artificial Image 4',
			button: {
				text: 'Upload Image'
			},
			multiple: false  // Set this to true to allow multiple files to be selected
		})
		.on('select', function() {
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$('.plant_4_image').attr('src', attachment.url);
			$('.plant_4_image_url').val(attachment.url);

		})
		.open();
	});
});