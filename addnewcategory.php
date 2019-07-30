<?php 
include('../../../wp-config');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
.cover_div {
    margin: 50px auto 0;
    width: 50%;
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
    width: 96%;
}
</style>
</head>

<body>
<div class="cover_div">
	<form method="post" action="<?php echo $url = admin_url(); ?>admin.php?page=all_categories">
    
    <table class="wp-list-table widefat fixed pages">
    <thead>
    <th style="background:#0091CD; color:white;">Category Type</th>
    </thead>
    <tbody>
      	<tr><td><div class="tr_cvr"><label for="cat_name">Category Name</label>
        	<input type="text" name="cat_txt" class="cat_txt" required="required"/></td></tr>
            <tr><td><input type="submit" name="cat_save" value="Add Category" class="button-primary" /></div></td>
            </tr>
            
    </tbody>
        </table>
    </form>
    </div>

</body>
</html>