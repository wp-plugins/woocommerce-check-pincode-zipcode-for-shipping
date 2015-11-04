<?php
global $table_prefix, $wpdb;

if(sanitize_text_field( $_GET['action'] ) == 'delete')

{
	
	$id = intval( $_GET['id'] );
	
	if( isset($id) )

	{

		
		$wpdb->query( $wpdb->prepare( "DELETE FROM `".$table_prefix."check_pincode_p` WHERE `id` = %d", $id ) );


	}

	$ids = $_GET['pincode'];

	if( isset($ids) )
	{

		$count = count($ids);

		for($i=0;$i<$count;$i++)

		{


			$_id = $ids[$i];


			$wpdb->query( $wpdb->prepare( "DELETE FROM `".$table_prefix."check_pincode_p` WHERE `id` = %d ", $_id ) );


		}

	}

}


if(!class_exists('WP_List_Table')){



    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );



}


class TT_Example_List_Tablee extends WP_List_Table {


    function __construct(){



        global $status, $page;


        //Set parent defaults



        parent::__construct( array(



            'singular'  => 'Zipcode',     //singular name of the listed records



            'plural'    => 'Zipcodes',    //plural name of the listed records



            'ajax'      => false        //does this table support ajax?



        ) );



    }



    function column_default($item, $column_name){





    }




    function column_title($item){



        //Build row actions



        $actions = array(



            'edit'      => sprintf('<a href="?page=%s&action=%s&p=%s">Edit</a>',sanitize_text_field( $_REQUEST['page'] ),'edit',$item['id']),



            'delete'    => sprintf('<a href="?page=%s&action=%s&p=%s">Delete</a>',sanitize_text_field( $_REQUEST['page'] ),'delete',$item['id']),



        );



        



        //Return the title contents



        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',



            /*$1%s*/ $item['pincode'],



            /*$2%s*/ $item['id'],



            /*$3%s*/ $this->row_actions($actions)



        );



    }




    function column_cb($item){



        return sprintf(



            '<input type="checkbox" name="%1$s[]" value="%2$s" />',



            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("movie")



            /*$2%s*/ $item['ID']                //The value of the checkbox should be the record's id



        );



    }




    function get_columns(){



        $columns = array(



            'id'        => '<label for="id-select-all-1" class="screen-reader-text">Select All</label><input class="id-select-all-1" type="checkbox" />', //Render a checkbox instead of text



            'pincode'     => 'Pincode',



            'city'    => 'City',



            'state'  => 'State',



			'dod'  => 'Delivery within days'



        );



        return $columns;



    }





    function get_sortable_columns() {



        $sortable_columns = array(



            'pincode'     => array('pincode',false),  //true means it's already sorted



            'city'    => array('city',false),



            'state'  => array('state',false),



			'dod'  => array('dod',false),



        );



        return $sortable_columns;



    }


    function get_bulk_actions() {



        $actions = array(



            'delete'    => 'Delete'



        );



        return $actions;



    }



    function process_bulk_action() {


        //Detect when a bulk action is being triggered...



        if( 'delete'===$this->current_action() ) {



            wp_die('Items deleted (or they would be if we had items to delete)!');



        }



    }



    function prepare_items() {


	   global $wpdb, $_wp_column_headers,$table_prefix;



		/* -- Preparing your query -- */



        $query = "SELECT * FROM `".$table_prefix."check_pincode_p`";



		/* -- Ordering parameters -- */



       //Parameters that are going to be used to order the result



       $orderby = !empty($_GET["orderby"]) ? mysql_real_escape_string($_GET["orderby"]) : 'ASC';



       $order = !empty($_GET["order"]) ? mysql_real_escape_string($_GET["order"]) : '';



       if(!empty($orderby) & !empty($order)){ $query.=' ORDER BY '.$orderby.' '.$order; }







		/* -- Pagination parameters -- */



        //Number of elements in your table?



        $totalitems = $wpdb->query($query); //return the total number of affected rows



        //How many to display per page?



        $perpage = 15;



        //Which page is this?



        $paged = !empty($_GET["paged"]) ? mysql_real_escape_string($_GET["paged"]) : '';



        //Page Number



        if(empty($paged) || !is_numeric($paged) || $paged<=0 ){ $paged=1; }



        //How many pages do we have in total?



        $totalpages = ceil($totalitems/$perpage);



        //adjust the query to take pagination into account



       if(!empty($paged) && !empty($perpage)){



          $offset=($paged-1)*$perpage;



         $query.=' LIMIT '.(int)$offset.','.(int)$perpage;



       }



		/* -- Register the pagination -- */



      $this->set_pagination_args( array(



         "total_items" => $totalitems,



         "total_pages" => $totalpages,



         "per_page" => $perpage,



      ) );



      //The pagination links are automatically built according to those parameters


	  /* -- Register the Columns -- */



      $columns = $this->get_columns();



      $hidden = array();



	  $sortable = $this->get_sortable_columns();



	  $this->_column_headers = array($columns, $hidden, $sortable);


	/* -- Fetch the items -- */



      $this->items = $wpdb->get_results($query);


    }



		function display_rows() 

		{



			//Get the records registered in the prepare_items method



			$records = $this->items;


			//Get the columns registered in the get_columns and get_sortable_columns methods



			list( $columns, $hidden ) = $this->get_column_info();



			//Loop for each record



			if(!empty($records)){foreach($records as $rec){


			//Open the line



			echo '<tr class="alternate" id="record_'.$rec->id.'">';



					foreach ( $columns as $column_name => $column_display_name ) {



							//Style attributes for each col



							$class = "class='$column_name column-$column_name'";



							$style = "";



							if ( in_array( $column_name, $hidden ) ) $style = ' style="display:none;"';



							$attributes = $class . $style;



							//edit link



							$editlink  = '/wp-admin/link.php?action=edit&id='.stripslashes($rec->id);



							//Display the cell



							switch ( $column_name ) {



									case "id":     echo '<th '.$attributes.'><input name="pincode[]" type="checkbox" value="'.stripslashes($rec->id).'" /></th>';break;



									case "pincode": echo '<td '.$attributes.'>'.stripslashes($rec->pincode).'<div class="row-actions"><span class="edit"><a href="?page=list_pincodes&amp;action=edit&amp;id='.stripslashes($rec->id).'">Edit</a> | </span><span class="delete"><a href="?page=list_pincodes&amp;action=delete&amp;id='.stripslashes($rec->id).'">Delete</a></span></div></td>'; break;



									case "city": echo '<td '.$attributes.'>'.stripslashes($rec->city).'</td>'; break;



									case "state": echo '<td '.$attributes.'>'.stripslashes($rec->state).'</td>'; break;



									case "dod": echo '<td '.$attributes.'>'.stripslashes($rec->dod).'</td>'; break;



									
							}



					}



					//Close the line



					echo'</tr>';



			}}



		}



}




function list_pincodes_f()

{



	global $table_prefix, $wpdb;



	//Create an instance of our package class...



   $testListTable = new TT_Example_List_Tablee();



    //Fetch, prepare, sort, and filter our data...



$testListTable->prepare_items();

$tab = sanitize_text_field( $_GET['tab'] );
?>

<div class="wrap">

		<h2 class="nav-tab-wrapper woo-nav-tab-wrapper">
				<a class="nav-tab <?php if($tab == 'list' || $tab == ''){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=list_pincodes&amp;tab=list">Zip Code List</a>
				<a class="nav-tab <?php if($tab == 'premium'){ echo esc_html( "nav-tab-active" ); } ?>" href="?page=list_pincodes&amp;tab=premium">Premium Version</a>
		</h2>

<?php
if($tab == 'list' || $tab == '')
{
?>
			<div class="meta-box-sortables" id="normal-sortables">
				<div class="postbox " id="yith_wcqv_general_videobox">
					<h3><span class="upgrade-heading">Upgrade to the PREMIUM VERSION</span></h3>
					<div class="inside">
						<div class="yith_videobox">

							<div class="column two">
								<!----<h2>Get access to Pro Features</h2>---->

								<p>Switch to the premium version of Woocommerce Check Pincode/Zipcode for Shipping and COD to get the benefit of all features!</p>

									<p>
										<a target="_blank" href="http://www.phoeniixx.com/product/woocommerce-check-pincodezipcode-for-shipping-and-cod/" class="button-primary grn-btn">Get access to Premium Features</a>
									</p>
							</div>
						</div>
					</div>
				</div>
			</div>
        <?php
}
if($tab == 'list' || $tab == '')
{

			$id = sanitize_text_field( $_GET['id'] );



			if(sanitize_text_field( $_GET['action'] ) == 'delete')



			{



			?>



				<div class="updated below-h2" id="message"><p>Deleted Successfully.</p></div>



			<?php



			}



			if(sanitize_text_field( $_GET['action'] ) == 'edit' && isset($id))

			{



				if(sanitize_text_field( $_POST['submit'] ) == 'Update')

				{



					$pincode = sanitize_text_field( $_POST['pincode'] );



					$city = sanitize_text_field( $_POST['city'] );



					$state = sanitize_text_field( $_POST['state'] );



					$dod = sanitize_text_field( $_POST['dod'] );



					$cod = sanitize_text_field( $_POST['cod'] );
					

					$safe_zipcode = intval( $pincode );
					
			
					$safe_dod = intval( $dod );
					
				
						if (  $safe_zipcode && $safe_dod )
						{
							$wpdb->query( $wpdb->prepare( "UPDATE `".$table_prefix."check_pincode_p` SET `pincode`='$pincode', `city`='$city', `state`='$state', `dod`='$dod' where `id` = $id" ) );

							?>


								<div class="updated below-h2" id="message"><p>Updated Successfully.</p></div>


							<?php



						}
						else
						{
							?>

								<div class="error below-h2" id="message"><p> Please Fill Valid Data.</p></div>

							<?php
						}
				

				}

				$qry22 = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM `".$table_prefix."check_pincode_p` where `id` = $id" ) ,ARRAY_A);	


				foreach($qry22 as $qry)

				{

				}



				?>



				<div id="icon-users" class="icon32"><br/></div>



				<h2>Update Zip Code</h2>



					<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->



				<form action="" method="post" id="uzip_form" name="uzip_form">


					<table class="form-table">



					<tbody>



						<tr class="user-user-login-wrap">



							<th><label for="user_login">Pincode</label></th>



							<td><input required="required" type="text" class="regular-text" value="<?php echo $qry['pincode'];?>" id="pincode" name="pincode"></td>



						</tr>


						<tr class="user-first-name-wrap">



							<th><label for="first_name">City</label></th>



							<td><input required="required" type="text" class="regular-text" value="<?php echo $qry['city'];?>" id="city" name="city"></td>



						</tr>


						<tr class="user-last-name-wrap">



							<th><label for="last_name">State</label></th>



							<td><input required="required" type="text" class="regular-text" value="<?php echo $qry['state'];?>" id="state" name="state"></td>



						</tr>


						<tr class="user-nickname-wrap">



							<th><label for="nickname">Delivery within days</label></th>



							<td><input required="required" type="number" min="1" step="1" class="regular-text" value="<?php echo $qry['dod'];?>" id="dod" name="dod"></td>



						</tr>


					</tbody>


				</table>



					<p class="submit"><a class="button" href="?page=list_pincodes">Back</a>&nbsp;&nbsp;<input type="submit" value="Update" class="button button-primary" id="submit" name="submit"></p>



			</form>


				<?php



			}

			else

			{


				?>



				<div id="icon-users" class="icon32"><br/></div>



				<h2>Zip Code List <a class="add-new-h2" href="?page=add_pincode">Add New</a></h2>



				<!-- Forms are NOT created automatically, so you need to wrap the table in one to use features like bulk actions -->



				<form id="pincodes-filter" method="get">



					<!-- For plugins, we also need to ensure that the form posts back to our current page -->



					<input type="hidden" name="page" value="<?php echo sanitize_text_field( $_REQUEST['page'] ); ?>" />



					<!-- Now we can render the completed list table -->



					<?php $testListTable->display(); ?>



				</form>



				<?php



			}


}
if($tab == 'premium')
{
	require_once(dirname(__FILE__).'/premium-setting.php');
}
?>
 </div>
	<script>


		jQuery('.id-select-all-1').click(function() {



			if (jQuery(this).is(':checked')) {



				jQuery('div input').attr('checked', true);



			} else {



				jQuery('div input').attr('checked', false);



			}



		});



	</script>



    <?php

}

?>