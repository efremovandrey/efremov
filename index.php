<html>
<head>
<Title>Registration Form</Title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
    body { background-color:
 #fff; border-top: solid 10px #000;
 color: #333; font-size: .85em;
 margin: 20; padding: 20;
 font-family: "Segoe UI",
 Verdana, Helvetica, Sans-Serif;}
    h1, h2, h3,{ color: #000; 
margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 1.75em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.75em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em;
 text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; 
border: 0 none; }
</style>
</head>
<body>
<h1>Регистрация</h1>
<p>Заполните ваше имя и адрес электронной почты, затем нажмите кнопку Отправить, чтобы зарегистрироваться.</p>
<form method="post" action="index.php" 
enctype="multipart/form-data" >
      Имя  <input type="text" 
name="name" id="name"/></br>
      Email <input type="text" 
name="email" id="email"/></br>
      <input type="submit" 
name="submit" value="Отправить" />
</form>
<?php
// DB connection info
$host = "tcp:qagmpmy2wy.database.windows.net,1433";
$user = "efremov@qagmpmy2wy";
$pwd = "1Qwertyu";
$db = "efremovAu91BFbnU";
// Connect to database.
try {
    $conn = new PDO
( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
    $conn->setAttribute
( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
    die(var_dump($e));
}
if(!empty($_POST)) {
try {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = date("Y-m-d");
    // Insert data
    $sql_insert = 
"INSERT INTO registration_tb (name, email, date) 
                   VALUES (?,?,?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bindValue(1, $name);
    $stmt->bindValue(2, $email);
    $stmt->bindValue(3, $date);
    $stmt->execute();
}
catch(Exception $e) {
    die(var_dump($e));
}
echo "<h3>Your're registered!</h3>";
}
$sql_select = "SELECT * FROM registration_tb";
$stmt = $conn->query($sql_select);
$registrants = $stmt->fetchAll(); 
if(count($registrants) > 0) {
    echo "<h2>Зарегистрированные:</h2>";
    echo "<table>";
    echo "<tr><th>Имя</th>";
    echo "<th>Email</th>";
    echo "<th>Дата</th></tr>";
    foreach($registrants as $registrant) {
        echo "<tr><td>".$registrant['name']."</td>";
        echo "<td>".$registrant['email']."</td>";
        echo "<td>".$registrant['date']."</td></tr>";
    }
    echo "</table>";
} else {
    echo "<h3>Никто в настоящее время не зарегистрирован .</h3>";
}
?>
</body>
</html>
