<?php
$dbhost = gethostbyname('mysql.msinfra'); 
$dbport = 3306;
$dbuser = "app_user";
$dbname = "microservices";
$dbpwd = "password";
 
$connection = mysqli_connect($dbhost.":".$dbport, $dbuser, $dbpwd, $dbname) or die("Error " . mysqli_error($connection));
$query = "SELECT * from emails" or die("Error in the consult.." . mysqli_error($connection));
echo "Here is the list of emails sent: <br>";
$rs = $connection->query($query);
while ($row = mysqli_fetch_assoc($rs)) {
    echo "From Address: ".$row['from_add'] . "To Address: " . $row['to_add'] . "Subject: " . $row['subject'] ."When: ".$row['created_at'] . "<br>";
}
echo "End of the list <br>";
mysqli_close($connection);
?>
