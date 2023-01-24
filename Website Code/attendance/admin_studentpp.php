<!-- <table class="table table-info table-striped">
  <tbody> -->
  <?php

session_start();
//Connect to database
require 'connectDB.php';

if (isset($_POST['log_date'])) {
    $_SESSION['yrsel'] = $_POST['yr_sel'];
    $_SESSION['brsel'] = $_POST['br_sel'];
  }
  $yrrsel = $_SESSION['yrsel'];
  $brrsel = $_SESSION['brsel'];
  
if ($brrsel == "0" and $yrrsel == "0") {
  $sql = "SELECT * FROM unusers ORDER BY `name`;";
} else if ($brrsel == "0") {
  $sql = "SELECT * FROM unusers WHERE year='$yrrsel' ORDER BY `name`";
} else if ($yrrsel == "0") {
  $sql = "SELECT * FROM unusers WHERE branch='$brrsel' ORDER BY `name`";
} else {
  $sql = "SELECT * FROM unusers WHERE year='$yrrsel' AND branch='$brrsel' ORDER BY `name`";
}
$result = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($result, $sql)) {
  echo '<p class="error">SQL Error</p>';
} else {
  mysqli_stmt_execute($result);
  $resultl = mysqli_stmt_get_result($result);
  if (mysqli_num_rows($resultl) > 0) {
    $ctr = 0;

    while ($row = mysqli_fetch_assoc($resultl)) {
?>
      <tr>
        <th scope="row"><?php $ctr++;
                        echo $ctr; ?></th>
        <td><?php echo $row['enrollno']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['fingerprint_id']; ?></td>
        <td><?php echo $row['branch']; ?></td>
        <td><?php echo $row['year']; ?></td>
        <td><?php echo $row['finger_time']; ?></td>
        <td><?php echo $row['finger_date']; ?></td>
      </tr>
<?php
    }
  }
}
?>
<!-- </tbody>
</table> -->