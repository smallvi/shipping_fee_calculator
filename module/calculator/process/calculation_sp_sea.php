<?php
echo "
<table class='table table-sm'>
  <thead>
    <tr class='table-info'>
      <th>
        {$language[$locale]["LABEL_TYPE"]}
      </th>
      <th class='text-right'>
        {$language[$locale]["LABEL_TOTAL"]} (MYR)
      </th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        {$language[$locale]["PRODUCT_SEA_SP_HUB"]}
      </td>
      <th class='text-right'>";
        echo number_format(CALCULATOR::Calc_Sea_SP_Hub_Fee($total_chr_value),2) ;
      echo "
      </th>
    </tr>
    <tr>
      <td>
        {$language[$locale]["PRODUCT_SEA_SP_DELIVERY"]} <br><small>({$language[$locale]["MSG_MIN_SPEND"]} " . CALCULATOR::$min_kg_sea_sp_delivery . " KG</small>)
      </td>
      <th class='text-right'>";
        $total_price = CALCULATOR::Calc_Sea_SP_Delivery_Fee($total_chr_value) + CALCULATOR::Check_Over_Length_Fee($max_length);
        echo number_format($total_price,2) ;
        echo "<br>";
        CALCULATOR::Gen_Over_Length_icon($max_length,$language[$locale]["MSG_INC_OVER_LENGTH_FEE"]);
      echo "
      </th>
    </tr>
    <tr>
      <td>
        DDP101 {$language[$locale]["PRODUCT_SEA_SP_DDP"]}
      </td>
      <th class='text-right'>";
        if(CALCULATOR::Calc_Sea_SP_DDP($total_chr_value)==0){
          echo "{$language[$locale]["MSG_NOT_AVAILABLE"]} <br><small>({$language[$locale]["MSG_MAX_CHR_WEIGHT"]} " . CALCULATOR::$max_kg_sp_ddp101 . " KG )</small>";
        } else {
          $total_price = CALCULATOR::Calc_Sea_SP_DDP($total_chr_value) + CALCULATOR::Check_Over_Length_Fee($max_length);
          echo number_format($total_price,2) ;
          echo "<br>";
          echo "<small>📍 {$language[$locale]["MSG_INC_SELF_COLLECT_CHR"]}</small>";
          echo "<br>";
          CALCULATOR::Gen_Over_Length_icon($max_length,$language[$locale]["MSG_INC_OVER_LENGTH_FEE"]);
        }

      echo "
      </th>
    </tr>
  </tbody>
</table>
";
?>
