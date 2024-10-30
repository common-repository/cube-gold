<?php 
function gold_admin_bar_init() {
global $wpdb;
global $wp_admin_bar;
$plugin_dir = plugin_dir_url(__FILE__);
do_action('cg_style','cg_style');
$nonce_admin_bar = wp_create_nonce('admin_bar');
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$userlogin = $current_user->user_login;
$testing = $wpdb->get_var('select option_value from wp_options where option_name = "cp_module_ranks_data"');
$new = unserialize($testing);
ksort($new);
$new_array=array_values($new);
reset($new);
$rank = cp_module_ranks_getRank(cp_currentUser());
$rank_points = array_search($rank,$new_array);
$current_rank_points = array_search($rank,$new);
// Get the sum of the gold, silver, and copper.
$prev_lvl = $new_array[$rank_points];
$xp = cp_getPoints($user_id);
$current_lvl = array_search($next_lvl,$new);
$next_ranks_points = $new_array[$rank_points+1];
$xp_level =  array_search($next_ranks_points,$new);
$percentage_num = $xp - array_search($prev_lvl,$new);
$percentage_dom = $xp_level - $current_rank_points;
$percentage = $percentage_num/$percentage_dom*100;
if ($percentage == 0){$percentage = 1;}
if($percentage == 100){$percentage = 0;}
if($percentage > 100){$percentage = 100;}
$site_url = get_site_url();
$xp_prefix = get_option('cp_prefix','').''.get_option('cp_suffix',''); 	
//$mastered_list = $wpdb->get_results("select data from wp_cp where uid = $user_id and status = 4", OBJECT  );
//$mk = serialize($mastered_list);
//setcookie('cg_m_list', $mk);

$minutes_check_trig = get_option('cgmin','on');
if($minutes_check_trig == 'on'){
	$minutes_input = 'Minutes: <input type="text" id = "minutes_admin" style="margin-top:8px; margin-left: 6px; width: 25px;" />  
for:<input type="text" id = "minutes_reason_admin" style="width: 145px; margin-left: 6px;"  />
<br />' ;
$minutes_total = (int)$wpdb->get_var("select sum(minutes) from wp_class_cur where login = '".$userlogin."'");
	
	} else {$minutes_input = '';
	$minutes_total = '';}



$ab_ad_check = get_option('ab','on');
if($ab_ad_check=='on'){
/*	$ab_version_check = get_option('ab_version','on');
	if ($ab_version_check=='on'){
		*/
$ab_fill = $minutes_input.$xp_prefix.': <input type="text" id = "xp_admin" style="width:25px; margin-top: 11px; margin-left: 7px; margin-right: 2px;" />  
 for:<input type="text" id = "xp_reason_admin" style="width: 145px; margin-left: 6px;"  />
<br />
Gold: <input type="text" id = "gold_admin" style="width:25px; margin-top: 11px; margin-left: 7px; margin-right: 2px;" />  
 for:<input type="text" id = "gold_reason_admin" style="width: 145px; margin-left: 6px;"  />
<br />
<input style="width: 145px; margin-left: 6px;" type="button" value="Add" onclick="ab_cg();" />';
	
	
	
$ab_js = 
	'

<script language="javascript">
ajaxurl = "'.$site_url.'/wp-admin/admin-ajax.php";



function ab_cg(){
	
		var xp = jQuery("#xp_admin").val();
		var xp_reason = jQuery("#xp_reason_admin").val();
		var minutes = jQuery("#minutes_admin").val();
		var minutes_reason = jQuery("#minutes_reason_admin").val();
		var gold = jQuery("#gold_admin").val();
		var gold_reason = jQuery("#gold_reason_admin").val();
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: "admin_bar_cg", _ajax_nonce:"'.$nonce_admin_bar.'", xp_admin: xp , minutes_admin: minutes, gold_admin: gold , xp_reason_admin: xp_reason , minutes_reason_admin: minutes_reason, gold_reason_admin: gold_reason },
		success: function(html){ 
		//so, if data is retrieved, store it in html
			jQuery("#xp_admin").val(""); 
			jQuery("#minutes_admin").val(""); 
			jQuery("#gold_admin").val(""); 
			jQuery("#xp_reason_admin").val("");
			jQuery("#minutes_reason_admin").val("");  
			jQuery("#gold_reason_admin").val(""); 
				
			
		}
	});
};

</script>
'


; 
		
	/*	
		} else {
			$ab_js = '';
			$ab_sc = get_option('ab_sc','');
			$ab_sc = apply_filters('the_content', $ab_sc);
$ab_sc = str_replace(']]>', ']]&gt;', $ab_sc);
			$ab_fill = $ab_sc;
			
			
			}
		
	*/	
		
		
		
		
		if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => 'Add'.$ab_js.$stylesheet,
		'href' => false,
		'id' => 'gold_links',
	));
		
		
		
		
		
		
				$wp_admin_bar->add_menu( array(
'title' => '<div id="admin_bar_area">'.$ab_fill.' </div>
    ',
		'href' => false,
		'parent' => 'gold_links',
	));
		
		
		
		
	
	}






	// Is the user sufficiently leveled, or has the bar been disabled?
	
	if (!is_admin_bar_showing() || !is_user_logged_in() )
		return;
		$wp_admin_bar->add_menu( array(
		'title' => "<div id='prog_bar_admin_box' style='width:120px; padding-top: 7px !important;'><div id=\"progress-bar-2\" class=\"all-rounded\" style=\"	border: 2px solid #777777 !important;
	border-radius: 8px 8px 8px 8px;
	clear: none !important;
	margin-bottom: 0 !important;
	padding: 0 !important;\">\n
<div id
=\"progress-bar-percentage\" class=\"all-rounded\" style=\"
-webkit-border-radius: 5px;
 -moz-border-radius: 5px;
 border-radius: 5px;
border-bottom-width:100%; 
padding: 5px 0px;
color: #FFF;
font-weight: bold;
background-color:#ff6600;
text-align: center; width: ".$percentage."%\">
</div></div></div>",
'href' => false,
'id' => 'prog_bar_links',
));


	$gold_sum = (int) $wpdb-> get_var("select sum(gold) from wp_class_cur where login = '$userlogin'");
$minutes_sum = (int) $wpdb-> get_var("select sum(minutes) from wp_class_cur where login = '$userlogin'");
$period_count_check_three = (int) $wpdb->get_var("select count(*) from wp_total_cur where id = $user_id and period_one != 0 and period_two != 0 and period_three != 0");
if($period_count_check_three != 0){$period_count = 3;}else{
$period_count_check_two = (int) $wpdb->get_var("select count(*) from wp_total_cur where id = $user_id and period_one != 0 and period_two != 0");
if($period_count_check_two != 0){$period_count = 2;}else{
$period_count = 1;
}}

				$wp_admin_bar->add_menu( array(
			'title' => $rank,
			'href' => false,
			'parent' => 'prog_bar_links',
		));
$wp_admin_bar->add_menu( array(
'title' => $xp."/".$xp_level." (".floor($percentage)."%)",
'href' => false,
'parent' => 'prog_bar_links',
	));
$wp_admin_bar->add_menu( array(
'title' => $minutes_total,
'href' => false,
'parent' => 'prog_bar_links',
));

$wp_admin_bar->add_menu( array(
'title' => $gold_sum.' Gold',
'href' => false,
'parent' => 'prog_bar_links'));
}
add_action('admin_bar_init', 'gold_admin_bar_init'); ?>