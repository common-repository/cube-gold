<?php 


//Period Menu	
global $wpdb;

?>
<style>
#even {
background-color: #EEE !important;
}
</style>
<br />
<br />
<form method="post" action="" >
Period: <select name="Period"  onchange="form.submit()" >
  <option value="<?php echo '...'; ?>"><?php echo $stored_period; ?></option>
  <option value="1">Period 1</option>
  <option value="2">Period 2</option>
  <option value="3">Period 3</option>
  <option value="4">Period 4</option>
  <option value="5">Period 5</option>
  <option value="6">Period 6</option>
  <option value="7">Period 7</option>
</select>

</form>

<br />

<?php 


$period  = $_POST['Period'];

global $wpdb;
//table of clipboard
?>

    
<table class="widefat"  id="clipboard" border="1px" bordercolor="#000000" cellpadding="3px">
<thead> <tr>
<th width="100px">Gamertag</th>
<th width="100px">Website</th>
</tr></thead><tbody>
 <?php

$studs_id = $wpdb->get_results("SELECT user_id  FROM wp_usermeta where meta_key like '%period%' and meta_value = $period");
$y = 1;

if(isset($_POST['Period'])){
$period  = $_POST['Period'];} 

   $table_name_all_users = $wpdb->prefix ."usermeta" ;
     $students_id = $wpdb->get_results("SELECT id
FROM wp_total_cur
WHERE (period_one =$period
OR period_two =$period
OR period_three = $period)

");
	
$x = 0;

 $pstat_id= (int) $wpdb->get_var("select post_id from wp_postmeta where meta_key = '_wp_page_template' and meta_value = 'page.stats.php'");
 $pstat_link = get_permalink($pstat_id);
foreach ($students_id as $id) {
foreach ($id as $student_id){
$st_id_ca = (int)$wpdb->get_var("SELECT count(*) FROM wp_usermeta where meta_key = 'wp_capabilities' and meta_value like '%student%' and user_id = $student_id ");
if($st_id_ca != 0){
	
$user_info = get_userdata($student_id);
$user_website= $user_info->user_url;
$display_name = $user_info->display_name ;
$gold = (int) $wpdb->get_var("SELECT totalgold FROM wp_total_cur where login = '$user_login_name'") ;
$minutes = (int) $wpdb->get_var("SELECT minutes FROM wp_total_cur where login = '$user_login_name'") ;
$xp = cp_getPoints($student_id);
$row_div_id = ($y&1) ? "odd" : "even";
$per = $wpdb->get_var("SELECT meta_key  FROM wp_usermeta where meta_key like '%period%' and meta_value = $period and user_id = $student_id");
if($per == 'period'){$comp='computer';} else if($per=='periodtwo'){$comp= 'computertwo';} else if ($per=='periodthree'){$comp='computerthree';}
$computer_nums= (int) $wpdb->get_var("SELECT meta_value FROM wp_usermeta where meta_key = '$comp' and user_id = $student_id");
?> <tr div id="<?php echo $row_div_id; ?>"> <td><a href="<?php echo $pstat_link;?>?id=<?php echo $student_id; ?>" target="_blank"> <?php echo $display_name;
?></a> </td> <td width="100px"><a href="<?php echo $user_website; ?>" target="_blank" >Website</a></td></tr><?php
	   

$y = $y +1;
$x = $x +1;
	
}
}
}
?></tbody> </table> 


 <script src="<?= plugin_dir_url(__FILE__); ?>my_js/myown_jquery.js"></script>
<script src="<?= plugin_dir_url(__FILE__); ?>/my_js/myown_js/jquery-ui.js"></script>
<script src="<?= plugin_dir_url(__FILE__); ?>/my_js/sortable_us.js"></script>
