<?php
include "../../lb/dbCon.php";

$sql = "SELECT * FROM comment ORDER BY  idCmt desc";

$qr = mysqli_query($con, $sql);
/*$record_set = array();
while ($row = mysqli_fetch_assoc($result)) {
    array_push($record_set, $row);
}
mysqli_free_result($result);
mysqli_close($conn);
echo json_encode($record_set);
*/
$rowCmt= mysqli_fetch_array($qr);
if (! $qr) {
    $result = mysqli_error($con);
}
echo "<table width='550' border='0'>";
      echo  "<tr>";
       echo "<td width='100' rowspan='3'><img src='images/avartar_cmt.jpg' width='50'></td>";
         echo "<td style='color:#EE3322, font:14px' width='440'>".$rowCmt["Ten"]."</td>";
        echo"</tr><tr>";
         echo "<td>".$rowCmt["NoiDung"]."</td>";
        echo "</tr><tr>";
          echo "<td><small>".$rowCmt["ThoiGian"]." <a href='#'> Xóa</a></small></td></tr></table>";

?>