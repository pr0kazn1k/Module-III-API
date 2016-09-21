<?php
/**
* The function returns the current ID.
* Returns zero if no ID is stored.
*/
function GetID() {
  // Search current ID...
  if (isset($_COOKIE['CURRENT_ID'])) {
    $id = (int)$_COOKIE['CURRENT_ID'] + 1;
  // ...or returns zero
  } else {
    $id = 0;
  }
  // We issue results
  return $id;
}

/**
* Session initialization function.
* Searches saved session, producing a new
* init or returns zero on failure.
* @param $token - The values of the token.
* @param $bot - Initialized bot.
*/
function GetSession($token, $bot) {
  // Search the old session
  if (isset($_COOKIE['BOT_SESSION'])) {
    $session = $bot->session($_COOKIE['BOT_SESSION']);
  } else { // Open a new one
    $session = $bot->session();
    SetCookie("BOT_SESSION", $session);
  }

  // We issue results
  if (isset($session)) {
    return $session;
  } else {
    return 0;
  }
}

/**
* The function overrides the current ID to
* the specified or the next. If any missing ID
* returns the one.
* @param $id - Current ID.
*/
function SetID($id) {
  // Process the specified ID...
  if (isset($id)) {
    $id = $id + 1;
  // ...Or are saved...
  } elseif (isset($_COOKIE['CURRENT_ID'])) {
    $id = (int)$_COOKIE['CURRENT_ID'] + 1;
  // ...Or return one
  } else {
    $id = 1;
  }
  SetCookie('CURRENT_ID', $id, time()+300); // Save the result
  return $id; // We issue results
}

/**
* Cleaning function of the parameter that is passed to it.
* @param $type - Type cleansed.
*/
function ClearingCache($type) {
  switch ($type) {
    // Clear the cookies
    case 'cookies':
      foreach ($_COOKIE as $key => $value) {
        SetCookie($key, $value, time()-1000);
      }
      break;
    // Clear the POST
    case 'post':
      $_POST = array();
      break;
    // ...
    default:
      break;
  }
}

/**
* The function maintains a history of conversations,
* using a database of cookie files.
* @param $currentid - Message ID.
* @param $textarea - Message text.
* @param $type - Who said (Man / Bot).
*/
function SavingStories($currentid, $textarea, $type) {
  // We form an array with values
  $cookie = array(
    'type' => $type,
    'textarea' => $textarea,
    'time' => time());
  // Save by encoding in JSON-string
  SetCookie("TALK".$currentid, json_encode($cookie), time()+60);
}

/**
* Function line formation.
* @param $id - Variable Message ID.
*/
function ShowRecord($id) {
  for ($i=0; $i < $id; $i++) {
    if (isset($_COOKIE['TALK'.$i])) {
      $cookie = json_decode($_COOKIE['TALK'.$i], true);
      echo("<tr>");
      echo("<td>".$cookie['type']."</td>");
      echo("<td>".$cookie['textarea']."</td>");
      echo("<td>".date("H:i:s", $cookie['time'])."</td>");
      echo("</tr>");
    }
  }
} ?>
