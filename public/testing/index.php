<?php
/*echo "Max execution time: ".ini_get("max_execution_time")."<br />";
echo "Max input time: ".ini_get("max_input_time")."<br />";
while(true)
{
    sleep(1);
}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
<head profile="http://gmpg.org/xfn/11">
</head>

<body>
<?php
echo '<pre>';
print_r($_POST);
print_r($_FILES);
echo '</pre>';
?>
<form action="" method="post" enctype="multipart/form-data">
<input type="file" name="fileUploaded" id="fileUploaded" value="" />
<input type="submit" />
</form>
<?php
echo 'CONFIG<br />';
echo 'display_errors = ' . ini_get('display_errors') . "<br />";
echo 'register_globals = ' . ini_get('register_globals') . "<br />";
echo 'post_max_size = ' . ini_get('post_max_size') . "<br />";
echo "Max execution time: ".ini_get("max_execution_time")."<br />";
echo "Max input time: ".ini_get("max_input_time")."<br />";
echo '<hr><pre>';
print_r(ini_get_all());
?>
</body>
</html>

