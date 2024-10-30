<?php
global $wpdb;
$current_user = wp_get_current_user();
do_action('stats_style', 'stats_style');
if(isset($_GET['id'])){$user_id = $_GET['id'];
$user_info = get_userdata($user_id);
$userlogin = $user_info->user_login ;
$gamertag = $user_info->display_name ;
$user_website= $user_info->user_url;
} else {$user_id = $current_user->ID; 
$userlogin = $current_user->user_login;
$gamertag = $current_user->display_name;
$user_website= $current_user->user_url;}
$quest_posts_ids = $wpdb->get_results("select post_id from wp_postmeta where meta_value = 'page.quest.php' and meta_key ='_wp_page_template'");
$quest_posts_count = (int) $wpdb->get_var("select count(*) from wp_postmeta where meta_value = 'page.quest.php' and meta_key ='_wp_page_template'");
$quests_e =  (int)$wpdb->get_var("select count(data) from wp_cp where uid = $user_id and status = 1");
$quests_a =  (int)$wpdb->get_var("select count(data) from wp_cp where uid = $user_id and status = 2");
$quests_c =  (int)$wpdb->get_var("select count(data) from wp_cp where uid = $user_id and status = 3");
$quests_m =  (int)$wpdb->get_var("select count(data) from wp_cp where uid = $user_id and status = 4");
$quests_ne = $quest_posts_count - $quests_e - $quests_a - $quests_c - $quests_m;



//Progres Bar!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 $testing = $wpdb->get_var('select option_value from wp_options where option_name = "cp_module_ranks_data"');
$new = unserialize($testing);
ksort($new);
$new_array=array_values($new);
reset($new);
$rank = cp_module_ranks_getRank($user_id);
$rank_points = array_search($rank,$new_array);
$current_rank_points = array_search($rank,$new);
$prev_lvl = $new_array[$rank_points];
$xp = cp_getPoints($user_id);
$current_lvl = array_search($next_lvl,$new);
$next_ranks_points = $new_array[$rank_points+1];
$xp_level =  array_search($next_ranks_points,$new);
if(isset($_POST['re_xp_in'])){$xp_left= $_POST['re_xp_in'];}else{$xp_left= $xp;}
$percentage_num = $xp_left - array_search($prev_lvl,$new);
$percentage_dom = $xp_level - $current_rank_points;
$percentage = $percentage_num/$percentage_dom*100;
if ($percentage <=1 ){$percentage = 1;}
reset($new);
$new = unserialize($testing);
ksort($new);


//Gold!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$period_count_check_three = (int) $wpdb->get_var("select count(*) from wp_total_cur where id = $user_id and period_one != 0 and period_two != 0 and period_three != 0");
if($period_count_check_three != 0){$period_count = 3;}else{
$period_count_check_two = (int) $wpdb->get_var("select count(*) from wp_total_cur where id = $user_id and period_one != 0 and period_two != 0");
if($period_count_check_two != 0){$period_count = 2;}else{
$period_count = 1;
}}



$minutes_set = get_option('min_req',5400);
$minutes_required = $minutes_set*$period_count;
$querygold = "SELECT SUM(gold) FROM wp_class_cur where login = '$userlogin'"; 
$resultgold = mysql_query($querygold) or die(mysql_error());
$rowgold = mysql_fetch_array($resultgold);
$gold_rnd = $rowgold['SUM(gold)'];




$check_minutes_trig = get_option('cgmin','on');
$minutes_additions = (int)$wpdb->get_var("select sum(minutes) from wp_class_cur where login = '".$userlogin."'");
$minutes_rnd = $minutes_additions;






$wpdb->update( $table_name_c, array( 'totalgold' => $gold_rnd/*,'totalsilver' => $silver_sb, 'totalcopper' => $copper_rnd */), array(login => $userlogin ), array( '%d','%d'), array( '%s' ));
$qry_per="select period_one, period_two, period_three, computer_one, computer_two, computer_three from wp_total_cur where login = '$userlogin'";  


$rt_per=mysql_query($qry_per);
$minutes_percentage = $minutes_rnd/$minutes_required*100;
$minutes_margin = 50;
$color = 'blue';
if($minutes_percentage < 0){
	$minutes_margin = 50 + $minutes_percentage;
	$minutes_percentage = $minutes_percentage * -1;
	$color = 'red';}
$numb_queries_lb = get_option('numb_queries_lb','50');


//leaderboards
$xp_lbs= $wpdb->get_results("select id, totalxp from wp_total_cur order by totalxp DESC limit 0, $numb_queries_lb");
$minutes_lbs= $wpdb->get_results("select id, minutes from wp_total_cur order by minutes DESC limit 0,  $numb_queries_lb");
$mastered_lbs= $wpdb->get_results("select id, mastered from wp_total_cur order by mastered DESC limit 0,  $numb_queries_lb");
//Ajax!!!!!!!!!!!!!!!!!!!!
$nonce_xp_load = wp_create_nonce('xp_load');
$nonce_minutes_load = wp_create_nonce('minutes_load');
$nonce_gold_load = wp_create_nonce('gold_load');
$nonce_quests = wp_create_nonce('quests');

$xp_number_check = (int)$wpdb->get_var("select count(*) from wp_cp where uid = ".$user_id);
$minutes_number_check = (int)$wpdb->get_var("select count(*) from wp_class_cur where login = '$userlogin' and minutes IS NOT NULL");
$gold_number_check = (int)$wpdb->get_var("select count(*) from wp_class_cur where login = '$userlogin' and gold IS NOT NULL");
$quests_number_check = (int)$wpdb->get_var("SELECT count(*) FROM wp_cp WHERE  status != 0 and uid = $user_id");	
$version = get_option('cgversion');
//<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__); my_js/myown_js/ui-lightness/jquery-ui-1.8.21.custom.css" type="text/css" />
//<link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url(__FILE__); /my_js/myown_js/myown_style.css" /> 

?>
 <head>


</head>
<body>
<div id="topinfo">
<h2 id="gt"><?php echo $gamertag; ?></h2>
<div id="gravatarstat">
<?php
echo '<div id="re_xp_p"></div>';
echo get_avatar( $user_id, '96',  $default = '<path_to_url>'); 
?>
</div>
<div id="profileinfo">
<table cellpadding="0px" id="profiletable">
<tr><td width="50%"><a href="<?php echo $user_website; ?>" target="_blank" >Website</a></td><td width="50%"><?php echo $encountered_t = get_option('encountered_t'); ?>: <?php echo $quests_e+$quests_a+$quests_c+$quests_m; ?></td><tr>
<tr><td><?php echo $rank; ?> </td><td> <?php echo $accepted_t = get_option('accepted_t'); ?>: <?php echo $quests_a+$quests_c+$quests_m;?></td></tr>
<tr><td> <?php print $xp_left.'/'.$xp_level;?></td><td> <?php echo $completed_t = get_option('completed_t'); ?>: <?php echo $quests_c+$quests_m; ?></td></tr>
<tr><td> <?php print $gold_rnd; ?> Gold </td><td> <?php echo $mastered_t = get_option('mastered_t'); ?>: <?php echo $quests_m; ?></td></tr>
<tr><td> <?php echo $minutes_rnd; ?> Minutes</td><tr>
</table>
</div>
<div id="progressbar">
	<?php
		
	 print "<div id=\"progress-bar-2\" class=\"all-rounded\">\n";
	print "<div id
	=\"progress-bar-percentage-stats-2\" class=\"all-rounded\" style=\"
	-webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
	border-bottom-width:100%px; 
	height:20px;
	padding: 5px 0px;
 	color: #FFF;
 	font-weight: bold;
	background-color:#ff6600;
	
background: -webkit-gradient(linear, left top, left bottom, 
color-stop(0%, #ff6600), color-stop(20%, #ff6600), color-stop(150%, rgba(255,255,255,.9))); 

background: -webkit-linear-gradient(top, #ff6600, rgba(255,255,255,.9)); 
background: -moz-linear-gradient(top, #ff6600 0%, #ff6600 20%, rgba(255,255,255,.9) 150%);
 	text-align: center; width: ".$percentage."%\">";
	print "</div></div>";
	print $xp_left.'/'.$xp_level;
	 ?>
     </div>
     <?php if($check_minutes_trig == 'on'){ ?>
     <div id="progressbar2">
	<?php
		
	 print "<div id=\"progress-bar-3\" class=\"all-rounded\">\n";
	 
	// echo '<div id="minutes_second_layer">';
	 echo '<div id="minutes_fourth_layer"></div>';
	 
	print "<div id
	=\"progress-bar-percentage-stats-3\" class=\"all-rounded\" style=\"
	-webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
	border-bottom-width:100%px; 
	height:20px;
	padding: 5px 0px;
 	color: #FFF;
 	font-weight: bold;
	background-color:".$color.";
	background: -webkit-gradient(linear, left top, left bottom, 
color-stop(0%, ".$color."), color-stop(20%, ".$color."), color-stop(150%, rgba(255,255,255,.9))); 

background: -webkit-linear-gradient(top, ".$color.", rgba(255,255,255,.9)); 
background: -moz-linear-gradient(top, ".$color." 0%, ".$color."0 20%, rgba(255,255,255,.9) 150%);
	
	
	z-index:1;
	margin-left:".$minutes_margin."%;
 	text-align: center; width: ".$minutes_percentage."%\">";
	print "</div></div>";
	print $minutes_rnd;
	
	 ?>
  
 </div> <?php } ?>
    </div>

<div id ="tabs">
<ul>
<li><a href="#quests" id="quests_t"><?= get_option('cg_system_t','Quest') ?></a></li>
<li><a href="#xp" id="xp_t" ><?php echo  get_option('cp_prefix','XP'); echo get_option('cp_suffix','');?></a></li>
<?php if($check_minutes_trig == 'on'){ ?><li><a href="#min_cover" id="minutes_t">Minutes</a></li> <?php } ?>
<li><a href="#gold_cover" id="gold_t">Gold</a></li>
<li><a href="#xp_lb"><?php echo get_option('cp_prefix',''); echo get_option('cp_suffix',''); ?>	 LB</a></li>
<?php if($check_minutes_trig == 'on'){ ?><li><a href="#minutes_lb">Minutes LB</a></li> <?php }?>
<li><a href="#mastered_lb">Mastered LB</a></li>

</ul>




<div id="xp" style="height:500px; overflow-y:scroll;">
<table id="xp_table" rules="rows" style="height:500px; overflow:auto;" data_number="0">
<tr><th>Type</th><th>Reason</th><th><?= get_option('cp_prefix','XP'); ?></th></tr>
</table>
    <input type="button" value="More" id="xp_more" onClick="xp();" style="width:100%;"/>

</div>


<?php if($check_minutes_trig == 'on'){ ?>
<div id="min_cover" style="height:500px; overflow:auto;"> 
<div id="minutes" data_number = "0"></div>
    <input type="button" value="More" onClick="minutes();" id="min_more" style="width:100%;"/>

</div>
<?php } ?>

<div id="gold_cover"  style="height:500px; overflow:auto;"><div id="gold" data_number= "0"></div>    <input type="button" value="More" onClick="gold();" id="gold_more" style="width:100%;"/>
</div>



<div id="quests" style="overflow:auto; height:500px;">
<table id="quests_table" data_number = "0"> <tr align="left"><th><?php echo $encountered_t; ?></th><th> <?php echo $accepted_t; ?></th><th> <?= $completed_t ?></th><th> <?= $mastered_t ?></th></tr></table>
    <input type="button" id="quests_more" value="More" onClick="quests();" style="width:100%;"/>

                       
</div>


<div id="xp_lb">
<?php
  $pstat_id= (int) $wpdb->get_var("select post_parent from wp_posts where post_content like '%[statspage]%' and post_parent != 0 order by id Desc limit 1");
 $pstat_link = get_permalink($pstat_id);
$xp_int = 1;
	?>
	<table>
    <tr><th align="left" width="40px"></th><th align="left" >Gamer Tag</th><th align="left" width="800px"><?= get_option('cp_prefix','XP'); ?></th></tr>
    <?php
foreach($xp_lbs as $xp_lb){

	$xp_id = $xp_lb->id;
	$xp_user_info = get_userdata($xp_id);
		$xp_login = $xp_user_info->user_login;
$xp_gamertag = $xp_user_info->display_name ;
	$xp_lb_xp = $xp_lb->totalxp; 
   ?> <tr id= "<?php echo ($xp_int&1) ? "odd" : "even"; ?>"> <?php echo '<td>'.$xp_int.'</td><td><a href="'.$pstat_link.'?id='.$xp_id.'" target="_blank">'.$xp_gamertag.'</a></td><td>'.$xp_lb_xp.'</td></tr>';
	$xp_int = $xp_int + 1;
	
	

	}


	
	?>
    </table>
                        
</div>

	<?php
 if($check_minutes_trig == 'on'){ 

?> 

<div id="minutes_lb">
<?php

$minutes_int = 1;
	?>
	<table>
    <tr><th align="left" width="40px"></th><th align="left" width="160px">Gamer Tag</th><th align="left" width="800px">Minutes</th></tr>
    <?php
foreach($minutes_lbs as $minutes_lb){

	$minutes_id = $minutes_lb->id;
	$minutes_user_info = get_userdata($minutes_id);
		$minutes_login = $minutes_user_info->user_login;
$minutes_gamertag = $minutes_user_info->display_name ;
	$minutes_lb_p = $minutes_lb->minutes; 
    ?> <tr id= "<?php echo($minutes_int&1) ? "odd" : "even"; ?>"> <?php echo '<td>'.$minutes_int.'</td><td><a href="'.$pstat_link.'?id='.$minutes_id.'" target="_blank">'.$minutes_gamertag.'</a></td><td>'.$minutes_lb_p.'</td></tr>';
	$minutes_int = $minutes_int + 1;
	
	

	}



	
	?>
    </table>
	                       
</div> <?php } ?>
<div id="mastered_lb">
<?php

$mastered_int = 1;
	?>
	<table>
    <tr><th align="left" width="40px"></th><th align="left">Gamer Tag</th><th align="left" width="800px"><?php echo $mastered_t; ?></th></tr>
    <?php
foreach($mastered_lbs as $mastered_lb){

	$mastered_id = $mastered_lb->id;
	$mastered_user_info = get_userdata($mastered_id);
	$mastered_login = $mastered_user_info->user_login;
$mastered_gamertag = $mastered_user_info->display_name ;
	$mastered_lb_p = $mastered_lb->mastered; 
   ?> <tr id= "<?php echo($mastered_int&1) ? "odd" : "even"; ?>"> <?php echo '<td>'.$mastered_int.'</td><td><a href="'.$pstat_link.'?id='.$mastered_id.'" target="_blank">'.$mastered_gamertag.'</a></td><td>'.$mastered_lb_p.'</td></tr>';
	$mastered_int = $mastered_int + 1;
	
	}


	
	?>
    </table>
	<?php
$numb_queries = get_option('numb_queries','45');

?>                         
</div>


 </div>
 <script src="<?= plugin_dir_url(__FILE__); ?>my_js/myown_jquery.js"></script>
<script src="<?= plugin_dir_url(__FILE__); ?>/my_js/myown_js/jquery-ui.js"></script>
 <script src="<?php echo plugin_dir_url(__FILE__); ?>/my_js/myown_js/development-bundle/external/jquery.cookie.js"></script>
<script src="<?php echo plugin_dir_url(__FILE__); ?>/my_js/myown_js/ui.js"></script>

<script language="javascript">
ajaxurl = '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php';
jQuery("#xp_t").one("click", function(){
			// Do the ajax lookup here.
			var number =  jQuery('#xp_table').attr('data_number')*25;
					var prev_xp = jQuery('#xp_table').html();
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'xp_load', _ajax_nonce:"<?= $nonce_xp_load; ?>", xp_number: number/25, id:<?= $user_id ?> },
		success: function(html){ //so, if data is retrieved, store it in html
			jQuery("#xp_table").html(prev_xp+html); //show the html inside helloworld div
				$('#xp_table').attr('data_number',(number/25)+<?= $numb_queries ?>);
			
		}
	}); //close jQuery.ajax(
});

//jQuery('#xp').scroll(
function xp(){
	
	var number =  jQuery('#xp_table').attr('data_number')*25;
	if(((number/25)) <  <?php echo $xp_number_check; ?>){
	
	
		ajaxurl = '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php';
		var prev_xp_s = jQuery('#xp_table').html();
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'xp_load',xp_number: number/25, _ajax_nonce: '<?php echo $nonce_xp_load; ?>', id:<?= $user_id ?>},
		success: function(html){ //so, if data is retrieved, store it in html
		jQuery("#xp_table").html(prev_xp_s+html); //show the html inside helloworld div
		$('#xp_table').attr('data_number',(number/25)+<?= $numb_queries ?>);
		if(jQuery('#xp_table').attr('data_number') > <?= $xp_number_check ?>){ jQuery('#xp_more').hide('50');}
			
		}
	}); 
		}
		
}
//);





//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

jQuery("#minutes_t").one("click", function(){
			// Do the ajax lookup here.
				var number =  jQuery('#xp_table').attr('data_number')*25;
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'minutes_load', _ajax_nonce:"<?php echo $nonce_minutes_load; ?>", minutes_number: number, id:<?= $user_id ?> },
		success: function(html){ //so, if data is retrieved, store it in html
			jQuery("#minutes").html(html); //show the html inside helloworld div
					$('#minutes').attr('data_number',(number/25)+<?= $numb_queries ?>);

			
		}
	}); //close jQuery.ajax(
});


function minutes(){
	var number =  jQuery('#minutes').attr('data_number')*25;
	if((number/25) <  <?php echo $minutes_number_check; ?>){
	
		ajaxurl = '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php';
		var prev_minutes_s = jQuery('#minutes').html();
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'minutes_load',minutes_number: number/25, _ajax_nonce: '<?php echo $nonce_minutes_load; ?>', id:<?= $user_id ?>},
		success: function(html){ //so, if data is retrieved, store it in html
		jQuery("#minutes").html(prev_minutes_s+html); //show the html inside helloworld div
		$('#minutes').attr('data_number',(number/25)+<?= $numb_queries ?>);
			if(jQuery('#minutes').attr('data_number') > <?= $minutes_number_check ?>){ jQuery('#min_more').hide('50');}
			
		}
	}); 
		}
		
}


//!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
jQuery("#gold_t").one("click", function(){
					var number =  jQuery('#gold').attr('data_number')*25;
			// Do the ajax lookup here.
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'gold_load', _ajax_nonce:"<?php echo $nonce_gold_load; ?>", gold_number:number, id:<?= $user_id ?> },
		success: function(html){ //so, if data is retrieved, store it in html
		jQuery("#gold").html(html); //show the html inside helloworld div
		$('#gold').attr('data_number',(number/25)+<?= $numb_queries ?>);

			
		}
	}); //close jQuery.ajax(
});


function gold(){
	var number =  jQuery('#gold').attr('data_number')*25;
		if((number/25) <  <?php echo $gold_number_check; ?>){

		ajaxurl = '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php';
		var prev_gold_s = jQuery('#gold').html();
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'gold_load',gold_number: number/25, _ajax_nonce: '<?php echo $nonce_gold_load; ?>', id:<?= $user_id ?>},
		success: function(html){ //so, if data is retrieved, store it in html
		jQuery("#gold").html(prev_gold_s+html); //show the html inside helloworld div
		$('#gold').attr('data_number',(number/25)+<?= $numb_queries ?>);
			if(jQuery('#gold').attr('data_number') > <?= $gold_number_check ?>){ jQuery('#gold_more').hide('50');}
			
		}
	}); 
		}
		
}


ajaxurl = '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php';
jQuery(document).ready(	 function(){
			// Do the ajax lookup here.
					var prev_quests = jQuery('#quests_table').html();
			var number =  jQuery('#quests_table').attr('data_number')*25;
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'quests', _ajax_nonce:"<?php echo $nonce_quests; ?>", quests_number: number/25, id:<?= $user_id ?> },
		success: function(html){ //so, if data is retrieved, store it in html
			jQuery("#quests_table").html(prev_quests+html); //show the html inside helloworld div
				$('#quests_table').attr('data_number',(number/25)+<?= $numb_queries ?>);
			
		}
	}); //close jQuery.ajax(
});
jQuery("#quests_t").one("click", function(){
			// Do the ajax lookup here.
					var prev_quests = jQuery('#quests_table').html();
			var number =  jQuery('#quests_table').attr('data_number')*25;
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'quests', _ajax_nonce:"<?php echo $nonce_quests; ?>", quests_number: number/25, id:<?= $user_id ?> },
		success: function(html){ //so, if data is retrieved, store it in html
			jQuery("#quests_table").html(prev_quests+html); //show the html inside helloworld div
				$('#quests_table').attr('data_number',(number/25)+<?= $numb_queries ?>);
			
		}
	}); //close jQuery.ajax(
});

function quests(){
	
	var number =  jQuery('#quests_table').attr('data_number')*25;
	if(((number/25)) <  <?php echo $quests_number_check; ?>){
	
	
		ajaxurl = '<?php echo get_site_url(); ?>/wp-admin/admin-ajax.php';
		var prev_quests_s = jQuery('#quests_table').html();
		jQuery.ajax({
		type: "post",url: ajaxurl,data: { action: 'quests',quests_number: number/25, _ajax_nonce: '<?php echo $nonce_quests; ?>', id:<?= $user_id ?>},
		success: function(html){ //so, if data is retrieved, store it in html
		jQuery("#quests_table").html(prev_quests_s+html); //show the html inside helloworld div
		$('#quest_table').attr('data_number',(number/25)+<?= $numb_queries ?>);
			if(jQuery('#quests_table').attr('data_number') > <?= $quests_number_check ?>){ jQuery('#quests_more').hide('50');}
			
		}
	}); 
		}
		
}

</script>

 </body>
 
