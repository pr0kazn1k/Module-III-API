<?php
function ShowRecord($id) {
  for ($i=0; $i < $id; $i++) {
    $cookie = json_decode($_COOKIE['TALK'.$i], true);
    echo("<tr>");
    echo("<td>".$cookie['type']."</td>");
    echo("<td>".$cookie['textarea']."</td>");
    echo("<td>".date("H:i:s", $cookie['time'])."</td>");
    echo("</tr>");
  }
  return 0;
}

  if (isset($_COOKIE['BOT_TOKEN'])) {
    $BOT_TOKEN = $_COOKIE['BOT_TOKEN'];
  }

  if (isset($_POST['BOT_TOKEN'])) {
    unset($_COOKIE); // Clear the session
    SetCookie("BOT_TOKEN", htmlspecialchars($_POST['BOT_TOKEN']));
    $BOT_TOKEN = htmlspecialchars($_POST['BOT_TOKEN']);
  }

  if (isset($BOT_TOKEN)) {
    define('BOT_TOKEN', $BOT_TOKEN);
    $bot = new Bot(BOT_TOKEN);
    if (isset($_COOKIE['BOT_SESSION'])) {
      $session = $bot->session($_COOKIE['BOT_SESSION']);
    } else {
      $session = $bot->session();
      SetCookie("BOT_SESSION", $session);
    }
    if (!isset($session)) { ?>
      <div class="container">
        <div class="alert alert-danger" role="alert">Session is not initialized, check the settings!</div>
      </div>
    <?php }
  }

  if (isset($_POST['textarea'])) {
    $textarea = htmlspecialchars($_POST['textarea']);
    if (isset($_COOKIE['CURRENT_ID'])) {
      $current_id = (int)$_COOKIE['CURRENT_ID'];
      SetCookie('CURRENT_ID', $current_id+1);
    } else {
      $current_id = 0;
      SetCookie('CURRENT_ID', $current_id);
    }

    $cookie = array(
      'type' => 'user',
      'textarea' => $textarea,
      'time' => time()
    );
    SetCookie("TALK".$current_id, json_encode($cookie));

    $current_id = $current_id+1;
    SetCookie('CURRENT_ID', $current_id+1);
    $cookie = array(
      'type' => 'bot',
      'textarea' => $bot->say($textarea),
      'time' => time()
    );
    SetCookie("TALK".$current_id, json_encode($cookie));
  }
?>
