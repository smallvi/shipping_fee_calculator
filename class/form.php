<?php
class FORM {
  public static $required_text;

  public static function MultiCheckBox($typeName="phone",$required=0,$readonly=0,$array_value=""){
		if($typeName==""){
			$typeName="phone";
		}
		if($array_value==""){
			$array_value = array("Realme 6", "Redmi Note 8");
		}
    if($required=="" or $required==0){
			$required_text = "";
		} else {
      $required_text = "required" ;
    }
    if($readonly=="" or $readonly==0){
			$readonly_text = "";
		} else {
      $readonly_text = "readonly" ;
    }
		$array_count = count($array_value);
    echo "Please select: <br>";
		for( $r = 0 ; $r < $array_count ; $r++ ){
			echo "
      <input type='checkbox' id='" . $typeName . "_" . $r . "' name='" . $typeName . "_" . $r . "' value='" . $array_value[$r] . "' " . $required_text . " " . $readonly_text . ">
	  	<label for='" . $typeName . "_" . $r . "'> " . $array_value[$r] . "</label><br>
			";
		}
	}

  public static function CheckBox($id="id_check_box",$input_name="priority_check_box",$required=0,$label="High Prority",$checked=1){
		if($id==""){
			$id="id_check_box";
		}
		if($input_name==""){
			$input_name="priority_check_box";
		}
    if($required=="" or $required==0){
      $required_text = "";
      $required_asterisk = "";
    } else {
      $required_text = "required" ;
      $required_asterisk = "<span class='text-danger'>*</span>";
    }
		if($label==""){
			$label="High Prority";
		}
		if($checked==0){
			$checked="";
		} else if ($checked==1) {
			$checked="checked";
		}

		echo "<div class='custom-control custom-switch custom-switch-off-danger custom-switch-on-success mb-3'>
			<input type='checkbox' name='" . $input_name . "' class='custom-control-input' id='customSwitch3' " . $checked . "  >
			<label class='custom-control-label' for='customSwitch3'>" . $label . "</label>
		</div>
		";
	}

  public static function Radio($input_name="YN_radio",$required=0,$array_value=""){
		if($input_name==""){
			$input_name="YN_radio" ;
		}
		if($array_value ==""){
			$array_value = array("Yes","No");
		}
    //self:: requiredInput(1);
    if($required=="" or $required==0){
      $required_text = "";
      $required_asterisk = "";
    } else {
      $required_text = "required" ;
      $required_asterisk = "<span class='text-danger' style='font-weight:bold;'>*</span>";
    }
		$array_count = count($array_value);
    echo  $required_asterisk . " Please select: <br>";
		for( $r = 0 ; $r < $array_count ; $r++ ){
			echo "
			<input type='radio' id='" . $array_value[$r] . "' name='" . $input_name . "' value='" . $array_value[$r] . "' " . $required_text . ">
	  	<label for='" . $array_value[$r] . "'>" . $array_value[$r] . "</label>
			<br>
			";
		}
	}

  public static function MonthSelectOption($id="month",$input_name="month",$required=0,$selectText="Select month",$labelText="Choose a month",$textType=0){
		if($id==""){
			$id="month" ;
		}
		if($input_name==""){
			$input_name="month" ;
		}
		if($selectText==""){
			$selectText="Select month" ;
		}
		if($labelText==""){
			$labelText="Choose a month" ;
		}
    if($required=="" or $required==0){
      $required_text = "";
      $required_asterisk = "";
    } else {
      $required_text = "required" ;
      $required_asterisk = "<span class='text-danger' style='font-weight:bold;'>*</span>";
    }
		$month[0] = array(1,2,3,4,5,6,7,8,9,10,11,12);
		$month[1] = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","DEC");
		if($required==0){
			$requiredText = "";
		} else if ($required==1){
			$requiredText = "required";
		}

		echo "
		<label for='" . $id . "'>" . $required_asterisk . " " . $labelText . ":</label>
		<select id='" . $id . "' class='form-select mb-3 form-control-lg' aria-label='Default select example' name='" . $input_name . "' " . $required_text . ">
			<option value=''>" . $selectText . "</option>" ;
			for( $r = 0 ; $r < 12 ; $r++ ){
				echo "<option value='" . $month[$textType][$r] . "'>" . $month[$textType][$r] . "</option>" ;
			}
		echo "</select>";
	}

  public static function YearSelectOption($id="year",$input_name="year",$required=0,$selectText="Select year",$labelText="Choose a year",$startYear=2020,$endYear=0){
		if($id==""){
			$id="year" ;
		}
		if($input_name==""){
			$input_name="year" ;
		}
		if($endYear == 0 or $endYear == ""){
			$endYear = date("Y");
		}
		if($startYear > $endYear){
			exit("ERROR : Invalid Year Selection");
		}

    if($required=="" or $required==0){
      $required_text = "";
      $required_asterisk = "";
    } else {
      $required_text = "required" ;
      $required_asterisk = "<span class='text-danger' style='font-weight:bold;'>*</span>";
    }

		$year = $startYear ;
		echo "<label for='" . $id . "'>" . $required_asterisk . " " . $labelText . ": </label>" ;
		echo "<select id='" . $id . "' class='form-select mb-3 form-control-lg' aria-label='Default select example' name='" . $input_name . "' " . $required_text . ">";
			echo "<option value=''>" . $selectText . "</option>" ;
			for( $year = $startYear ; $year < ($endYear+1) ; $year++ ){
				echo "<option value='" . $year . "'>" . $year . "</option>" ;
			}
		echo "</select>";
	}

  public static function DateSelectOption(
    $id="date",
    $input_name="date",
    $required=0,
    //$selectText="Select Date",
    $labelText="Choose a date",
    $default_value_yn = 0,
    $value="",
    $min="2019-01-01",
    $max=""
  ){
    if($id==""){
      $id="date" ;
    }
    if($input_name==""){
      $input_name="date" ;
    }

    if($required=="" or $required==0){
      $required_text = "";
      $required_asterisk = "";
    } else {
      $required_text = "required" ;
      $required_asterisk = "<span class='text-danger' style='font-weight:bold;'>*</span>";
    }
    if($max==""){
      $max= date("Y-m-d", strtotime("Dec 31"));
    }
    if($default_value_yn == 1){
      if($value==""){
        $value= date("Y-m-d");
      }
    }

    if($labelText==""){
      $labelText= "Choose a date";
    }

    echo "<label for='" . $id . "'>" . $required_asterisk . " " . $labelText . "</label>" ;
		echo "<div class='input-group date mb-3'>
			<input
        id='" . $id . "'
        type='date'
        class='form-control'
        name='" . $input_name . "'
        value='" . $value . "'
        min='" . $min . "'
        max='" . $max . "' />
			<div class='input-group-append'>
				<div class='input-group-text'><i class='fa fa-calendar'></i></div>
			</div>
		</div>";
  }

  public static function TextInput(
    $id="",
    $input_name="",
    $required=0,
    $labelText="Text:",
    $value="",
    $label_yn=1,
    $placeholder=""
  ){
    if($id==""){
			$id="text" ;
		}
		if($input_name==""){
			$input_name="text" ;
		}
    if($value == ""){
			$default_value = "" ;
		}else {
      $default_value = "value='{$value}'" ;
    }
    if($required=="" or $required==0){
      $required_text = "";
      $required_asterisk = "";
    } else {
      $required_text = "required" ;
      $required_asterisk = "<span class='text-danger' style='font-weight:bold;'>*</span>";
    }
    if($label_yn==1){
      echo "<label for='" . $id . "'>" . $required_asterisk . " " . $labelText . "</label>" ;
    }
		echo "<div class='input-group date mb-3'>
			<input
        id='{$id}'
        type='text'
        class='form-control'
        name='{$input_name}'
        {$default_value}
        placeholder='{$placeholder}'
      />
		</div>";
  }

  public static function SelectOption($id="",$input_name="",$required=0,$selectText="Select",$labelText="Select",$select_value,$size=""){
    if($required=="" or $required==0){
      $required_text = "";
      $required_asterisk = "";
    } else {
      $required_text = "required" ;
      $required_asterisk = "<span class='text-danger' style='font-weight:bold;'>*</span>";
    }

		if($required==0){
			$requiredText = "";
		} else if ($required==1){
			$requiredText = "required";
		}

    if($size == ""){
      $size = "form-control" ;
    } else if ($size == "s"){
      $size = "form-control-sm" ;
    } else if($size == "l"){
      $size = "form-control-lg" ;
    }

    $count_select_value = count($select_value);
    echo "
		<label for='{$id}'> {$required_asterisk} {$labelText}:</label>
		<select id='{$id}' class='form-select mb-3 {$size}' aria-label='Default select example' name='{$input_name}' {$required_text}>
			<option value=''>{$selectText}</option>" ;
			for( $r = 0 ; $r < $count_select_value ; $r++ ){
        if($select_value[$r] == "SEA"){
          echo "<option selected='selected' value='{$select_value[$r]}'>{$select_value[$r]}</option>" ;
        }
        else {
          echo "<option value='{$select_value[$r]}'>{$select_value[$r]}</option>" ;
        }

			}
		echo "</select>";
  }

  public static function SelectOption2Dimension($id="",$input_name="",$class_name="",$required=0,$selectText="Select",$labelText="Select",$select_value){
    if($required=="" or $required==0){
      $required_text = "";
      $required_asterisk = "";
    } else {
      $required_text = "required" ;
      $required_asterisk = "<span class='text-danger' style='font-weight:bold;'>*</span>";
    }

    if($required==0){
      $requiredText = "";
    } else if ($required==1){
      $requiredText = "required";
    }

    $count_select_value = count($select_value);
    echo "
    <label for='{$id}'> {$required_asterisk} {$labelText}:</label>
    <select id='{$id}' class='{$class_name} form-select mb-3 form-control-lg' aria-label='Default select example' name='{$input_name}' {$required_text}>
      <option value=''>{$selectText}</option>" ;
      for( $r = 0 ; $r < $count_select_value ; $r++ ){
        echo "<option value='{$select_value[$r][0]}'>{$select_value[$r][1]}</option>" ;
      }
    echo "</select>";
  }

}
?>
