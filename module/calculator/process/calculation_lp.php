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
        {$language[$locale]["PRODUCT_SEA_LP_HUB"]}
      </td>
      <th class='text-right'>";
        echo number_format(CALCULATOR::Calc_Sea_LP_hub($total_chr_value),2) ;

      echo "
      </th>
    </tr>
    <tr>
      <td>
        {$language[$locale]["PRODUCT_SEA_LP_KV"]}
      </td>
      <th class='text-right'>";
        echo number_format(CALCULATOR::Calc_Sea_LP_KV($total_chr_value),2) ;

      echo "
      </th>
    </tr>
    <tr>
      <td>
        {$language[$locale]["PRODUCT_SEA_LP_WM"]}
      </td>
      <th class='text-right'>";
        echo number_format(CALCULATOR::Calc_Sea_LP_WM($total_chr_value),2) ;

      echo "
      </th>
    </tr>
  </tbody>
</table>
";
?>
