<?php
$query_date = $_POST['date'];
$db = new SQLite3('/var/www/finance.2013-03-12_17-29.backup');
if(!$db){
    die("connect fail");
}
$sqlCommand="select t.id, c.name, date(t.time,'unixepoch','localtime') time, t.amount, t.note from transactions t left join categories c where c.id=t.category and date(t.time,'unixepoch')>=date('$query_date');";
$results=$db->query($sqlCommand);
$i=0;
while($row=$results->fetchArray()){
//    $response->rows[$i]['id']=$row["id"];
//    $tmp = Transliterator::transliterate("Any-Hex/Java", $row["note"]);
    $response->rows[$i]['cell']=array($row["id"], $row["name"], $row["time"], $row["amount"]*(-0.01), $row["note"]);
    $i++;
}
$response->page = 1;
$response->total = 1;
$response->records = $i;
$db->close();
echo json_encode($response);
?>
