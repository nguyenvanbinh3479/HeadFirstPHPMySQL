<?php


  $subject = "";
  $text = "";

  if(isset($_POST['submit'])){

    /////////////////////////////////////////////////////create variable
    $from = 'nguyenvanbinh3479@gmail.com';
    $subject = $_POST['subject'];
    $text = $_POST['elvismail'];
    $output_form = false; 
    ////////////////////////////////////////////////////////////////////

    if (empty($subject) && empty($text)) {
      // We know both $subject AND $text are blank
      echo 'You forgot the email subject and body text.<br />';
      $output_form = true;
      }
      if (empty($subject) && (!empty($text))) {
      echo 'You forgot the email subject.<br />';
      $output_form = true;
      }
      if ((!empty($subject)) && empty($text)) {
      echo 'You forgot the email body text.<br />';
      $output_form = true;
      }
      if ((!empty($subject)) && (!empty($text))) {
      
        ///////////////////////////////////////////////////connect database
        $dbc = mysqli_connect('localhost', 'root', '', 'elvis_store')
        or die('error to connect database');
        ///////////////////////////////////////////////////////////////////

        /////////////////////////////////////////////////////query database
        $query = 'SELECT * FROM  email_list';
        $result = mysqli_query($dbc, $query)

        or die('error to query database');
        while($row = mysqli_fetch_array($result)){
          $first_name = $row['first_name'];
          $last_name = $row['last_name'];
          $msg = "Dear $first_name $last_name, \n $text";
          $to = $row['email'];
          mail($to, $subject, $msg, 'From:' . $from);
          echo 'Email sent to: '. $to . '<br/>';
        }
      mysqli_close($dbc);
      /////////////////////////////////////////////////////////////////////
    }
  }     
  ///////////////////////////////////////////////////////else statements
  else{
    $output_form = true; 
  }
  ///////////////////////////////////////////////////////////////////////

  ////////////////////////////////////////////////////////////create form
  if($output_form){
    ?>
    <!DOCTYPE html>
    <html lang="en">
      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Elvis email</title>
      </head>
      <body>
          <div class="container-fluit">
            <div class="row">
              <form action="sendemail.php" method="POST">
                <label for="subject">Subject of email:</label><br />
                <input type="text" id="subject" name="subject" size="58" value="<?php echo $subject?>"><br />
                <label for="elvismail">body of email:</label><br />
                <textarea name="elvismail" id="elvismail" cols="60" rows="8" value="<?php echo $text?>"></textarea><br />
                <input type="submit" value="submit" name="submit">
              </form>
            </div>
          </div>
      </body>
    </html>
    <?php
  }

?>