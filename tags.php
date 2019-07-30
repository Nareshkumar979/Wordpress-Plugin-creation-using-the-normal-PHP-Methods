<?php 
include('../../../wp-config');
?>
<style>
.cover_div {
    margin: 50px auto 0;
    width: 97%;
}
td>.cat_add_btn{
	margin-left:95px;
}
.tr_cvr {
    padding: 18px 0 17px;
}
.success_msg {
   background: green none repeat scroll 0 0;
    float: left;
    padding: 10px;
    width: 63%;
	margin-bottom:10px;
}
.cvr_div {
    float: left;
    width: 97%;
}
.heading {
    float: left;
    width: 19%;
}
.add_btn {
    float: left;
    padding: 12px 0 0;
    text-align: right;
    width: 48%;
}
.delete_msg {
     float: left;
    padding: 5px 0 5px 3px;
    width: 63%;
	margin-bottom:10px;
}
#title{
	height: 38px;
	width: 55%;
}
</style>
<div class="cvr_div">
<div class="heading">
	<h1>Tags</h1>
</div>
<div class="add_btn">
	<a href=" <?php echo get_admin_url() ?>admin.php?page=tags&addtag=1" class="button-primary hid">Add Tags</a>
   
</div>
</div>
<?php 
//delete
			if($_REQUEST['delete_id']){
				 $delete="DELETE FROM ".SE_SERMONS_TAG." WHERE `id` =".$_REQUEST['delete_id'];
				$del_qry=mysql_query($delete);
				echo '<div class="delete_msg" style="background:red;"><span style="color:white; padding:0 0 0 7px;">Deleted...</span></div>';?>
				<script>
                var $=jQuery.noConflict();
                $(".delete_msg").slideUp(2000);
                </script>
			<?php } ?>
<?php if($_REQUEST['addtag']){ ?>

		<style>.add_btn{display:none;}</style>
<div class="cover_div">

	<form method="post" action="<?php get_admin_url ?>admin.php?page=tags">
    <table class="wp-list-table widefat fixed pages">
    <thead>
    <th><b>Tags</b></th>
    </thead>
    <tbody>
      	<tr><td><div class="tr_cvr"><label for="cat_name" style="font-size:18px;" >Tags</label>
        	<input type="text" name="cat_txt" class="cat_txt" required="required" id="title"/></td></tr>
            <tr><td><input type="submit" name="cat_save" value="Add Tags" class="button-primary" /></div></td>
            </tr>
            
    </tbody>
        </table>
    </form>	
</div>
<?php }

else if($_REQUEST['edit_id']){ ?>
		<style>.add_btn{display:none;}</style>
	<form method="post" action="<?php get_admin_url ?>admin.php?page=tags">
    <table class="wp-list-table widefat fixed pages">
    <thead>
    <th><b>Category Type</b></th>
    </thead>
    <tbody>
      	<tr><?php 
			 $select_qry="SELECT * FROM ".SE_SERMONS_TAG." WHERE id=".$_REQUEST['edit_id']; 
			$qru=mysql_query($select_qry);
			$row=mysql_fetch_assoc($qru);?>
			<td><div class="tr_cvr"><label for="cat_name" style="font-size:18px;">Tags</label>
        	<input type="text" name="cat_txt" class="cat_txt" required="required" value="<?php echo $row['tag_name'] ?>" id="title"/>
              
            <input type="hidden" value="<?php echo $row['id'] ?>" name="edit_hid"/>
                       </td></tr>
            <tr><td><input type="submit" name="edit_cat" value="Update Tags" class="button-primary" /></div></td>					
            </tr>
            
    </tbody>
        </table>
    </form>	
	

<?php } 
else{?>
		<table class="wp-list-table widefat fixed pages" style="width:65%;">
            <thead>
            <th width="10%;"><b>S.No</b></th>
            <th width="15%;"><b>Tags</b></th>
            <th width="6%;"><b>Action</b></th>
            </thead>
            <tbody>
      		<tr><?php
			//insert
				if($_POST['cat_save']){?>
            	<script></script>
			<?php $insert_cat="INSERT INTO ".SE_SERMONS_TAG."(`tag_name`,`tag_slug`) VALUES('".$_POST['cat_txt']."','".sanitize_title($_POST['cat_txt'])."')";
			mysql_query($insert_cat);
			echo '<div class="success_msg"><span style="color:white; padding:0 0 0 7px;">Inserted...</span></div>';?>
			<script>
			var $=jQuery.noConflict();
			$(".success_msg").slideUp(2000);
			</script>
            
			<?php } ?>
					<?php if($_POST['edit_cat']){
	 $update="UPDATE ".SE_SERMONS_TAG." SET `tag_name`='".$_POST['cat_txt']."',`tag_slug`='".sanitize_title($_POST['cat_txt'])."' WHERE id=".$_POST['edit_hid'];	
				mysql_query($update);
                echo '<div class="success_msg"><span style="color:white; padding:0 0 0 7px;">Updated...</span></div>';?>
			<script>
			var $=jQuery.noConflict();
			$(".success_msg").slideUp(2000);
			</script>
					<?php } ?>	
           	     
        <?php    //select
		 $select_qry="SELECT * FROM ".SE_SERMONS_TAG.""; 
				$qru=mysql_query($select_qry);
				$count=mysql_num_rows($qru);
				if($count==0){
					echo '<td colspan="3" align="center" style="color:red;"> No Tags Found</td>';
				}
				else{
				$i=1;
				while($row=mysql_fetch_assoc($qru)){?>
                		
                		<tr><td><?php echo $i; ?></td>	
						<td><?php echo $row['tag_name'];?></td>
                        <td>
                        	<a href="?page=tags&edit_id=<?php echo $row['id'];?>"><img src="<?php echo ICT_SE_URL; ?>/images/edit.png"/></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;<a onClick="return confirm('Are you Sure to Delete?')" href="?page=tags&delete_id=<?php echo $row['id'];?>"><img src="<?php echo ICT_SE_URL; ?>/images/delete.png"/></a>
                        </td></tr>
       			<?php $i++;} }?>
                
                
           
            
            
                
    </tbody>
      </table>

<?php } ?> 