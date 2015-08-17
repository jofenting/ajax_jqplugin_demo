<?php
$query_date = $_POST['date'];
$db = new SQLite3('/var/www/finance.2013-03-12_17-29.backup');
if(!$db){
    die("connect fail");
}
$sqlCommand="select c.name, sum(t.amount) s from transactions t left join categories c where c.id=t.category and date(t.time,'unixepoch')>=date('$query_date') group by c.id;";
$results=$db->query($sqlCommand);
$i=0;
while($row=$results->fetchArray()){
    $response[$i]=array($row["name"], $row["s"]*(-0.01));
    $i++;
}
$db->close();
echo json_encode($response);
?>
