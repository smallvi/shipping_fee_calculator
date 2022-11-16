<?php
  //include_once("../../../config.php");
  //include_once("../../../class/db.php");
  session_start();
  include_once("../../../class/language.php");
  include_once("../../../class/function.php");
  include_once("../../../module/calculator/class/calculator.php");

  if(
    ! isset($_POST["qty_1"]) or
    ! isset($_POST["row_cnt"]) or
    ! isset($_POST["shipping_type"])
  ){
    exit("<strong>". $language[$locale]["ERROR"] . ": " . $language[$locale]["ERROR_ISSET"] . " : " . $language[$locale]["ERROR_CONTACT_ADMIN"] . "</strong>");
  }

  if(empty($_POST["shipping_type"])){
    exit("<strong>". $language[$locale]["ERROR"] . ": " . $language[$locale]["ERROR_EMPTY"] . " : " . $language[$locale]["LABEL_SHIPPING_TYPE"] . "</strong>");
  }

  if($_POST["shipping_type"] == "SEA" OR $_POST["shipping_type"] == "AIR"){
    $parcel_type = "SP";
  } else if($_POST["shipping_type"] == "LARGE PARCEL") {
    $parcel_type = "LP";
  }

  $total_chr_value = 0;
  $max_length = 0;
  $total_qty = 0;

  for( $c = 1 ; $c <= $_POST["row_cnt"] ; $c++){
    $qty = "qty_" . $c ;
    $length = "length_" . $c ;
    $width = "width_" . $c ;
    $height = "height_" . $c ;
    $kg = "kg_" . $c ;

    if(
      ! is_numeric($_POST[$qty]) or
      ! is_numeric($_POST[$kg]) or
      ! is_numeric($_POST[$length]) or
      ! is_numeric($_POST[$width]) or
      ! is_numeric($_POST[$height])
    ){
      exit("<strong>" . $language[$locale]["ERROR"] . ": " . $language[$locale]["ERROR_INVALID_NUMBER"] . " : " . $language[$locale]["ERROR_PLS_CHECK_ROW"] . " " . $c . "</strong>") ;
    }
    $max_length = max($max_length,$_POST[$length],$_POST[$width],$_POST[$height]);
    $chr_value = CALCULATOR::getChrVal($parcel_type,$_POST[$qty],$_POST[$kg],$_POST[$length],$_POST[$width],$_POST[$height]);
    $total_chr_value = $total_chr_value + $chr_value;
    $total_qty = $total_qty + $_POST[$qty] ;
  }
echo "
  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    ⚠️<strong>{$language[$locale]["ALERT_SHIPPING_FEE_CALCULATOR_RESULT_REFERENCE"]}</strong>
    <br><small>{$language[$locale]["ALERT_SHIPPING_FEE_CALCULATOR_FINAL_DATA_BASED_ON_OUR_HUBCN"]}</small>
  </div>";
  if($parcel_type=="SP"){
    $total_chr_value = ceil($total_chr_value);
  }
  else if ($parcel_type=="LP"){
    $total_chr_value = $total_chr_value * 10000 ;
    $total_chr_value = ceil($total_chr_value);
    $total_chr_value = $total_chr_value / 10000 ;
  }

  include_once("calculation_chr_val.php"); //Result Header

  if($_POST["shipping_type"] == "SEA"){
    include_once("calculation_sp_sea.php");
  }
  else if($_POST["shipping_type"] == "AIR"){
    include_once("calculation_sp_air.php");
  }
  else if($_POST["shipping_type"] == "LARGE PARCEL"){
    include_once("calculation_lp.php");
  }
?>
