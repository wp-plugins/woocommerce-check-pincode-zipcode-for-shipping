<?php
function add_pincodes_f()
{
	?>
	<div class="wrap">
	<?php
	global $table_prefix, $wpdb;
	
	if(isset($_POST['submit']))
	{
		$pincode = sanitize_text_field( $_POST['pincode'] );
		$city = sanitize_text_field( $_POST['city'] );
		$state = sanitize_text_field( $_POST['state'] );
		$dod = sanitize_text_field( $_POST['dod'] );
		
		$safe_zipcode = intval( $pincode );
		
		$safe_dod = intval( $dod );
		
		if (  $safe_zipcode && $safe_dod )
		{	
			$num_rows = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM `".$table_prefix."check_pincode_p` where `pincode` = %d", $pincode ) );

			if($num_rows == 0)

			{

				$result = $wpdb->query( $wpdb->prepare( "INSERT INTO `".$table_prefix."check_pincode_p` SET `pincode` = %d , `city` = %s , `state` = %s , `dod` = %d ", $pincode, $city, $state, $dod ) );
				
				if($result == 1)
				{
				?>

					<div class="updated below-h2" id="message"><p>Added Successfully.</p></div>

				<?php
				}
				else
				{
					?>
						<div class="error below-h2" id="message"><p> Something Went Wrong Please Try Again With Valid Data.</p></div>
					<?php
					
				}
			}
			else
			{
				?>

					<div class="error below-h2" id="message"><p> This Pincode Already Exists.</p></div>

				<?php
			}
		}
		else
		{
			?>

				<div class="error below-h2" id="message"><p> Please Fill Valid Data.</p></div>

			<?php
		}
	}
	?>
			<div id="icon-users" class="icon32"><br/></div>
<?php
$tab = sanitize_text_field( $_GET['tab'] );
?>
			<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->
			<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
					<a class="nav-tab <?php if($tab == 'add' || $tab == ''){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=add_pincode&amp;tab=add">Add Zip Code</a>
					<a class="nav-tab <?php if($tab == 'premium'){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=add_pincode&amp;tab=premium">Premium Version</a>
			</h2>				
<?php
if($tab == 'add' || $tab == '')
{
?>
			<div class="meta-box-sortables" id="normal-sortables">
				<div class="postbox " id="yith_wcqv_general_videobox">
					<h3><span class="upgrade-heading">Upgrade to the PREMIUM VERSION</span></h3>
					<div class="inside">
						<div class="yith_videobox">

							<div class="column two">
								<!-----<h2>Get access to Pro Features</h2>----->

								<p>Switch to the premium version of Woocommerce Check Pincode/Zipcode for Shipping and COD to get the benefit of all features!</p>

									<p>
										<a target="_blank" href="http://www.phoeniixx.com/product/woocommerce-check-pincodezipcode-for-shipping-and-cod/" class="button-primary grn-btn">Get access to Premium Features</a>
									</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<h2>Add Zip Code</h2>
			
				<form action="" method="post" id="azip_form" name="azip_form">

					<table class="form-table">

					<tbody>

						<tr class="user-user-login-wrap">

							<th><label for="user_login">Pincode</label></th>

							<td><input type="text" required="required" class="regular-text" id="pincode" name="pincode"></td>

						</tr>

						<tr class="user-first-name-wrap">

							<th><label for="first_name">City</label></th>

							<td><input type="text" required="required" class="regular-text" id="city" name="city"></td>

						</tr>

						<tr class="user-last-name-wrap">

							<th><label for="last_name">State</label></th>

							<td><input type="text" required="required" class="regular-text" id="state" name="state"></td>

						</tr>

						<tr class="user-nickname-wrap">

							<th><label for="nickname">Delivery within days</label></th>

							<td><input type="number" min="1" step="1" value="1" class="regular-text" id="dod" name="dod"></td>

						</tr>

					</tbody>

				</table>

					<p class="submit"><a class="button" href="?page=list_pincodes">Back</a>&nbsp;&nbsp;<input type="submit" value="Add" class="button button-primary" id="submit" name="submit"></p>

			</form>
<?php
}
if($tab == 'premium')
{
	require_once(dirname(__FILE__).'/premium-setting.php');
}
?>			
</div>
<?php
}
?>