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
        {$language[$locale]["PRODUCT_AIR_SP_NORMAL"]}
      </td>
      <th class='text-right'>";
        $total_price = CALCULATOR::Calc_Air_SP_Normal($total_chr_value) + CALCULATOR::Check_Over_Length_Fee($max_length);
        echo number_format($total_price,2) ;
        echo "<br>";
        CALCULATOR::Gen_Over_Length_icon($max_length,$language[$locale]["MSG_INC_OVER_LENGTH_FEE"]);
      echo "
      </th>
    </tr>
    <tr>
      <td>
        {$language[$locale]["PRODUCT_AIR_SP_NORMAL_TAX"]}
      </td>
      <th class='text-right'>";
        $total_price = CALCULATOR::Calc_Air_SP_Normal_Tax($total_chr_value) + CALCULATOR::Check_Over_Length_Fee($max_length);
        echo number_format($total_price,2) ;
        echo "<br>";
        CALCULATOR::Gen_Over_Length_icon($max_length,$language[$locale]["MSG_INC_OVER_LENGTH_FEE"]);
      echo "
      </th>
    </tr>
    <tr>
      <td>
        {$language[$locale]["PRODUCT_AIR_SP_SENSITIVE"]}
      </td>
      <th class='text-right'>";
        $total_price = CALCULATOR::Calc_Air_SP_Sensitive($total_chr_value) + CALCULATOR::Check_Over_Length_Fee($max_length);
        echo number_format($total_price,2) ;
        echo "<br>";
        CALCULATOR::Gen_Over_Length_icon($max_length,$language[$locale]["MSG_INC_OVER_LENGTH_FEE"]);
      echo "
      </th>
    </tr>
    <tr>
      <td>
        {$language[$locale]["PRODUCT_AIR_SP_SENSITIVE_TAX"]}
      </td>
      <th class='text-right'>";
        $total_price = CALCULATOR::Calc_Air_SP_Sensitive_Tax($total_chr_value) + CALCULATOR::Check_Over_Length_Fee($max_length);
        echo number_format($total_price,2) ;
        echo "<br>";
        CALCULATOR::Gen_Over_Length_icon($max_length,$language[$locale]["MSG_INC_OVER_LENGTH_FEE"]);
      echo "
      </th>
    </tr>
  </tbody>
</table>
";
?>
