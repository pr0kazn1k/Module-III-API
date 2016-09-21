<!-- Start navigation bar -->
<nav class="navbar navbar-default navbar-fixed-top">
  <!-- Loaded banner GitHub -->
  <a href="https://github.com/valentineus/Module-III-API">
    <img class="github-fork">
  </a>
  <!-- Filling panel -->
  <div class="container">
    <div class="collapse navbar-collapse">
      <!-- The right side of the navigation bar -->
      <ul class="nav navbar-nav navbar-right">
        <li>
          <p class="navbar-text"><?php
            // Check the ability to use Cookie
            if (SetCookie("TestCookie", "Success")) { ?>
              <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            <?php } else { ?>
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            <?php }
          ?> Cookie</p>
        </li>
      </ul><!-- navbar-right -->
    </div>
  </div><!-- container -->
</nav>
<!-- End navigation bar -->
