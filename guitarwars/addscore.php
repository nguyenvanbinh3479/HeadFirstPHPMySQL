<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>add score</title>
</head>
<body>
  <h2>Guitar Wars - Add Your High Score</h2> 
  <?php
    require_once('appvars.php');
    require_once('connectvars.php');
    if (isset($_POST['submit'])) {
      // Grab the score data from the POST
      $name = $_POST['name'];
      $score = $_POST['score'];
      $screenshot = $_FILES['screenshot']['name'];
      $screenshot_size = $_FILES['screenshot']['size'];
      $screenshot_type = $_FILES['screenshot']['type'];
      if (!empty($name) && is_numeric($score) && !empty($screenshot)) {
        if ((($screenshot_type =='image/gif') || 
        ($screenshot_type =='image/jpeg') || 
        ($screenshot_type =='image/pipeg')
         ||($screenshot_type='image/png')) &&($screenshot_size > 0) && ($screenshot_size<= GW_MAXFILESIZE)){
           if ($_FILES['screenshot']['error'] ==0){
            $target = GW_UPLOADPATH . $screenshot;
            if (move_uploaded_file($_FILES['screenshot']['tmp_name'], $target)) { 
              $dbc = mysqli_connect('localhost', 'root', '', 'gwdb');
              // Write the data to the database
              $query = "INSERT INTO guitarwars (date, name, score, screenshot) VALUES ( CURDATE(), '$name', '$score', '$screenshot')";
              mysqli_query($dbc, $query);
              // Confirm success with the user
              echo '<p>Thanks for adding your new high score!</p>';
              echo '<p><strong>Name:</strong> ' . $name . '<br />';
              echo '<strong>Score:</strong> ' . $score . '</p>';
              echo '<img src="' . $target .'" alt="score image"/></p>';
              echo '<p><a href="index.php">&lt;&lt; Back to high scores</a></p>';
              // Clear the score data to clear the form
              $name = "";
              $score = "";
              mysqli_close($dbc);
            }
          }
          else {
            echo '<p class="error">Please enter all of the information to add ' .
            'your high score.</p>';
          }
        }
      }
      else{
        echo '<p class="error">the sceen shot must be a GIF, JPEG, or PNG image file no'.'greater than'.(GW_MAXFILESIZE/ 1024) . 'KB in size</p>';
      }
      // try to delete the temporary sceen shot image file
      @unlink($_FILES['screenshot']['tmp_name']);
       
    }
    else {
      echo '<p class="error">Please enter all of the infomation to add your high score.</p>';
    }
  ?> 
  <hr />
  <form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="MAX_FILE_SIZE" value="32768">
    <label for="name">Name:</label><input type="text" id="name" name="name"
    value="<?php if (!empty($name)) echo $name; ?>" /><br />
    <label for="score">Score:</label><input type="text" id="score" name="score"
    value="<?php if (!empty($score)) echo $score; ?>" /><br />
    <label for="screenshot">Screen shot:</label>
    <input type="file" id="screenshot" name="screenshot">
    <hr />
    <input type="submit" value="Add" name="submit" />
 </form> 
</body>
</html>