<?php 
global $wpdb;
$sql="alter table wp_cp add column status INT";
$rt=mysql_query($sql);  
$page_id = get_the_ID();
$page_title = get_the_title($page_id);
$content = get_the_content($more_link_text, $stripteaser);
$template_check= (int) $wpdb->get_var("select count(*) from wp_postmeta where meta_key = '_wp_page_template' and meta_value = 'page.quest.php' and post_id = $page_id");
if($template_check !=1){
$content = substr($content, 11, -12);}
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
$summary = get_post_meta($page_id, 'sum', true);
$summary = apply_filters('the_content', $summary);
$summary = str_replace(']]>', ']]&gt;', $summary);
if (!is_user_logged_in()) {
$table_name = $wpdb->prefix . "cp" ;
$table_name_meta = $wpdb->prefix."postmeta" ;
echo $summary;
echo $content;
	}else{
global $current_user;
$user_id = $current_user->ID;
$current_user = wp_get_current_user();
echo $summary;
$mastered_list = get_user_meta($user_id, 'cg_mastered_list', true);
if($mastered_list == ''){
$mastered_list = $wpdb->get_results("select data from wp_cp where uid = $user_id and status = 4", OBJECT_K);
$keys = array_keys($mastered_list);
$mk = serialize($keys);
update_user_meta( $user_id, 'cg_mastered_list', $mk, '' );
	} else {
		$keys = unserialize($mastered_list);
		}
$rq_s = get_option('required_quests','');
$message = '';
$rq_u = unserialize($rq_s);

if($rq_u != ''){
	if(!in_array($page_title, $rq_u)){
	foreach($rq_u as $rq_ss){
		if($rq_ss != ''){
		if (!in_array($rq_ss, $keys) ){
			$message = $message.' '.$rq_ss;
			$message_array [] = $rq_ss;
			}}
		}
	} 
}
if($message != ''){ foreach($message_array as $message_arrays){echo '<div style="color:red;" >You need to master '.$message_arrays.' to unlock quests.</div>';}} else{
	$mastery_rq = get_post_meta($page_id,'required_mastery',true);
	if($mastery_rq != ''){$mastery_check = (int)$wpdb->get_var("select count(*) from wp_cp where uid = $user_id and data = '$mastery_rq' and status = 4");}else{ $mastery_check = 1;};
	if($mastery_check == 0){ echo '<div style="color:red;">You need to master '.$mastery_rq.' to unlock this quest.</div>';} else {
$level_limit = $wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='level_limit' and post_id= '$page_id' ");
$ranks_array = $wpdb->get_var('select option_value from wp_options where option_name = "cp_module_ranks_data"');
$new = unserialize($ranks_array);
$xp = cp_getPoints($user_id);
$lvl_xp = array_search($level_limit,$new);
if($xp < $lvl_xp){
echo '<div id="level_limit_warning" style="color:red;">You need to be '.$level_limit.'</div><br/>';
} else {
$points = cp_getPoints($user_id);
$enc_check = (int)$wpdb->get_var("select count(*) from wp_cp where uid = $user_id and data = '$page_title'");
$time = date('m/d@H:i',current_time('timestamp',0));

if ($enc_check == 0){
	$xp_value_e = $wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE post_id = '$page_id' AND meta_key =  'xp_e'");
	if ($version == 'full'){$wpdb->insert( 'wp_class_cur_log', array( 'uid' => $user_id, 'quest' => $page_title, 'enc'=> $time  ), array( '%s','%s','%s'));} 
	$wpdb->insert( 'wp_cp', array(  'timestamp' => time(), 'uid' => $user_id,'points' => $xp_value_e, 'data' => $page_title,'type' => "Quest" , 'status'=>1), array( '%s','%s','%s'));
echo '<div class="noticetime"><div class="notice-wrap"><div class="notice-item-wrapper"><div style="" class="notice-item notice"><div class="notice-item-close">×</div><p>+'.$xp_value_e.'</p></div></div></div></div>';
update_user_meta($user_id, 'cpoints', $points+$xp_value_e);
$level_prog = 1;
} else {$level_prog = (int)$wpdb->get_var("select status from wp_cp where data = '$page_title' and uid = $user_id");}
if($level_prog == 1){$button_text = get_option('accepted_b','');}else if($level_prog == 2){$button_text = get_option('completed_b','');}else if($level_prog == 3){$button_text = get_option('mastered_b','');}


	?>
      <?php if($level_prog > 1){ echo $content.'<br/>';} else { ?>
    <div id="content_q"><?php echo $content; ?></div> <?php }?>
    <?php if ($level_prog != 4){?><div id="level_prog_b"><input type="button" name="<?php echo $level_prog; ?>" id="quest_b" value="<?php echo $button_text; ?>" onclick=" this.disabled = true;quest();"/></div><?php } 
	
	if($level_prog == 4){
		$mm = get_post_meta($page_id, 'mast_mes', true);
$mm = apply_filters('the_content', $mm);
$mm = str_replace(']]>', ']]&gt;', $mm);
echo $mm;
		}?>
	<div id="check"></div>
	<?php
	} 
				
	}}}

$nonce = wp_create_nonce('quest_b');

?>
<script src="<?php echo plugin_dir_url(__FILE__); ?>my_js/myown_js/jquery-ui.js"></script>
<script src="<?php echo plugin_dir_url(__FILE__); ?>my_js/myown_ui.js"></script>
     
<script language="javascript">
ajaxurl = '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php';
jQuery(document).ready(function(){
	
		if(<?php echo $level_prog;?> == 1){
		
		jQuery("#content_q").hide(1000);
		
		}
		});
				jQuery(document).ready(
				function(){
					setTimeout(
					function(){
  jQuery("div.noticetime").fadeOut(
  "slow", function () {
  jQuery("div.noticetime").remove();
      });});});
    
function quest(){
			// Do the ajax lookup here.
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'questb', _ajax_nonce: '<?php echo $nonce; ?>' ,level_prog: jQuery('#quest_b').attr('name'), pageid: '<?php echo $page_id; ?>' },
		success: function(html){ //so, if data is retrieved, store it in html
			jQuery("#level_prog_b").html(html); //show the html inside helloworld div
			jQuery("#content_q").show(1000);
			jQuery("#quest_b").disabled = false; 
			setTimeout(function(){
  jQuery("div.noticetime").fadeOut("slow", function () {
  jQuery("div.noticetime").remove();
      });
    
}, 2000);
			
		}
	}); 
	
	}
	
	
	
</script>