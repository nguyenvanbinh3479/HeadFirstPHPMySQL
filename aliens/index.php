<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Head First PHP</title>
  <style>
    body{
      padding: 30px;
      text-align: center;
    }
    form{
      margin: 0 auto;
      max-width: 550px;
      overflow: hidden;
      text-align: initial;
    }
  </style>
</head>
<body>  
  <div class="container-fluit">
    <div class="row">
      <div class="form">
        <p>Share your story of alien abduction:</p>
        <form action="report.php" method="POST">
          <label for="firstname">First Name: </label>
          <input type="text" id="firstname" name="firstname"><br />
          <label for="lastname">Last Name: </label>
          <input type="text" id="lastname" name="lastname"><br />
          <label for="email">What is your Email Address? </label>
          <input type="text" id="email" name="email"><br />
          <label for="whenithappened">When did it happen?</label>
          <input type="text" id="whenithappened" name="whenithappened" /><br />
          <label for="howlong">How long were you gone?</label>
          <input type="text" id="howlong" name="howlong" /><br />
          <label for="howmany">How many did you see?</label>
          <input type="text" id="howmany" name="howmany" /><br />
          <label for="aliendescription">Describe them:</label>
          <input type="text" id="aliendescription" name="aliendescription" size="32" /><br />
          <label for="whattheydid">What did they do to you?</label>
          <input type="text" id="whattheydid" name="whattheydid" size="32" /><br />
          <label for="fangspotted">Have you seen my dog Fang?</label> 
          Yes <input type="radio" name="fangspotted" id="fangspotted" value="yes">
          No <input type="radio" name="fangspotted" id="fangspotted" value="no"><br />
          <img src="fang.jpg" width="100" height="175" alt="My abducted dog Fang." /><br />
          <label for="other">Anything else you want to add?</label>
          <textarea id="other" name="other"></textarea><br />
          <input type="submit" value="Report Abduction" name="submit" /> 
        </form>
      </div>
    </div>
  </div>
</body>
</html>