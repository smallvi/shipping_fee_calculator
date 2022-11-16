<?php
  session_start();

  if($_SESSION["locale"] == "EN"){
    $_SESSION["locale"] = "CN" ;
  } else if($_SESSION["locale"] == "CN"){
    $_SESSION["locale"] = "EN" ;
  }
  $locale = $_SESSION["locale"];

?>
