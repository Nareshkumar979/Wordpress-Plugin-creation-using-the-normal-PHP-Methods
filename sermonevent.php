<?php 
include('../../../wp-config');
$siteurl = get_site_url();
$path = get_home_path();

?>
<link href="<?php echo ICT_SE_URL; ?>/css/jquery-ui.css" rel="stylesheet">
<style>
	.covr_div {
		float: left;
		padding: 30px 0 0;
		width: 99%;
	}
		.covr_div2 {
		float: left;
		margin: 30px 0 0;
		padding: 12px 0 10px 10px;
		width: 99%;
	}
	.page_title {
		float: left;
		width: 50%;
	}
	
	.add_btn_div {
		float: left;
		text-align: right;
		width: 50%;
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
.three {
    float: left;
    font-size: 14px;
    line-height: 2;
    width: 21%;
}
.inner_rows {
    float: left;
    width: 100%;
}
.cal {
    margin: 1px 0 0 157px;
    position: absolute;
    width: 3%;
}
.cal > img {
    height: 27px;
    width: 32px;
}

#posteddate {
    float: left;
    height: 45px;
    width: 25%;
}
.success_msg {
    background: green none repeat scroll 0 0;
    float: left;
    padding: 10px;
    width: 63%;
	margin-bottom:10px;
}
.delete_msg{
 background: green none repeat scroll 0 0;
    display: block;
    float: left;
    padding: 8px 0;
    width: 100%;
	}
</style>

<?php
//delete
if($_REQUEST['delete_id']){
$delet="DELETE FROM ".SE_SERMONS_EVENT." WHERE id=".$_REQUEST['delete_id'];
mysql_query($delet);
echo '<div class="delete_msg" style="background:red;"><span style="color:white; padding:0 0 0 7px;">Your Data has been successfully Deleted.</span></div>';?>
				<script>
                var $=jQuery.noConflict();
                $(".delete_msg").slideUp(5000);
                </script>
<?php } ?>


 <?php if($_REQUEST['addsermon']){?>
		
		<div class="covr_div2">
        <form method="post" action="<?php get_admin_url ?>admin.php?page=sermonevent" enctype="multipart/form-data">
        <div class="page_title"><h1>Sermon Event</h1></div>
        	<div class="rows"><label><h3>Event Title</h3></label> <input type="text" name="eve_title" id="titles" placeholder="Enter Event Title" required="required"/></div>
            <div class="rows"><label><h3>Event Description</h3></label><textarea name="eve_desc"></textarea></div>      		<div class="rows"><label><h3>Event Organisers<h4>(Eg: Williams,Henry,etc.,)</h4></h3></label><input type="text" name="eve_org" id="titles"/ required="required"></div>
            <div class="rows"><label><h3>Event Date</h3></label><div class="cal"></div><input type="text" required="required" placeholder="Event Date" id="posteddate" name="eve_date" /></div>
            <div class="rows"><label><h3>Select Categories</h3></label>
            <?php 
				$sel="SELECT * FROM ".SE_SERMONS_CATEGORY."";
				$qry=mysql_query($sel);
				$count=mysql_num_rows($qry);
			?>
            <select style="width:100%; height:50px !important;" name="eve_catlist">
            	<?php if($count==0){?>
							<option value="no_data">No Data</option>
				<?php } else{?>
           			 <?php while($row=mysql_fetch_assoc($qry)){ ?>
            				<option value="<?php echo $row['category_name'];?>"><?php echo $row['category_name'];?></option>
                            
			<?php  } 
			
			}?>
            </select>
            </div>
            
            <div class="rows"><label><h3>Select Tags</h3></label>
            	<div class="inner_rows">
            	<?php 
					$sel="SELECT * FROM ".SE_SERMONS_TAG."";
					$qry=mysql_query($sel);
					$count=mysql_num_rows($qry);
					if($count==0){ ?>
						<div class="three">No Tags</div>
					<?php } else {
					while($row=mysql_fetch_assoc($qry)){?>
							<div class="three"><input type="checkbox" name="tag[]" value="<?php echo $row['tag_name']; ?>"/><?php echo $row['tag_name']; ?></div>
					<?php } 
					}?>
            </div>
            </div>
            
            <div class="rows">
            <label><h3>Event Image</h3></label><input type="file" name="fileToUpload" id="eventimage" required="required"/>
            </div>
			<div class="rows">
           	 	<label><h3>Youtube Url</h3></label>
                <input type="text" id="titles" name="youtube_url" placeholder="Youtube Url"/>
            </div>
            <div class="rows">
            <label><h3></h3></label>
            <input type="submit" class="button-primary" name="save" value="Add Details" /></div>
           </form>
        </div><!--covr_div2-->
        
<?php } else if($_REQUEST['edit_id']){ ?>
		<div class="covr_div2">
			
        	<?php  	$sele="SELECT * FROM ".SE_SERMONS_EVENT." WHERE id=".$_REQUEST['edit_id'];
					$sel_qry=mysql_query($sele);
					$row_sel=mysql_fetch_assoc($sel_qry);
					$js_fetch=$row_sel['categories_tag'];
					$js_de=json_decode($js_fetch);
			?>
        <form method="post" action="<?php get_admin_url ?>admin.php?page=sermonevent" enctype="multipart/form-data">
        <div class="page_title"><h1>Sermon Event</h1></div>
        	<div class="rows"><label><h3>Event Title</h3></label> <input type="text" name="eve_title" id="titles" placeholder="Enter Event Title" required="required" value="<?php echo $row_sel['event_title']; ?>"/></div>
            <div class="rows"><label><h3>Event Description</h3></label><textarea name="eve_desc"><?php echo $row_sel['event_desc']; ?></textarea></div>      		<div class="rows"><label><h3>Event Organisers<h4>(Eg: Williams,Henry,etc.,)</h4></h3></label><input type="text" name="eve_org" id="titles"/ required="required" value="<?php echo $row_sel['event_organisers']; ?>"></div>
            <div class="rows"><label><h3>Event Date</h3></label><div class="cal"></div><input type="text" required="required" placeholder="Event Date" id="posteddate" name="eve_date" value="<?php echo $row_sel['event_date']; ?>" /></div>
            <div class="rows"><label><h3>Select Categories</h3></label>
            <?php 
				$sel="SELECT * FROM ".SE_SERMONS_CATEGORY."";
				$qry=mysql_query($sel);
				$count=mysql_num_rows($qry);
			?>
            <select style="width:100%; height:50px !important;" name="eve_catlist">
            	<?php if($count==0){?>
							<option value="no_data">No Data</option>
				<?php } else{?>
           			 <?php while($row=mysql_fetch_assoc($qry)){ ?>
            				<option value="<?php echo $row['category_name'];?>"<?php if($row['category_name']== $row_sel['event_categories']){echo 'selected=selected';} ?>><?php echo $row['category_name'];?></option>
                            
			<?php  } 
			
			}?>
            </select>
            </div>
            
            <div class="rows"><label><h3>Select Tags</h3></label>
            	<div class="inner_rows">
            	<?php 
					$sel="SELECT * FROM ".SE_SERMONS_TAG."";
					$qry=mysql_query($sel);
					$count=mysql_num_rows($qry);
					if($count==0){ ?>
						<div class="three">No Tags</div>
					<?php } else {
					while($row=mysql_fetch_assoc($qry)){?>
							<div class="three"><input type="checkbox" name="tag[]" value="<?php echo $row['tag_name']; ?>"<?php if(in_array($row['tag_name'],$js_de)){echo 'checked';} ?>/><?php echo $row['tag_name']; ?></div>
					<?php } 
					}?>
            </div>
            </div>
            
            <div class="rows">
            <label><h3>Event Image</h3></label><input type="file" name="fileToUpload" id="eventimage" placeholder="Enter Event Title" />
				<div class="img_show"><img height="38" width="75" src="<?php echo $siteurl; ?>/wp-content/plugins/Sermons/event_img/<?php echo $row_sel['categories_images'] ?>"/></div>
            </div>
			<div class="rows">
           	 	<label><h3>Youtube Url</h3></label>
                <input type="text" id="titles" name="youtube_url" placeholder="Youtube Url" value="<?php echo $row_sel['youtube_url'] ?>"/>
               <input type="hidden" name="edit_usr_id" value="<?php echo $row_sel['id'] ?>" />
            </div>
            <div class="rows">
            <label><h3></h3></label>
            <input type="submit" class="button-primary" name="update" value="Update Details" /></div>
           </form>
        </div>

<?php }
else {?>
<div class="covr_div">
	<div class="page_title"><h1>Sermon Event</h1></div>
    <div class="add_btn_div"><a href="<?php  get_admin_url ?>admin.php?page=sermonevent&addsermon=1" class="button-primary">Add Sermon Event</a></div>
	<table class="wp-list-table widefat fixed pages">
    	<thead>
        	<th><b>S.No</b></th>
            <th><b>Event Title</b></th>
            <th><b>Event Date</b></th>
            <th><b>Event Image</b></th>
            <th><b>Action</b></th>
        </thead>
        <tbody>
        <?php 
				
				if($_POST['save']){
					//get cat id
					$catename = $_POST['eve_catlist'];
	$catid = "SELECT * FROM ".SE_SERMONS_CATEGORY." WHERE `category_name`='".$catename."'";
	$catqrys = mysql_query($catid);
	$fetchs= mysql_fetch_assoc($catqrys);
	$categoryid = $fetchs['id'];
	
					//json_encode
					$jtag=$_POST[tag];
					$json_tag=json_encode($jtag);
					
					//img upload
					$file_name=$_FILES['fileToUpload']['name'];
	$here1 = explode(".",$file_name);
	$num1 = (count($here1) - 1);
	$name_new =$here1[0]."_".date("Mj_Y_g_i").".".$here1[$num1];
	$paths= $name_new;
	move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$path."/wp-content/plugins/Sermons/event_img/".$name_new);
					
					//insert
				 $insert="INSERT INTO ".SE_SERMONS_EVENT."(`event_title`, `event_title_slug`,`event_desc`, `event_organisers`, `event_date`, `event_categories`, `categories_id`, `categories_tag`, `categories_images`, `youtube_url`) VALUES ('".$_POST['eve_title']."','".sanitize_title($_POST['eve_title'])."','".$_POST['eve_desc']."','".$_POST['eve_org']."','".$_POST['eve_date']."','".$_POST['eve_catlist']."','".$categoryid."','".$json_tag."','".$paths."','".$_POST['youtube_url']."')";
				mysql_query($insert);
			 	}?>
				
					<?php 
			//update
			if($_POST['update']){
			
			//	json_encode
					$jtag=$_POST[tag];
					$json_tag=json_encode($jtag);
				//img upload
					$file_name=$_FILES['fileToUpload']['name'];
	$here1 = explode(".",$file_name);
	$num1 = (count($here1) - 1);
	$name_new =$here1[0]."_".date("Mj_Y_g_i").".".$here1[$num1];
	$paths= $name_new;
	move_uploaded_file($_FILES['fileToUpload']['tmp_name'],$path."/wp-content/plugins/Sermons/event_img/".$name_new);
	//get cat id
					$catename = $_POST['eve_catlist'];
	$catid = "SELECT * FROM ".SE_SERMONS_CATEGORY." WHERE `category_name`='".$catename."'";
	$catqrys = mysql_query($catid);
	$fetchs= mysql_fetch_assoc($catqrys);
	$categoryid = $fetchs['id'];
	
	if(empty($here1[$num1]))
	{
		
		  $upd="UPDATE  ".SE_SERMONS_EVENT." SET `event_title`='".$_POST['eve_title']."',`event_title_slug`='".sanitize_title($_POST['eve_title'])."',`event_desc`='".$_POST['eve_desc']."',`event_organisers`='".$_POST['eve_org']."',`event_date`='".$_POST['eve_date']."',`event_categories`='".$_POST['eve_catlist']."',`categories_id`='".$categoryid ."',`categories_tag`='".$json_tag."',`youtube_url`='".$_POST['youtube_url']."' WHERE  id= ".$_POST['edit_usr_id'];
				mysql_query($upd);
				echo '<div class="delete_msg" style="background:green;"><span style="color:white; padding:0 0 0 7px;">Your Data has been successfully Updated.</span></div>';?>
				<script>
                var $=jQuery.noConflict();
                $(".delete_msg").slideUp(10000);
                </script>
	
	<?php }
	else{
				 $upd="UPDATE  ".SE_SERMONS_EVENT." SET `event_title`='".$_POST['eve_title']."',event_title_slug`='".sanitize_title($_POST['eve_title'])."',`event_desc`='".$_POST['eve_desc']."',`event_organisers`='".$_POST['eve_org']."',`event_date`='".$_POST['eve_date']."',`event_categories`='".$_POST['eve_catlist']."',`categories_id`='".$categoryid ."',`categories_tag`='".$json_tag."',`categories_images`='".$paths."',`youtube_url`='".$_POST['youtube_url']."' WHERE  id= ".$_POST['edit_usr_id'];
				mysql_query($upd);
				
				echo '<div class="delete_msg" style="background:red;"><span style="color:white; padding:0 0 0 7px;">Your Data has been successfully Updated.</span></div>';?>
				<script>
                var $=jQuery.noConflict();
                $(".delete_msg").slideUp(10000);
                </script>
<?php 		}
				
				}
			?>
				
           <?php 
		   	$select="SELECT * FROM ".SE_SERMONS_EVENT."";
			$qrry=mysql_query($select);
			$i=1;
		   while($row=mysql_fetch_assoc($qrry)){?>
        	<tr><td><?php echo $i; ?></td>
            <td><?php echo $row['event_title']; ?></td>
            <td><?php echo $row['event_date']; ?></td>
            <td><img height="38" width="75" src="<?php echo $siteurl; ?>/wp-content/plugins/Sermons/event_img/<?php echo $row['categories_images'] ?>"></td>
            <td><a href="?page=sermonevent&edit_id=<?php echo $row['id'];?>"><img src="<?php echo ICT_SE_URL; ?>/images/edit.png"/></a>
                           &nbsp;&nbsp;&nbsp;&nbsp; <a onClick="return confirm('Are you Sure to Delete?')"href="?page=sermonevent&delete_id=<?php echo $row['id'];?>"><img src="<?php echo ICT_SE_URL; ?>/images/delete.png"/></a></td></a></tr>
            <?php $i++; } ?>
        </tbody>
    </table>
</div>

<?php } ?>

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
</script>