<?php
class CALCULATOR {
  public static $unit_price_sea_sp_hub = 3.40;

  public static $unit_price_sea_sp_delivery = 5.50;
  public static $min_kg_sea_sp_delivery = 5;

  public static $unit_price_sea_sp_ddp101 = 3.40;
  public static $collect_fee_sea_sp_ddp101 = 5;
  public static $kg_per_unit_sea_sp_ddp101 = 5;
  public static $max_kg_sp_ddp101 = 10;

  public static $unit_price_sea_sp_ddp201 = 3.40;
  public static $collect_fee_sea_sp_ddp201 = 10;
  public static $kg_per_unit_sea_sp_ddp201 = 5;
  public static $max_kg_sp_ddp201 = 10;

  public static $unit_price_sea_lp_hub_tier_a = 570;
  public static $unit_price_sea_lp_hub_tier_b = 550;
  public static $unit_price_sea_lp_hub_tier_c = 540;

  public static $unit_price_sea_lp_kv_tier_a = 640;
  public static $unit_price_sea_lp_kv_tier_b = 590;
  public static $unit_price_sea_lp_kv_tier_c = 570;

  public static $unit_price_sea_lp_wm_tier_a = 670;
  public static $unit_price_sea_lp_wm_tier_b = 620;
  public static $unit_price_sea_lp_wm_tier_c = 620;

  public static $min_m3_sea_lp = 0.3;
  public static $m3_sea_lp_tier_a = 1;
  public static $m3_sea_lp_tier_b = 5;

  public static $unit_price_air_sp_normal_a = 27.50 ;
  public static $unit_price_air_sp_normal_b = 27.00 ;
  public static $unit_price_air_sp_normal_c = 26.50 ;

  public static $unit_price_air_sp_normal_tax_a = 29.50 ;
  public static $unit_price_air_sp_normal_tax_b = 29.00 ;
  public static $unit_price_air_sp_normal_tax_c = 28.50 ;

  public static $unit_price_air_sp_sensitive_a = 30.50 ;
  public static $unit_price_air_sp_sensitive_b = 30.00 ;
  public static $unit_price_air_sp_sensitive_c = 29.50 ;

  public static $unit_price_air_sp_sensitive_tax_a = 32.50 ;
  public static $unit_price_air_sp_sensitive_tax_b = 32.00 ;
  public static $unit_price_air_sp_sensitive_tax_c = 31.50 ;

  public static function getChrVal($type="SP",$qty=1,$kg=1,$length=0,$width=0,$height=0,$vol_kg=6000,$vol_size=400){

    if(! isset($kg) or $kg ==0){
      return "ERROR: KG is empty" ;
    } else {
      if($type == "SP"){
        $kg = $kg * 10 ;
        $kg = ceil($kg);
        $kg = $kg / 10;
        $kg_total = $qty * $kg ;
        $kg_vol = ($qty * ceil($length) * ceil($width) * ceil($height) ) / $vol_kg ;
        $kg_chr = 0 ;
        if($kg_total > $kg_vol){
          $kg_chr = $kg_total;
        }else{
          $kg_chr = $kg_vol;
        }
        return $kg_chr;
      } else if ($type == "LP"){
        $m3_total = ($qty * ceil($length) * ceil($width) * ceil($height) ) / 1000000 ;
        $m3_vol = ($qty * $kg) / $vol_size ;
        $m3_chr = 0 ;
        if($m3_total > $m3_vol){
          $m3_chr = $m3_total;
        } else {
          $m3_chr = $m3_vol;
        }
        return $m3_chr;
      }

    }
  }

  public static function Calc_Sea_SP_Hub_Fee($kg){
    return ceil($kg) * self::$unit_price_sea_sp_hub ;
  }

  public static function Calc_Sea_SP_Delivery_Fee($kg){
    if($kg < 5){
      return 5 * self::$unit_price_sea_sp_delivery ;
    }
    return ceil($kg) * self::$unit_price_sea_sp_delivery ;
  }

  public static function Calc_Sea_SP_DDP($kg){
    if($kg > self::$max_kg_sp_ddp101){
      return 0;
    }
    $collect_fee = ceil(ceil($kg) / self::$kg_per_unit_sea_sp_ddp101) * self::$collect_fee_sea_sp_ddp101 ;
    return (ceil($kg) * self::$unit_price_sea_sp_ddp101) + $collect_fee ;
  }

  public static function Calc_Air_SP_Normal($kg){
    if($kg <=3){
      return $kg * self::$unit_price_air_sp_normal_a ;
    }
    else if ( $kg >= 4 and $kg <= 10){
      return $kg * self::$unit_price_air_sp_normal_b ;
    }
    else if ( $kg >= 11 ){
      return $kg * self::$unit_price_air_sp_normal_c ;
    }
  }

  public static function Calc_Air_SP_Normal_Tax($kg){
    if($kg <=3){
      return $kg * self::$unit_price_air_sp_normal_tax_a ;
    }
    else if ( $kg >= 4 and $kg <= 10){
      return $kg * self::$unit_price_air_sp_normal_tax_b ;
    }
    else if ( $kg >= 11 ){
      return $kg * self::$unit_price_air_sp_normal_tax_c ;
    }
  }

  public static function Calc_Air_SP_Sensitive($kg){
    if($kg <=3){
      return $kg * self::$unit_price_air_sp_sensitive_a ;
    }
    else if ( $kg >= 4 and $kg <= 10){
      return $kg * self::$unit_price_air_sp_sensitive_b ;
    }
    else if ( $kg >= 11 ){
      return $kg * self::$unit_price_air_sp_sensitive_c ;
    }
  }

  public static function Calc_Air_SP_Sensitive_Tax($kg){
    if($kg <=3){
      return $kg * self::$unit_price_air_sp_sensitive_tax_a ;
    }
    else if ( $kg >= 4 and $kg <= 10){
      return $kg * self::$unit_price_air_sp_sensitive_tax_b ;
    }
    else if ( $kg >= 11 ){
      return $kg * self::$unit_price_air_sp_sensitive_tax_c ;
    }
  }

  public static function Calc_Sea_LP_hub($m3){
    if($m3 <= self::$min_m3_sea_lp){
      return 0.3 * self::$unit_price_sea_lp_hub_tier_a  ;
    }
    else if ($m3 > self::$min_m3_sea_lp and $m3 < self::$m3_sea_lp_tier_a) {
      return $m3 * self::$unit_price_sea_lp_hub_tier_a  ;
    }
    else if ($m3 >= self::$m3_sea_lp_tier_a and $m3 < self::$m3_sea_lp_tier_b) {
      return $m3 * self::$unit_price_sea_lp_hub_tier_b  ;
    }
    else if ($m3 >= self::$m3_sea_lp_tier_b) {
      return $m3 * self::$unit_price_sea_lp_hub_tier_c  ;
    }
  }

  public static function Calc_Sea_LP_KV($m3){
    if($m3 <= self::$min_m3_sea_lp){
      return 0.3 * self::$unit_price_sea_lp_kv_tier_a  ;
    }
    else if ($m3 > self::$min_m3_sea_lp and $m3 < self::$m3_sea_lp_tier_a) {
      return $m3 * self::$unit_price_sea_lp_kv_tier_a  ;
    }
    else if ($m3 >= self::$m3_sea_lp_tier_a and $m3 < self::$m3_sea_lp_tier_b) {
      return $m3 * self::$unit_price_sea_lp_kv_tier_b  ;
    }
    else if ($m3 >= self::$m3_sea_lp_tier_b) {
      return $m3 * self::$unit_price_sea_lp_kv_tier_c  ;
    }
  }

  public static function Calc_Sea_LP_WM($m3){
    if($m3 <= self::$min_m3_sea_lp){
      return 0.3 * self::$unit_price_sea_lp_wm_tier_a  ;
    }
    else if ($m3 > self::$min_m3_sea_lp and $m3 < self::$m3_sea_lp_tier_a) {
      return $m3 * self::$unit_price_sea_lp_wm_tier_a  ;
    }
    else if ($m3 >= self::$m3_sea_lp_tier_a and $m3 < self::$m3_sea_lp_tier_b) {
      return $m3 * self::$unit_price_sea_lp_wm_tier_b  ;
    }
    else if ($m3 >= self::$m3_sea_lp_tier_b) {
      return $m3 * self::$unit_price_sea_lp_wm_tier_c  ;
    }
  }

  public static function Check_Over_Length_Fee($max_length){
    if( $max_length >= 80 and $max_length <= 120 ){
      return 30;
    }
    else if ( $max_length >= 121 and $max_length <= 149 ){
      return 50;
    }
    else if ( $max_length >= 150 ){
      return 120;
    }
    else if ( $max_length < 80){
      return 0;
    }
  }

  public static function Gen_Over_Length_icon($max_length, $text){
    if(self::Check_Over_Length_Fee($max_length) <> 0){
      $text = "📏 " . $text . " " . number_format(self::Check_Over_Length_Fee($max_length),2) ;
      echo " <small data-bs-toggle='tooltip' data-bs-placement='bottom' title='{$text}'>{$text}</small>";
    }
  }
}
?>
