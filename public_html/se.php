<?php
include("connection.php");

if(!isset($_POST['search'])){
header("Location:searchresult.html");
}else{

$searchq = $_POST['search'];
$search = preg_replace('#[^0-9 a-z]#i','',$searchq);


$search_sql="SELECT * FROM celebritybiography WHERE nickname LIKE '%$search%' OR description LIKE '%$search%'";
$search_query= mysql_query($search_sql) or die(mysql_error(). "Could not connect to our database");
$count = mysql_num_rows($search_query);
if($count!=0){
$search_rs = mysql_fetch_assoc($search_query);
}
}

?>

<html>
<head>
<title>Search Result</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="js/libs/normalize-2.0.1/normalize.css" type="text/css"/>
<link rel="stylesheet" href="js/libs/normalize-2.0.1/normalize.css" type="text/css">
</head>
<style type="text/css">
h1{position:absolute; top:0px; align:center; color:red}

</style>
<body>

<div class="container">
<div class="jumbotron">
<div class="row">
<div class="panel-primary">
<div class="panel panel-heading"><h2 class="glyphicon glyphicon-star">&nbsp;&nbsp;Your Search Results</h2></div>
<div class="panel panel-body">

<?php
$count = mysql_num_rows($search_query);
if($count!=0){
do{ ?>
<?php echo $search_rs['nickname'].' <a href="http://localhost/multimedia/moviestar_bio/public_html/'.$search_rs['link'].'">Click Here</a></br>';
} 
while($search_rs =mysql_fetch_assoc($search_query));
}
else{
echo "No result found";
}

?>
</div>
</div>
</div>
</div>
</div>
</body>



</html>