<?php
/*
Plugin Name: Woocommerce check pincode/zipcode for shipping
Plugin URI: http://www.phoeniixx.com
Description: Advance Check Pin Code is a solution that allows users to set delivery dates based on the pin codes.
Version: 1.1
Author: phoeniixx
Author URI: http://www.phoeniixx.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
ob_start();

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**

 * Check if WooCommerce is active
 
**/

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) 
{

	function pincodes_settings_link($links) {
	
		  $settings_link = '<a href="admin.php?page=pincodes_setting">Settings</a>'; 
		  
		  array_unshift($links, $settings_link); 
		  
		  return $links; 
		  
	}
		 
	$plugin = plugin_basename(__FILE__);

	add_filter("plugin_action_links_$plugin", 'pincodes_settings_link' ); //for plugin setting link

	function pincodes_setting() {

		require_once(dirname(__FILE__).'/admin-setting.php');
		
	} 
	
	function pincodes_premium_setting() {

		require_once(dirname(__FILE__).'/premium-setting.php');
		
	} 
 
	function phoen_adpanel_style3() {

        $plugin_dir_url =  plugin_dir_url( __FILE__ );

		?>
			<script>
				var blog_title = '<?php echo $plugin_dir_url; ?>';
				var usejs = 0;
			</script>
		<?php
		
		echo '<link rel="stylesheet" href="'.$plugin_dir_url.'/assets/css/style.css">';

	}

	

	add_action('wp_head', 'phoen_adpanel_style3'); //for adding assets/js/css in wp head
	
	function phoen_adpanel_style4() {

        $plugin_dir_url =  plugin_dir_url( __FILE__ );
		
		echo '<link rel="stylesheet" href="'.$plugin_dir_url.'/assets/css/admin.css">
		<script src="'.$plugin_dir_url.'/assets/js/custom.js"></script>';
		?>
			<script>
				var usejs = 0;
			</script>
		<?php

	}

	add_action('admin_head', 'phoen_adpanel_style4'); //for adding assets/js/css in wp head
	

	// embed the javascript file that makes the AJAX request
	wp_enqueue_script( 'picodecheck-ajax-request', plugin_dir_url( __FILE__ ) . '/assets/js/custom.js', array( 'jquery' ) );

	// declare the URL to the file that handles the AJAX request (wp-admin/admin-ajax.php)
	wp_localize_script( 'picodecheck-ajax-request', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );


	//Activation Code of table in wordpress

	register_activation_hook(__FILE__, 'pincode_plugin_activation');
	
	function pincode_plugin_activation() {
		
	   create_table();
	} 

	function create_table() {

		global $table_prefix, $wpdb;

		$tblname = 'check_pincode_p';

		$wp_track_members_table = $table_prefix . "$tblname";

		#Check to see if the table exists already, if not, then create it

		if($wpdb->get_var( "show tables like '$wp_track_members_table'" ) != $wp_track_members_table) 
		{

			$sql0  = "CREATE TABLE `". $wp_track_members_table . "` ( ";

			$sql0 .= "  `id`  int(11)   NOT NULL auto_increment, ";

			$sql0 .= "  `pincode`  int(128)   NOT NULL, ";

			$sql0 .= "  `city`  varchar(250)   NOT NULL, ";

			$sql0 .= "  `state`  varchar(250)   NOT NULL, ";

			$sql0 .= "  `dod`  int(11)   NOT NULL, ";

			$sql0 .= "  `cod`  varchar(250)   NOT NULL DEFAULT 'no', ";

			$sql0 .= "  PRIMARY KEY `order_id` (`id`) "; 

			$sql0 .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";

			#We need to include this file so we have access to the dbDelta function below (which is used to create the table)

			require_once(ABSPATH . '/wp-admin/upgrade-functions.php');

			dbDelta($sql0);

		}
	

		$table_name = $wpdb->prefix . 'pincode_setting_p';
		
		#Check to see if the table exists already, if not, then create it

		if($wpdb->get_var( "show tables like '$table_name'" ) != $table_name) 
		{
			
			$sql = "CREATE TABLE $table_name (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`del_help_text` text NOT NULL,
			`cod_help_text` text NOT NULL, 
			`cod_msg1` text NOT NULL, 
			`cod_msg2` text NOT NULL, 
			`error_msg` text NOT NULL,
			`del_date` int(11) NOT NULL, 
			`cod` int(11) NOT NULL,
			`s_s` int(11) NOT NULL, 
			`s_s1` int(11) NOT NULL, 
			`cod_p` int(11) NOT NULL,
			`delv_by_cart` int(11) NOT NULL,
			`val_checkout` int(11) NOT NULL,
			`bgcolor` varchar(250) NOT NULL, 
			`textcolor` varchar(250) NOT NULL, 
			`bordercolor` varchar(250) NOT NULL, 
			`buttoncolor` varchar(250) NOT NULL, 
			`buttontcolor` varchar(250) NOT NULL, 
			`ttbordercolor` varchar(250) NOT NULL, 
			`ttbagcolor` varchar(250) NOT NULL, 
			`tttextcolor` varchar(250) NOT NULL, 
			`devbytcolor` varchar(250) NOT NULL, 
			`codtcolor` varchar(250) NOT NULL, 
			`datecolor` varchar(250) NOT NULL, 
			`codmsgcolor` varchar(250) NOT NULL, 
			`errormsgcolor` varchar(250) NOT NULL, 
			`image_size` varchar(250) NOT NULL, 
			`image_size1` varchar(250) NOT NULL, 
			`tt_c_image_size` varchar(250) NOT NULL, 
			`tt_c_image_size1` varchar(250) NOT NULL, 
			`help_image` text NOT NULL, 
			`tt_c_image` text NOT NULL, 
			`date_time` DATETIME NULL,
			PRIMARY KEY id (id));";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			
			dbDelta( $sql );
			
			$rows_affected = $wpdb->insert( $table_name, array('del_help_text' => 'Delivery Date Help Text', 'bgcolor' => '#f4f2f2', 'textcolor' => '#737070', 'buttoncolor' => '#a46497', 'buttontcolor' => '#ffffff'));

			dbDelta( $rows_affected );
		}
	}


	require_once(dirname(__FILE__).'/list_pincodes.php');

	require_once(dirname(__FILE__).'/add_pincode.php');
	

	add_action( 'admin_menu', 'register_my_custom_menu_page' ); //for admin menu


	function register_my_custom_menu_page() {
        
        $plugin_dir_url =  plugin_dir_url( __FILE__ );

		add_menu_page(__('Zip codes','disp-test'), __('Zip codes','disp-test'), 'manage_options' , 'add_pincode' , '' , "$plugin_dir_url/assets/img/page_white_zip.png" , '6');

		add_submenu_page('add_pincode', __('Add Zip Code','displ-test'), __('Add Zip Code','displ-test'), 'manage_options', 'add_pincode', 'add_pincodes_f');

		add_submenu_page('add_pincode', __('Zip Code List','displ-test'), __('Zip Code List','displ-test'), 'manage_options', 'list_pincodes', 'list_pincodes_f');

		add_submenu_page('add_pincode', __('Setting','displ-test'), __('Settings','displ-test'), 'manage_options', 'pincodes_setting', 'pincodes_setting');

	}

	add_action( 'woocommerce_before_add_to_cart_button', 'pincode_field' ); //for pincode field on product page

	function pincode_field( $product ) {
		
		global $table_prefix, $wpdb,$woocommerce;
		
		$pro_id = get_the_ID();
		
		$_pf = new WC_Product_Factory();  

		$_product = $_pf->get_product($pro_id);
		
		$product_type =  $_product->product_type;
		
		$blog_title = site_url();
		
		if($product_type != 'external' && $_product->is_downloadable('yes') != 1 && $_product->is_virtual ('yes') != 1) 
		{
			?>
				<script>
					var usejs = 1;
				</script>
			<?php
			
			$plugin_dir_url =  plugin_dir_url( __FILE__ );

			$cookie_pin = $_COOKIE['valid_pincode'];
			
			$num_rows = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM `".$table_prefix."check_pincode_p` where `pincode` = %d" , $cookie_pin ) );
	
			if($num_rows == 0)
			{

				$cookie_pin = '';

			}


			if(isset($cookie_pin) && $cookie_pin != '') {

				$qry22 = $wpdb->get_results( "SELECT * FROM `".$table_prefix."pincode_setting_p` ORDER BY `id` ASC  limit 1" ,ARRAY_A);
				
				$query = " SELECT * FROM `".$table_prefix."check_pincode_p` where `pincode` = '$cookie_pin' ";

				$getdata = $wpdb->get_results( $query );

				foreach($getdata as $data){

				$dod =  $data->dod;

				}


				$delivery_date = date("D, jS M", strtotime("+ $dod day"));

				$customer = new WC_Customer();

				$customer->set_shipping_postcode($cookie_pin);
				
				$user_ID = get_current_user_id();
				
				if(isset($user_ID) && $user_ID != 0) {
					
					update_user_meta($user_ID, 'shipping_postcode', $cookie_pin); //for setting shipping postcode
					
				}

				?>


				<div style="clear:both;font-size:14px;" class="wc-delivery-time-response">
					
				<span class='avlpin' id='avlpin'><p>Available at <?php echo esc_html( $cookie_pin ); ?></p><a class="button" id='change_pin'>change</a></span>

				<div class="pin_div" id="my_custom_checkout_field2" style="display:none;">

						<div class="error_pin" id="error_pin" style="display:none">Oops! We are not currently servicing your area.</div>

						<p id="pincode_field_idp" class="form-row my-field-class form-row-wide">

							<label class="" for="pincode_field_id">Check Availability At</label>

							<input type="text" required="required" value="<?php echo esc_html( $cookie_pin ); ?>" maxlength="6" placeholder="Enter Your Pincode" id="pincode_field_id" name="pincode_field" class="input-text" />

							<a class="button" id="checkpin">Check</a>

							<span id="chkpin_loader" style="display:none">

							<img src="<?php echo esc_url( $plugin_dir_url ); ?>/assets/img/ajax-loader.gif"/>

							</span>
						</p>
				</div>
				
				
				<div class="delivery-info-wrap">

					<div class="delivery-info">

							<div class="header">

								<span><h6>Delivered By</h6></span>
								
								<?php
									if($qry22[0]['del_date'] == 1)
									{
										?>
										<a id="delivery_help_a" class="delivery-help-icon">?</a>
										
										<div class="delivery_help_text_main width_class" style="display:none">
										
											<a id="delivery_help_x" class="delivery-help-cross">x</a>
												
											<div class="delivery_help_text width_class" >
																	
																			
												<?php
												
													echo esc_html( $qry22[0]['del_help_text'] );
												
												?>
											
											</div>
										
										</div>
										<?php
									}
								?>
														
								<div class="delivery">
		
									<ul class="ul-disc">
		
										<li>
		
											<?php echo esc_html( $delivery_date ); ?>
		
										</li>
		
									</ul>
		
								</div>
							
							</div>

					</div>

				 </div>

				</div>

				<?php

			}
			else
			{

				$qry22 = $wpdb->get_results( "SELECT * FROM `".$table_prefix."pincode_setting_p` ORDER BY `id` ASC  limit 1" ,ARRAY_A);	
				
				?>

				<div class="pin_div" id="my_custom_checkout_field">
					
						<div class="error_pin" id="error_pin" style="display:none">Oops! We are not currently servicing your area.</div>

						<p id="pincode_field_idp" class="form-row my-field-class form-row-wide">

							<label class="" for="pincode_field_id">Check Availability At</label>

							<input type="text" required="required" value="" maxlength="6" placeholder="Enter Your Pincode" id="pincode_field_id" name="pincode_field" class="input-text" />

							<a class="button" id="checkpin">Check</a>

								<span id="chkpin_loader" style="display:none">

									<img src="<?php echo esc_url( $plugin_dir_url ); ?>/assets/img/ajax-loader.gif"/>

								</span>
						</p>

				</div>

				<?php

			}
		}
		else
		{
			?>
				<script>
					var usejs = 0;
				</script>
			<?php
		}

	}

	add_action( 'woocommerce_after_order_notes', 'checkout_page_function' ); //for checkout page functionality

	
	function checkout_page_function() {
		
		global $table_prefix, $wpdb, $woocommerce;
		
		$blog_title = site_url();
		
		$cookie_pin = $_COOKIE['valid_pincode'];

		if(isset($cookie_pin))
		{		
	
			$customer = new WC_Customer();

			$customer->set_shipping_postcode($cookie_pin);
			
			$user_ID = get_current_user_id();
			
			$current_pcode = get_user_meta($user_ID, 'shipping_postcode');
			
			$customer = new WC_Customer();
			
			if(isset($user_ID) && $user_ID != 0)
			{
				update_user_meta($user_ID, 'shipping_postcode', $cookie_pin);
				
				if($current_pcode[0] != $cookie_pin)
				{
					
					header("Refresh:0");
				}
			}
			
			
		}
		
	}
	
	// if both logged in and not logged in users can send this AJAX request,
	// add both of these actions, otherwise add only the appropriate one
	add_action( 'wp_ajax_nopriv_picodecheck_ajax_submit', 'picodecheck_ajax_submit' );
	add_action( 'wp_ajax_picodecheck_ajax_submit', 'picodecheck_ajax_submit' );

	function picodecheck_ajax_submit() {
		// get the submitted parameters
		//$pin_code = $_POST['pin_code'];

		global $table_prefix, $wpdb;
		$pincode = sanitize_text_field( $_POST['pin_code'] );
		$safe_zipcode = intval( $pincode );
		
		if($safe_zipcode)
		{
			$table_pin_codes = $table_prefix."check_pincode_p";
			//echo "select COUNT(*) from $table_pin_codes where pincode='$pincode'";
			$count = $wpdb->get_var( $wpdb->prepare( "select COUNT(*) from $table_pin_codes where `pincode` = %d" , $pincode ) );
			if($count==0)
			{

			   echo "0";  

			}
			else
			{
				setcookie("valid_pincode",$pincode,time() + (10 * 365 * 24 * 60 * 60),"/");
				echo "1";
			}
		}
		else
		{
			echo "0";
		}

		// IMPORTANT: don't forget to "exit"
		exit;
	}

    add_action('wp_head','hook_css'); //for adding dynamic css in wp head
    
    function hook_css() {
		
		global $table_prefix, $wpdb, $woocommerce;
		
		$blog_title = site_url();
		
		$qry22 = $wpdb->get_results( "SELECT * FROM `".$table_prefix."pincode_setting_p` ORDER BY `id` ASC  limit 1" ,ARRAY_A);	
		
		$bgcolor =  $qry22[0]['bgcolor'];
		
		$textcolor =  $qry22[0]['textcolor'];
				
		$buttoncolor = $qry22[0]['buttoncolor'];
		
		$buttontcolor = $qry22[0]['buttontcolor'];

    ?>
    <style>
	#shade{background: none repeat scroll 0 0 #000000;opacity: 0.5;}
	
	#shade {height: 100%;left: 0;position: fixed;top: 0;width: 100%;z-index: 100;}
    
	form.cart #my_custom_checkout_field #pincode_field_id{width:180px;border: 1px solid #d3d3d3;margin-right: 5px;font-size: 13px;font-family: "Source Sans Pro",Helvetica,sans-serif;}
    
	form.cart #my_custom_checkout_field #pincode_field_idp label{display: inline-block;margin-right: 5px;font-size: 14px;font-family: "Source Sans Pro",Helvetica,sans-serif;color:<?php echo $textcolor; ?>;}
    
    form.cart .wc-delivery-time-response .delivery-info-wrap {margin: 15px 0;}
    
	form.cart .wc-delivery-time-response .delivery-info-wrap .delivery-info {display: inline-block;width: 100%; position: relative;}
    
	form.cart .wc-delivery-time-response .delivery-info-wrap .delivery-info .header {float: left;width: 50%;}
    
	form.cart .wc-delivery-time-response .delivery-info-wrap .delivery-info .cash-on-delivery-info-wrap {float: right;width: 50%;position:relative;}
    
	form.cart .wc-delivery-time-response .delivery-info-wrap .delivery-info .delivery-help-icon{margin-left:5px;cursor:pointer;}
    
    form.cart .wc-delivery-time-response .delivery-info-wrap .delivery-info .header .delivery .ul-disc{margin:0;padding:0;list-style:none;}
   
    form.cart .wc-delivery-time-response .delivery-info-wrap .delivery-info .cash-on-delivery-info-wrap .cash-on-delivery-info .header{float:none;width:100%;}
    
	form.cart .wc-delivery-time-response .delivery-info-wrap .delivery-info .cash-on-delivery-info-wrap .cash-on-delivery-info .header .cash-on-delivery-help-icon{margin-left: 5px;cursor:pointer;}
    
    
    /*-------------------product1-----------------*/
 
    #my_custom_checkout_field2 #pincode_field_idp #pincode_field_id.input-text{width:180px;border: 1px solid #666666;margin-right: 5px;font-size: 13px;font-family: "Source Sans Pro",Helvetica,sans-serif;color:#999;}
    
    #my_custom_checkout_field2 #pincode_field_idp .button{ margin-top:-3px;padding:5px 10px;float: none;font-size: 14px;font-family: "Source Sans Pro",Helvetica,sans-serif;text-transform: uppercase;  font-weight: normal;}
    
	#my_custom_checkout_field #pincode_field_idp #pincode_field_id.input-text{width:180px;border: 1px solid #666666;margin-right: 5px;font-size: 13px;font-family: "Source Sans Pro",Helvetica,sans-serif;}
    
    #my_custom_checkout_field #pincode_field_idp .button{ margin-top:-3px;padding: 5px 10px;float: none;font-size: 14px;font-family: "Source Sans Pro",Helvetica,sans-serif;text-transform: uppercase;  font-weight: normal;}
    
    
    .delivery_help_text p{font-size: 14px;font-family: "Source Sans Pro",Helvetica,sans-serif;color:<?php echo $textcolor; ?>;}
    
	.delivery_help_text h3{font-size: 16px;font-family: "Source Sans Pro",Helvetica,sans-serif;color:#7d7b6d;}
    
    .header .cash_on_delivery_help_text p{font-size: 14px;font-family: "Source Sans Pro",Helvetica,sans-serif;color:<?php echo $textcolor; ?>;}
    
	.header .cash_on_delivery_help_text h3{font-size: 16px;font-family: "Source Sans Pro",Helvetica,sans-serif;color:#7d7b6d;}
    
	.delivery-help-cross {color: #000 !important;font-size: 17px;font-weight: bold;position: absolute;right: 0px;top: -2px;cursor: pointer;}
    /*-------------------product1-----------------*/
    
    
    .cash_on_delivery_help_text p{font-size: 14px;font-family: "Source Sans Pro",Helvetica,sans-serif;color:<?php echo $textcolor; ?>;}

	/*------------background & border color & EOD message color------------*/
	
	.avlpin{ <?php if($bgcolor == ''){ echo "background:#f4f2f2;"; } else { echo "background:$bgcolor".';'; }  ?> }
	
	.avlpin{  border: 1px solid #e8e7e7; }
	
	.avlpin{ margin:24px 0 12px; padding:20px; text-align:center; min-width:400px; display:inline-block;box-sizing:border-box;}
	
	.pin_div{ <?php if($bgcolor == ''){ echo "background:#f4f2f2;"; } else { echo "background:$bgcolor".';'; }  ?> }
	
	.pin_div{ border: 1px solid #e8e7e7; }
	
	.pin_div{ margin:24px 0 12px; padding:20px; text-align:center; width:100%; display:inline-block; }
	
	/*------------background & border color & EOD message color------------*/
	
	/*------------Text color------------*/
	
	.avlpin p{ color:<?php echo $textcolor; ?>; }
	
	.avlpin p{ display:inline-block; margin-right: 5px; font-size: 14px; font-family: "Source Sans Pro",Helvetica,sans-serif; margin-bottom:0;}
	
	#pincode_field_idp label{color:<?php echo $textcolor; ?>; display: inline-block; margin-right: 5px; font-size:14px; font-family: "Source Sans Pro",Helvetica,sans-serif;}
	
	/*------------Text color------------*/
	
	/*------------Button & Button Text color------------*/
	
	#change_pin.button{ background:<?php echo $buttoncolor; ?>; }
	
	#change_pin.button{ color:<?php echo $buttontcolor; ?>; }
	
	#my_custom_checkout_field2 #pincode_field_idp .button{ color:<?php echo $buttontcolor; ?>; }
	
	#my_custom_checkout_field2 #pincode_field_idp .button{ background:none repeat scroll 0 0 <?php echo $buttoncolor; ?>; }
	
	#my_custom_checkout_field #pincode_field_idp .button{ color:<?php echo $buttontcolor; ?>; }
	
	#my_custom_checkout_field #pincode_field_idp .button{ background:none repeat scroll 0 0 <?php echo $buttoncolor; ?>; }
		
	#change_pin.button{ float:none; font-size: 14px; font-family: "Source Sans Pro",Helvetica,sans-serif; padding:7px 12px; text-transform: uppercase; font-weight:normal;}
	
	/*------------Button & Button Text color------------*/
	
	/*-----Tooltip Border, Tooltip Background & Tooltip Text color-----*/

	.header .delivery_help_text{ background:#EDEDED; }
	
	.header .delivery_help_text{ border:1px solid #e8e7e7; }
	
	.header .delivery_help_text{ width:100%; box-sizing: border-box; overflow:auto; height:200px; position: absolute; z-index:9999; top:25px; left:0; padding:15px; font-size:14px; font-family: "Source Sans Pro",Helvetica,sans-serif;}	
	
	/*-----Tooltip Border, Tooltip Background & Tooltip Text color-----*/
    
	/*------------Delivered by Text color------------*/
	
	.delivery-info h6{ margin:0; display:inline-block; font-size: 16px; font-family: "Source Sans Pro",Helvetica,sans-serif;}
	
	/*------------Delivered by Text color------------*/

	/*------------Date color------------*/
	
	.delivery .ul-disc li{ font-size:14px;font-family: "Source Sans Pro",Helvetica,sans-serif;}
	
	/*------------Date color------------*/
	
	.delivery_help_text_main{ position: relative;width:100%; }
	
	.delivery-info span h6{ color:#484747; }
	
	.width_class {  }
	
    </style>
    <?php
    }
}
?>