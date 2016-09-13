<!DOCTYPE html>
<html>
  <head>
    <!-- Connecting library jQuery -->
    <script src="https://code.jquery.com/jquery-3.1.0.slim.min.js" integrity="sha256-cRpWjoSOw5KcyIOaZNo4i6fZ9tKPhYYb6i5T9RSVJG8=" crossorigin="anonymous"></script>
    <!-- Connecting library Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <!-- Custom styles -->
    <link href="style.css" rel="stylesheet">
    <!-- Custom JavaScript -->
    <script type="text/javascript" src="javascript.js"></script>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="robots" content="NONE">
    <!-- Title -->
    <title>Testing conversational bot</title>
  </head>
  <body>
    <?php // Connect all of the dependencies
      include("../src/bot.php");
      include("components/navbar.php"); // Connect the navigation bar
      include("components/engine.php"); // Connect the engine project
      include("components/settings.php"); // Connecting a modal window with the settings
    ?>
    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Communication with the bot</h1>
      </div>
      <?php
        include("components/communication.php");
        include("components/results.php");
      ?>
    </div>
    <?php include("components/footer.php"); // Connect the bottom panel ?>
  </body>
</html>
