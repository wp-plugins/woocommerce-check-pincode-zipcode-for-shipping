<?php
global $wpdb,$table_prefix;

wp_enqueue_script('wp-color-picker'); //for color picker scripts

wp_enqueue_style( 'wp-color-picker' );

wp_enqueue_media();  //for upload media scripts

/* Form Post Data */

if( sanitize_text_field( $_POST['submit'] ) == 'Save') {

	$del_help_text = sanitize_text_field( $_POST['del_help_text'] );

	$del_date = sanitize_text_field( $_POST['del_date'] );

	$bgcolor = sanitize_text_field( $_POST['bgcolor'] );

	$textcolor = sanitize_text_field( $_POST['textcolor'] );

	$buttoncolor = sanitize_text_field( $_POST['buttoncolor'] );

	$buttontcolor = sanitize_text_field( $_POST['buttontcolor'] );

	/* Database Queries */
	
    $adddate = date('Y-m-d H:i:s');
	
	$num_rows = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM `".$table_prefix."pincode_setting_p` " ) );

	if($num_rows == 0)

	{
	
		$result = $wpdb->query( $wpdb->prepare( "INSERT INTO `".$table_prefix."pincode_setting_p` SET `del_help_text` = %s, `del_date` = %s, `bgcolor` = %s, `textcolor` = %s, `buttoncolor` = %s, `buttontcolor` = %s,`date_time` = %s" , $del_help_text, $del_date, $bgcolor, $textcolor, $buttoncolor, $buttontcolor,$adddate ) );
	
	}
	
	else
	{
		$result = $wpdb->query( $wpdb->prepare( "UPDATE `".$table_prefix."pincode_setting_p` SET `del_help_text` = %s, `del_date` = %s, `bgcolor` = %s, `textcolor` = %s, `buttoncolor` = %s, `buttontcolor` = %s,`date_time` = %s" , $del_help_text, $del_date, $bgcolor, $textcolor, $buttoncolor, $buttontcolor,$adddate ) );
	
	}
	
	if($result == 1)
	{
	?>

		<div class="updated" id="message">

			<p><strong>Setting updated.</strong></p>

		</div>

	<?php
	}
	else
	{
		?>
			<div class="error below-h2" id="message"><p> Something Went Wrong Please Try Again With Valid Data.</p></div>
		<?php
	}

}

/* Fetching Data From DB */

$qry22 = $wpdb->get_results( "SELECT * FROM `".$table_prefix."pincode_setting_p` ORDER BY `id` ASC  limit 1",ARRAY_A );	

foreach($qry22 as $qry) {

}

?>

<div id="profile-page" class="wrap">
<?php
$tab = sanitize_text_field( $_GET['tab'] );
?>
<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
		<a class="nav-tab <?php if($tab == 'set' || $tab == ''){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=pincodes_setting&amp;tab=set">Settings</a>
		<a class="nav-tab <?php if($tab == 'premium'){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=pincodes_setting&amp;tab=premium">Premium Version</a>
		<a class="nav-tab <?php if($tab == 'allp'){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=pincodes_setting&amp;tab=allp">More Plugins</a>
</h2>
<?php
if($tab == 'set' || $tab == '')
{
?>
<div class="meta-box-sortables" id="normal-sortables">
				<div class="postbox " id="yith_wcqv_general_videobox">
					<h3><span class="upgrade-setting">Upgrade to the PREMIUM VERSION</span></h3>
					<div class="inside">
						<div class="yith_videobox">

							<div class="column two">
								<!----<h2>Get access to Pro Features</h2>----->

								<p>Switch to the premium version of Woocommerce Check Pincode/Zipcode for Shipping and COD to get the benefit of all features!</p>

									<p>
										<a target="_blank" href="http://www.phoeniixx.com/product/woocommerce-check-pincodezipcode-for-shipping-and-cod/" class="button-primary grn-btn">Get access to Premium Features</a>
									</p>
							</div>
						</div>
					</div>
				</div>
			</div>			
<h2>

WooCommerce Pincode Check - Plugin Options</h2>

<form novalidate="novalidate" method="post" action="" >

<h3>Manual Settings</h3>

<table class="form-table">

	<tbody>

		<tr class="user-user-login-wrap">

			<th><label for="del_help_text">Delivery Date Help Text</label></th>
			
			<td><textarea class="regular-text" id="del_help_text" name="del_help_text"><?php echo $qry['del_help_text']; ?></textarea></td>

		</tr>

		

	</tbody>

</table>

<table class="form-table">

	<tbody>

		<h3>Enable Help Text</h3>

		<tr class="user-nickname-wrap">

			<th><label for="del_date">Delivery Date</label></th>

			<td><label for="del_date"><input type="radio" <?php if($qry['del_date'] == 1) { ?> checked <?php } ?> name="del_date" value="1">ON</label>

			<label for="del_date"><input type="radio" <?php if($qry['del_date'] == 0) { ?> checked <?php } ?> name="del_date" value="0">OFF</label></td>

		</tr>

	</tbody>

</table>

<table class="form-table">

<tbody>

<h3>Styling of Check Pincode Functionality on Product Page</h3>


	<tr class="user-user-login-wrap">

			<th><label for="bgcolor">Box Background color</label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['bgcolor']; ?>" id="bgcolor" name="bgcolor"></td>

		</tr>


		<tr class="user-first-name-wrap">

			<th><label for="textcolor">Check Pincode Label Text Color</label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['textcolor']; ?>" id="textcolor" name="textcolor"></td>

		</tr>


		<tr class="user-last-name-wrap">

			<th><label for="buttoncolor">"Check" Button Color</label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['buttoncolor']; ?>" id="buttoncolor" name="buttoncolor"></td>

		</tr>
		
		
		<tr class="user-last-name-wrap">

			<th><label for="buttontcolor">"Check" Button Text Color</label></th>

			<td><input type="text" class="regular-text" value="<?php echo $qry['buttontcolor']; ?>" id="buttontcolor" name="buttontcolor"></td>

		</tr>
		

</tbody>

</table>		

<p class="submit"><input type="submit" value="Save" class="button button-primary" id="submit" name="submit"></p>

</form>

<?php
}
if($tab == 'premium')
{
	require_once(dirname(__FILE__).'/premium-setting.php');
}
if($tab == 'allp')
{
	
	?>
<style>
iframe.more-plugin {
    min-height: 1000px;
    width: 100%;
}

.wrap{
	margin:0;
}
</style>
	<iframe class="more-plugin" src="http://plugins.snapppy.com/plugins.php"></iframe> 
	<?php

}	
?>			
</div>

<script>

jQuery(document).ready(function($) {

	jQuery("#bgcolor").wpColorPicker();

	jQuery("#textcolor").wpColorPicker();

	jQuery("#buttoncolor").wpColorPicker();
	
	jQuery("#buttontcolor").wpColorPicker();
	
});

</script>
<style>
.form-table th {
    width: 270px;
	padding: 25px;
}
.form-table td {
	
    padding: 20px 10px;
}
.form-table {
	background-color: #fff;
}
h3 {
    padding: 10px;
}
</style>