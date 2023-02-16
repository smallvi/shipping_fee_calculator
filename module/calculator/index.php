<?php

include_once("class/form.php");
include_once("inc/modal.php");
include_once("module/calculator/class/calculator.php");


$calculator = new CALCULATOR();

$select_value = array(
  array("SEA", $language[$locale]["PRODUCT_SEA"] . " - " . $language[$locale]["PRODUCT_SP"]),
  array("AIR", $language[$locale]["PRODUCT_AIR"] . " - " . $language[$locale]["PRODUCT_SP"]),
  array("LARGE PARCEL", $language[$locale]["PRODUCT_SEA"] . " - " . $language[$locale]["PRODUCT_LP"])
);

//$parcel_count = 1;
?>

<div class='row'>
  <div class='col-sm-12' style='overflow-x:auto;''>
  		<div class=' card shadow mb-4'>
    <div class='card-header py-3'>
      <h4 class='m-0 font-weight-bold text-primary'>
        <?= $language[$locale]["TITLE_SHIPPING_FEE_CALCULATOR"]; ?>
      </h4>
    </div>
    <div class='card-body'>


      <?= "<a class='btn btn-success act-add-row mr-3 mb-3'>+ {$language[$locale]["BTN_ADD_ROW"]}</a>"; ?>
      <?= "<a class='btn btn-danger act-remove-row mr-3 mb-3'>- {$language[$locale]["BTN_DEL_ROW"]}</a>"; ?>

      <?php if (!isset($_GET['lang'])) : ?>
        <?php if (empty($_GET['lang'])) : ?>
          <a id='btn-language-calc' class='btn btn-secondary mr-3 mb-3 float-right'>EN / 中</a>
        <?php endif; ?>
      <?php endif; ?>

      <form id='form_calc'>
        <?php FORM::SelectOption2Dimension("shipping_type", "shipping_type", "", 1, "", $language[$locale]["LABEL_SELECT"] . $language[$locale]["LABEL_SHIPPING_TYPE"], $select_value); ?>

        <div class='table-responsive'>
          <table class='table table-sm'>
            <thead>
              <tr class='table-info'>
                <th style='width: 5%'><?= $language[$locale]["TABLE_COL_NO"]; ?></th>
                <th style='width: 15%'><?= $language[$locale]["TABLE_COL_QTY"]; ?></th>
                <th style='width: 20%'><?= $language[$locale]["TABLE_COL_KG"]; ?></th>
                <th style='width: 20%'><?= $language[$locale]["TABLE_COL_LENGTH"]; ?></th>
                <th style='width: 20%'><?= $language[$locale]["TABLE_COL_WIDTH"]; ?></th>
                <th style='width: 20%'><?= $language[$locale]["TABLE_COL_HEIGHT"]; ?></th>
              </tr>
            </thead>
            <tbody id='table_calc'>
              <tr id='tr_1'>
                <td>
                  1
                </td>
                <td>
                  <input name='qty_1' class='form-control' type='number' style='width:8rem;'>
                </td>
                <td>
                  <input name='kg_1' class='form-control' type='number' style='width:8rem;'>
                </td>
                <td>
                  <input name='length_1' class='form-control' type='number' style='width:8rem;'>
                </td>
                <td>
                  <input name='width_1' class='form-control' type='number' style='width:8rem;'>
                </td>
                <td>
                  <input name='height_1' class='form-control' type='number' style='width:8rem;'>
                </td>
                <td>

                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </form>
      <a class='btn btn-bg btn-primary mr-1 mb-3 act-calc'><?= $language[$locale]["BTN_CALCULATE"]; ?></a>
    </div>
  </div>
</div>
</div>

<script>
  var locale = "<?= $locale; ?>";
  var row_cnt = 1;
  $(".act-add-row").click(function() {
    row_cnt++;
    var append_text = "<tr id='tr_" + row_cnt + "'>" +
      "<td>" + row_cnt + "</td>" +
      "<td><input name='qty_" + row_cnt + "' class='form-control' type='number' style='width:8rem;'></td>" +
      "<td><input name='kg_" + row_cnt + "' class='form-control' type='number' style='width:8rem;'></td>" +
      "<td><input name='length_" + row_cnt + "' class='form-control' type='number' style='width:8rem;'></td>" +
      "<td><input name='width_" + row_cnt + "' class='form-control' type='number' style='width:8rem;'></td>" +
      "<td><input name='height_" + row_cnt + "' class='form-control' type='number' style='width:8rem;'></td>" +
      "</tr>";
    $("#table_calc").append(append_text);
  });

  $(".act-remove-row").click(function() {
    if (row_cnt > 1) {
      $("#tr_" + row_cnt).remove();
      row_cnt--;
    }

  });

  $(".act-calc").click(function() {

    $.ajax({
      type: "POST",
      url: 'module/calculator/process/calculation.php?lang=' + locale,
      data: $("#form_calc").serialize() + "&row_cnt=" + row_cnt,
      success: function(result) {

        $('#modal .modal-header').removeClass('bg-info bg-warning bg-danger text-white');
        if (result.includes("ERROR") == false && result.includes("错误") == false) {
          $("#modal .modal-title").html("<?= $language[$locale]["HEADER_ESTIMATED_RESULT"]; ?>");
          $('#modal .modal-header').addClass('bg-info text-white');
        } else {
          $("#modal .modal-title").html("<?= $language[$locale]["ERROR"]; ?>");
          $('#modal .modal-header').addClass('bg-danger text-white');
        }
        $("#modal .modal-body").html(result);
        $("#modal").modal("show");
      },
      failure: function() {
        alert("Error");
      }
    });
  });

  $('#btn-language-calc').click(function() {
    //var locale = $('#btn-language-text').text();
    var locale = '<?= $_SESSION["locale"]; ?>';
    if (locale == "EN") {
      locale = "CN";
      $('#btn-language-text').text(locale);
    } else if (locale == "CN") {
      locale = "EN";
      $('#btn-language-text').text(locale);
    }

    $.ajax({
      type: "POST",
      url: 'change_language.php',
      //data: {locale : locale},
      success: function(result) {
        location.reload();
      },
      failure: function() {
        alert("Error");
      }
    });

  });
</script>