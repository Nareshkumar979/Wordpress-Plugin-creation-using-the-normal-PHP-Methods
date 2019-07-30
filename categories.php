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
    width: 20%;
}
.add_btn {
    float: left;
    padding: 12px 0 0;
    text-align: right;
    width: 47%;
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
	<h1>Categories</h1>
</div>
<div class="add_btn">
	<a href=" <?php echo get_admin_url() ?>admin.php?page=categories&addcategory=1" class="button-primary hid">Add New Category</a>
   
</div>
</div>
<?php 
//delete
			if($_REQUEST['delete_id']){
				 $delete="DELETE FROM ".SE_SERMONS_CATEGORY." WHERE `id` =".$_REQUEST['delete_id'];
				$del_qry=mysql_query($delete);
				echo '<div class="delete_msg" style="background:red;"><span style="color:white; padding:0 0 0 7px;">Your Data has been successfully Deleted.</span></div>';?>
				<script>
                var $=jQuery.noConflict();
                $(".delete_msg").slideUp(5000);
                </script>
			<?php } ?>
<?php if($_REQUEST['addcategory']){ ?>

		<style>.add_btn{display:none;}</style>
<div class="cover_div">

	<form method="post" action="<?php get_admin_url ?>admin.php?page=categories">
    <table class="wp-list-table widefat fixed pages">
    <thead>
    <th><b>Category Type</b></th>
    </thead>
    <tbody>
      	<tr><td><div class="tr_cvr"><label for="cat_name" style="font-size:18px;">Category Name</label>
        	<input type="text" name="cat_txt" class="cat_txt" required="required" id="title"/></td></tr>
            <tr><td><input type="submit" name="cat_save" value="Add Category" class="button-primary" /></div></td>
            </tr>
            
    </tbody>
        </table>
    </form>	
</div>
<?php }

else if($_REQUEST['edit_id']){ ?>
		<style>.add_btn{display:none;}</style>
	<form method="post" action="<?php get_admin_url ?>admin.php?page=categories">
    <table class="wp-list-table widefat fixed pages">
    <thead>
    <th><b>Category Type</b></th>
    </thead>
    <tbody>
      	<tr><?php 
			 $select_qry="SELECT * FROM ".SE_SERMONS_CATEGORY." WHERE id=".$_REQUEST['edit_id']; 
			$qru=mysql_query($select_qry);
			$row=mysql_fetch_assoc($qru);?>
			<td><div class="tr_cvr"><label for="cat_name" style="font-size:18px;">Category Name</label>
        	<input type="text" name="cat_txt" class="cat_txt" required="required" value="<?php echo $row['category_name'] ?>" id="title"/>
              
            <input type="hidden" value="<?php echo $row['id'] ?>" name="edit_hid"/>
                       </td></tr>
            <tr><td><input type="submit" name="edit_cat" value="Update Category" class="button-primary" /></div></td>					
            </tr>
            
    </tbody>
        </table>
    </form>	
	

<?php } 
else{?>
		<table class="wp-list-table widefat fixed pages" style="width:65%;">
            <thead>
            <th width="10%"><b>S.No</b></th>
            <th><b>Category Name</b></th>
            <th width="12%"><b>Action</b></th>
            </thead>
            <tbody>
      		<tr><?php
			//insert
				if($_POST['cat_save']){?>
            	<script></script>
			<?php $insert_cat="INSERT INTO ".SE_SERMONS_CATEGORY."(`category_name`,`category_slug`) VALUES('".$_POST['cat_txt']."','".sanitize_title($_POST['cat_txt'])."')";
			mysql_query($insert_cat);
			echo '<div class="success_msg"><span style="color:white; padding:0 0 0 7px; text-align:center;">Your Category has been successfully Inserted</span></div>';?>
			<script>
			var $=jQuery.noConflict();
			$(".success_msg").slideUp(5000);
			</script>
            
			<?php } ?>
					<?php if($_POST['edit_cat']){
	 $update="UPDATE ".SE_SERMONS_CATEGORY." SET `category_name`='".$_POST['cat_txt']."',`category_slug`='".sanitize_title($_POST['cat_txt'])."' WHERE id=".$_POST['edit_hid'];	
				mysql_query($update);
                echo '<div class="success_msg"><span style="color:white; padding:0 0 0 7px;">Your Category has been successfully Updated</span></div>';?>
			<script>
			var $=jQuery.noConflict();
			$(".success_msg").slideUp(5000);
			</script>
					<?php } ?>	
           	     
        <?php    //select
		 $select_qry="SELECT * FROM ".SE_SERMONS_CATEGORY.""; 
				$qru=mysql_query($select_qry);
				$count=mysql_num_rows($qru);
				if($count==0){
					echo '<td colspan="3" align="center" style="color:red;"> No Categories Found</td>';
				}
				else{
				$i=1;
				while($row=mysql_fetch_assoc($qru)){?>
                		
                		<tr><td><?php echo $i; ?></td>	
						<td><?php echo $row['category_name'];?></td>
                        <td>
                        	<a href="?page=categories&edit_id=<?php echo $row['id'];?>"><img src="<?php echo ICT_SE_URL; ?>/images/edit.png"/></a>
                           &nbsp;&nbsp;&nbsp;&nbsp; <a onClick="return confirm('Are you Sure to Delete?')"href="?page=categories&delete_id=<?php echo $row['id'];?>"><img src="<?php echo ICT_SE_URL; ?>/images/delete.png"/></a>
                        </td></tr>
       			<?php $i++;} }?>
                
                
           
            
            
                
    </tbody>
      </table>

<?php } ?> 