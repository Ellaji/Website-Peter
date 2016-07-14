<!DOCTYPE HTML>
<html lang="nl">

<head>
  <link href='https://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' 
  type='text/css'>
  <title>Peter van Haastrecht Fotografie</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <meta charset="utf-8"/>
  <meta name="description"
    content="Peter van Haastrecht is een Nederlandse hobbyfotograaf, gespecialiseerd 
    in fotografie van Nederlandse vergezichten en vogels." />
  <meta name="keyword" content="landschapsfotografie, vogels, macro" />
  <link rel="stylesheet" type="text/css" href="css/main.css" media="screen"/>
  <!--[if IE]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
  <!--[if lte IE 7]>
  <script src="js/IE8.js" type="text/javascript"></script><![endif]-->
  <!--[if lt IE 7]>
  <link rel="stylesheet" type="text/css" media="all" href="css/ie6.css"/><![endif]-->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <script src="js/responsiveslides.js"></script>
  <script>
    $(function() {
      $(".rslides").responsiveSlides();
    });
  </script>
</head>
	
<body>
  <header class="gradient_background">
    <div class="widthwrap">
      <img src="images/logo.svg" alt="Vogels logo">
      <h3> Peter van Haastrecht</h3>
    </div>
    <div class="widthwrap">
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="bruiloften.html">Bruiloften</a></li>
          <li><a href="landschappen.html">Landschappen</a></li>
          <li><a href="dieren.html">Dieren</a></li>
          <li><a href="series.html">Series</a></li>
          <li><a href="biografie.html">Biografie</a></li>
          <li><a href="contact.html" class="active_page">Contact</a></li>
        </ul>
      </nav>
    </div>
  </header>
  <div id="contacttext" class="widthwrap">
    <h4>Wilt u meer weten over de foto's, over het bestellen van foto's, heeft u opmerkingen
    over de website of heeft u een fotograaf nodig voor uw bruiloft? 
    Stel hier gerust uw vragen.</h4>
  </div> 
  
  <!-- ***** Start php ***** -->
  <?php 
  // Define the variables and set to empty values
  $nameErr = $mailErr = $contentErr = "";
  $name = $mail = $content = "";
  
  if($_SERVER['REQUEST_METHOD'] == 'POST'){ 
    
    if (empty($_POST["naam"])) {
        $nameErr = "Vul hier uw naam in.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST["naam"])) {
        // Check if name only contains letters and whitespace
        $nameErr = "Gelieve alleen letters en spaties te gebruiken."; 
    } else {
        $name = test_input($_POST["naam"]);
    }
    
    
    if (empty($_POST["e-mail"])) {
        $mailErr = "Vul hier uw E-mail adres in.";
    // Make use of build-in filter to validate an e-mail address    
    } elseif (!filter_var($_POST["e-mail"], FILTER_VALIDATE_EMAIL)) {
        $mailErr = "E-mail format is niet juist.";
    } elseif (IsInjected($_POST["e-mail"])) {
        $mailErr = "E-mail format is niet juist.";
    } else {
        $mail = test_input($_POST["e-mail"]);
    }
     
     
    if (empty($_POST["bericht"])) {
        $contentErr = "Vul hier uw vragen of opmerkingen in.";
    } else {
        $content = test_input($_POST["bericht"]);
    }
  }
  
  function test_input($data) {
    $data = trim ($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    
    $to = "mirellakersten@gmail.com";//<== NOG DOEN  mail address
    $email_subject = "Bericht van $name. via de website";
    $email_body = "Bericht: $message. ";
    $headers = "From: $email_from \r\n";
    $headers .= "Reply-To: $visitor_email \r\n";
    //Send the email!
    mail($to,$email_subject,$email_body,$headers);
    //done. redirect to 'verzonden' page.
  }
  
  // Function to validate against any email injection attempts (hackers)
  function IsInjected($str) {
    $injections = array('(\n+)',
                '(\r+)',
                '(\t+)',
                '(%0A+)',
                '(%0D+)',
                '(%08+)',
                '(%09+)'
                );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if(preg_match($inject,$str)) {
      return true;
    } else {
      return false;
    }
  }
  ?>
  <!-- ***** End php ***** -->
  
  <div id="contactform">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
      <p> 
        <label for="Naam">Naam:<BR></label> 
        <input type="text" name="naam" value=<?php echo $_POST["naam"];?>> 
        <span><?php echo $nameErr;?></span>
      </p> 
      <p>
        <label for="E-mail">E-mail:<BR></label> 
        <input type="text" name="e-mail" value="<?php echo $_POST["e-mail"];?>"> 
        <span><?php echo $mailErr;?></span>
      </p>
      <p> 
        <label for="Bericht">Uw vragen of opmerkingen:<BR></label> 
        <input rows="9" cols ="30" type="text" name="bericht" value="<?php echo $_POST["bericht"];?>">
        <span><?php echo $contentErr;?></span>
      </p>
      <p> 
        <input type="submit" value="Verzenden"/> 
      </p> 
    </form> 
  </div>           
  <footer>
    <h5>Copyright photos Peter van Haastrecht<br>
    Website door Mirella Kersten 2016</h5> 
  </footer>
</body>
	
</html>