<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
  <?php

    ///////////////////////////////////////////////////connect database
    $dbc = mysqli_connect('localhost', 'root', '', 'elvis_store')
    or die('error to connect database');
    ///////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////////delete row
    if (isset($_POST['submit'])) {
      foreach ($_POST['todelete'] as $delete_id) {
        $query = "DELETE FROM email_list WHERE id=$delete_id";
        mysqli_query($dbc, $query)
        or die('Error query database');
      }
      echo 'Customer(s) remove.<br />';
    }
    ///////////////////////////////////////////////////////////////////

    /////////////////////////////////////////////////////query database
    $query = "SELECT * FROM email_list";
    $result = mysqli_query($dbc, $query);
    while ($row = mysqli_fetch_array($result)) {
      echo '<input type="checkbox" value="' . $row['id'] . '" name="todelete[]" />';
      echo $row['first_name'];
      echo ' ' . $row['last_name'];
      echo ' ' .$row['email'];
      echo '<br />';
    }
    ///////////////////////////////////////////////////////////////////

    mysqli_close($dbc);

  ?>

  <input type="submit" name="submit" value="Remove">
</form>