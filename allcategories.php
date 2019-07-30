<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<style>
.success_msg {
    background: green none repeat scroll 0 0;
    float: left;
    padding: 10px;
    width: 96%;
}
.cover_div {
    margin: 50px auto 0;
    width: 100%;
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
    width: 100%;
}
.delete_msg {
    background: red none repeat scroll 0 0;
    float: left;
    padding: 10px;
    width: 100%;
}
</style>
<body>
    <div class="cover_div">
	<form method="post" action="<?php echo $url = admin_url(); ?>admin.php?page=all_categories">
	<table class="wp-list-table widefat fixed pages">
    <thead>
     <th style="background:#0091CD; color:white;">Category Name</th>
     <th style="background:#0091CD; color:white;">Action</th>
    </thead>
    <tbody>
	    <?php 
			//insert
			if($_POST['cat_save']){
			$insert_cat="INSERT INTO ".SE_SERMONS_CATEGORY."(`category_name`) VALUES('".$_POST['cat_txt']."')";
			mysql_query($insert_cat);
			echo '<div class="success_msg"><span style="color:white; padding:0 0 0 7px;">Inserted...</span></div>';?>
			<script>
			var $=jQuery.noConflict();
			$(".success_msg").slideUp(2000);
			</script>
			<?php }
			//delete
			if($_REQUEST['delete_id']){
				 $delete="DELETE FROM ".SE_SERMONS_CATEGORY." WHERE `id` =".$_REQUEST['delete_id'];
				$del_qry=mysql_query($delete);
				echo '<div class="delete_msg"><span style="color:white; padding:0 0 0 7px;">Deleted...</span></div>';?>
				<script>
                var $=jQuery.noConflict();
                $(".delete_msg").slideUp(2000);
                </script>
			<?php }
			//select
		$select_qry="SELECT * FROM ".SE_SERMONS_CATEGORY.""; 
				$qru=mysql_query($select_qry);
				while($row=mysql_fetch_assoc($qru)){?>
						<tr><td><?php echo $row['category_name'];?></td>
                        <td><a href="?page=all_categories&delete_id=<?php echo $row['id'];?>">Delete</a></td></tr>
				<?php }?>
    </tbody>
    
    </table>	
    </form>
    </div>
</body>
</html>