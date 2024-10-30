<?php	global $wpdb;
				
$page_id = get_the_ID();
$current_user = wp_get_current_user();
$page_title = get_the_title($page_id);
$user_id = $current_user->ID;
$page_id_manual = $wpdb->get_var("SELECT post_parent FROM wp_posts WHERE post_title = '$page_title' order by id desc limit 1 ");
$level_limit = $wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='level_limit' and post_id= '$page_id_manual' ");
$ranks_array = $wpdb->get_var('select option_value from wp_options where option_name = "cp_module_ranks_data"');
$new = unserialize($ranks_array);
$xp = cp_getPoints($user_id);
$lvl_xp = array_search($level_limit,$new);
if($xp < $lvl_xp){
$page_id = get_the_ID();
$current_user = wp_get_current_user();
$page_title = get_the_title($page_id);
$page_id_manual = $wpdb->get_var("SELECT post_parent FROM wp_posts WHERE post_title = '$page_title' order by id desc limit 1 ");
$table_name = $wpdb->prefix . "cp" ;
$table_name_meta = $wpdb->prefix."postmeta" ;
global $current_user;
$user_id = $current_user->ID;
$sum = $wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='sum' and post_id= '$page_id_manual' ");
echo '<div id="level_limit_warning" style="color:red;">You need to be '.$level_limit.'</div><br/>';
echo $sum;
} else{
$page_id = get_the_ID();
$page_title = get_the_title($page_id);
$table_name = $wpdb->prefix . "class_cur" ;
$table_name_meta = $wpdb->prefix."postmeta" ;
$time = date('m/d@H:i',current_time('timestamp',0));
$current_user = wp_get_current_user();
$userlogin = $current_user->user_login;
$pgold_value = (int) $wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE post_id = '$page_id' AND meta_key = 'gold_m'");
$gold_value = -$pgold_value;
$test = (int) $wpdb->get_var("SELECT count(*) FROM $table_name WHERE login = '$userlogin' AND  gold_reason = '$page_title' ");
if ($test == 0 ) {
$wpdb->insert( $table_name, array(  'gold_reason' => $page_title, 'login' => $userlogin), array( '%s','%s',));}
$test_paid = (int) $wpdb->get_var("SELECT count(*) FROM $table_name WHERE login = '$userlogin' AND  gold_reason = '$page_title'  and status = '5'");
$gold_clicked = $_POST['pc_gold_b'];
if(isset($gold_clicked)){
	$gold_sum= (int) $wpdb->get_var("select sum(gold) from wp_class_cur where login = '$userlogin'");
	if($gold_sum >= $pgold_value){
	$wpdb->update( $table_name, array('gold' => $gold_value,'status' => 5,'gold_reason' => $page_title, 'login' => $userlogin, 'timestamp' => $time),array(gold_reason => $page_title, login => $userlogin),  array( '%s','%s',));$test_paid = 1;} else {echo' <div id="NSF" style="color:#F00"><strong>Insufficient Funds </strong></div>'; }}
if($test_paid == 0){
$summary = $wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE post_id = '$page_id' AND meta_key =  'sum'");
echo $summary;
echo '<form method="post" action=""> <input name="pc_gold_b" type="submit" value="Buy for '.$pgold_value.' Gold" /> </form>';

} else {
	$template_check= (int) $wpdb->get_var("select count(*) from wp_postmeta where meta_key = '_wp_page_template' and meta_value = 'page.paidcontent.php' and post_id = $page_id");

								$content = get_the_content($more_link_text, $stripteaser);
								if($template_check != 1){
	$content = substr($content, 17, -18);}
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	echo $content;}}
?>				
			