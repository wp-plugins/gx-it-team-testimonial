<?php
/*
Plugin Name: GX IT TEAM TESTIMONIALS
Plugin URI: http://getgx.com/wordpress-plugins/testimonials/
Description: This plugin is a plugin that will show testimonials
Version: 1.0
Author: Eucimar Raposo
Author URI: http://eucimarraposo.com	
License: GPLv2


Copyright 2013 Eucimar Raposo (email : eraposo@getgx.com)
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/




function gx_it_team_testimonials_activate(){

	
}
register_activation_hook( __FILE__, 'gx_it_team_testimonials_activate');

function gx_it_team_testimonials_uninstall() {


}
register_deactivation_hook( __FILE__, 'gx_it_team_testimonials_uninstall' );



// add quote to admin menu



add_action ( 'init', 'quotes_register_my_post_types' );
function quotes_register_my_post_types() {
	$labels = array (
			'name' => 'Testimonials',
			'singular_name' => 'Testimonial',
			'add_new' => 'Add New Testimonial',
			'add_new_item' => 'Add New Testimonial',
			'edit_item' => 'Edit Testimonial',
			'new_item' => 'New Testimonials',
			'all_items' => 'All Testimonials',
			'view_item' => 'View Testimonials',
			'search_items' => 'Search Testimonials',
			'not_found' => 'No Testimonial found',
			'not_found_in_trash' => 'No Testimonials found in Trash',
			'parent_item_colon' => '',
			'menu_name' => 'Testimonials',
			
			
	);
	$args = array (
			'labels' => $labels,
			'menu_icon' =>  plugins_url( '/images/gxit.png', __FILE__ ), 
			'supports' => array (
					'title',
					'editor'
			),
			'public' => true
	);
	register_post_type ( 'testimonials', $args );
}



function gx_it_testimonial_create_menu() {

	
	//create submenu items
	//add_submenu_page( 'testimonials', 'Testimonial General Plugin', 'Testimonial General Plugin',  'manage_options', 'testimonials');
add_submenu_page('edit.php?post_type=testimonials', 'General Info', 'General Info', 'manage_options', 'gx_it_testimonial_settings', 'gx_it_core_testimonial_general_page');

}
add_action( 'admin_menu', 'gx_it_testimonial_create_menu' );
function gx_it_core_testimonial_general_page(){echo "<p>I am developing a widget. For now You can use the shortcode. Type in on your post/page or text widget <h2>[gx-it-team-testimonials]</h2></p>";}



// end quote to admin menu


function gx_it_team_testimonials_add_styles(){
wp_enqueue_style( 'gx-it-team-testimonials-css', plugins_url('/css/style.css', __FILE__), true ); 
 wp_register_script( 'gx-it-team-testimonials-js', plugins_url('/js/myscript.js', __FILE__), array( 'jquery' ));
wp_enqueue_script( 'gx-it-team-testimonials-js');
}

add_action( 'wp_enqueue_scripts', 'gx_it_team_testimonials_add_styles' );

function gx_it_team_testimonials_display_testimonials(){

?>
<div class="gx-it-team-testimonial">
		<div class="gx-it-team-testimonial-caption">
			<h4>Our Testimonial</h4>
			
		</div>
		<div class="gx-it-team-testimonial-buttons">
			<div>
				<button type="button" class="left-button button left">
					
				</button>
				<button type="button" class="right-button button left"
					href="#quotes" data-slide="next">
					
				</button>
			</div>
		</div>
			
<?php
// params for our query
remove_all_filters('posts_orderby');
$args = array (
		'post_type' => 'Testimonials',
		//'orderby' => 'menu_order title',
		'orderby' => 'rand',
		'posts_per_page' => 20 
);
// The Query
?>
	<blockquote>
			<div class="quote-block">
<?php 
$my_special_tag = new WP_Query ( $args );
$i = 1;
if ($my_special_tag) :
	while ( $my_special_tag->have_posts () ) :	
		$my_special_tag->the_post ();
		?>
		 <div class="item <?php echo ($i==1?"first active ":$i);?> "> 
		
		  <div class="quote left">&nbsp;</div>
		  <?php echo get_the_content();?> 
		   <div class="quote right">&nbsp;</div>
					
					<div class="quote-author">
					           <?php $title = get_the_title();
							     if(strlen($title)>0){
							     ?>
					           <small ><?php echo $title;?></small>
							   <?php }?>
				    </div>
				</div>
		<?php
		$i++;
	endwhile
	;
 else :
?>	
	<div class="item first active">
					<p>
						<span class="quote left">&nbsp;</span>Lorem ipsum dolor sit amet,
						consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
						labore et dolore magna aliqua. Ut enim ad minim veniam, quis
						nostrud exercitation ullamco <span class="quote right">&nbsp;</span>
					</p>
					<small class="quote-author">Someone famous</small>
				</div>

<?php 
endif;
wp_reset_postdata ();
?>
	</div>

		</blockquote>
	</div>

<?php 
}
add_shortcode('gx-it-team-testimonials','gx_it_team_testimonials_display_testimonials');



?>
