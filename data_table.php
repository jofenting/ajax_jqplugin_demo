<?php
$query_date = $_POST['date'];
$db = new SQLite3('/var/www/finance.2013-03-12_17-29.backup');
if(!$db){
    die("connect fail");
}
$sqlCommand="select t.id, c.name, date(t.time,'unixepoch','localtime') time, t.amount, t.note from transactions t left join categories c where c.id=t.category and date(t.time,'unixepoch')>=date('$query_date');";
$results=$db->query($sqlCommand);
echo "<table><th>id</th><th>category</th><th>time</th><th>amount</th><th>note</th>";
while($row=$results->fetchArray()){
    echo "<tr>";
    echo "<td>",$row['id'],"</td>";
    echo '<td align="center">',$row['name'],"</td>";
    echo "<td>",$row['time'],"</td>";
    echo "<td>",$row['amount'],"</td>";
    echo '<td align="center">',$row['note'],"</td>";
    echo "</tr>";
}
echo "</table>";
$db->close();
echo $response;
?>
