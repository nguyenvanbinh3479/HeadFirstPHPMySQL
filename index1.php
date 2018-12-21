<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Giutar wars</title>
</head>
<body>

  <h2>giutar wars</h2>

  <?php
    require_once('appvars.php');
    require_once('connectvars.php');

    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
    or die('error to connect');
  
    $query = "SELECT * FROM guitarwars WHERE approved = 1 ORDER BY score DESC, date ASC";
    $result = mysqli_query($dbc, $query);
    echo '<table>';
    $i = 0;
    while ($row = mysqli_fetch_array($result)){
      if ($i==0){
        echo '<tr><td colspan="2" class="topscoreheader">Top Score: '. $row['score'] .'</td></tr>';
      }
      echo '<tr><td class="scoreinfo">';
      echo '<span class="score">' . $row['score'] . '</span><br />';
      echo '<strong>Name: </strong>' . $row['name'] . '</span><br />';
      echo '<strong>Date: </strong>' . $row['date'] . '</span><br />';
      if (is_file(GW_UPLOADPATH .$row['screenshot']) && filesize(GW_UPLOADPATH .$row['screenshot']) > 0) {
        echo '<td><img src="'. GW_UPLOADPATH . $row['screenshot'] . '"alt="Score image"/></td></tr>';
      }
      else{
        echo '<td><img src=" '. GW_UPLOADPATH . 'unverified.gif" alt="Unverified score"/></td></tr>';
      }
      $i++;
    }
    echo '</table>';
    mysqli_close($dbc);
  ?>

</body>
</html>