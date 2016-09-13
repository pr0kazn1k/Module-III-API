<!-- Start navigation bar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li>
          <!-- Home project -->
          <a href="https://github.com/valentineus/Module-III-API"><span class="github" aria-hidden="true"></span> GitHub.com</a>
        </li>
      </ul>
      <!-- The right side of the navigation bar -->
      <ul class="nav navbar-nav navbar-right">
        <li>
          <p class="navbar-text" data-toggle="popover" data-placement="auto" data-trigger="hover" data-content="Cookies must be enabled in your browser!"><?php
            // Check the ability to use Cookie
            if (SetCookie("TestCookie", "Success")) { ?>
              <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <?php } else { ?>
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            <?php }
          ?> Cookie</p>

          <p class="navbar-text" data-toggle="popover" data-placement="auto" data-trigger="hover" data-content="Before the work necessary to configure!"><?php
            // Checking the portal settings
            if (isset($_COOKIE['BOT_TOKEN']) OR isset($_POST['BOT_TOKEN'])) { ?>
              <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <?php } else { ?>
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            <?php }
          ?> Settings</p>
        </li>
      </ul><!-- navbar-right -->
    </div>
  </div><!-- container -->
</nav>
<!-- End navigation bar -->
