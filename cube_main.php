<?php 
/*
Plugin Name: CubeGold
Description: The complete version of Cube Gold.
Author:Semar Yousif
Version: 1.0.9.2
*/


// Admin Menu Functions

function stats_style() {
global $wpdb;

$plug_dir = plugin_dir_url(__FILE__);

	  wp_register_style( 'ui-style', $plug_dir.'my_js/myown_js/ui-lightness/jquery-ui-1.8.21.custom.css' );
        wp_enqueue_style( 'ui-style' );
	
	 wp_register_style( 'stats-style', $plug_dir.'/my_js/myown_js/myown_style.css' );
        wp_enqueue_style( 'stats-style' );
	
//wp_register_script('jquery_ui', $plug_dir.'/my_js/myown_js/jquery-ui.js',false, false, true); 
//wp_enqueue_script('jquery_ui');
	

}
add_action('stats_style', 'stats_style');


function cg_style() {
global $wpdb;

$plug_dir = plugin_dir_url(__FILE__);
	  wp_register_style( 'cg-style', $plug_dir.'/cubegold_style.css ');
        wp_enqueue_style( 'cg-style' );
	
}
add_action('cg_style', 'cg_style');



include ("admin_bar.php");
include("attendence.php");
add_action('admin_menu', 'cubegold', $capability, $menu_slug, $function);


function cubegold() {
global $wpdb;
$dir = plugin_dir_url(__FILE__);
add_menu_page('cubegold options', 'Cube Gold', 'manage_options', 'cubegold_settings', 'cubegold_menu', $dir.'/images/cg_16.png');}

	function cubegold_menu() {
		global $wpdb;
	if (!current_user_can('manage_options'))  { 
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}

else {
	
	if(isset($_POST['version'])){
	$version = $_POST['version'];
update_option('cgversion', $version);
		if($version == 'lite'){$lite_radio = 'checked'; $full_radio='';} else if($version == 'full'){$full_radio= 'checked'; $lite_radio='';}
	}

	 else {	$version_choice = get_option( 'cgversion', '' ); if($version_choice == 'lite'){$lite_radio = 'checked'; $full_radio = '';} else if($version_choice == 'full'){$full_radio= 'checked'; $lite_radio = '';} }
	 
	 if(isset($_POST['encountered_b'])){
		update_option('encountered_b',$_POST['encountered_b']);
		$enc_b = $_POST['encountered_b'];
		} else {$enc_b = get_option('encountered_b','');}
	 
	  if(isset($_POST['accepted_b'])){
		update_option('accepted_b',$_POST['accepted_b']);
		$acc_b = $_POST['accepted_b'];
		} else {$acc_b = get_option('accepted_b','');}
		
	  if(isset($_POST['completed_b'])){
		update_option('completed_b',$_POST['completed_b']);
		$com_b = $_POST['completed_b'];
		} else {$com_b = get_option('completed_b','');}
		
	  if(isset($_POST['mastered_b'])){
		update_option('mastered_b',$_POST['mastered_b']);
		$mas_b = $_POST['mastered_b'];
		} else {$mas_b = get_option('mastered_b','');}
		
		
		 if(isset($_POST['encountered_t'])){
		update_option('encountered_t',$_POST['encountered_t']);
		$enc_t = $_POST['encountered_t'];
		} else {$enc_t = get_option('encountered_t','');}
		
		
		 if(isset($_POST['accepted_t'])){
		update_option('accepted_t',$_POST['accepted_t']);
		$acc_t = $_POST['accepted_t'];
		} else {$acc_t = get_option('accepted_t','');}
		
		
			 if(isset($_POST['completed_t'])){
		update_option('completed_t',$_POST['completed_t']);
		$com_t = $_POST['completed_t'];
		} else {$com_t = get_option('completed_t','');}
		
	 if(isset($_POST['mastered_t'])){
		update_option('mastered_t',$_POST['mastered_t']);
		$mas_t = $_POST['mastered_t'];
		} else {$mas_t = get_option('mastered_t','');}
		
		 if(isset($_POST['nt_enc_t'])){
		update_option('nt_enc_t',$_POST['nt_enc_t']);
		$nt_enc_t = $_POST['nt_enc_t'];
		} else {$nt_enc_t = get_option('nt_enc_t','');}
		
		
		if(isset($_POST['numb_queries'])){
		update_option('numb_queries',$_POST['numb_queries']);
		$numb_queries = $_POST['numb_queries'];
		} else {$numb_queries = get_option('numb_queries','');}
		
		if(isset($_POST['numb_queries_lb'])){
		update_option('numb_queries_lb',$_POST['numb_queries_lb']);
		$numb_queries_lb = $_POST['numb_queries_lb'];
		} else {$numb_queries_lb = get_option('numb_queries_lb','');}
		
		
	if(isset($_POST['level_comment'])){
	$level_comment = $_POST['level_comment'];
update_option('level_comment', $level_comment);
		if($level_comment == 1){$on_radio = 'checked'; $off_radio='';} else if($level_comment == 0){$off_radio= 'checked'; $on_radio='';}
	}

	 else {	$level_comment = get_option( 'level_comment', '' ); if($level_comment == 1){$on_radio = 'checked'; $off_radio = '';} else if($level_comment == 0){$off_radio= 'checked'; $off_radio = '';} }
	 
	 
	 
	 		
	if(isset($_POST['level_xp_option'])){
	$level_xp_option = $_POST['level_xp_option'];
update_option('level_xp_option', $level_xp_option);
		if($level_xp_option == 1){$on_opt_radio = 'checked'; $off_opt_radio='';} else if($level_xp_option == 0){$off_opt_radio= 'checked'; $on_opt_radio='';}
	}

	 else {	$level_xp_option = get_option( 'level_xp_option', '' ); if($level_xp_option == 1){$on_opt_radio = 'checked'; $off_opt_radio = '';} else if($level_xp_option == 0){$off_opt_radio= 'checked'; $on_opt_radio = '';} }
	 
	 
	 if(isset($_POST['hq_t'])){
		update_option('hq_t',$_POST['hq_t']);
		$hq_t = $_POST['hq_t'];
		} else {$hq_t = get_option('hq_t','');}
		
		
		
		
	 if(isset($_POST['system_t'])){
		update_option('cg_system_t',$_POST['system_t']);
		$system_t = $_POST['system_t'];
		} else {$system_t = get_option('cg_system_t','');}
	 
	 
	if(isset($_POST['min'])){
	$min = $_POST['min'];
update_option('cgmin', $min);
		if($min == 'on'){$min_on_radio = 'checked'; $min_off_radio='';} else if($min == 'off'){$min_off_radio= 'checked'; $min_on_radio='';}
	}

	 else {	$min_choice = get_option( 'cgmin', '' ); if($min_choice == 'on'){$min_on_radio = 'checked'; $min_off_radio = '';} else if($min_choice == 'off'){$min_off_radio= 'checked'; $min_on_radio = '';} }
	 
 if(isset($_POST['min_req'])){
		update_option('min_req',$_POST['min_req']);
		$min_req = $_POST['min_req'];
		} else {$min_req = get_option('min_req',5400);}
	 
	 
	 
	 if(isset($_POST['ab'])){
	$ab = $_POST['ab'];
update_option('ab', $ab);
		if($ab == 'on'){$on_ab_radio = 'checked'; $off_ab_radio='';} else if($ab == 'off'){$off_ab_radio= 'checked'; $on_ab_radio='';}
	}

	 else {	$ab = get_option( 'ab', '' ); if($ab == 'on'){$on_ab_radio = 'checked'; $off_ab_radio='';} else if($ab == 'off'){$off_ab_radio= 'checked'; $on_ab_radio='';} }
	 
/*	 
	 
	  if(isset($_POST['ab_version'])){
	$ab_version = $_POST['ab_version'];
update_option('ab_version', $ab_version);
		if($ab_version == 'on'){$st_ab_radio = 'checked'; $te_ab_radio='';} else if($ab_version == 'off'){$te_ab_radio= 'checked'; $st_ab_radio='';}
	}

	 else {	$ab_version = get_option( 'ab_version', '' ); if($ab_version == 'on'){$st_ab_radio = 'checked'; $te_ab_radio='';} else if($ab_version == 'off'){$te_ab_radio= 'checked'; $st_ab_radio='';} }
	 
	 
	 
	 	 if(isset($_POST['ab_sc'])){
			 
$ab_sc =  $_POST['ab_sc'];


			 
			 
		update_option('ab_sc',$ab_sc);
		} else {$ab_sc = get_option('ab_sc','');
		
		
		}
	 */
	 
	 
	 
?>
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); ?>/cubegold_style.css" type="text/css" />
<?php 
$tim = strtotime('tomorrow PST');
$ti = strtotime('now');
$t = (7*3600);
?>
<form method="post" action="">
  <h1 id="cg-title"><strong>Cube Gold Options</strong></h1>
  <br/>
  <h2 id="version">Version</h2>
  <br />
  <div id="version-radio">Lite:
    <input type="radio" name="version" value="lite" <?php print $lite_radio; ?>>
    <br/>
    Full:
    <input type="radio" name="version" value="full" <?php print $full_radio; ?>>
  </div>
  
 
 
  <br/>
  <h2 id="version" style="width:150px !important;">Admin Bar Box</h2>
  <br />
  <div id="version-radio">On:
    <input type="radio" name="ab" value="on" <?php print $on_ab_radio; ?>>
  
    Off:
    <input type="radio" name="ab" value="off" <?php print $off_ab_radio; ?>>
  </div>
  <?php /*
   <div id="ab_version">Student Driven:
    <input type="radio" name="ab_version" value="on" <?php print $st_ab_radio; ?>>
  
    Teacher Driven:
    <input type="radio" name="ab_version" value="off" <?php print $te_ab_radio; ?>>
  </div>
  
  
  <textarea name="ab_sc"><?= $ab_sc ?></textarea>
 
 */ ?>
 
 
 
 
  <div id="minutes">
    <h2 id="minutes_title">Minutes</h2>
    <div id="min_rad">On:
      <input type="radio" name="min" value="on" <?php print $min_on_radio; ?>>
      Off:
      <input type="radio" name="min" value="off" <?php print $min_off_radio; ?>>
      <br />
    </div>
    Required minutes per semester per period:
    <input type="text" name="min_req" value="<?= $min_req ?>" />
    <br />
    <input type="button" onclick="min_reset();" value="Reset Minutes"/>
  </div>
  <h2 id="buttons-title">Buttons</h2>
  <br />
  <div id="buttons">Encounter Stage:
    <input type="text" id="buttons-textarea" name="encountered_b" value="<?php echo $enc_b; ?>">
    <br/>
    Accept Stage:
    <input type="text" id="buttons-textarea" name="accepted_b" value="<?php echo $acc_b; ?>">
    <br/>
    Complete Stage:
    <input type="text" id="buttons-textarea" name="completed_b" value="<?php echo $com_b; ?>">
    <br/>
    Master Stage:
    <input type="text" id="buttons-textarea" name="mastered_b" value="<?php echo $mas_b; ?>">
    <br/>
  </div>
  <h2 id="stats-title">Stats Page Title</h2>
  <br />
  <div id="stats_page_titles"> System Title (Quest):
    <input type="text" id="buttons-textarea" name="system_t" value="<?php echo $system_t; ?>">
    <br/>
    Encounter Stage:
    <input type="text" id="buttons-textarea" name="encountered_t" value="<?php echo $enc_t; ?>">
    <br/>
    Accept Stage:
    <input type="text" id="buttons-textarea" name="accepted_t" value="<?php echo $acc_t; ?>">
    <br/>
    Complete Stage:
    <input type="text" id="buttons-textarea" name="completed_t" value="<?php echo $com_t; ?>">
    <br/>
    Master Stage:
    <input type="text" id="buttons-textarea" name="mastered_t" value="<?php echo $mas_t; ?>">
    <br/>
    <?php //Not Encountered: <input type="text" id="buttons-textarea" name="nt_enc_t" value="<?php echo $nt_enc_t; "><br/>?>
    Hidden Quest Title:
    <input type="text" id="buttons-textarea" name="hq_t" value="<?php echo $hq_t; ?>">
    <br/>
    Rows in Tab:
    <input type="text" id="buttons-textarea" name="numb_queries" value="<?php echo $numb_queries; ?>">
    <br/>
    Leaderboard:
    <input type="text" id="buttons-textarea" name="numb_queries_lb" value="<?php echo $numb_queries_lb; ?>">
  </div>
  <h2 id="lic">Level In Comments</h2>
  <br />
  <div id="level_comment">On:
    <input type="radio" name="level_comment" value="1" <?php print $on_radio; ?>>
    <br/>
    Off:
    <input type="radio" name="level_comment" value="0" <?php print $off_radio; ?>>
    <br />
    Show: <br />
    XP:
    <input type="radio" name="level_xp_option" value="1" <?php print $on_opt_radio; ?>>
    <br/>
    Level:
    <input type="radio" name="level_xp_option" value="0" <?php print $off_opt_radio; ?>>
  </div>
  <br/>
  <div id="required_quests">
    <h2 id="rm">Required
      <?= $system_t ?>
    </h2>
    <div id="rq_m">
      <?php 
$ps_rq = get_option('required_quests','');
if($ps_rq != ''){
	$ps_rq_u = unserialize ($ps_rq);
$ps_rq_u =array_filter($ps_rq_u, 'strlen');
foreach($ps_rq_u as $ps){
	echo '<input type="text" value="'.$ps.'" name="rq_text[]"/>';
	}}
	
	
	
	
	if(isset($_POST['rq_text'])){
			$f_rq = array_filter($_POST['rq_text'], 'strlen');
	$count = count($ps_rq_u);
		$n_rq = array_splice($f_rq, $count);

		foreach($n_rq as $pss){
	echo '<input type="text" value="'.$pss.'" name="rq_text[]"/>';
	}
				$f_rq = array_filter($_POST['rq_text'], 'strlen');

$s_rq = serialize($f_rq);
		update_option('required_quests',$s_rq);
		}

?>
      <div id="rq_text">
        <input type="text" name="rq_text[]"/>
      </div>
      <input type="button" onclick="add_rq();" value="+" />
    </div>
    <?php /*<div id="eq_text">
<input type="text" name="eq_text[]"/>
</div> */ ?>
  </div>
  <div>
    <input type="submit" value="Save" id="cgsave" style="float:left; clear:both;" />
  </div>
</form>
<script src="<?= plugin_dir_url(__FILE__); ?>my_js/myown_jquery.js"></script> 
<script language="javascript" type="text/javascript">
function add_rq(){
	jQuery("#rq_text").html(jQuery('#rq_text').html() + '<input type="text" name="rq_text[]"/>'); 
	jQuery("#rq_text").show("slow"); 
	}
	function min_reset(){
		alert('hi');
		ajaxurl = '<?= get_site_url(); ?>/wp-admin/admin-ajax.php';
	
	jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'min_reset' },
		
	}); //close jQuery.ajax(
	
	
	}
	
</script>
<?php




if(isset($_POST['version'])){
	
	$table_name_t = $wpdb->prefix . "total_cur";

   $sql_t = "CREATE TABLE $table_name_t (

  id INT,

login VARCHAR (30),
gamertag VARCHAR (30),
first_name VARCHAR (30),

last_name VARCHAR (30),

minutes INT,
minutes_p INT,
mastered INT,


period_one INT,

computer_one INT,

period_two INT,

computer_two INT,

period_three INT,

computer_three INT,

totalxp INT,

totalgold INT,

temp_comp INT

     )";



   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

   dbDelta($sql_t);

	
	if($_POST['version'] == 'full'){
		
		
		

   $table_name_log = $wpdb->prefix . "class_cur_log";

   $sql_log = "CREATE TABLE $table_name_log (

  id mediumint(9) NOT NULL AUTO_INCREMENT,

uid INT,

quest VARCHAR (200),

enc text(30),

acc text(30),

com text(30),

mas text (30),

  UNIQUE KEY id (id)

    );";



   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

   dbDelta($sql_log);

		
		
		
		
		
		

   $table_name_c = $wpdb->prefix . "class_cur";

   $sql_c = "CREATE TABLE $table_name_c (

  id mediumint(9) NOT NULL AUTO_INCREMENT,

login VARCHAR (300),

timestamp VARCHAR (50),

minutes INT,

minutes_reason VARCHAR (500),

  gold INT,

  gold_reason VARCHAR (500),

  status VARCHAR (20),

  period_choice INT,

  order_choice INT,

  UNIQUE KEY id (id)

    );";





   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

   dbDelta($sql_c);
		
		
		}
	
	if($_POST['version'] == 'lite'){
   $table_name = $wpdb->prefix . "class_cur";

   $sql = "CREATE TABLE $table_name (

  id mediumint(9) NOT NULL AUTO_INCREMENT,

login VARCHAR (300),

timestamp VARCHAR (50),

minutes INT,

minutes_reason VARCHAR (500),

  gold INT,

  gold_reason VARCHAR (500),

  status VARCHAR (20),

  period_choice INT,

  order_choice INT,

  UNIQUE KEY id (id)

    );";





   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

   dbDelta($sql);}
	}




		
}
	}
do_action('cubegold_menu');
	
	
	
	
	
	
	
add_action( 'add_meta_boxes', 'myplugin_add_custom_box' );



// backwards compatible (before WP 3.0)

// add_action( 'admin_init', 'myplugin_add_custom_box', 1 );



/* Do something with the data entered */

add_action( 'save_post', 'myplugin_save_postdata' );



/* Adds a box to the main column on the Post and Page edit screens */

function myplugin_add_custom_box() {

    add_meta_box( 

        'myplugin_sectionid',

        __( 'My Post Section Title', 'myplugin_textdomain' ),

        'myplugin_inner_custom_box',

        'post' 

    );

    add_meta_box(

        'myplugin_sectionid',

        __( 'Currency Options', 'myplugin_textdomain' ), 

        'myplugin_inner_custom_box',

        'page'

    );

}



/* Prints the box content */

function myplugin_inner_custom_box( $post ) {




	 $gold_m = $_POST['gold_m'];







$xp_e = $_POST['xp_e'];

$xp_a = $_POST['xp_a'];

$xp_c = $_POST['xp_c'];

$xp_m = $_POST['xp_m'];

$level_limit = $_POST['level_limit'];

 $sum = $_POST['sum'];



  // Use nonce for verification

  wp_nonce_field( plugin_basename( __FILE__ ), 'myplugin_noncename' );



 //Get current set values for XP and Gold
  

  global $wpdb;

  $post_id = $_GET['post'];

$sum = get_post_meta($post_id,'sum',true);
$mm = get_post_meta($post_id,'mast_mes',true);


$xp_pte = (int)$wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='xp_e' and post_id= '$post_id' ");

$xp_pta = (int)$wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='xp_a' and post_id='$post_id' ");

$xp_ptc = (int)$wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='xp_c' and post_id='$post_id' ");

$xp_ptm = (int)$wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='xp_m' and post_id='$post_id' ");

$gold_pm = (int)$wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='gold_m' and post_id='$post_id' ");

$level_limit = get_post_meta($post_id,'level_limit',true);

$hq_trig = get_post_meta($post_id,'hidden_quest',true);
$rm = get_post_meta($post_id,'required_mastery',true);


$xp_pe = $pte;

$xp_pa = $xp_pta - $xp_pte;

$xp_pc = $xp_ptc - $xp_pta;

$xp_pm = $xp_ptm - $xp_ptc ;

//Default values of XP and Gold

if($xp_pte ==0){$xp_pte= 10;}

if($xp_pa ==0){$xp_pa= 10;}

if($xp_pc ==0){$xp_pc= 10;}

if($xp_pm ==0){$xp_pm= 10;}

if($gold_pm ==0){$gold_pm= 10;}


	$testing_level_one = $wpdb->get_var('select option_value from wp_options where option_name = "cp_module_ranks_data"');
$new_level_one = unserialize($testing_level_one);
ksort($new_level_one);
$level_list=array_values($new_level_one);
if($level_limit == ''){
	$level_limit = $level_list[0]; 
}
$current_level_limit_xp = array_search($level_limit, $new_level_one);
 //Displays boxes in the menu

      echo '<div><label for="myplugin_new_field"><strong>';

       _e("Summary - ", 'myplugin_textdomain' );

  echo '</strong></label> ';
echo '<textarea id="myplugin_new_field" name="sum" style="width:400px">'.$sum.'</textarea><br />';

  

    

    echo '<label for="myplugin_new_field"><strong>';

       _e("XP - ", 'myplugin_textdomain' );

  echo 'Encounter:</strong></label> ';

  echo '<input type="text" id="myplugin_new_field" name="xp_e" value="'.$xp_pte.'" size="5"  /> '; 

  

    echo '<label for="myplugin_new_field"><strong>';

       _e(" Accepted:", 'myplugin_textdomain' );

  echo '</strong></label> ';

  echo '<input type="text" id="myplugin_new_field" name="xp_a" value="'.$xp_pa.'" size="5" />';

  



  

    echo '<label for="myplugin_new_field"><strong>';

       _e(" Completed:", 'myplugin_textdomain' );

  echo '</strong></label> ';

  echo '<input type="text" id="myplugin_new_field" name="xp_c" value="'.$xp_pc.'" size="5" />';

  

  

echo '<label for="myplugin_new_field"><strong>';

       _e(" Mastered:", 'myplugin_textdomain' );

echo '</strong></label> ';

echo '<input type="text" id="myplugin_new_field" name="xp_m" value="'.$xp_pm.'" size="5" />';

  

echo '<label for="myplugin_new_field"><strong>';

       _e(" Gold for Mastered:", 'myplugin_textdomain' );

echo '</strong></label> ';

echo '<input type="text" id="myplugin_new_field" name="gold_m" value="'.$gold_pm.'" size="5" />';

  
  
  
  
echo '<label for="myplugin_new_field"><strong>';

       _e(" Level Required:", 'myplugin_textdomain' );

echo '</strong></label> ';
?>
<select  style="overflow:auto;" id="myplugin_new_field" name="level_limit" />

<option value="<?= $level_limit ?>">
<?= $level_limit.' ('.$current_level_limit_xp.')' ?>
</option>
<?php
$lvl_list_num = 0;
foreach($level_list as $lvl_list){
	$current_lvl = $level_list[$lvl_list_num];
	$lvl_limit_xp = array_search($level_list[$lvl_list_num],$new_level_one);
	?>
<option value="<?= $current_lvl; ?>">
<?= $current_lvl.' ('.$lvl_limit_xp.')' ?>
</option>
<?php
	$lvl_list_num = $lvl_list_num + 1;
	}
 ?>
</select>
<?php
echo '<label for="myplugin_new_field"><strong>';

       _e(" Hide Quest:", 'myplugin_textdomain' );

echo '</strong></label> ';

?>
<input type="checkbox" name="hidden_quest" <?php if($hq_trig == 1){ echo'checked="checked"';}
 ?> />
<?php

echo '<label for="myplugin_new_field"><strong>';

       _e(" Mastery Required:", 'myplugin_textdomain' );

echo '</strong></label> ';
echo '<input type="text" id="myplugin_new_field" name="rm" value="'.$rm.'" size="15" /><br />';


 echo '<div><label for="myplugin_new_field"><strong>';
 _e("Mastery Message - ", 'myplugin_textdomain' );
  echo '</strong></label> ';
echo '<textarea id="myplugin_new_field" name="mm" style="width:400px">'.$mm.'</textarea>';

echo '</div>';

}



/* When the post is saved, saves our custom data */

function myplugin_save_postdata( $post_id ) {

	

  // verify if this is an auto save routine. 

  // If it is our form has not been submitted, so we dont want to do anything

  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 

      return;



  // verify this came from the our screen and with proper authorization,

  // because save_post can be triggered at other times



  if ( !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename( __FILE__ ) ) )

      return;



  

  // Check permissions

  if ( 'page' == $_POST['post_type'] ) 

  {

    if ( !current_user_can( 'edit_page', $post_id ) )

        return;

  }

  else

  {

    if ( !current_user_can( 'edit_post', $post_id ) )

        return;

  }



  // OK, we're authenticated: we need to find and save the data



$mydata = $_POST['myplugin_new_field'];



$gold_m = $_POST['gold_m'];

	 
$mm = $_POST['mm'];
	 

$xp_e = $_POST['xp_e'];

$xp_ap = $_POST['xp_a'];

$xp_cp = $_POST['xp_c'];

$xp_mp = $_POST['xp_m'];

$rm = $_POST['rm'];

	 
$sum = $_POST['sum'];

$xp_a = $xp_ap + $xp_e;

$xp_c = $xp_a + $xp_cp;

$xp_m = $xp_c + $xp_mp;


$level_limit = $_POST['level_limit'];
$hidden_quest = $_POST['hidden_quest'];
add_post_meta($post_id, 'gold_m', $gold_m, true) or update_post_meta($post_id, 'gold_m', $gold_m);



add_post_meta($post_id, 'xp_e', $xp_e, true) or update_post_meta($post_id, 'xp_e', $xp_e);

add_post_meta($post_id, 'xp_a', $xp_a, true) or update_post_meta($post_id, 'xp_a', $xp_a);

add_post_meta($post_id, 'xp_c', $xp_c, true) or update_post_meta($post_id, 'xp_c', $xp_c);

add_post_meta($post_id, 'xp_m', $xp_m, true) or update_post_meta($post_id, 'xp_m', $xp_m);



add_post_meta($post_id, 'sum', $sum, true) or update_post_meta($post_id, 'sum', $sum);

add_post_meta($post_id, 'mast_mes', $mm, true) or update_post_meta($post_id, 'mast_mes', $mm);


add_post_meta($post_id, 'level_limit', $level_limit, true) or update_post_meta($post_id, 'level_limit', $level_limit);


add_post_meta($post_id, 'required_mastery', $rm, true) or update_post_meta($post_id, 'required_mastery', $rm);

if(isset($_POST['hidden_quest'])) 
{
    add_post_meta($post_id, 'hidden_quest', 1, true) or update_post_meta($post_id, 'hidden_quest', 1);
} else {
	add_post_meta($post_id, 'hidden_quest',0, true) or update_post_meta($post_id, 'hidden_quest', 0);
	}

}
	
	
	
	

		 
add_shortcode('statspage', 'statspage_short');  
function statspage_short( $atts, $content = null ){
include ("statspage.php");
	}
	

add_shortcode('questpage', 'questpage_short');  
function questpage_short( $more_link_text = null, $stripteaser = false){
	$cg_version = get_option('cgversion');
include ("quest.php"); 
	
	}
	
add_shortcode('paidcontentpage', 'paid_content_page_short');  
function paid_content_page_short( $atts, $content = null, $more_link_text = null, $stripteaser = true){
include ("paid_content.php"); 
	
	}
add_shortcode('gamerlist', 'gamerlist');  
function gamerlist( $atts, $content = null ){
include ("gamerlist.php"); 
	
	}

	add_action('wp_ajax_questb', 'questb'); 
function questb(){
check_ajax_referer('quest_b');
global $wpdb;
$version = get_option('cgversion');
$prev_level_prog = $_POST['level_prog'];
$page_id = $_POST['pageid'];
$page_title = get_the_title($page_id);
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$userlogin = $current_user->user_login;
$level_prog = $prev_level_prog +1;
$content = get_the_content($more_link_text, $stripteaser);
$content = substr($content, 11, -12);
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);
$time = date('m/d@H:i',current_time('timestamp',0));
$xp_value_a = get_post_meta($page_id,'xp_a',true);
$xp_value_e = get_post_meta($page_id,'xp_e',true);
$xp_value_c = get_post_meta($page_id,'xp_c',true);
$xp_value_m = get_post_meta($page_id,'xp_m',true);
$points = cp_getPoints($user_id);
if($prev_level_prog < 3){ 
if($prev_level_prog ==1){
	$time_click = 'acc';
	$button_text = get_option('completed_b'); 
	$xp_value = $xp_value_a;
	$xp_display = $xp_value_a - $xp_value_e;}
if($prev_level_prog == 2){
	$button_text = get_option('mastered_b');
	 $time_click = 'com'; 
	 $xp_value = $xp_value_c;
	 $xp_display = $xp_value_c - $xp_value_a;}
echo '<input type="button" name="'.$level_prog.'" id="quest_b" value="'.$button_text.'" onclick="this.disabled = true;quest();"/>';
$wpdb->update( 'wp_cp', array(  'timestamp' => time(), 'points' => $xp_value,'type' => "Quest", 'data'=> $page_title,  'status'=>$level_prog ), array(uid => $user_id, data => $page_title),array( '%s','%s'));
echo '<div class="noticetime"><div class="notice-wrap"><div class="notice-item-wrapper"><div style="" class="notice-item notice"><div class="notice-item-close">×</div><p>+'.$xp_display.'</p></div></div></div></div>';
if($version == 'full'){$wpdb->update( 'wp_class_cur_log', array( $time_click=>$time), array(uid => $user_id, quest => $page_title),array( '%s','%s'));}
update_user_meta($user_id, 'cpoints', $points+$xp_display);
} else if($prev_level_prog == 3){
$time_click = 'mas';
$xp_value = $xp_value_m;
$xp_display = $xp_value_m - $xp_value_c;
$gold_value_m = $xp_value_m = get_post_meta($page_id,'gold_m',true);
$wpdb->update( 'wp_cp', array(  'timestamp' => time(), 'points' => $xp_value,'type' => "Quest", 'data'=> $page_title,  'status'=>$level_prog ), array(uid => $user_id, data => $page_title),array( '%s','%s'));
$wpdb->insert( 'wp_class_cur', array(  'gold' => $gold_value_m,'gold_reason' => $page_title, 'status'=>4, 'login' => $userlogin, 'timestamp' => $time),  array( '%s','%s',));
if($version == 'full'){$wpdb->update( 'wp_class_cur_log', array( $time_click=>$time), array(uid => $user_id, quest => $page_title),array( '%s','%s'));}


$mastered_list = get_user_meta($user_id, 'cg_mastered_list', true);
$ml_u = unserialize($mastered_list);
$ml_u[] = $page_title;
$ml_u = serialize($ml_u);
update_user_meta( $user_id, 'cg_mastered_list', $ml_u, $mastered_list );



update_user_meta($user_id, 'cpoints', $points+$xp_display);
$dir = plugin_dir_url(__FILE__);
$mm = get_post_meta($page_id, 'mast_mes', true);
$mm = apply_filters('the_content', $mm);
$mm = str_replace(']]>', ']]&gt;', $mm);
echo $mm;
echo '<div class="noticetime"><div class="notice-wrap"><div class="notice-item-wrapper"><div style="" class="notice-item notice"><div class="notice-item-close">×</div><p>+'.$xp_display.'</p></div></div></div></div>';
echo '<embed src ="'.$dir.'/images/CashRegister.mp3" hidden="true" autostart="true"></embed>';

	}

die();
}
	 

		
		add_action('wp_ajax_xp_load','xp_load');
	function xp_load(){
		
check_ajax_referer('xp_load');
global $wpdb;
$user_id = $_POST['id'];
$user_info = get_userdata($user_id);
$userlogin = $user_info->user_login ;
$gamertag = $user_info->display_name ;
$user_website= $user_info->user_url;

$xp_number = $_POST['xp_number'];
$numb_queries = get_option('numb_queries','45');
$qry_xp="select type, data, points from wp_cp where uid = ".$user_id." order by id desc limit $xp_number,$numb_queries";  
$rt_xp=mysql_query($qry_xp);
$j =1; while($nt=mysql_fetch_array($rt_xp)){$xp_div_id = ($j&1) ? "odd" : "even";$data = $nt['data'];$type = $nt['type'];$xp_p = $nt['points']; if($type == 'Quest'){$type =get_option('cg_system_t','Quest');}
$xp_quest_check = (int) $wpdb->get_var("select count(*) from wp_cp where data ='$data' and uid = $user_id and type = 'Quest'");
if($xp_quest_check != 0){ 
$xp_post_id = $wpdb->get_var("select post_parent from wp_posts where post_title = '$data' order by id desc limit 1");
$xp_post_id_link = get_permalink($xp_post_id);
echo'<tr id="'.$xp_div_id.'"><th>'.$type.'</th><th><a href="'.$xp_post_id_link.'">'.$data.'</a></th><th>'.$xp_p.'</th></tr>';
}else{
 echo'<tr id="'.$xp_div_id.'"><th>'.$type.'</th><th>'.$data.'</th><th>'.$xp_p.'</th></tr>';} $j= $j+1;}
		
		}	
	 
	 
	
	 
	 
add_action('wp_ajax_minutes_load','minutes_load');
	function minutes_load(){
		
check_ajax_referer('minutes_load');
global $wpdb;
$user_id = $_POST['id'];
$user_info = get_userdata($user_id);
$userlogin = $user_info->user_login ;
$gamertag = $user_info->display_name ;
$user_website= $user_info->user_url;
$numb_queries = get_option('numb_queries','45');


$minutes_number = $_POST['minutes_number'];
$qry_m="select minutes, minutes_reason, timestamp from wp_class_cur where login = '$userlogin' and minutes IS NOT NULL order by id desc limit $minutes_number,$numb_queries";  
$rt_m=mysql_query($qry_m);


 $v = 1; while($nt=mysql_fetch_array($rt_m)){  $minutes_div_id = ($v&1) ? "odd" : "even";$minutes = $nt['minutes']; $minutes_reason = $nt['minutes_reason']; echo '<div id="'.$minutes_div_id.'">'.$minutes.'-'.$minutes_reason.' - '.$nt['timestamp'].'</div>'; $v = $v+1;}  
 die();
		
		}	
	 
	 

	 
	 
	  
	  add_action('wp_ajax_gold_load','gold_load');
	function gold_load(){
		global $wpdb;
		check_ajax_referer('gold_load');
$user_id = $_POST['id'];
$user_info = get_userdata($user_id);
$userlogin = $user_info->user_login ;
$gamertag = $user_info->display_name ;
$user_website= $user_info->user_url;
$numb_queries = get_option('numb_queries','45');

$gold_number = $_POST['gold_number'];
$qry_g="select gold, gold_reason, timestamp from wp_class_cur where login = '$userlogin' and gold IS NOT NULL order by id desc limit $gold_number,$numb_queries";
$rt_g=mysql_query($qry_g);
$g = 1; while($nt=mysql_fetch_array($rt_g)){
	$gold_div_id = ($g&1) ? "odd" : "even";
	 $gold_d = $nt['gold']; 
	 $gold_reason_d = $nt['gold_reason'];
$gold_check_master = (int) $wpdb->get_var("select count(*) from wp_cp where data ='$gold_reason_d' and uid = $user_id and status in(4,5)");
$gold_check_pc = (int)$wpdb->get_var("select count(*) from wp_class_cur where gold_reason ='$gold_reason_d' and login = '$userlogin' and status = 5");
if($gold_check_master != 0){ 
$gold_post_id = $wpdb->get_var("select post_parent from wp_posts where post_title = '$gold_reason_d' order by id desc limit 1");
$gold_post_id_link = get_permalink($gold_post_id);
echo '<div id= "'.$gold_div_id.'">'.$gold_d.' - <a href="'.$gold_post_id_link.'" >'.$gold_reason_d.'</a> - '.$nt['timestamp'].'</div>';} else if($gold_check_pc != 0){$gold_post_id = $wpdb->get_var("select post_parent from wp_posts where post_title = '$gold_reason_d' order by id desc limit 1");
$gold_post_id_link = get_permalink($gold_post_id);
echo '<div id= "'.$gold_div_id.'">'.$gold_d.' - <a href="'.$gold_post_id_link.'" >'.$gold_reason_d.'</a> - '.$nt['timestamp'].'</div>';} else{
 echo '<div id= "'.$gold_div_id.'">'.$gold_d.' - '.$gold_reason_d.' - '.$nt['timestamp'].'</div>'; }$g = $g+1;}
		
		die();
		}
	 
	 
	 	  add_action('wp_ajax_quests','quests');
	function quests(){
		global $wpdb;
		check_ajax_referer('quests');
$user_id = $_POST['id'];
$user_info = get_userdata($user_id);
$userlogin = $user_info->user_login ;
$gamertag = $user_info->display_name ;
$user_website= $user_info->user_url;

$numb_queries = get_option('numb_queries','45');


$quests_number = $_POST['quests_number'];
$version = get_option('cgversion');

$quests= $wpdb->get_results("SELECT id FROM wp_cp WHERE  status != 0 and uid = $user_id order by id desc limit $quests_number, $numb_queries");	
$s = 1;
foreach ($quests as $qst){foreach($qst as $qsts){
	
$encountered= $wpdb->get_var("SELECT data FROM wp_cp WHERE  status = 1 and uid = $user_id and id = $qsts");
$accepted= $wpdb->get_var("SELECT data FROM wp_cp WHERE  status = 2 and uid = $user_id and id = $qsts");
$completed= $wpdb->get_var("SELECT data FROM wp_cp WHERE  status = 3 and uid = $user_id and id = $qsts");
$mastered= $wpdb->get_var("SELECT data FROM wp_cp WHERE  status = 4 and uid = $user_id and id = $qsts");

			
$encountered_t= $wpdb->get_var("SELECT data FROM wp_cp WHERE  (status = 1 or status = 2 or status = 3 or status = 4) and uid = $user_id and id = $qsts");
$accepted_t= $wpdb->get_var("SELECT data FROM wp_cp WHERE  ( status = 2 or status = 3 or status = 4) and uid = $user_id and id = $qsts");
$completed_t= $wpdb->get_var("SELECT data FROM wp_cp WHERE  ( status = 3 or status = 4) and uid = $user_id and id = $qsts");
$mastered_t= $wpdb->get_var("SELECT data FROM wp_cp WHERE  status = 4 and uid = $user_id and id = $qsts");
			
			if($version == 'full'){
$encountered_time= $wpdb->get_var("SELECT enc FROM wp_class_cur_log WHERE uid = $user_id and (quest ='$encountered' or quest = '$accepted' or quest = '$completed' or quest = '$mastered')");	
$accepted_time= $wpdb->get_var("SELECT acc FROM wp_class_cur_log WHERE  uid = $user_id and (quest ='$encountered' or quest = '$accepted' or quest = '$completed' or quest = '$mastered')");	
$completed_time= $wpdb->get_var("SELECT com FROM wp_class_cur_log WHERE  uid = $user_id and (quest ='$encountered' or quest = '$accepted' or quest = '$completed' or quest = '$mastered')");
$mastered_time= $wpdb->get_var("SELECT mas FROM wp_class_cur_log WHERE  uid = $user_id and (quest ='$encountered' or quest = '$accepted' or quest = '$completed' or quest = '$mastered')");	}			
			
$title= $wpdb->get_var("SELECT data FROM wp_cp where id = $qsts");	
$ids = (int)$wpdb->get_var("SELECT post_parent FROM wp_posts WHERE  post_title = '$title'  order by id desc limit 1");
$permalink = get_permalink( $ids );
$hq_trig = get_post_meta($ids,'hidden_quest',true);						 ?>
<tr id= "<?php echo ($s&1) ? "odd" : "even"; ?>">
  <td align="left" title="<?php if($version == 'full'){echo $encountered_time;}?>"><?php  if($hq_trig == 1 && $encountered_t != ''){ echo get_option('hq','Hidden Quest');} else { ?>
    <a href="<?php echo $permalink; ?>"><?php echo $encountered_t;?> </a>
    <?php } ?></td>
  <td align="left" title="<?php if($version == 'full'){echo $accepted_time;} ?>"><?php  if($hq_trig == 1 && $accepted_t != ''){ echo get_option('hq','Hidden Quest');} else { ?>
    <a href="<?php echo $permalink; ?>"><?php echo $accepted_t;?></a>
    <?php } ?></td>
  <td  align="left" title="<?php if($version == 'full'){echo $completed_time;} ?>"><?php  if($hq_trig == 1 && $completed_t != ''){ echo get_option('hq','Hidden Quest');} else { ?>
    <a href="<?php echo $permalink; ?>"><?php echo $completed_t;?> </a>
    <?php }?></td>
  <td align="left" title=" <?php if($version == 'full'){echo $mastered_time;} ?>"><?php  if($hq_trig == 1 && $mastered_t !=''){ echo get_option('hq','Hidden Quest');} else { ?>
    <a href="<?php echo $permalink; ?>"><?php echo $mastered_t;?> </a>
    <?php } ?></td>
</tr>
<?php  $s = $s+1;  }} 




		
		die();
		}
		
		
		
		
		add_action('wp_ajax_admin_bar_cg', 'admin_bar_cg');
		
		function admin_bar_cg(){
			global $wpdb;
check_ajax_referer('admin_bar');
$current_user = wp_get_current_user();
$user_id = $current_user->ID; 
$userlogin = $current_user->user_login;
$gamertag = $current_user->display_name;
$user_website= $current_user->user_url;
$minute_admin = $_POST['minutes_admin'];
$gold_admin = $_POST['gold_admin'];
$gold_admin_reason = $_POST['gold_reason_admin'];
$minutes_admin_reason = $_POST['minutes_reason_admin'];
$xp_admin_reason = $_POST['xp_reason_admin'];
$xp_admin = $_POST['xp_admin'];
			
if (isset($gold_admin)&&isset($gold_admin_reason)) { if ($gold_admin!=0){
global $wpdb;
$current_user = wp_get_current_user();
$userlogin = $current_user->user_login;
$table_name = $wpdb->prefix . "class_cur" ;
$wpdb->insert( $table_name, array(  'gold' => $gold_admin,'gold_reason' => $gold_admin_reason, 'login' => $userlogin, 'timestamp' => date('m/d@H:i',current_time('timestamp',0))), array( '%s','%s'));
$dir = plugin_dir_url(__FILE__);
echo '<embed src ="'.$dir.'/images/CashRegister.mp3" hidden="true" autostart="true"></embed>';
} }
if (isset($xp_admin)&&isset($xp_admin_reason)) { if ($xp_admin!=0){
global $wpdb;
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
$table_name = $wpdb->prefix . "cp" ;
$points = cp_getPoints($user_id);
$wpdb->insert( $table_name, array(  'points' => $xp_admin,'data' => $xp_admin_reason, 'uid' => $user_id, 'timestamp' => time(), 'type'=> 'addpoints'), array( '%s','%s'));
update_user_meta($user_id, 'cpoints', $points+$xp_admin);
echo '<div class="noticetime"><div class="notice-wrap"><div class="notice-item-wrapper"><div style="" class="notice-item notice"><div class="notice-item-close">×</div><p>+'.$xp_admin.'</p></div></div></div></div>';
} }
if (isset($minute_admin)) { if ($minute_admin!=0){
global $wpdb;
$current_user = wp_get_current_user();
$userlogin = $current_user->user_login;
$time = date('m/d@H:i',current_time('timestamp',0));
$table_name = $wpdb->prefix . "class_cur" ;
$wpdb->insert( $table_name, array(  'minutes' => $minute_admin,'minutes_reason'=> $minutes_admin_reason, 'login' => $userlogin, 'timestamp' => $time), array( '%s'));} }
			
			
			}
			
			
			
			
add_action('wp_ajax_clipboard_table','clipboard_table');	
function clipboard_table (){

global $wpdb;
check_ajax_referer('clipboard_table');
$period = $_POST['cb_period'];


   $table_name_all_users = $wpdb->prefix ."usermeta" ;
     $students_id = $wpdb->get_results("SELECT id
FROM wp_total_cur
WHERE (period_one =$period
OR period_two =$period
OR period_three = $period)

");
	
$x = 0;

 $pstat_id= (int) $wpdb->get_var("select post_parent from wp_posts where post_content like '%[statspage]%' and post_parent != 0 order by id Desc limit 1");
 $pstat_link = get_permalink($pstat_id);
foreach ($students_id as $id) {
foreach ($id as $student_id){
$st_id_ca = (int)$wpdb->get_var("SELECT count(*) FROM wp_usermeta where meta_key = 'wp_capabilities' and meta_value like '%student%' and user_id = $student_id ");
if($st_id_ca != 0){
$user_info = get_userdata($student_id);
$user_login_name = $user_info->user_login ;
$first_name = $user_info->user_firstname ;
$last_name = $user_info->user_lastname ;
$display_name = $user_info->display_name ;
$user_website= $user_info->user_url;

$date = date('l jS F Y');
$gold = (int) $wpdb->get_var("SELECT totalgold FROM wp_total_cur where login = '$user_login_name'") ;
$silver= (int) $wpdb->get_var("SELECT totalsilver FROM wp_total_cur where login = '$user_login_name'") ;
$copper=  (int) $wpdb->get_var("SELECT totalcopper FROM wp_total_cur where login = '$user_login_name'") ;
$minutes = (int) $wpdb->get_var("SELECT minutes FROM wp_total_cur where login = '$user_login_name'") ;
$xp = cp_getPoints($student_id);
$rank = cp_module_ranks_getRank($student_id);

$row_div_id = ($y&1) ? "odd" : "even";
$per = $wpdb->get_var("SELECT meta_key  FROM wp_usermeta where meta_key like '%period%' and meta_value = $period and user_id = $student_id");
if($per == 'period'){$comp='computer';} else if($per=='periodtwo'){$comp= 'computertwo';} else if ($per=='periodthree'){$comp='computerthree';}
$computer_nums= (int) $wpdb->get_var("SELECT meta_value FROM wp_usermeta where meta_key = '$comp' and user_id = $student_id");
?>
<tr div id="<?php echo $row_div_id; ?>">
  <td><a href="<?php echo $pstat_link;?>?id=<?php echo $student_id; ?>" target="_blank"> <?php echo $letter[$x] = $user_login_name;?></a></td>
  <td><?php echo $computer_nums;?></td>
  <td style="width: 84px;"><a href="<?= $user_website?>"> <?php echo $last_name.", ".$first_name; ?></a></td>
  <td><?php echo $display_name;?></td>
  <td><?= $rank; ?></td>
  <td><?php echo $gold;?></td>
  <td><?php echo $minutes;?></td>
  <td><?php echo $xp;?></td>
  <td><?php $num_enc_s= (int)$wpdb->get_var("SELECT count(*) FROM wp_cp WHERE  status = 1 and uid = $student_id");	
	 $num_acc_s= (int)$wpdb->get_var("SELECT count(*) FROM wp_cp WHERE  status = 2 and uid = $student_id");	
	  $num_com_s= (int)$wpdb->get_var("SELECT count(*) FROM wp_cp WHERE  status = 3 and uid = $student_id");	
	   $num_mas_s= (int)$wpdb->get_var("SELECT count(*) FROM wp_cp WHERE  status = 4 and uid = $student_id");
	   
	   $num_enc= $num_enc_s + $num_acc_s + $num_com_s + $num_mas_s;	
	   $num_acc=  $num_acc_s + $num_com_s + $num_mas_s;	
	  $num_com=  $num_com_s + $num_mas_s;		
	   $num_mas= $num_mas_s;	
	   
	   
	   
	   
	   echo '('.$num_enc.')';?></td>
  <td><?php echo '('.$num_acc.')'; ?></td>
  <td><?php echo '('.$num_com.')'; ?></td>
  <td><?php echo '('.$num_mas.')'; ?></td>
  <?php
$y = $y +1;
$x = $x +1;
	}
}
}
die();
}

function comment_level(){
	global $wpdb;
	$level_option= get_option('level_comment',0);
	if($level_option == 1){
		add_filter('get_comment_author_link', 'insertPoints');

		}
	}
add_action('comment_level','comment_level');
do_action('comment_level');
function insertPoints($author){
	global $wpdb;
     $author = get_comment_author(get_comment_ID());
	  $id = get_comment(get_comment_ID())->user_id;
	  $pstat_id= (int) $wpdb->get_var("select post_parent from wp_posts where post_content like '%[statspage]%' and post_parent != 0 order by id Desc limit 1");
 $pstat_link = get_permalink($pstat_id);
     echo '<a href="'.$pstat_link.'?id='.$id.'">'.$author.'</a> ';
     if(function_exists(cp_displayPoints)){
          $id = get_comment(get_comment_ID())->user_id;
          if($id == 0){
               echo '';
          } else{ $lvl_xp_option = get_option('level_xp_option');
			  if($lvl_xp_option == 0){
				  $lvl = cp_module_ranks_getRank($id);
				  echo '<strong>'.$lvl.'</strong>';
				  }else if($lvl_xp_option == 1){
					  echo '<strong>';
          cp_displayPoints($uid = $id);
		  echo '</strong>';}
         }
     }
}






add_action('wp_ajax_add_rq','add_rq');
	function add_rq(){
		
echo '<input type="rq_text" name="rq_text[]"/><br />';
		
		}	
		
		
		add_action('wp_ajax_min_reset','min_reset');
	function min_reset(){
		
global $wpdb;

$wpdb->query("DELETE FROM wp_class_cur
WHERE gold is NULL and gold_reason is NULL" );
		
		}	
	
	
	
	
	
	add_filter('mce_external_plugins', "cgbutton_register");
add_filter('mce_buttons', 'cgbutton_add_button', 0);

function cgbutton_add_button($buttons){
    array_push($buttons, "separator", "cgbuttonplugin");
    return $buttons;
}

function cgbutton_register($plugin_array){
	$plug_dir = plugin_dir_url(__FILE__);
    $url = $plug_dir."/my_js/myown_js/editor_buttons.js";

    $plugin_array['cgbuttonplugin'] = $url;
    return $plugin_array;
}
	
	
add_shortcode('add_cubegold', 'cg_add');  
function cg_add( $atts, $content = null ){
			global $wpdb;
			$current_user = wp_get_current_user();
$user_id = $current_user->ID; 
$userlogin = $current_user->user_login;

	?>
  <script src="<?= plugin_dir_url(__FILE__); ?>my_js/myown_jquery.js"></script> 
  <script src="<?= plugin_dir_url(__FILE__); ?>/my_js/myown_js/jquery-ui.js"></script> 
  <script src="<?php echo plugin_dir_url(__FILE__); ?>/my_js/myown_js/ui.js"></script>
  <?php 
	if(!isset($atts['button_display'])){
		$display = 'Collect';
		} else {$display = $atts['button_display'];}
	$buttonid= $display;
	$type[$buttonid]= $atts['type'];
	$xp[$buttonid]= $atts['xp'];
	$gold[$buttonid]=$atts['gold'];
	$gold_reason[$buttonid]=$atts['reason'];
	$minutes[$buttonid]=$atts['minutes'];
	$minutes_reason[$buttonid]=$atts['minutes_reason'];
	
	
	
	?>
  <form class="cube_gold_form" method="post" action="">
    <input type="submit" name="cg_add_sc" value="<?= $display ?>"  />
  </form>

  <?php 
	if(isset($_POST['cg_add_sc'])){
	
	$buttonid = $_POST['cg_add_sc'];
	$display = $buttonid;
	
	if(isset($gold[$buttonid])){
		
if($type[$buttonid]== 'Paid Content'){
	
	
	$gold_sum= (int) $wpdb->get_var("select sum(gold) from wp_class_cur where login = '$userlogin'");
	if($gold_sum < $gold[$buttonid]*-1){
	echo' <div id="NSF" style="color:#F00"><strong>Insufficient Funds </strong></div>'; } else{
	
	
	
	$dir = plugin_dir_url(__FILE__);
$time = date('m/d@H:i',current_time('timestamp',0));

		$wpdb->insert( 'wp_class_cur', array(  'gold' => $gold[$buttonid],'gold_reason' => $gold_reason[$buttonid], 'status'=>5, 'login' => $userlogin, 'timestamp' => $time),  array( '%s','%s',));
		echo '<embed src ="'.$dir.'/images/CashRegister.mp3" hidden="true" autostart="true"></embed>';
	}
	
	} else {
	$dir = plugin_dir_url(__FILE__);
$time = date('m/d@H:i',current_time('timestamp',0));

		$wpdb->insert( 'wp_class_cur', array(  'gold' => $gold[$buttonid],'gold_reason' => $gold_reason[$buttonid], 'status'=>4, 'login' => $userlogin, 'timestamp' => $time),  array( '%s','%s',));
		echo '<embed src ="'.$dir.'/images/CashRegister.mp3" hidden="true" autostart="true"></embed>';
	}
		}
	if(isset($xp[$buttonid])){
	

if($type[$buttonid]== 'Quest'){
	$status = 4;
	$version = get_option('cgversion');
	if($version == 'full'){$wpdb->update( 'wp_class_cur_log', array( 'mas'=>$time), array(uid => $user_id, quest => $gold_reason[$buttonid]),array( '%s','%s'));}
	} else {$status = '';}
	$points = cp_getPoints($user_id);
	$wpdb->insert( 'wp_cp', array(  'timestamp' => time(), 'uid' => $user_id,'points' => $xp[$buttonid], 'data' => $gold_reason[$buttonid],'type' => $type[$buttonid] , 'status'=>$status), array( '%s','%s','%s'));
echo '<div class="noticetime"><div class="notice-wrap"><div class="notice-item-wrapper"><div style="" class="notice-item notice"><div class="notice-item-close">×</div><p>+'.$xp[$buttonid].'</p></div></div></div></div>';
update_user_meta($user_id, 'cpoints', $points+$xp[$buttonid]);
}

if($type[$buttonid]=='minutes'){
	$time = date('m/d@H:i',current_time('timestamp',0));
$wpdb->insert( 'wp_class_cur', array(  'minutes' => $minutes[$buttonid],'minutes_reason' => $minutes_reason[$buttonid],  'login' => $userlogin, 'timestamp' => $time),  array( '%s','%s',));
	}


	}
	}
	
	
	
	
	
	add_action('wp_ajax_add_quest_editor','add_quest_editor');
	function add_quest_editor(){
		



  global $wpdb;
$post_id = $_POST['post'];

$sum = get_post_meta($post_id,'sum',true);
$mm = get_post_meta($post_id,'mast_mes',true);
$xp_pte = (int)$wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='xp_e' and post_id= '$post_id' ");
$xp_pta = (int)$wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='xp_a' and post_id='$post_id' ");
$xp_ptc = (int)$wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='xp_c' and post_id='$post_id' ");
$xp_ptm = (int)$wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='xp_m' and post_id='$post_id' ");
$gold_pm = (int)$wpdb->get_var("SELECT meta_value FROM wp_postmeta WHERE meta_key='gold_m' and post_id='$post_id' ");
$level_limit = get_post_meta($post_id,'level_limit',true);
$hq_trig = get_post_meta($post_id,'hidden_quest',true);
$rm = get_post_meta($post_id,'required_mastery',true);


$xp_pe = $pte;
$xp_pa = $xp_pta - $xp_pte;
$xp_pc = $xp_ptc - $xp_pta;
$xp_pm = $xp_ptm - $xp_ptc ;

//Default values of XP and Gold

if($xp_pte ==0){$xp_pte= 10;}
if($xp_pa ==0){$xp_pa= 10;}
if($xp_pc ==0){$xp_pc= 10;}
if($xp_pm ==0){$xp_pm= 10;}
if($gold_pm ==0){$gold_pm= 10;}


	$testing_level_one = $wpdb->get_var('select option_value from wp_options where option_name = "cp_module_ranks_data"');
$new_level_one = unserialize($testing_level_one);
ksort($new_level_one);
$level_list=array_values($new_level_one);
if($level_limit == ''){
	$level_limit = $level_list[0]; 
}
$current_level_limit_xp = array_search($level_limit, $new_level_one);






echo '<div><label for="myplugin_new_field"><strong>';
echo 'Summary: </strong></label> ';
echo '<textarea id="sum" name="sum" style="width:400px">'.$sum.'</textarea><br />';

echo '<label for="myplugin_new_field"><strong>';
echo '1st Stage: </strong></label> ';
echo '<input type="text" id="xp_e" name="xp_e" value="'.$xp_pte.'" size="5"  /> <br>';
 
echo '<label for="myplugin_new_field"><strong>';
echo '2nd Stage: </strong></label> ';
echo '<input type="text" id="xp_a" name="xp_a" value="'.$xp_pa.'" size="5" /><br>
';
echo '<label for="myplugin_new_field"><strong>';
echo '3rd Stage: </strong></label> ';
echo '<input type="text" id="xp_c" name="xp_c" value="'.$xp_pc.'" size="5" /><br>
';
echo '<label for="myplugin_new_field"><strong>';
echo '4th Stage: </strong></label> ';
echo '<input type="text" id="xp_m" name="xp_m" value="'.$xp_pm.'" size="5" /><br>
';
echo '<label for="myplugin_new_field"><strong>';
echo 'Gold: </strong></label> ';
echo '<input type="text" id="gold_m" name="gold_m" value="'.$gold_pm.'" size="5" /><br>
';  
echo '<label for="myplugin_new_field"><strong>';
echo 'Level Required: </strong></label>
';
?>
<select  style="overflow:auto;" id="level_limit" name="level_limit" >

<option value="<?= $level_limit ?>">
<?= $level_limit.' ('.$current_level_limit_xp.')' ?>
</option>
<?php
$lvl_list_num = 0;
foreach($level_list as $lvl_list){
	$current_lvl = $level_list[$lvl_list_num];
	$lvl_limit_xp = array_search($level_list[$lvl_list_num],$new_level_one);
	?>
<option value="<?= $current_lvl; ?>">
<?= $current_lvl.' ('.$lvl_limit_xp.')' ?>
</option>
<?php
	$lvl_list_num = $lvl_list_num + 1;
	}
 ?>
</select>
<?php
echo '<br />
<label for="myplugin_new_field"><strong>';
echo 'Hidden Quest: </strong></label>
';
?>
<input type="checkbox" name="hidden_quest" <?php if($hq_trig == 1){ echo'checked="checked"';}
 ?> /> <br />
<?php
echo '<label for="myplugin_new_field"><strong>';
echo 'Mastery Required: </strong></label><br>
 ';
echo '<input type="text" id="rm" name="rm" value="'.$rm.'" size="15" /><br />';
echo '<div><label for="myplugin_new_field"><strong>';
echo 'Mastery Message: </strong></label> ';
echo '<textarea id="myplugin_new_field" name="mm" style="width:400px">'.$mm.'</textarea>';
echo '</div>'; 

die();

		
		}	
	
/*	
add_action('wp_ajax_cg_update','cg_update');	
	function cg_update(){


		global $wpdb;
		
$post_id = $_POST['post'];
$gold_m = $_POST['gold_m'];

	 
$mm = $_POST['mm'];
	 

$xp_e = $_POST['xp_e'];

$xp_ap = $_POST['xp_a'];

$xp_cp = $_POST['xp_c'];

$xp_mp = $_POST['xp_m'];

$rm = $_POST['rm'];

	 
$sum = $_POST['sum'];

$xp_a = $xp_ap + $xp_e;

$xp_c = $xp_a + $xp_cp;

$xp_m = $xp_c + $xp_mp;


$level_limit = $_POST['level_limit'];
//$hidden_quest = $_POST['hidden_quest'];
add_post_meta($post_id, 'gold_m', $gold_m, true) or update_post_meta($post_id, 'gold_m', $gold_m);


add_post_meta($post_id, 'xp_e', $xp_e, true) or update_post_meta($post_id, 'xp_e', $xp_e);

add_post_meta($post_id, 'xp_a', $xp_a, true) or update_post_meta($post_id, 'xp_a', $xp_a);

add_post_meta($post_id, 'xp_c', $xp_c, true) or update_post_meta($post_id, 'xp_c', $xp_c);

add_post_meta($post_id, 'xp_m', $xp_m, true) or update_post_meta($post_id, 'xp_m', $xp_m);



add_post_meta($post_id, 'sum', $sum, true) or update_post_meta($post_id, 'sum', $sum);

add_post_meta($post_id, 'mast_mes', $mm, true) or update_post_meta($post_id, 'mast_mes', $mm);


add_post_meta($post_id, 'level_limit', $level_limit, true) or update_post_meta($post_id, 'level_limit', $level_limit);


add_post_meta($post_id, 'required_mastery', $rm, true) or update_post_meta($post_id, 'required_mastery', $rm);

///if(isset($_POST['hidden_quest'])) 
//{
 //   add_post_meta($post_id, 'hidden_quest', 1, true) or update_post_meta($post_id, 'hidden_quest', 1);
//} else {
//	add_post_meta($post_id, 'hidden_quest',0, true) or update_post_meta($post_id, 'hidden_quest', 0);
	//}
	echo 'hello';
		die();
		
		
		}
	*/
	
	
	
	 ?>
