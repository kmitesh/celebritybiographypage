<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

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
    
    include_once 'connection.php';
    $query = mysql_query($sqlcommand)or die(mysql_error());
    $count = mysql_num_rows($query);
    if($count>1){
        $search_output = "<hr> $count results for <strong>$searchquery</strong></hr>$sqlcommand";
        while ($row = mysql_fetch_array($query)) {
            $firstname = ['firstname'];
            $surname = ['surname'];
            $search_output .= "Results are: $firstname - $surname</br>";
    }
    }else{
        $search_output = "<hr> 0 results for <strong>$searchquery</strong></hr>$sqlcommand";
    } 
}
    
?>

