<?php
echo "
<table class='table table-sm'>
  <tbody>
    <tr>
      <td>
        {$language[$locale]["LABEL_SHIPPING_TYPE"]}:
      </td>
      <th class='text-right'>";
        if($_POST["shipping_type"]=="SEA" or $_POST["shipping_type"]=="LARGE PARCEL"){
          echo $language[$locale]["PRODUCT_SEA"];
        }
        else if($_POST["shipping_type"]=="AIR"){
          echo $language[$locale]["PRODUCT_AIR"];
        }

      echo "
      </th>
    </tr>
    <tr>
      <td>
        {$language[$locale]["LABEL_PARCEL_TYPE"]}:
      </td>
      <th class='text-right'>";
        if($parcel_type=="SP"){
          echo $language[$locale]["PRODUCT_SP"];
        }
        else if($parcel_type=="LP"){
          echo $language[$locale]["PRODUCT_LP"];
        }
      echo "
      </th>
    </tr>
    <tr>
      <td>
        {$language[$locale]["LABEL_ROW_COUNT"]} / {$language[$locale]["LABEL_PARCEL_COUNT"]}:
      </td>
      <th class='text-right'>
        {$_POST["row_cnt"]} / {$total_qty}
      </th>
    </tr>
    <tr>
      <td>";
        if($_POST["shipping_type"]=="LARGE PARCEL"){
          echo "{$language[$locale]["LABEL_CHR_M3"]}:";
        } else {
          echo "{$language[$locale]["LABEL_CHR_WEIGHT"]}:";
        }

      echo
      "</td>
      <th class='text-right'>";
        if($_POST["shipping_type"]=="LARGE PARCEL"){
          echo $total_chr_value . " M3 " ;
          if($total_chr_value < 0.3){
            //echo "<br>( {$language[$locale]["MSG_MIN_SPEND"]} 0.3 M3 )";
            //$total_chr_value = 0.3;
          }
        } else {
          echo $total_chr_value . " KG" ;

        }
      echo "
      </th>
    </tr>
  </tbody>
</table>";

if($_POST["shipping_type"]<>"LARGE PARCEL"){
  if(CALCULATOR::Check_Over_Length_Fee($max_length) <> 0){
    echo "
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        📏 <strong>{$language[$locale]["PRODUCT_OVER_LENGTH_FEE"]} ( {$max_length} CM ) : RM " . number_format(CALCULATOR::Check_Over_Length_Fee($max_length),2) . "</strong>
      </div>";
  }
}
if($max_length > 250){
  echo "
  <div class='alert alert-danger alert-dismissible fade show' role='alert'>
    📏 <strong>{$language[$locale]["ALERT_OVER_LENGTH"]} ( {$max_length} CM )<br><small>{$language[$locale]["MSG_ASK_CUSTOMER_SERVICE"]}</small></strong>
  </div>";

}
if($_POST["shipping_type"] == "LARGE PARCEL"){
  if($total_chr_value < 0.3){
    echo "
      <div class='alert alert-warning alert-dismissible fade show' role='alert'>
        🔴 <strong>{$language[$locale]["MSG_MIN_SPEND"]} 0.3 M3</strong>
      </div>";
    $total_chr_value = 0.3;
  }
}
?>
