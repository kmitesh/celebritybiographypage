
<html>

<style type=text/css>
</style>


</html>



<?php
$submit=['submit'];

if($submit){
$name=$_POST['name'];
$comment=$_POST['comment'];
$handle=fOpen("com.html","a+");
fWrite($handle,"<hr><b>".$name."<b>:</br>".$comment."</br>");
fclose($handle);

}

?>

<div position="absolute" right="30px">
<?php include 'com.html'; ?>
</div>