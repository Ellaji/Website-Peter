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
  <script type="text/javascript">
    $(document).ready(function(){
      $(".hamburger").click(function(event){            
        $("nav ul").slideToggle(1000)
      });
    });
  </script>
</head>
	
<body>
  <header class="gradient_background">
    <div class="widthwrap">
      <img src="images/logo.svg" alt="Vogels logo">
      <h3 id="logotext"> Peter van Haastrecht</h3>
    </div>
    <div class="widthwrap">
      <nav>
        <a href="javascript:void(0);">
          <img class="hamburger" src="images/hamburgerline.svg" alt="MENU">
        </a>
        <p class="hamburger">MENU</p>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="bruiloften.html">Bruiloften</a></li>
          <li><a href="landschappen.html">Landschappen</a></li>
          <li><a href="dieren.html">Dieren</a></li>
          <li><a href="series.html">Series</a></li>
          <li><a href="biografie.html">Biografie</a></li>
          <li><a href="contact.php" class="active_page">Contact</a></li>
        </ul>
        <a href="javascript:void(0);">
          <img class="hamburger" id="lastline" src="images/hamburgerline.svg" alt="MENU">
        </a>
      </nav>
    </div>
  </header>
  <div id="bannerarea">
    <img src="images/contact.jpg" alt="Foto door Peter van Haastrecht" id="singleimg">
  </div>
  <div id="contacttext" class="widthwrap">
    <h4>
    Mijn adres:<BR>
		Wilemien van Naaldwijkstraat 11 <BR>
		3417 BC Montfoort <BR><BR>
    Wilt u meer weten over de foto's, over het bestellen van foto's? Heeft u opmerkingen
    over de website? Of heeft u een fotograaf nodig voor uw bruiloft of voor een rapportage? 
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
    } elseif (strlen($_POST["naam"]) > 40) {
        $nameErr = "Gelieve hier alleen uw naam in te vullen."; 
    } else {
        $name = $_POST["naam"];
    }
        
    if (empty($_POST["email"])) {
        $mailErr = "Vul hier uw E-mail adres in.";
    // Check for bots and spam:  
    } elseif (IsInjected($_POST["email"])) {
        $mailErr = "E-mail format is niet juist.";
    // Make use of build-in filter to validate an e-mail address    
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $mailErr = "E-mail format is niet juist.";
    } else {
        $mail = $_POST["email"];
    }
      
    if (empty($_POST["bericht"])) {
        $contentErr = "Vul hier nog uw vragen of opmerkingen in:";
    } elseif (strlen($_POST["bericht"]) > 2000) {
        $contentErr = "Sorry, dit bericht is te lang. Gelieve niet meer dan 2000 karakters te gebruiken."; 
    } else {
        $content = $_POST["bericht"];
    }
    
    if (!empty($name) && !empty($mail) && !empty($content) && empty($_POST["test"])) { 
      $from = "Mirella@iMac-van-imac.local";
      $to = "mirellakersten@gmail.com";
      $email_subject = "Bericht van $name via de website";
      $email_body = "Opgegeven mailadres: $mail \r\nBericht: \r\n$content";
      $headers = "From: $from \r\n";
      mail($to, $email_subject, $email_body, $headers);
      $succes = "Uw bericht is succesvol verzonden. Ik zal u zo spoedig mogelijk een
      bericht terugsturen op het door u opgegeven adres: $mail.";
    } else {
     $nosucces = "Er is iets mis gegaan met het versturen.";
     }
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
      <p id="errortext">
        <?php echo $nameErr;?>
      </p>      
      <p> 
        <label for="Naam">Naam:<BR></label> 
        <input id="normal_field" type="text" name="naam" value="<?php echo $_POST["naam"];?>"> 
      </p> 
      <BR>
      <p id="errortext">
        <?php echo $mailErr;?>
      </p>
      <p>
        <label for="E-mail">E-mail:<BR></label> 
        <input id="normal_field"  type="text" name="email" value="<?php echo $_POST["email"];?>"> 
      </p>
      <BR>
      <p id="errortext">
        <?php echo $contentErr;?>
      </p>
      <p> 
        <label for="Bericht">Uw vragen of opmerkingen:<BR></label> 
        <!-- textarea has no value attribute -->
        <textarea id="big_field" type="text" name="bericht" maxlength="2000"
        ><?php echo htmlentities($_POST["bericht"]);?></textarea>
      </p>
      <!-- Dit is tegen spam -->
      <p id="last_field">
      <label>Gelieve hier niets in te vullen.</label>
      <input name="test" type="text"/>
    </p>
      <p> 
        <input type="submit" value="Verzenden"/> 
      </p> 
      <p id="send"> 
        <?php echo $nosucces;?>
        <?php echo $succes;?>
      </p>
    </form> 
  </div> 
  <!-- To keep footer at bottom -->     
  <footer>
    <h5>Copyright photos Peter van Haastrecht<br>
    Website door Mirella Kersten 2016</h5> 
  </footer>
</body>
	
</html>