<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include_once 'connection.php';
if(isset($_POST['celebrity'])&& $_POST['celebrity']!=""){
    $searchquery= preg_replace('#[^a-z 0-9?]#i', '',$_POST['celebrity']);
    
    if($_POST['Age']== "All"){
        $sqlcommand = "(select firstname, surname as lastname from celebritybiography where firstname like '%searchquery%' or 
            description like '%searchquery%') UNION 
            (select firstname, surname as lastname from celebritybiography where firstname like '%searchquery%' or 
            description like '%searchquery%')";
    }
  
    elseif($_POST['Age']== "0-10 years old"){
        $sqlcommand = "select firstname, surname as lastname from celebritybiography where firstname like '%searchquery%' or 
            page_body like '%searchquery%'";
         
    }else if($_POST['Age']== "11-18 years old"){
        $sqlcommand = "select firstname, surname as lastname from celebritybiography where firstname like '%searchquery%' or
            page_body like '%searchquery%'";
    }elseif($_POST['Age']=="19-30 years old"){
         $sqlcommand = "select firstname, surname as lastname from celebritybiography where firstname like '%searchquery%' or
            page_body like '%searchquery%'";
    }elseif($_POST['Age']=="31-45 years old"){
        $sqlcommand = "select firstname, surname as lastname from celebritybiography where firstname like '%searchquery%' or
            page_body like '%searchquery%'";
    }elseif($_POST['Age']=="Above 46"){
        $sqlcommand = "select firstname, surname as lastname from celebritybiography where firstname like '%searchquery%' or 
            page_body like '%searchquery%'";
    }
    
  
}
    
?>

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
<title>Search Results</title>
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

   include_once 'connection.php';
    $query = mysql_query($sqlcommand)or die(mysql_error());
    $count = mysql_num_rows($query);
    if($count>1){
        $search_output = "<hr> $count results for <strong>$searchquery</strong></hr>$sqlcommand";
        while ($row = mysql_fetch_array($query)) {
            $firstname = ['firstname'];
            $surname = ['surname'];
            $search_output .= "Results are: $firstname "-" $surname</br>";
    }
    }else{
        $search_output = "<hr> 0 results for <strong>$searchquery</strong></hr>$sqlcommand";
    }


?>
</div>
</div>
</div>
</div>
</div>
</body>



</html>