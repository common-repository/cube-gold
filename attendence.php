<?php 
 
add_action('admin_menu', 'clipboard_plugin_menu', $capability, $menu_slug, $function, '/wp-content/plugins/clipboard/clipboardicon.png', $position);

function clipboard_plugin_menu() {
global $wpdb;
$dir = plugin_dir_url(__FILE__);
add_menu_page('Clipboard Options', 'Clipboard', 'manage_options', 'clipboard_settings', 'clipboard_options', $dir.'/images/clipboardicon.png');}
	function clipboard_options() {
	if (!current_user_can('manage_options'))  { 
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

function attendence(){
//Period Menu	
global $wpdb;
$period  = $_POST['Period'];
if($period!=0){
$wpdb->update( 'wp_class_cur', array( period_choice=>$period),array(id=>1),array('%s'));}


$stored_period = (int)$wpdb->get_var("SELECT period_choice  FROM wp_class_cur where id=1");
$stored_order = (int)$wpdb->get_var("SELECT order_choice  FROM wp_class_cur where id=1");
if($stored_order==1){$order = 'temp_comp';}else if($stored_order==2){$order = 'id';}else if($stored_order==3){$order = 'first_name';}else if($stored_order==4){$order = 'last_name';}else if($stored_order==5){$order = 'xp';} 


//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

	$nonce = wp_create_nonce('suggested');
	?>


<?php

?>
<style>
#even {
background-color: #EEE !important;
}
</style>
<br />
<br />
<form method="post" action="" >
Period: <select name="clipboard_selection" id="clipboard_selection"  onchange="clipboard_table();" >
  <option value="1">Period 1</option>
  <option value="2">Period 2</option>
  <option value="3">Period 3</option>
  <option value="4">Period 4</option>
  <option value="5">Period 5</option>
  <option value="6">Period 6</option>
  <option value="7">Period 7</option>
</select>

<input type="submit" value="Collect Data" name="collect"/>
</form>
<br />

<?php 
global $wpdb;
//collect and update data
$upload_data = $_POST['collect'];
if(isset($upload_data)){ 
global $wpdb;
$students_login = $wpdb->get_results("SELECT DISTINCT user_id FROM  wp_usermeta where meta_key like 'wp_capabilities' and meta_value like '%student%'");
foreach($students_login as $login){
foreach($login as $user_id){
$user_info = get_userdata($user_id);
$user_login = $user_info->user_login ;
$gamertag = $user_info->display_name ;
$user_website= $user_info->user_url;

global $wpdb;
$table_name_b = $wpdb->prefix . "total_cur";
$query = "select id from $table_name_b where id='$user_id'";
$query_run = mysql_query($query);
if (mysql_num_rows($query_run)==0) {
$rows_affected = $wpdb->insert( 'wp_total_cur', array( 'login' => $user_login, 'id'=> $user_id) );}
$num_mas_u= (int)$wpdb->get_var("SELECT count(*) FROM wp_cp WHERE  status = 4 and uid = $user_id");
$period_one = (int) $wpdb->get_var("SELECT meta_value FROM wp_usermeta where meta_key = 'period' and user_id = '$user_id'");
$period_two = (int) $wpdb->get_var("SELECT meta_value FROM wp_usermeta where meta_key = 'periodtwo' and user_id = '$user_id'");
$period_three = (int) $wpdb->get_var("SELECT meta_value FROM wp_usermeta where meta_key = 'periodthree' and user_id = '$user_id'");
$comp_one = (int) $wpdb->get_var("SELECT meta_value FROM wp_usermeta where meta_key like 'computer' and user_id = '$user_id'");
$comp_two = (int) $wpdb->get_var("SELECT meta_value FROM wp_usermeta where meta_key like 'computertwo' and user_id = '$user_id'");
$comp_three = (int) $wpdb->get_var("SELECT meta_value FROM wp_usermeta where meta_key like computerthree' and user_id = '$user_id'");
$period_count_check_three = (int) $wpdb->get_var("select count(*) from wp_total_cur where id = $user_id and period_one != 0 and period_two != 0 and period_three != 0");
if($period_count_check_three != 0){$period_count = 3;}else{
$period_count_check_two = (int) $wpdb->get_var("select count(*) from wp_total_cur where id = $user_id and period_one != 0 and period_two != 0");
if($period_count_check_two != 0){$period_count = 2;}else{
$period_count = 1;
}}

$queryminutes = "SELECT SUM(minutes) FROM wp_class_cur where login = '$user_login'"; 
$resultminutes = mysql_query($queryminutes) or die(mysql_error());
$rowminutes = mysql_fetch_array($resultminutes);
$totalminutes= $rowminutes['SUM(minutes)'];
$querygold = "SELECT SUM(gold) FROM wp_class_cur where login = '$user_login'"; 
$resultgold = mysql_query($querygold) or die(mysql_error());
$rowgold = mysql_fetch_array($resultgold);
$gold_rnd = $rowgold['SUM(gold)'];
$xp = cp_getPoints($user_id);
$first_name = $user_info->user_firstname ;
$last_name = $user_info->user_lastname ;
$table_name_b = $wpdb->prefix . "total_cur";
$wpdb->update('wp_total_cur', array( 'totalgold' => $gold_rnd, 'minutes'=>$totalminutes, 'totalxp'=> $xp, 'period_one' => $period_one, 'period_two' => $period_two, 'period_three' => $period_three, 'computer_one' => $comp_one, 'computer_two' => $comp_two, 'computer_three' => $comp_three, 'first_name'=>$first_name, 'last_name'=> $last_name, 'gamertag'=>$gamertag, 'mastered'=>$num_mas_u), array(id => $user_id), array( '%d','%d','%d','%d','%d','%d','%d','%d','%d','%s','%s','%s','%d','%d'), array( '%s' ));
}}}


$period  = $_POST['Period'];
$nonce_clipboard_table = wp_create_nonce('clipboard_table');

global $wpdb;
//table of clipboard
?>

    
<table class="widefat"  id="clipboard_table" border="1px" bordercolor="#000000" cellpadding="3px" style="width:90%;">
<thead> <tr><th style="width:7%;"><a href="#" id="id">ID</th>
 <th style="width:7%;"><a href="#" id="comp">Comp</a></th>
 <th style="width:10%;"><a href="#" id="name">Name</a></th>
<th style="width:10%;""><a href="#" id="gamertag">Gamertag</a></th>
<th style="width:9%;"><a href="#" id="lvl">Lvl</a></th>
<th style="width:7%;"><a href="#" id="gold">Gold</a></th>
<th style="width:9%;"><a href="#" id="minutes">Minutes</a></th>
<th style="width:5%;" align="center"><a href="#" id="xp">XP</a></th>
<th style="width:10%;"><a href="#" id="encountered">Encountered</a></th> 
<th style="width:9%;"><a href="#" id="accepted">Accepted</a></th> 
<th style="width:9%;"><a href="#" id="completed">Completed</a></th> 
<th style="width:14%;"><a href="#" id="mastered">Mastered</a></th> </tr></thead><tbody id="clipboard_table_body">
 <?php

?></tbody> </table> 


 <script src="<?= plugin_dir_url(__FILE__); ?>my_js/myown_jquery.js"></script>
<script src="<?= plugin_dir_url(__FILE__); ?>/my_js/myown_js/jquery-ui.js"></script>
<script src="<?= plugin_dir_url(__FILE__); ?>/my_js/sortable_us.js"></script>
<script  type='text/javascript'>
ajaxurl = '<?= get_site_url(); ?>/wp-admin/admin-ajax.php';
function clipboard_table(){
	
	jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'clipboard_table', _ajax_nonce:"<?= $nonce_clipboard_table; ?>", cb_period: jQuery('#clipboard_selection').val() },
		success: function(html){ //so, if data is retrieved, store it in html
			jQuery("#clipboard_table_body").html(html); 
	jQuery("#clipboard_table_body").show("slow"); //animation
ts_resortTable(jQuery("#comp"), 1);return false;

		}
	}); //close jQuery.ajax(
	
	
	}
	
	
	jQuery(document).ready(function(){
	
	jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'clipboard_table', _ajax_nonce:"<?= $nonce_clipboard_table; ?>", cb_period: 1 },
		success: function(html){ //so, if data is retrieved, store it in html
			jQuery("#clipboard_table_body").html(html); 
	jQuery("#clipboard_table_body").show("slow"); //animation
ts_resortTable(jQuery("#comp"), 1);return false;
		}
	}); //close jQuery.ajax(
	
	
	});
	

<!--
// When the document loads do everything inside here ...
jQuery("#searchbar").keydown(function(){
	

		// Do the ajax lookup here.
		jQuery.ajax({
		type: "post",url: "admin-ajax.php",data: { action: 'searchbar', _ajax_nonce: '<?php echo $nonce; ?>', context: $('#searchbar').val() },
		success: function(html){ //so, if data is retrieved, store it in html
			jQuery("#suggested").html(html); //show the html inside helloworld div
			jQuery("#suggested").show("fast"); //animation
		}
	}); //close jQuery.ajax(
		
	
	
})
-->
</script>

<?php
	
}

do_action( $get_attendence,attendence() );
do_action('attendence');
	}
//add text fields to user menu
add_action( 'show_user_profile', 'extra_user_profile_fields' );
add_action( 'edit_user_profile', 'extra_user_profile_fields' );

function extra_user_profile_fields( $user ) { ?>
<h3><?php _e("Student Information", "blank"); ?></h3>
 
<table class="form-table">
<tr>
<th><label for="computer"><?php _e("Computer"); ?></label></th>
<td>
<input type="text" name="computer" id="computer" value="<?php echo esc_attr( get_the_author_meta( 'computer', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your computer number."); ?></span>
</td>
</tr>
<tr>
<th><label for="period"><?php _e("Period"); ?></label></th>
<td>
<input type="text" name="period" id="period" value="<?php echo esc_attr( get_the_author_meta( 'period', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please enter your period number."); ?></span>
</td>
</tr>
<tr>
<th><label for="computertwo"><?php _e("Other Computer"); ?></label></th>
<td>
<input type="text" name="computertwo" id="computertwo" value="<?php echo esc_attr( get_the_author_meta( 'computertwo', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please Enter Another Period if you have two."); ?></span>
</td>
</tr>
<tr>
<th><label for="periodtwo"><?php _e("Other Period"); ?></label></th>
<td>
<input type="text" name="periodtwo" id="periodtwo" value="<?php echo esc_attr( get_the_author_meta( 'periodtwo', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please Enter Another Period if you have two."); ?></span>
</td>
</tr>
<tr>
<th><label for="computerthree"><?php _e("Third Computer"); ?></label></th>
<td>
<input type="text" name="computerthree" id="computerthree" value="<?php echo esc_attr( get_the_author_meta( 'computerthree', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please Enter Another Period if you have three."); ?></span>
</td>
</tr>
<tr>
<th><label for="periodthree"><?php _e("Third Period"); ?></label></th>
<td>
<input type="text" name="periodthree" id="periodthree" value="<?php echo esc_attr( get_the_author_meta( 'periodthree', $user->ID ) ); ?>" class="regular-text" /><br />
<span class="description"><?php _e("Please Enter Another Period if you have three."); ?></span>
</td>
</tr>
</table>
<?php }
 
add_action( 'personal_options_update', 'save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'save_extra_user_profile_fields' );
 
function save_extra_user_profile_fields( $user_id ) {
 
if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }
 
update_user_meta( $user_id, 'computer', $_POST['computer'] );
update_user_meta( $user_id, 'period', $_POST['period'] );
update_user_meta( $user_id, 'periodtwo', $_POST['periodtwo'] );
update_user_meta( $user_id, 'computertwo', $_POST['computertwo'] );
update_user_meta( $user_id, 'periodthree', $_POST['periodthree'] );
update_user_meta( $user_id, 'computerthree', $_POST['computerthree'] );
} 


function searchbar_ajax() {
	check_ajax_referer( "suggested" );
	global $wpdb;
	$context=  $_POST['context'];

	$mastered_suggestions = $wpdb->get_results("select distinct data from wp_cp where data like '%$context%' and type ='Quest'");
	foreach($mastered_suggestions as $mas_sug){ foreach ($mas_sug as $ms_sg){echo $ms_sg.'<br/>';}}
	die();
}
add_action( 'wp_ajax_searchbar', 'searchbar_ajax' );




?>