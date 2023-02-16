<?php
//防止SQL INJECTION的 坚持Input 方法
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	//$data = strtoupper($data);
	return $data;
}

function writeMsg($fmsg)
{
	echo "$fmsg" . "<br>";
}

function UserValidating($fsecureno)
{

	global $useraccessright;

	if ($useraccessright == "All") {
		return "1";
	} else if (($fsecureno == "Admin") and ($useraccessright == "Admin Only")) {
		return "1";
	} else {
		echo "<p><h3>You have no right!</h3></p>";
		return "0";
	}
}

function GetDateDiff($date1, $date2, $unit = "d")
{
	$date1 = strtotime($date1);
	$date2 = strtotime($date2);
	//echo "test: " . $date1 . "   /   " . $date2 . "<br>";
	$datediff = abs($date1 - $date2);
	if ($unit == "Y") {
		$datediff = $datediff / (365 * 24 * 60 * 60);
	} else if ($unit == "d") {
		$datediff = $datediff / (24 * 60 * 60);
	}
	return $datediff;
}

function GetPercentage($pre_value, $new_value, $digit)
{
	if ($pre_value == 0) {
		$percentage = 0;
	} else {
		$percentage = ($new_value - $pre_value) / $pre_value * 100;
		$percentage = number_format($percentage, $digit, ".", "");
	}

	return $percentage;
}

function GenerateCardSingleValue($name_en, $name_cn, $value, $front_prefix, $end_prefix, $value_digit, $direction = "left", $color = "primary", $iconyn = 0, $icon = "calender")
{
	// echo "<div class='col-sm-3'>" ;
	// echo "<div style='margin:10px;' class='card card-body'>" ;

	// echo "<h5>" . $name_en . "<br>" . $name_cn . "<br><br>" . $front_prefix . " " . number_format($value,$value_digit,".",",") . " " . $end_prefix . "</h5>" ;

	// echo "</div>" ;
	// echo "</div>" ;

	//Earnings (Monthly) Card Example
	echo "
		<div class='col-xl-3 col-md-6 mb-4'>
			<div class='card border-" . $direction . "-" . $color . " shadow h-100 py-2'>
				<div class='card-body'>
					<div class='row no-gutters align-items-center'>
						<div class='col mr-2'>
							<div class='text-xs font-weight-bold text-primary text-uppercase mb-1'>
								" . $name_en . "<br>" . $name_cn . "
							</div>
							<div class='h5 mb-0 font-weight-bold text-gray-800'>
							" . $front_prefix . " " . number_format($value, $value_digit, ".", ",") . " " . $end_prefix . "
							</div>
						</div> ";
	if ($iconyn == 1) {
		echo "<div class='col-auto'>
								<i class='fas fa-" . $icon . " fa-2x text-gray-300'></i>
							</div> ";
	}

	echo "</div>
				</div>
			</div>
		</div>
		";
}

function GenerateCardPreviousVSCurrent($name_en, $name_cn, $front_prefix, $end_prefix, $previous_value, $current_value, $value_digit, $versus = "year")
{
	$fee_percent = GetPercentage($previous_value, $current_value, 0);
	if ($versus = "" or $versus = "year") {
		$versus_text = "vs. Last Year";
	}
	echo "
			<div style='margin:10px;' class='card card-body'>
				<div class='text-dark font-weight-bold'>
					<h5>" .
		$name_en .
		"<br>" .
		$name_cn .
		"
					</h5>
					<br>
					<h3>" .
		$front_prefix . " ";

	if ($current_value == 0) {
		echo "-";
	} else {
		echo number_format($current_value, $value_digit, '.', ',');
	}

	echo " " . $end_prefix .
		"
					</h3>
					<h5>
					";

	if ($previous_value == 0 & $current_value == 0) {
		echo "<span class='badge bg-secondary' style='color:white;'> " . $fee_percent;
	} else if ($previous_value == 0) {
		echo "<span class='badge bg-success' style='color:white;'><i class='fas fa-caret-up'></i> 100";
	} else if ($current_value - $previous_value < 0) {
		echo "<span class='badge bg-danger' style='color:white;'><i class='fas fa-caret-down'></i> " . $fee_percent;
	} else if ($current_value - $previous_value > 0) {
		echo "<span class='badge bg-success' style='color:white;'><i class='fas fa-caret-up'></i> " . $fee_percent;
	}

	echo "
						%</span>
					</h5>
				</div>

			{$versus_text}
			</div>";
}

function BarwaaTrackingButton($tracking)
{
	if ($tracking == "" or substr($tracking, 0, 6) == "等待") {
		echo "<span class='badge bg-danger' style='color:white;'>Pending...</span>";
	} else {
		$url = "https://www.barwaa.com/tracking?no=" . $tracking;
		echo "<a href='" . $url . "' target='_blank' class='btn btn-dark btn-sm mb-1'>Barwaa</a>";
	}
}

function TrackingMyButton($trackingmy, $type)
{

	$trackingmy = test_input($trackingmy);

	$pattern = "/[-\/:]/";
	$components = preg_split($pattern, $trackingmy);
	$tracking_qty = sizeof($components);


	if ($trackingmy == "" or substr($trackingmy, 0, 6) == "等待") {
		//blank
		if ($type <> "drop_point") {
			echo "Pending...";
		}
	} else {
		if ($type == "self_collect" or $type == "drop_point") {
			//echo $trackingmy ;
			for ($x = 0; $x < $tracking_qty; $x++) {
				echo $components[$x];
			}
		} else {
			for ($x = 0; $x < $tracking_qty; $x++) {
				echo "<a onclick='linkTrack(this.innerText)' class='btn btn-warning btn-sm mb-1'>" . $components[$x] . "</a><br>";
			}
		}
	}

	echo "<script src='//www.tracking.my/track-button.js'></script>";
	echo "<script>";
	echo "function linkTrack(num) {";
	echo "TrackButton.track({";
	echo "tracking_no: num";
	echo "});";
	echo "}";
	echo "</script>";
}

function TrackingBaiduButton($tracking_cn, $show_tracking = 1)
{

	$tracking_cn = test_input($tracking_cn);

	if ($show_tracking == 1) {
		echo $tracking_cn . " ";
	}

	//echo substr($tracking_cn,0,2) ;
	echo "<a href='";
	if (substr($tracking_cn, 0, 2) == "SF") {
		//顺丰
		echo "https://www.sf-international.com/my/sc/dynamic_function/waybill/#search/bill-number/" . $tracking_cn;
	} else {
		echo "https://www.baidu.com/s?ie=utf-8&tn=baidu&wd=" . $tracking_cn;
	}
	echo "' target='_blank' ><i class='fas fa-search'></i></a>";
}

function generateScannerBtn($invno)
{
	echo "<a class='' href='module/invoice/process/scanner_new.php?inv=" . $invno . "' target='_blank'><i class='fas fa-barcode'></i></a>";
}




function WriteLog($name, $msg)
{

	$filename = "txt_log/" . $name . "-" . $_SESSION["user"] . "-" . date("Y-m-d") . "-" . session_id() . ".txt";

	$msg = str_replace("<br>", "\n", $msg);
	$msg = "\n" . $msg;
	$myfile = fopen($filename, "a") or die("Unable to open file!");

	fwrite($myfile, $msg);
	fclose($myfile);
}

function ExportCSV($foldername, $name, $array)
{
	//writemsg("start");
	$list = $array;
	$filename = $foldername . "/" . $name . ".csv";
	//writemsg($filename);
	$file = fopen($filename, 'w');
	foreach ($list as $line) {
		fputcsv($file, $line);
	}
	fclose($file);
}

function GenerateInvoiceButton($invno)
{
	//echo "<a href='ModInv.php?invno=" . $invno . "' target='_blank' ><i class='fas fa-file-invoice-dollar'></i></a>" ;
	echo "<a href='index.php?mod=invoice&invno=" . $invno . "' target='_blank' ><i class='fas fa-file-invoice-dollar'></i></a>";
}

function GenerateBankSlipDownloadButton($filename)
{
	echo "<a href='https://admin.deliboy.com.my/external/wallet_receipt/" . $filename . "' target='_blank'><i class='fas fa-credit-card'></i></a>";
}

function ClientCodeButton($clientcode)
{

	$clientcode = test_input($clientcode);

	if ($clientcode <> "") {
		//echo $clientcode . " " ;
		echo "<a href='index.php?mod=client&code=" . substr($clientcode, -5);

		echo "' target='_blank'><i class='fas fa-address-card'></i></a>";
	} else {
		echo "Unknown";
	}
}

function DeliveryOrderButton($invno, $size)
{
	if ($invno <> "") {
		if ($size == '0') {
			echo "<a href='module/pdf/pdf_delivery_order.php?invno=" . strtoupper($invno) . "' target='_blank'><i class='fas fa-print'></i></a>";
		} else if ($size == '1') {
			echo "<a class='btn btn-info btn-lg' href='module/pdf/pdf_delivery_order.php?invno=" . strtoupper($invno) . "' target='_blank'><i class='fas fa-print'></i> Print DO</a>";
		}
	}
}


function GetReceiptID($invno = "")
{
	if ($invno == "") {
		return 0;
	}
	$invno = test_input($invno);

	$sql = "
				SELECT id
				from db_receipt
				where receipt_no = '" . $invno . "'
			";

	global $conn;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {

		while ($row = $result->fetch_assoc()) {
			$receipt_id = $row["id"];
			//echo $receipt_id ;
		}
	} else {
		//echo "Record not found";
		return 0;
		//exit("Record not found");
	}
	return $receipt_id;
}
function GetETA($pl_no)
{

	$pl_no = test_input($pl_no);

	if ($pl_no <> "") {
		$sql = "
					SELECT max(customer_eta) as eta FROM `db_container` where pl_no = '" . $pl_no . "'
				";

		global $conn;

		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				if ($row["eta"] == "0000-00-00 00:00:00") {
					$eta = "Pending...";
				} else {
					$eta = date("Y-m-d", strtotime($row["eta"]));
				}
			}
		} else {
			//echo "Record not found";
		}
	} else {
		$eta = "Pending...";
	}
	return $eta;
}

function GetMYShelf($tracking)
{
	$shelf = "";
	$tracking = test_input($tracking);

	$sql = "
					SELECT shelf FROM db_hub_parcel_my where tracking_no_cn = '" . $tracking . "'
					and is_active <> '2'
				";
	//writeMsg($sql);
	global $conn;

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			if ($row["shelf"] == "") {
				$shelf = "";
			} else {
				$shelf = $row["shelf"];
			}
		}
	} else {
		//echo "Record not found";
	}

	return $shelf;
}

function GetClientID($client_code)
{

	$client_code = test_input($client_code);

	$sql = "select id from db_client where customer_code = '" . $client_code . "'";
	global $conn;

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$clientid = $row["id"];
		}
	} else {
		//echo "Record not found";
	}

	return $clientid;
}

function GetClientCode($client_id)
{

	$client_id = test_input($client_id);

	$sql = "select customer_code from db_client where id = '" . $client_id . "'";
	global $conn;

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$customer_code = $row["customer_code"];
		}
	} else {
		//echo "Record not found";
	}

	return $customer_code;
}

function CheckExist($tablename, $colname, $value)
{
	global $conn;
	$sql = "select " . $colname . " from " . $tablename . " where " . $colname . " = '" . $value . "' and is_active <> '2'";

	//writemsg($sql);
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$exist = 1;
	} else {
		$exist = 0;
	}
	return $exist;
}

function GetCreditBalance($clientcode)
{

	global $conn;

	$sql = "
		select credit_available
		from db_client
		where customer_code='" . test_input($clientcode) . "'
		";

	//writemsg($sql);
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$user_balance = number_format($row["credit_available"], 2, ".", "");
		}
	} else {
		$user_balance = 0;
	}
	return $user_balance;
}

function GetValueByColname($target_col = "", $table_name = "", $search_col = "", $search_val = "")
{

	$target_col = test_input($target_col);
	$table_name = test_input($table_name);
	$search_col = test_input($search_col);
	$search_val = test_input($search_val);

	if ($target_col == "" or $table_name == "" or $search_col == "" or $search_val == "") {
		exit("ERROR: Invalid");
	}

	global $conn;

	$sql = "
		select " . $target_col . "
		from " . $table_name . "
		where " . $search_col . " = '" . $search_val . "'
		";

	//writemsg($sql);
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$target_val = $row[$target_col];
		}
	} else {
		$target_val = 0;
		exit("ERROR: Invalid");
	}
	return $target_val;
}

function DeliveryTypeTranslate($type, $iconyn = "0")
{
	$translated = "";
	if ($type == "self_collect") {
		if ($iconyn == "1") {
			$translated = "<i class='fas fa-warehouse'></i> HUB Collect";
		} else {
			$translated = $translated . "HUB Collect";
		}
		//$translated = "<i class='fas fa-warehouse'></i> HUB Collect" ;
	} else if ($type == "drop_point") {
		if ($iconyn == "1") {
			$translated = "<i class='fas fa-map-marker-alt'></i> DP Collect";
		} else {
			$translated = $translated . "DP Collect";
		}
		//$translated = "<i class='fas fa-map-marker-alt'></i> DP Collect" ;
	} else if ($type == "door_delivery") {
		if ($iconyn == "1") {
			$translated = "<i class='fas fa-truck'></i> Delivery";
		} else {
			$translated = $translated . "Delivery";
		}
	} else if ($type == "delivery_my_west") {
		if ($iconyn == "1") {
			$translated = "<i class='fas fa-truck'></i> Delivery - LP West MY";
		} else {
			$translated = $translated . "Delivery - LP West MY";
		}
	} else if ($type == "delivery_klang") {
		if ($iconyn == "1") {
			$translated = "<i class='fas fa-truck'></i> Delivery - LP Klang";
		} else {
			$translated = $translated . "Delivery - LP Klang";
		}
	} else if ($type == "without_inland") {
		$translated = "Normal w/o Tax";
	} else if ($type == "with_inland") {
		$translated = "Normal with Tax";
	} else if ($type == "sensitive_without_inland") {
		$translated = "Sensitive w/o Tax";
	} else if ($type == "sensitive_with_inland") {
		$translated = "Sensitive with Tax";
	} else {
		$translated = $type;
	}
	return $translated;
}

function StatusTranslate($status = "")
{
	if ($status == "sea_own_collect_hub") {
		$translated = "<span style='color:green;font-weight:bold;'><i class='fas fa-check-square'></i> Ready to Collect (HUB MY)</span>";
	} else if ($status == "sea_own_collect_drop") {
		$translated = "<span style='color:green;font-weight:bold;'><i class='fas fa-check-square'></i> Ready to Collect (Drop Point)</span>";
	} else if ($status == "sea_ready") {
		$translated = "<span style='color:green;font-weight:bold;'><i class='fas fa-check-square'></i> Ready to Delivery</span>";
	} else if ($status == "reach_hub_my") {
		$translated = "<span class='badge bg-danger' style='color:white;'>Pending...</span>";
	} else if ($status == "air_processing") {
		$translated = "<span class='badge bg-danger' style='color:white;'>Pending...</span>";
	} else if ($status == "loading_container") {
		$translated = "<i class='fas fa-truck-loading'></i> Loading Container";
	} else if ($status == "in_transit_sea") {
		$translated = "<i class='fas fa-ship'></i> In Transit";
	} else if ($status == "air_in_transit_air") {
		$translated = "<i class='fas fa-plane-departure'></i> In Transit";
	} else if ($status == "air_delivery") {
		$translated = "<span style='color:green;font-weight:bold;'><i class='fas fa-truck'></i> Out of Delivery</span>";
	} else if ($status == "sea_collected") {
		$translated = "<i class='fas fa-check-circle'></i> Collected";
	} else if ($status == "sea_delivered" or $status == "air_delivered") {
		$translated = "<i class='fas fa-check-circle'></i> Delivered";
	} else if ($status == "sea_delivery") {
		$translated = "<span style='color:green;font-weight:bold;'><i class='fas fa-truck'></i> Out of Delivery</span>";
	} else if ($status == "delay_shipping") {
		$translated = "<span style='color:red;font-weight:bold;'>🔴 Delay - Shipping Line</span>";
	} else if ($status == "delay_port") {
		$translated = "<span style='color:red;font-weight:bold;'>🔴 Delay - Port Congestion</span>";
	} else if ($status == "delay_my") {
		$translated = "<span style='color:red;font-weight:bold;'>🔴 Delay - MY Custom Inspection</span>";
	} else if ($status == "air_delay_cn" or $status == "delay_cn") {
		$translated = "<span style='color:red;font-weight:bold;'>🔴 Delay - CN Custom Inspection</span>";
	} else if ($status == "air_undeliver" or $status == "sea_undeliver") {
		$translated = "<span style='color:red;font-weight:bold;'>🔴 Unsuccessful Delivery</span>";
	} else if ($status == "air_reach_courier_my" or $status == "sea_reach_courier_my") {
		$translated = "<span style='color:blue;font-weight:bold;'>🔵 Inbound Courier Hub MY</span>";
	} else if ($status == "air_in_transit_courier") {
		$translated = "<span style='color:blue;font-weight:bold;'>🔵 Courier MY Collected</span>";
	} else if ($status == "haulage_pull") {
		$translated =
			"
				Custom Clearance
			";
	} else {
		$translated = $status;
	}
	return $translated;
}

function ParcelTypeTranslate($parcel_type = "")
{
	if ($parcel_type == "") {
		$translated = $parcel_type;
	} else if ($parcel_type == "SP") {
		$translated = "<i class='fas fa-box'></i> Small Parcel";
	} else if ($parcel_type == "LP") {
		$translated = "<i class='fas fa-couch'></i> Large Parcel";
	}
	return $translated;
}

function FreightCodeTranslate($freight_code)
{
	if ($freight_code == "SEA") {
		$translated = "<i class='fas fa-ship'></i> Sea";
	} else if ($freight_code == "AIR") {
		$translated = "<i class='fas fa-plane-departure'></i> Air";
	}
	return $translated;
}

function GetMaxReceivedDateByHubMy($receipt_no)
{
	$sql = "
			SELECT max(received_date) AS received_date
			FROM db_hub_parcel_my
			WHERE receipt_id = (SELECT id FROM db_receipt WHERE receipt_no = '" . $receipt_no . "')
		";
	global $conn;

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$received_date = $row["received_date"];
		}
	}
	return $received_date;
}

function GenerateMeasurementColData($parcel_type, $qty, $long, $height, $width, $m3, $kg, $vol_weight, $vol_m3, $ch_kg, $ch_m3)
{
	echo "Qty：" . $qty . "<br>";
	echo "Size：" . $long . " * " . $height . " * " . $width;
	echo "<br>";
	echo "Act.m3：" . $m3 . " m3";
	echo "<br>";
	echo "Act.kg.：" . $kg . " kg";
	echo "<br>";
	if ($parcel_type == 'SP') {
		echo "Vol.kg: " . $vol_weight . " kg";
	} else if ($parcel_type == 'LP') {
		echo "Vol.m3: " . $vol_m3 . " kg";
	} else {
		echo "Vol.kg: " . $vol_weight . " kg";
		echo "<br>";
		echo "Vol.m3: " . $vol_m3 . " kg";
	}

	echo "<span style='font-weight:bold;'>";

	if ($parcel_type == 'SP') {
		echo "<hr>";
		echo "Ch.kg.：" . $ch_kg . " kg";
	} else if ($parcel_type == 'LP') {
		echo "<hr>";
		echo "Ch.m3.：" . $ch_m3 . " m3";
	}
	echo "<span>";
}

function GeneratePLColData($cn_date, $pl_no, $conso_no, $my_date, $eta, $paid_date = "0000-00-00 00:00:00")
{
	echo "CN：" . date("Y-m-d", strtotime($cn_date)) . "<br>";
	if ($pl_no <> "") {
		echo "PL：" . $pl_no . "<br>";
	}
	if ($conso_no <> "") {
		echo "Conso：" . $conso_no . "<br>";
	}

	if ($eta == "0000-00-00 00:00:00" or $eta == "Pending...") {
	} else {
		echo "ETA：" . date("Y-m-d", strtotime($eta)) . "<br>";
	}
	if ($my_date <> "0000-00-00 00:00:00") {
		//echo $my_date ;
		echo "MY：";
		echo date("Y-m-d", strtotime($my_date)) . "<br>";
		$date_check = $my_date;
	} else {
		$date_check = date("Y-m-d");
	}
	if (GetDateDiff($cn_date, $date_check, "d") >= 30) {
		echo "<span style='font-weight:bold;color:red;'>Operation Days: ";
		echo GetDateDiff($cn_date, $date_check, "d");
		echo "</span>";
	} else {
		echo "Operation Days: ";
		echo GetDateDiff($cn_date, $date_check, "d");
	}
	echo "<br>";
	echo "<span style='font-weight:bold;color:blue;'>";
	echo "Storage Days: ";
	if ($paid_date == "0000-00-00 00:00:00") {
		//echo "No pay";
		echo GetDateDiff($cn_date, date("Y-m-d"), "d");
	} else {
		echo number_format(GetDateDiff($cn_date, $paid_date, "d"), 0);
	}
	echo "</span>";
}

function GenerateProductColData($product_name, $value, $parcel_type, $freight_code)
{
	echo substr($product_name, 0, 30);
	echo "<br>";
	echo "￥ " . number_format($value, 2, ".", ",");
	echo "<br>";
	echo ParcelTypeTranslate($parcel_type);
	echo "<br>";
	echo FreightCodeTranslate($freight_code);
}

function GetHelpShipAirCount()
{
	$sql =
		"
		SELECT client_cocode, tracking_no_cn,
		create_date, freight_code,
		product_name, estimate_ctn,
		total_amount
		FROM `db_help_ship`
		where receive_status = 0
		AND is_active = 1
		and parcel_address_id = 0
		AND freight_code = 'AIR'
		AND estimate_ctn <> 0
		ORDER BY create_date DESC
		";

	global $conn;

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$count = $result->num_rows;
	}
	return $count;
}

function GetPendingAirDeliveryCount()
{
	$sql = "
		SELECT client_code,
		receipt_no,
		delivery_pay_date
		FROM db_hub_parcel
		WHERE conso_no = '' and
		pl_no = '' and
		container_id = '' and
		receipt_no <> '' and
		freight_code = 'AIR' and
		parcel_status <> 'air_delivered'
		group by receipt_no
		order by receipt_no
		";
	//echo $sql;
	global $conn;
	$count = 0;
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$count = $result->num_rows;
	}
	return $count;
}

function GetPendingSeaDeliveryCount()
{
	$sql = "
		SELECT delivery_conso_no, client_code, freight_code,
		parcel_count, delivery_type, my_hub_date, delivery_create_date, delivery_status
		FROM `db_hub_parcel_address` where delivery_status = 'reach_hub_my'
		order by my_hub_date
		";
	global $conn;

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$count = $result->num_rows;
	}
	return $count;
}

function mandatoryField($field_name, $mandatory = 0)
{
	if ($mandatory == 1) {
		echo "<span style='color:red;font-weight:bold;'>* </span>";
	}
	echo $field_name;
}

function dd($obj)
{
	echo "<pre>";
	var_dump($obj);
	echo "</pre>";
	die();
}
