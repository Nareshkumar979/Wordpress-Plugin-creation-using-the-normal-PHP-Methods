<?php
$siteurl = get_site_url();
$path = get_home_path();
include('../../../wp-config.php');
?>
<link href="<?php echo ICT_SE_URL; ?>/css/jquery-ui.css" rel="stylesheet">


<style>

#sub_update_loc {
    margin-top: 15px;
}
#sub_add_loc {
    margin-top: 15px;
}
.success_message {
    background: #87c540 none repeat scroll 0 0;
    float: left;
    font-weight: bold;
    margin-bottom: 10px;
    padding: 10px 0;
    text-align: center;
    width: 97%;
}
#sermonarchives1
{
	float:left;
	width:97%;
}
.archive h2 {
    float: left;
    width: 50%;
}
.archive {
    float: left;
    margin-top: 15px;
    width: 97%;
}
.add_button {
    float: left;
    margin: 10px 0;
    text-align: right;
    width: 50%;
}
.addform {
    float: left;
    padding-top: 15px;
    width: 97%;
	border-top: 3px solid #c7c7c7;
}
#titles1 {
    float: left;
    height: 50px;
    width: 100%;
}
.rows {
    float: left;
    width: 97%;
}
.special {
    float: left;
    margin: 15px 0 0;
    padding: 10px 0 25px 0px;
    width: 43%;
}
#special {
    float: left;
    margin: 15px 0 0;
    padding: 10px 0 0;
    width: 43%;
}

.special > label {
    float: left;
    width: 200px;
}
#special > label {
    float: left;
    width: 200px;
}


.a_tag {
    background: black none repeat scroll 0 0;
    border: 1px solid black;
    border-radius: 15px;
    float: right;
    text-align: center;
    width: 4%;
}
.btn.btn-info {
    float: left;
    padding: 22px 0 0;
    text-decoration: none;
    width: 100%;
}
.removeclass {
    color: white;
	background:red;
    font-size: 14px;
    text-decoration: none;
	float:left;
}
.special > input {
    float: left;
    width: 200px;
}
#special > input {
    float: left;
    width: 200px;
}
	#titles {
    float: left;
    height: 50px;
    width: 100%;
}
.btn.btn-info {
    display: none;
}

.special {
    display: none;
}
</style>
<div class="archive">
<h2>Locations</h2>
<div class="add_button">
<a href="<?php echo get_admin_url();?>admin.php?page=locations&add=1" class="button-primary">Add New Location</a>
</div>
</div>
<?php
//INSERT LOCATION
if($_POST['sub_add_loc'])
{
   /* $file_name=$_FILES['featuredimage1']['name'];
	$random_number=rand(0000,9999);
	$new_name=$random_number.$file_name;
	//--New File Name Creation 	
	//--Moving the file Name In to New Part
	move_uploaded_file($_FILES['featuredimage1']['tmp_name'],$path."/wp-content/plugins/Sermons/locations/images/".$new_name);*/
	
	$file_name=$_FILES['featuredimage1']['name'];
	$here1 = explode(".",$file_name);
	$num1 = (count($here1) - 1);
	$new_name =$here1[0]."_".date("Mj_Y_g_i").".".$here1[$num1];
	$paths= $new_name;
	move_uploaded_file($_FILES['featuredimage1']['tmp_name'],$path."/wp-content/plugins/Sermons/locations/images/".$new_name);
	
$file_name2=$_FILES['featuredimage2']['name'];
	$here2 = explode(".",$file_name2);
	$num2 = (count($here1) - 1);
	$new_name2 =$here2[0]."_".date("Mj_Y_g_i").".".$here2[$num2];
	$paths2= $new_name2;
	move_uploaded_file($_FILES['featuredimage2']['tmp_name'],$path."/wp-content/plugins/Sermons/locations/header_img/".$new_name2);

	//$file_name2=$_FILES['special_img']['name'];
//	foreach($file_name2 as $imgfile){  
//		foreach($imgfile as $sing_img){
//				$kk[]=$sing_img;
//			}
//	}
//	 $imp=implode(",",$kk);
//	$here2 = explode(",",$imp);
//	 $num2 = (count($here2) - 1);
//	$new_name2 =$here2[0]."_".date("Mj_Y_g_i").".".$here2[$num2];
//	$paths2= $new_name2;
//	move_uploaded_file($_FILES['special_img']['tmp_name'],$path."/wp-content/plugins/Sermons/locations/images/".$new_name2);
//	$js_imgp[]=$paths2;
//	//$js_imgencd=json_encode($js_img);
//
//
//	$js_en=$_POST[ 'special'];
//	$js_encd=json_encode($js_en);
	
	
	
	
	 $query_insert="INSERT INTO `wp_ictse_location` (location_title, location_desc, fetcher_img, location_day, location_time,special,special_img,header_img,youtube,location_address,location_title_slug) VALUES('".$_POST['locationtitle']."', '".$_POST['locationaddress']."', '".$paths."', '".$_POST['location_day']."', '".$_POST['location_time']."','".$js_encd."','".$js_imgencd."','".$paths2."','".$_POST['youtube_url']."','".$_POST['location_address']."','".sanitize_title($_POST['locationtitle'])."')";
			 mysql_query($query_insert);
		echo '<div class="success_message" id="noti_msg">Your Data Was Successfully Inserted! <span class="close_msg" onclick="close_msg();"></span></div>';
			
}
//UPDATE Location
	if($_POST['sub_update_loc'])
{
	$file_name=$_FILES['featuredimage1']['name'];
	$here1 = explode(".",$file_name);
	$num1 = (count($here1) - 1);
	$new_name =$here1[0]."_".date("Mj_Y_g_i").".".$here1[$num1];
	$paths= $new_name;
	move_uploaded_file($_FILES['featuredimage1']['tmp_name'],$path."/wp-content/plugins/Sermons/locations/images/".$new_name);
	
	$file_name2=$_FILES['featuredimage2']['name'];
	$here2 = explode(".",$file_name2);
	$num2 = (count($here1) - 1);
	$new_name2 =$here2[0]."_".date("Mj_Y_g_i").".".$here2[$num2];
	$paths2= $new_name2;
	move_uploaded_file($_FILES['featuredimage2']['tmp_name'],$path."/wp-content/plugins/Sermons/locations/header_img/".$new_name2);
	
	if(empty($here1[$num1]))
	{
	 $updatecat = "UPDATE wp_ictse_location SET `location_title` = '".$_POST['locationtitle']."', `location_desc`= '".$_POST['locationaddress']."',`location_day`='".$_POST['location_day']."',`header_img`='".$paths2."',`location_title_slug`='".sanitize_title($_POST['locationtitle'])."',`location_address`='".$_POST['location_address']."',`youtube`='".$_POST['youtube_url']."', `location_time` = '".$_POST['location_time']."' WHERE `id`='".$_POST['editval']."'";
	}
	else if(empty($here2[$num2])){
	 $updatecat = "UPDATE wp_ictse_location SET `location_title` = '".$_POST['locationtitle']."', `location_desc`= '".$_POST['locationaddress']."',`location_day`='".$_POST['location_day']."',`fetcher_img`='".$paths."',`location_title_slug`='".sanitize_title($_POST['locationtitle'])."', `location_address`='".$_POST['location_address']."',`youtube`='".$_POST['youtube_url']."',`location_time` = '".$_POST['location_time']."' WHERE `id`='".$_POST['editval']."'";
	}
	else if(empty($here1[$num1]) AND empty($here2[$num2])){
		echo  $updatecat = "UPDATE wp_ictse_location SET `location_title` = '".$_POST['locationtitle']."', `location_desc`= '".$_POST['locationaddress']."',`location_day`='".$_POST['location_day']."',`location_title_slug`='".sanitize_title($_POST['locationtitle'])."', `location_address`='".$_POST['location_address']."',`youtube`='".$_POST['youtube_url']."',`location_time` = '".$_POST['location_time']."' WHERE `id`='".$_POST['editval']."'";
	}
	else
	{
	 $updatecat = "UPDATE wp_ictse_location SET `location_title` = '".$_POST['locationtitle']."', `location_desc`= '".$_POST['locationaddress']."',`fetcher_img`='".$paths."', `header_img`='".$paths2."',`location_title_slug`='".sanitize_title($_POST['locationtitle'])."',`location_day`='".$_POST['location_day']."',`youtube`='".$_POST['youtube_url']."',`location_address`='".$_POST['location_address']."', `location_time` = '".$_POST['location_time']."' WHERE `id`='".$_POST['editval']."'";
	}
	$updateqry=mysql_query($updatecat);
	echo '<div class="success_message">Your Location has been successfully Updated</div>';
}
		

//DELETE Location

if($_REQUEST['delete_id']){
  $sqldel = "DELETE from `wp_ictse_location` WHERE id = ".$_REQUEST['delete_id'];
 if(mysql_query($sqldel)){
			
            echo '<div class="success_message" id="noti_msg">Your Data Was Successfully Deleted! <span class="close_msg" onclick="close_msg();"></span></div>';
			
         }
      else
       {
           	echo '<div class="notify_msg_f" id="noti_msg">Your Data Was Not Deleted! <span class="close_msg" onclick="close_msg();">X</span></div>';
       }
 
 }
//ADD NEW LOCATION
if($_REQUEST['add'])
{?>
<style>
.add_button
{
	display:none;
}
</style>
<div class="addform">
<form method="post" enctype="multipart/form-data" id="addarchive" action="?page=locations">
<div class="rows">
<label for="title"><h3>Add New Location Title</h3></label>
<input type="text" name="locationtitle" id="titles" placeholder="Enter Title Here" spellcheck="true" required="required" />
</div>
<div class="rows">
<label for="title"><h3>Location Description</h3></label>
<textarea name="locationaddress" id="locationaddress"></textarea>
</div>

<div class="rows">
<label for="title"><h3>Featured Image</h3></label>
<input type="file" name="featuredimage1" id="featuredimage1" required="required"/>
</div>

<div class="rows">
<label for="title"><h3>Header Image</h3></label>
<input type="file" name="featuredimage2" id="featuredimage2" required="required"/>
</div>

<div class="rows">
<label for="title"><h3>Location Day</h3></label>
<select name="location_day" id="location_day" required="required" />
<option value="Sunday">Sunday</option>
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
</select>
</div>
<div class="rows">
<label for="title"><h3>Location Time</h3></label>
        
<select name="location_time" id="location_time" required="required" />
<option value="12:00 AM">12:00 AM</option>
<option value="12:30 AM">12:30 AM</option>
<option value="1:00 AM">1:00 AM</option>
<option value="1:30 AM">1:30 AM</option>
<option value="2:00 AM">2:00 AM</option>
<option value="2:30 AM">2:30 AM</option>
<option value="3:00 AM">3:00 AM</option>
<option value="3:30 AM">3:30 AM</option>
<option value="4:00 AM">4:00 AM</option>
<option value="4:30 AM">4:30 AM</option>
<option value="5:00 AM">5:00 AM</option>
<option value="5:30 AM">5:30 AM</option>
<option value="6:00 AM">6:00 AM</option>
<option value="6:30 AM">6:30 AM</option>
<option value="7:00 AM">7:00 AM</option>
<option value="7:30 AM">7:30 AM</option>
<option value="8:00 AM">8:00 AM</option>
<option value="8:30 AM">8:30 AM</option>
<option value="9:00 AM">9:00 AM</option>
<option value="9:30 AM">9:30 AM</option>
<option value="10:00 AM">10:00 AM</option>
<option value="10:30 AM">10:30 AM</option>
<option value="11:00 AM">11:00 AM</option>
<option value="11:30 AM">11:30 AM</option>
<option value="12:00 PM">12:00 PM</option>
<option value="12:30 PM">12:30 PM</option>
<option value="1:00 PM">1:00 PM</option>
<option value="1:30 PM">1:30 PM</option>
<option value="2:00 PM">2:00 PM</option>
<option value="2:30 PM">2:30 PM</option>
<option value="3:00 PM">3:00 PM</option>
<option value="3:30 PM">3:30 PM</option>
<option value="4:00 PM">4:00 PM</option>
<option value="4:30 PM">4:30 PM</option>
<option value="5:00 PM">5:00 PM</option>
<option value="5:30 PM">5:30 PM</option>
<option value="6:00 PM">6:00 PM</option>
<option value="6:30 PM">6:30 PM</option>
<option value="7:00 PM">7:00 PM</option>
<option value="7:30 PM">7:30 PM</option>
<option value="8:00 PM">8:00 PM</option>
<option value="8:30 PM">8:30 PM</option>
<option value="9:00 PM">9:00 PM</option>
<option value="9:30 PM">9:30 PM</option>
<option value="10:00 PM">10:00 PM</option>
<option value="10:30 PM">10:30 PM</option>
<option value="11:00 PM">11:00 PM</option>
<option value="11:30 PM">11:30 PM</option>

</select>
</div>
<a id="AddMoreFileBox" class="btn btn-info" href="#">Add More Field</a>
<div id="InputsWrapper">

<div class="special">
<label for="name">Name</label><input id="field_1" type="text"  name="special[1][name]">
<label for="email">Email</label><input id="field_2" type="text"  name="special[1][email]">
<label for="email">Designation</label><input id="field_2" type="text"  name="special[1][designation]">
<label for="email">photo</label><input type="file" name="special_img[1][img_upp]" />
</div>
</div>
<div class="rows">
<label for="title"><h3>Location</h3></label><input type="text" name="location_address" id="titles" />
</div>
<div class="rows">
<label for="title"><h3>Youtube Url</h3></label><input type="text" name="youtube_url" id="titles" />
</div>
<div class="rows">
<input type="submit" name="sub_add_loc" id="sub_add_loc" class="button-primary" value="Insert Location"/>
</div>

</form>
</div>
<?php	
}
//Edit Location
else if($_REQUEST['edit_id'])
{

 $select_msg = "SELECT * FROM wp_ictse_location where id='".$_REQUEST['edit_id']."'";	
 $msg_inbox = mysql_query($select_msg);
 while($row_msg = mysql_fetch_assoc($msg_inbox))
 {


?>
	<div class="addform">
<form method="post" enctype="multipart/form-data" id="addarchive" action="?page=locations">
<div class="rows">
<input type="hidden" value="<?php echo $_REQUEST['edit_id']; ?>" name="editval">
<label for="title"><h3>Location Title</h3></label>
<input type="text" name="locationtitle" id="locationtitle" placeholder="Enter Title Here" spellcheck="true" required="required" value="<?php echo $row_msg['location_title'];?>" />
</div>
<div class="rows">
<label for="title"><h3>Address</h3></label>
<textarea name="locationaddress" id="locationaddress"><?php echo $row_msg['location_desc'];?></textarea>
</div>

<div class="rows">
<label for="title"><h3>Featured Image</h3></label>
<input type="file" name="featuredimage1" id="featuredimage1"/>
</div>

<div class="rows">
<img src="<?php echo ICT_SE_URL; ?>/locations/images/<?php echo $row_msg['fetcher_img'] ?>"  width="200" height="100" alt="No Image">
</div>

<div class="rows">
<label for="title"><h3>Header Image</h3></label>
<input type="file" name="featuredimage2" id="featuredimage2" />
</div>
<div class="rows">
<img src="<?php echo ICT_SE_URL; ?>/locations/header_img/<?php echo $row_msg['header_img'] ?>"  width="200" height="100" alt="No Image">
</div>

<div class="rows">
<label for="title"><h3>Location Day</h3></label>
<select name="location_day" id="location_day" required="required"/>
<option value="Sunday" <?php if($row_msg['location_day']=="Sunday"){echo 'selected=selected';} ?>>Sunday</option>
<option value="Monday" <?php if($row_msg['location_day']=="Monday"){echo 'selected=selected';} ?>>Monday</option>
<option value="Tuesday" <?php if($row_msg['location_day']=="Tuesday"){echo 'selected=selected';} ?>>Tuesday</option>
<option value="Wednesday" <?php if($row_msg['location_day']=="Wednesday"){echo 'selected=selected';} ?>>Wednesday</option>
<option value="Thursday" <?php if($row_msg['location_day']=="Thursday"){echo 'selected=selected';} ?>>Thursday</option>
<option value="Friday" <?php if($row_msg['location_day']=="Friday"){echo 'selected=selected';} ?>>Friday</option>
<option value="Saturday" <?php if($row_msg['location_day']=="Saturday"){echo 'selected=selected';} ?>>Saturday</option>
</select>
</div>
<div class="rows">
<label for="title"><h3>Location Time</h3></label>
        
<select name="location_time" id="location_time" required="required" selected="selected" />
<option value="12:00 AM">12:00 AM</option>
<option value="12:30 AM">12:30 AM</option>
<option value="1:00 AM">1:00 AM</option>
<option value="1:30 AM">1:30 AM</option>
<option value="2:00 AM">2:00 AM</option>
<option value="2:30 AM">2:30 AM</option>
<option value="3:00 AM">3:00 AM</option>
<option value="3:30 AM">3:30 AM</option>
<option value="4:00 AM">4:00 AM</option>
<option value="4:30 AM">4:30 AM</option>
<option value="5:00 AM">5:00 AM</option>
<option value="5:30 AM">5:30 AM</option>
<option value="6:00 AM">6:00 AM</option>
<option value="6:30 AM">6:30 AM</option>
<option value="7:00 AM">7:00 AM</option>
<option value="7:30 AM">7:30 AM</option>
<option value="8:00 AM">8:00 AM</option>
<option value="8:30 AM">8:30 AM</option>
<option value="9:00 AM">9:00 AM</option>
<option value="9:30 AM">9:30 AM</option>
<option value="10:00 AM">10:00 AM</option>
<option value="10:30 AM">10:30 AM</option>
<option value="11:00 AM">11:00 AM</option>
<option value="11:30 AM">11:30 AM</option>
<option value="12:00 PM">12:00 PM</option>
<option value="12:30 PM">12:30 PM</option>
<option value="1:00 PM">1:00 PM</option>
<option value="1:30 PM">1:30 PM</option>
<option value="2:00 PM">2:00 PM</option>
<option value="2:30 PM">2:30 PM</option>
<option value="3:00 PM">3:00 PM</option>
<option value="3:30 PM">3:30 PM</option>
<option value="4:00 PM">4:00 PM</option>
<option value="4:30 PM">4:30 PM</option>
<option value="5:00 PM">5:00 PM</option>
<option value="5:30 PM">5:30 PM</option>
<option value="6:00 PM">6:00 PM</option>
<option value="6:30 PM">6:30 PM</option>
<option value="7:00 PM">7:00 PM</option>
<option value="7:30 PM">7:30 PM</option>
<option value="8:00 PM">8:00 PM</option>
<option value="8:30 PM">8:30 PM</option>
<option value="9:00 PM">9:00 PM</option>
<option value="9:30 PM">9:30 PM</option>
<option value="10:00 PM">10:00 PM</option>
<option value="10:30 PM">10:30 PM</option>
<option value="11:00 PM">11:00 PM</option>
<option value="11:30 PM">11:30 PM</option>

</select>
</div>

<div class="rows">
<label for="title"><h3>Location</h3></label><input type="text" id="titles" name="location_address" value="<?php echo $row_msg['location_address'];?>">
</div>

<div class="rows">
<label for="title"><h3>Youtube Url</h3></label><input type="text" id="titles" name="youtube_url" value="<?php echo $row_msg['youtube'];?>">
</div>

<div class="rows">
<input type="submit" name="sub_update_loc" id="sub_update_loc" class="button-primary"  value="Update Location"/>
</div>

</form>
</div>
<?php } 
}
else
{
?>
<table class="wp-list-table widefat fixed post" id="sermonarchives1">
<thead>
<tr>
<th><b>S.No</b></th>
<th><b>Location Title</b></th>
<th><b>Location Image</b></th>
<th><b>Location Address</b></th>
<th><b>Location Day</b></th>
<th><b>Location Time</b></th>
<th colspan="2" style="text-align:center;"><b>Actions</b></th>
</tr>
</thead>
<tbody>
<?php 
 $select_msg = "SELECT * FROM wp_ictse_location";	

$msg_inbox = mysql_query($select_msg);
$i=1;
$no=1;
			if(!$pagenum||$pagenum==1){$no=1;}
				elseif($pagenum){
				$no=1+$offset;
				}
while($row_msg = mysql_fetch_assoc($msg_inbox))
{
?> 
	<tr>
	<td><?php echo $no; ?></td>
	<td><?php echo $row_msg['location_title'];?></td>
	<td><img src="<?php echo ICT_SE_URL; ?>/locations/images/<?php echo $row_msg['fetcher_img'] ?>"  width="50" height="50" alt="No Image">
	<?php /*?><?php
	if (empty($row_msg['fetcher_img'])) {
        echo '<img src="'.ICT_TRUCK_URL.'/images/no_photo.jpg" width="100" height="100" alt="No Image">';
        }
        else
        { 
		echo '<img src="'.ICT_TRUCK_URL.'/images/'.$row_msg['driver_img'].'" width="100" height="100" alt="No Image">'; 
	
	}?><?php */?>
	
	<?php /*?><img src="<?php echo ICT_TRUCK_URL; ?>/images/<?php echo $row_msg['driver_img']; ?>" width="100" height="100" alt="No Image Uploaded"/><?php */?>
	</td>
	
	<td><?php echo $row_msg['location_desc']; ?></td>
	<td><?php echo $row_msg['location_day']; ?></td>
	<td><?php echo $row_msg['location_time']; ?></td>
	<td style="text-align:right"><a href="?page=locations&edit_id=<?php echo $row_msg['id'];?>" title="Edit"><img src="<?php echo ICT_SE_URL;?>/images/edit.png"/></a></td>
	<td><a onClick="return confirm('Are you Sure to Delete?')" title="Delete" href="?page=locations&delete_id=<?php echo $row_msg['id'];?>"><img src="<?php echo ICT_SE_URL;?>/images/delete.png"/></a></td>
	<td> 
		
	</td>
	</tr>
<?php $no++;} ?>
</tbody>
</table>
<?php
}
?>

<script type="text/javascript" src="<?php echo ICT_SE_URL ?>/js/tinymce/tinymce.min.js"></script>
<script src="<?php echo ICT_SE_URL; ?>/js/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">

tinymce.init({
    selector: "textarea"
 });
 jQuery(document).ready(function() {
    jQuery('#post_date1').datepicker({
        dateFormat : 'dd-mm-yy',
		minDate: 0
    });
	    jQuery('#bid_end_date').datepicker({
        dateFormat : 'dd-mm-yy',
		minDate: 0
    });
	
	
});

var $=jQuery.noConflict();
$('.success_message').slideUp(5000);


</script>

<script>
$(document).ready(function() {

var MaxInputs       = 25; //maximum input boxes allowed
var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
var AddButton       = $("#AddMoreFileBox"); //Add button ID

var x = InputsWrapper.length; //initlal text box count
var FieldCount=1; //to keep track of text box added

$(AddButton).click(function (e)  //on add input button click
{
if(x <= MaxInputs) //max input box allowed
{
 FieldCount++; //text box added increment
 //add input box
 $(InputsWrapper).append('<div class="special'+FieldCount+'" id="special"><label for="name">Name</label><input id="field_1" type="text"  name="special['+FieldCount+'][name]"><label for="email">Email</label><input id="field_2" type="text"  name="special['+FieldCount+'][email]"><label for="email">Designation</label><input id="field_2" type="text"  name="special['+FieldCount+'][designation]"><label for="email">photo</label><input type="file" name="special_img['+FieldCount+'][img_upp]" /></div><a class="removeclass" href="#"> &times;</a>');
 x++; //text box increment
}
return false;
});

$("body").on("click",".removeclass", function(e){ //user click on remove text
        if( x > 1 ) {
                $(this).parent('div').remove(); //remove text box
                x--; //decrement textbox
        }
return false;
})


});
</script>