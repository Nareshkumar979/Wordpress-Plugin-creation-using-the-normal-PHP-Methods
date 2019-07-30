<?php
$siteurl = get_site_url();
$path = get_home_path();
include('../../../wp-config.php');
?>
<link href="<?php echo ICT_SE_URL; ?>/css/jquery-ui.css" rel="stylesheet">

<style>
#sermonarchives
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
#titles {
    float: left;
    height: 50px;
    width: 100%;
}
.rows {
    float: left;
    width: 97%;
}
#posteddate {
    float: left;
    height: 35px;
    width: 25%;
}
#archivecrt {
    margin-top: 16px;
}
.image_display {
    float: left;
    padding-top: 15px;
    width: 100%;
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
</style>
<?php

?>
<div class="archive">
<h2>Sermon Archives</h2>
<div class="add_button">
<a href="<?php echo $siteurl; ?>/wp-admin/admin.php?page=sermons_file&add=1" class="button-primary">Add New Archive</a>
</div>
</div>
<?php
if($_REQUEST['add'])
{	
?>
<style>
.add_button
{
	display:none;
}
</style>
<div class="addform">
<form method="post" enctype="multipart/form-data" id="addarchive" action="<?php echo $siteurl; ?>/wp-admin/admin.php?page=sermons_file">
<div class="rows">
<label for="title"><h3>Category Type</h3></label>
<?php
$catsel = "SELECT * FROM ".SE_SERMONS_CATEGORY." ORDER BY `id` DESC";
$catqry = mysql_query($catsel);
$count=mysql_num_rows($catqry);
?>
<select id="category" name="archivecategory" required="required">
<?php 
if($count==0)
{ ?>
	<option value="No Data">No Data</option>
<?php
}
else
{
	while($fetch = mysql_fetch_assoc($catqry))
	{ ?>
		<option value="<?php echo $fetch['category_name'] ?>"><?php echo $fetch['category_name'] ?></option>
	<?php
    }
}
?>


</select>
</div>
<div class="rows">
<label for="title"><h3>Description</h3></label>
<textarea name="archivedescription" id="ardesc"></textarea>
</div>


<div class="rows">
<label for="title"><h3>Featured Image</h3></label>
<input type="file" name="featuredimage" id="featuredimage" required="required" />
</div>

<div class="rows">
<label for="title"><h3>Posted Date</h3></label>
<input type="text" name="posteddate" id="posteddate" placeholder="Enter Posted Date" required="required" />
</div>

<div class="rows">
<input type="submit" name="archivecreate" id="archivecrt" value="Insert Archive" class="button-primary" />
</div>

</form>
</div>
<?php
}
else if($_REQUEST['editid'])
{ 
$editsel="SELECT * FROM ".SE_SERMONS." WHERE `id`= '".$_REQUEST['editid']."'";
$editqry = mysql_query($editsel);
$fetching = mysql_fetch_assoc($editqry);
?>
<form method="post" enctype="multipart/form-data" id="editarchive" action="<?php echo $siteurl; ?>/wp-admin/admin.php?page=sermons_file">
<div class="rows">
<input type="hidden" value="<?php echo $_REQUEST['editid']; ?>" name="editval">
<label for="title"><h3>Category Type</h3></label>
<?php
$catsel = "SELECT * FROM ".SE_SERMONS_CATEGORY." ORDER BY `id` DESC";
$catqry = mysql_query($catsel);
$count=mysql_num_rows($catqry);
?>
<select id="category" name="archivecategorys">
<?php 
	while($fetch = mysql_fetch_assoc($catqry))
	{ ?>
		 <option value="<?php echo $fetch['category_name'] ?>" <?php if($fetching['sermons_category']==$fetch['category_name']){echo 'selected=selected';} ?>><?php echo $fetch['category_name']; ?>
         </option>
	<?php
    }
?>


</select>
</div>
<div class="rows">
<label for="title"><h3>Description</h3></label>
<textarea name="archivedescription" id="ardesc"><?php echo $fetching['sermons_desc'] ?></textarea>
</div>


<div class="rows">
<label for="title"><h3>Featured Image</h3></label>
<input type="file" name="featuredimage" id="featuredimage" />
<div class="image_display">
<img height="100" width="200" src="<?php echo $siteurl; ?>/wp-content/plugins/Sermons/archives/<?php echo $fetching['featured_img'] ?>">
</div>
</div>

<div class="rows">
<label for="title"><h3>Posted Date</h3></label>
<input type="text" name="posteddate" id="posteddate" placeholder="Enter Posted Date" value="<?php echo $fetching['sermons_date'] ?>" />
</div>

<div class="rows">
<input type="submit" name="updatearchive" id="archivecrt" value="Update Archive" class="button-primary" />
</div>

</form>
<?php
}
else
{
if($_REQUEST['deleteid'])
{
	$delete="DELETE FROM ".SE_SERMONS." WHERE `id`='".$_REQUEST['deleteid']."'";
	$delqry=mysql_query($delete);
	echo '<div class="success_message"> Your Archive has been deleted successfully</div>';
}	
if($_POST['archivecreate'])
{
	$catename = $_POST['archivecategory'];
	$catid = "SELECT * FROM ".SE_SERMONS_CATEGORY." WHERE `category_name`='".$catename."'";
	$catqrys = mysql_query($catid);
	$fetchs= mysql_fetch_assoc($catqrys);
	$categoryid = $fetchs['id'];
	$file_name=$_FILES['featuredimage']['name'];
	$here1 = explode(".",$file_name);
	$num1 = (count($here1) - 1);
	$name_new =$here1[0]."_".date("Mj_Y_g_i").".".$here1[$num1];
	$paths= $name_new;
	move_uploaded_file($_FILES['featuredimage']['tmp_name'],$path."/wp-content/plugins/Sermons/archives/".$name_new);
	
	if(empty($here1[$num1]))
	{
	$insertcat = "INSERT INTO ".SE_SERMONS." (`sermons_category_id`,`sermons_desc`,`sermons_category`,`sermons_slug`,`sermons_date`) VALUES ('".$categoryid."','".$_POST['archivedescription']."','".$_POST['archivecategory']."','".sanitize_title($_POST['archivecategory'])."','".$_POST['posteddate']."')";
	}
	else
	{
		$insertcat = "INSERT INTO ".SE_SERMONS." (`sermons_category_id`,`sermons_desc`,`featured_img`,`sermons_category`,`sermons_slug`,`sermons_date`) VALUES ('".$categoryid."','".$_POST['archivedescription']."','".$paths."','".$_POST['archivecategory']."','".sanitize_title($_POST['archivecategory'])."','".$_POST['posteddate']."')";
	}
	$cateqry=mysql_query($insertcat);
	echo '<div class="success_message">Your Archive has been successfully Inserted</div>';
}
if($_POST['updatearchive'])
{
	$catename = $_POST['archivecategorys'];
	$catid = "SELECT * FROM ".SE_SERMONS_CATEGORY." WHERE `category_name`='".$catename."'";
	$catqrys = mysql_query($catid);
	$fetchs= mysql_fetch_assoc($catqrys);
	echo $categoryid = $fetchs['id'];
	
	$file_name=$_FILES['featuredimage']['name'];
	$here1 = explode(".",$file_name);
	$num1 = (count($here1) - 1);
	$name_new =$here1[0]."_".date("Mj_Y_g_i").".".$here1[$num1];
	$paths= $name_new;
	move_uploaded_file($_FILES['featuredimage']['tmp_name'],$path."/wp-content/plugins/Sermons/archives/".$name_new);
	
	if(empty($here1[$num1]))
	{
	$updatecat = "UPDATE ".SE_SERMONS." SET `sermons_category_id` = '".$categoryid."', `sermons_desc`= '".$_POST['archivedescription']."',`sermons_category`='".$_POST['archivecategorys']."', `sermons_slug` = '".sanitize_title($_POST['archivecategory'])."',  `sermons_date` = '".$_POST['posteddate']."' WHERE `id`='".$_POST['editval']."'";
	}
	else
	{
	$updatecat = "UPDATE ".SE_SERMONS." SET `sermons_category_id` = '".$categoryid."', `sermons_desc`='".$_POST['archivedescription']."',`featured_img`='".$paths."',`sermons_category` = '".$_POST['archivecategorys']."', `sermons_slug` = '".sanitize_title($_POST['archivecategory'])."',`sermons_date` = '".$_POST['posteddate']."' WHERE `id`='".$_POST['editval']."'";
	}
	$updateqry=mysql_query($updatecat);
	echo '<div class="success_message">Your Archive has been successfully Updated</div>';
}
		
?>
<table class="wp-list-table widefat fixed post" id="sermonarchives">
<thead>
<tr>
<th><b>S.No</b></th>
<th><b>Archive Image</b></th>
<th><b>Archive Category</b></th>
<th><b>Posted Date</b></th>
<th><b>Actions</b></th>
</tr>
</thead>
<tbody>
<?php
$select = "SELECT * FROM ".SE_SERMONS." ORDER BY `id` DESC";
$query = mysql_query($select);
$counts = mysql_num_rows($query);
if($counts==0)
{
	echo '<tr><td colspan="6" align="center" style="color:#ff0000;">No Archives have been created yet..</td></tr>';
}
else
{
$i=1;	
while($row_fetch = mysql_fetch_assoc($query))
{
?>
<tr>
<td><?php echo $i; ?></td>
<td>
<img width="50" height="50" src="<?php echo $siteurl; ?>/wp-content/plugins/Sermons/archives/<?php echo $row_fetch['featured_img']; ?>">
</td>
<td><?php echo $row_fetch['sermons_category']; ?></td>
<td><?php echo $row_fetch['sermons_date']; ?></td>
<td><a href="<?php echo $siteurl; ?>/wp-admin/admin.php?page=sermons_file&editid=<?php echo $row_fetch['id']; ?>" class="views"><img src="<?php echo ICT_SE_URL; ?>/images/edit.png"></a> <a onClick="return confirm('Are you Sure want to Delete this Archive !!');" href="<?php echo $siteurl; ?>/wp-admin/admin.php?page=sermons_file&deleteid=<?php echo $row_fetch['id']; ?>"><img src="<?php echo ICT_SE_URL; ?>/images/delete.png"></a></td>
</tr>
<?php
$i++;
}
?>
</tbody>
</table>
<?php
}
}
?>
<script type="text/javascript" src="<?php echo ICT_SE_URL ?>/js/tinymce/tinymce.min.js"></script>
<script src="<?php echo ICT_SE_URL; ?>/js/prism.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea"
 });
var $=jQuery.noConflict();	 
 $(document).ready(function() {
    $('#posteddate').datepicker({
        dateFormat : 'dd-mm-yy',
		minDate: 0
    });
});
var $=jQuery.noConflict();
$('.success_message').slideUp(3000);
</script>