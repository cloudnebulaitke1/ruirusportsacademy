<?php
// save this as display.php


    // show errors 
error_reporting(E_ALL);
ini_set('display_errors', 1);
    //errors ends here 
// call the page for connecting to the db

function connected_Db(){

    $dsn  = 'mysql:host=localhost;dbname=zebruyic_ruirusa;charset=utf8';
    $opt  = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    #echo "Yes we are connected";
    return new PDO($dsn,'zebruyic_ruirusa','kensta879097', $opt);
    
}
$con = connected_Db();
if($con){
//echo "me  is connected ";
}
else {
//echo "Connection faid ";
exit();
}






?>
<?php
$get_member =" SELECT id,fname,sname,lname,age, weight, height, dob, nationality, county, school, playerpos, parent, contacts, fclub, nick, jersey, pjersey, `file` FROM `player_register` WHERE 1;
$user_coder1 = $con->prepare($get_member);
$user_coder1 ->execute();

echo "<table border='1' >
<tr>
<td align=center> <b>Roll No</b></td>
<td align=center><b>Name</b></td>
<td align=center><b>Address</b></td>
<td align=center><b>Stream</b></td></td>
<td align=center><b>Status</b></td>";

while($row =$user_coder1->fetch(PDO::FETCH_ASSOC)){
$firstName = $row['firstName'];
$empid = $row['empid'];
$lastName =    $row['lastName'];
$cell =    $row['cell'];

    echo "<tr>";
    echo "<td align=center>$firstName</td>";
    echo "<td align=center>$empid</td>";
    echo "<td align=center>$lastName </td>";
    echo "<td align=center>$cell</td>";
    echo "<td align=center>$cell</td>";
    echo "</tr>";
}
echo "</table>";
?>

