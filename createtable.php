#efremov
<?php
header("Content-Type: text/html; charset=UTF-8")
// DB connection info
$host = "tcp:qagmpmy2wy.database.windows.net,1433";
$user = "efremov@qagmpmy2wy";
$pwd = "1Qwertyu";
$db = "efremovAu91BFbnU";
try{
    $conn = new PDO
( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
    $conn->setAttribute
( PDO::ATTR_ERRMODE, 
PDO::ERRMODE_EXCEPTION );
    $sql = "CREATE TABLE registration_tb(
    id INT NOT NULL IDENTITY(1,1) 
    PRIMARY KEY(id),
    name VARCHAR(30),
    email VARCHAR(30),
    date DATE)";
    $conn->query($sql);
}
catch(Exception $e){
    die(print_r($e));
}
echo "<h3>Table created.</h3>";
?>
