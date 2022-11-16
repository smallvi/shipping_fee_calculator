<?php
  if(isset($_GET['lang']) or !empty($_GET['subject'])){
    if(strtoupper($_GET['lang']) == "EN"){
      $_SESSION["locale"] = "EN";
    }
    else if(strtoupper($_GET['lang']) == "CN"){
      $_SESSION["locale"] = "CN";
    }
    else{
      $_SESSION["locale"] = "EN";
    }
  }

  if(empty($_SESSION["locale"]) or !isset($_SESSION["locale"])){
    $_SESSION["locale"] = "EN";
  }

  $locale = $_SESSION["locale"] ;

  //Alert
  $language["CN"]["ALERT_SHIPPING_FEE_CALCULATOR_ESTIMATE_PURPOSE"] = "此运费计算机仅用于估算用途";
  $language["EN"]["ALERT_SHIPPING_FEE_CALCULATOR_ESTIMATE_PURPOSE"] = "This shipping fee calculator only for estimate purpose";

  $language["CN"]["ALERT_SHIPPING_FEE_CALCULATOR_FINAL_DATA_BASED_ON_OUR_HUBCN"] = "最终运费将以我司仓库测量的尺寸和重量为准";
  $language["EN"]["ALERT_SHIPPING_FEE_CALCULATOR_FINAL_DATA_BASED_ON_OUR_HUBCN"] = "The final weight and size data will be based on our warehouse's measurement";

  $language["CN"]["ALERT_SHIPPING_FEE_CALCULATOR_RESULT_REFERENCE"] = "此运费估算结果仅供参考";
  $language["EN"]["ALERT_SHIPPING_FEE_CALCULATOR_RESULT_REFERENCE"] = "This estimated price is for reference only";

  $language["CN"]["ALERT_OVER_LENGTH"] = "长度超长";
  $language["EN"]["ALERT_OVER_LENGTH"] = "The length is too long";

  //Button
  $language["CN"]["BTN_CALCULATE"] = "计算";
  $language["EN"]["BTN_CALCULATE"] = "Calculate";

  $language["CN"]["BTN_ADD_ROW"] = "添加行";
  $language["EN"]["BTN_ADD_ROW"] = "Add Row";

  $language["CN"]["BTN_DEL_ROW"] = "删除行";
  $language["EN"]["BTN_DEL_ROW"] = "Remove Row";

  $language["CN"]["BTN_CLOSE"] = "关闭";
  $language["EN"]["BTN_CLOSE"] = "Close";

  //ERROR
  $language["CN"]["ERROR"] = "错误";
  $language["EN"]["ERROR"] = "ERROR";

  $language["CN"]["ERROR_CONTACT_ADMIN"] = "请联系管理员";
  $language["EN"]["ERROR_CONTACT_ADMIN"] = "Please contact administrator";

  $language["CN"]["ERROR_INVALID_NUMBER"] = "无效号码";
  $language["EN"]["ERROR_INVALID_NUMBER"] = "Invalid Number";

  $language["CN"]["ERROR_PLS_CHECK_ROW"] = "请检查行";
  $language["EN"]["ERROR_PLS_CHECK_ROW"] = "Please check Row";

  $language["CN"]["ERROR_EMPTY"] = "空值";
  $language["EN"]["ERROR_EMPTY"] = "Empty";

  $language["CN"]["ERROR_ISSET"] = "变量为空值";
  $language["EN"]["ERROR_ISSET"] = "Variable is EMPTY";

  //Header
  $language["CN"]["HEADER_ESTIMATED_RESULT"] = "预估结果";
  $language["EN"]["HEADER_ESTIMATED_RESULT"] = "Estimated Result";


  //Label
  $language["CN"]["LABEL_SELECT"] = "选择";
  $language["EN"]["LABEL_SELECT"] = "Select";

  $language["CN"]["LABEL_SHIPPING_TYPE"] = "运输类型";
  $language["EN"]["LABEL_SHIPPING_TYPE"] = "Shipping Type";

  $language["CN"]["LABEL_PARCEL_TYPE"] = "包裹类型";
  $language["EN"]["LABEL_PARCEL_TYPE"] = "Parcel Type";

  $language["CN"]["LABEL_PARCEL_TYPE"] = "包裹类型";
  $language["EN"]["LABEL_PARCEL_TYPE"] = "Parcel Type";

  $language["CN"]["LABEL_CHR_WEIGHT"] = "计费重";
  $language["EN"]["LABEL_CHR_WEIGHT"] = "Chargeable Weight";

  $language["CN"]["LABEL_CHR_M3"] = "计费体积";
  $language["EN"]["LABEL_CHR_M3"] = "Chargeable M3";

  $language["CN"]["LABEL_TYPE"] = "类型";
  $language["EN"]["LABEL_TYPE"] = "Type";

  $language["CN"]["LABEL_TOTAL"] = "总计";
  $language["EN"]["LABEL_TOTAL"] = "Total";

  $language["CN"]["LABEL_ROW_COUNT"] = "行数";
  $language["EN"]["LABEL_ROW_COUNT"] = "Row Count";

  $language["CN"]["LABEL_PARCEL_COUNT"] = "包裹数";
  $language["EN"]["LABEL_PARCEL_COUNT"] = "Parcel Count";

  //Message
  $language["CN"]["MSG_INC_OVER_LENGTH_FEE"] = "已包含超长费";
  $language["EN"]["MSG_INC_OVER_LENGTH_FEE"] = "Inc Over Length Fee";

  $language["CN"]["MSG_NOT_AVAILABLE"] = "不适用";
  $language["EN"]["MSG_NOT_AVAILABLE"] = "N/A";

  $language["CN"]["MSG_OR_ABOVE"] = "或以上";
  $language["EN"]["MSG_OR_ABOVE"] = "or above";

  $language["CN"]["MSG_ASK_CUSTOMER_SERVICE"] = "请先咨询客服";
  $language["EN"]["MSG_ASK_CUSTOMER_SERVICE"] = "Please contact customer service first";

  $language["CN"]["MSG_MIN_SPEND"] = "最低消费";
  $language["EN"]["MSG_MIN_SPEND"] = "Min Spend";

  $language["CN"]["MSG_MAX_CHR_WEIGHT"] = "最大计费重";
  $language["EN"]["MSG_MAX_CHR_WEIGHT"] = "Max Chr Weight";

  $language["CN"]["MSG_INC_SELF_COLLECT_CHR"] = "已包含自提费";
  $language["EN"]["MSG_INC_SELF_COLLECT_CHR"] = "Inc Self-Collect Charges";
  //Table
  $language["CN"]["TABLE_COL_NO"] = "序";
  $language["EN"]["TABLE_COL_NO"] = "No";

  $language["CN"]["TABLE_COL_QTY"] = "数量";
  $language["EN"]["TABLE_COL_QTY"] = "Qty";

  $language["CN"]["TABLE_COL_KG"] = "公斤";
  $language["EN"]["TABLE_COL_KG"] = "KG";

  $language["CN"]["TABLE_COL_LENGTH"] = "长";
  $language["EN"]["TABLE_COL_LENGTH"] = "Length";

  $language["CN"]["TABLE_COL_WIDTH"] = "宽";
  $language["EN"]["TABLE_COL_WIDTH"] = "Width";

  $language["CN"]["TABLE_COL_HEIGHT"] = "高";
  $language["EN"]["TABLE_COL_HEIGHT"] = "Height";

  //Title
  $language["CN"]["TITLE_SHIPPING_FEE_CALCULATOR"] = "运费计算机";
  $language["EN"]["TITLE_SHIPPING_FEE_CALCULATOR"] = "Shipping Fee Calculator";

  //Product
  $language["CN"]["PRODUCT_SEA"] = "海运";
  $language["EN"]["PRODUCT_SEA"] = "SEA Freight";

  $language["CN"]["PRODUCT_AIR"] = "空运";
  $language["EN"]["PRODUCT_AIR"] = "Air Freight";

  $language["CN"]["PRODUCT_SP"] = "小包裹";
  $language["EN"]["PRODUCT_SP"] = "Small Parcel";

  $language["CN"]["PRODUCT_LP"] = "大货";
  $language["EN"]["PRODUCT_LP"] = "Large Parcel";

  $language["CN"]["PRODUCT_SEA_SP_HUB"] = "仓库自提";
  $language["EN"]["PRODUCT_SEA_SP_HUB"] = "HUB MY Self-Collect";

  $language["CN"]["PRODUCT_SEA_SP_DELIVERY"] = "派送";
  $language["EN"]["PRODUCT_SEA_SP_DELIVERY"] = "Delivery";

  $language["CN"]["PRODUCT_SEA_SP_DDP"] = "取货点自提";
  $language["EN"]["PRODUCT_SEA_SP_DDP"] = "Drop Point Self-Collect";

  $language["CN"]["PRODUCT_AIR_SP_NORMAL"] = "普货";
  $language["EN"]["PRODUCT_AIR_SP_NORMAL"] = "Normal Product";

  $language["CN"]["PRODUCT_AIR_SP_NORMAL_TAX"] = "普货包税";
  $language["EN"]["PRODUCT_AIR_SP_NORMAL_TAX"] = "Normal Product inc Tax";

  $language["CN"]["PRODUCT_AIR_SP_SENSITIVE"] = "敏感货";
  $language["EN"]["PRODUCT_AIR_SP_SENSITIVE"] = "Sensitive Product";

  $language["CN"]["PRODUCT_AIR_SP_SENSITIVE_TAX"] = "敏感货包税";
  $language["EN"]["PRODUCT_AIR_SP_SENSITIVE_TAX"] = "Sensitive Product inc Tax";

  $language["CN"]["PRODUCT_SEA_LP_HUB"] = "仓库自提";
  $language["EN"]["PRODUCT_SEA_LP_HUB"] = "HUB MY Self-Collect";

  $language["CN"]["PRODUCT_SEA_LP_KV"] = "派送 - 巴生谷";
  $language["EN"]["PRODUCT_SEA_LP_KV"] = "Delivery - Klang Valley";

  $language["CN"]["PRODUCT_SEA_LP_WM"] = "派送 - 西马主要城市";
  $language["EN"]["PRODUCT_SEA_LP_WM"] = "Delivery - Major Town West MY";

  $language["CN"]["PRODUCT_OVER_LENGTH_FEE"] = "超长费";
  $language["EN"]["PRODUCT_OVER_LENGTH_FEE"] = "Over Length Fee";
?>
