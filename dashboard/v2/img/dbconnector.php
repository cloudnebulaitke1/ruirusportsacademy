
<?php
// save this as dbconnector.php
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
