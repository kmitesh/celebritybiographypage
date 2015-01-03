
<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
$output = " ";
if(isset($_POST['searchVal'])&& $_POST['searchVal']!= ""){
    include_once ('connection.php');
    
   $searchq = $_POST['search'];
   $search= preg_replace('#[^0-9 a-z]#i',' ',$searchq);
   
   $query = mysql_query("select* from celebritybiography where firstname like '%$search%' or surname like '%$search%'")
         or die(mysql_error(). "Could not connect to our database");
    $count = mysql_num_rows($query);
    
    if($count>1){
        $output .= "<hr/>$count result for<strong>$search</strong><hr/>$query<hr/>";
         while($row = mysql_fetch_array($query)){
            $firstname = $row['firstname'];
            $surname = $row['surname'];
            
            $output .= "Result: $firstname - $surname</br>";
         }
    }else{
        $output .= "<hr/>$count result for<strong>$search</strong><hr/>$query";
        }
    }
    echo ($output);
?>