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
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="robots" content="NONE">
    <!-- Title -->
    <title>Testing conversational bot</title>
  </head>

  <body>
    <?php // Connect all of the dependencies
      include("../src/bot.php"); // Class for working with AI
      include("components/class-application.php"); // Class to work with application logic
      include("components/navbar.php"); // Connect the navigation bar
      include("components/settings.php"); // Connecting a modal window with the settings
    ?>

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <h1>Communication Panel</h1>
      </div>

      <?php
        // Treat the reset button
        if (isset($_POST['reset'])) {
          ClearingCache("cookies"); // We clear all cookies
          ClearingCache("post"); // Removes all requests that were not processed
          header("Location: " . $_SERVER["REQUEST_URI"]); // Reloading the page
        }

        // Checking the token initialization
        if (isset($_POST['BOT_TOKEN'])) {
          $token = htmlspecialchars($_POST['BOT_TOKEN']);
          ClearingCache("cookies"); // We clear all cookies
          SetCookie("BOT_TOKEN", $token); // Save a new cookie
          header("Location: " . $_SERVER["REQUEST_URI"]); // Reloading the page
        // ...Finding saved token
        } elseif (isset($_COOKIE['BOT_TOKEN'])) {
          $token = $_COOKIE['BOT_TOKEN'];
        }

        // The next step - checking/initialize the session with the bot.
        if (isset($token)) {
          // Initialize the robot system
          define('BOT_TOKEN', $token);
          $bot = new Bot(BOT_TOKEN);
          // Initialize the session
          $session = GetSession($token, $bot);
          if (empty($session)) { // No session? Error! ?>
            <!-- Error Notification -->
            <div class="alert alert-danger alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Error!</strong> Failed to create a session!
            </div>
          <?php }
        } else { // Nope token? A warning! ?>
          <!-- Error Notification -->
          <div class="alert alert-warning alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Attention!</strong> No token: Required to check the settings!
          </div>
        <?php }

        // Processes the message
        if (isset($_POST['textarea'])) {
          $currenttext = htmlspecialchars($_POST['textarea']); // Transform text
          SavingStories(GetID(), $currenttext, 'user'); // Keeping your message
          $currentid = SetID(GetID()); // Get next ID
          SavingStories(SetID($currentid), $bot->say($currenttext), 'bot'); // Save bot response
          header("Location: " . $_SERVER["REQUEST_URI"]); // Reloading the page
        }

        // Connecting the system interface
        include("components/on-board-panel.php"); // Settings panel
        include("components/results.php"); // Output messages
      ?>
    </div>
    <?php include("components/footer.php"); // Connect the bottom panel ?>
  </body>
</html>
