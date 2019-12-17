<?php
require_once __DIR__ . '/vendor/autoload.php';
include_once 'Model/Product.php';
include_once 'Model/User.php';

session_start();
$product = unserialize($_COOKIE['productCookie']);
$todayDate = date('d/M/Y');
$productPrice = number_format((float)$product->productPrice, 2, '.', '');
$loggedInUser = $_SESSION['login'];
$barcode = $loggedInUser->userID.$product->productID;
$html = "
<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: '.' center;
}

.productImage{
        height: 40px;
        margin-right: 30px;
}

.barcode{
        margin-top: 100px;
}
</style>
</head>
<body>
<!--mpdf
<htmlpageheader name='myheader'>
<table width='100%'><tr>
<td width='50%' style='color:#0000BB; '><span style='font-weight: bold; font-size: 14pt;'>631290.infhaarlem</span><br />Bijdorplaan 15<br />Haarlem<br />2015 CE<br /><span style='font-family:dejavusanscondensed;'>&#9742;</span> 023 541 2412</td>
<td width='50%' style='text-align: right;'>Invoice No.<br /><span style='font-weight: bold; font-size: 12pt;'>$barcode</span></td>
</tr></table>
</htmlpageheader>
<htmlpagefooter name='myfooter'>
<div style='border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; '>
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>
<sethtmlpageheader name='myheader' value='on' show-this-page='1' />
<sethtmlpagefooter name='myfooter' value='on' />
mpdf-->
<div style='text-align: right'>Date: $todayDate</div>
<table width='100%' style='font-family: serif;' cellpadding='10'><tr>
<td width='100%' style='border: 0.1mm solid #888888; '><span style='font-size: 7pt; color: #555555; font-family: sans;'>SOLD TO:</span><br /><br />$loggedInUser->userName $loggedInUser->userSurname<br />$loggedInUser->userEMail<br /></td>
<td width='10%'>&nbsp;</td>
</tr></table>
<br />
<table class='items' width='100%' style='font-size: 9pt; border-collapse: collapse; ' cellpadding='8'>
<thead>
<tr>
<td width='15%'>Product ID.</td>
<td width='45%'>Description</td>
<td width='15%'>Unit Price</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<tr>
<td align='center'>$product->productID</td>
<td><img class='productImage' src='images/$product->productImage'>$product->productName</td>
<td class='cost'>&euro;$productPrice</td>
</tr>
<!-- END ITEMS HERE -->
<tr>
<td class='blanktotal' colspan='2' rowspan='6'></td>
<td class='totals'>Subtotal:</td>
<td class='totals cost'>&euro;$productPrice</td>
</tr>
<tr>
<td class='totals'>Shipping:</td>
<td class='totals cost'>FREE</td>
</tr>
<tr>
<td class='totals'><b>TOTAL:</b></td>
<td class='totals cost'><b>$productPrice</b></td>
</tr>
</tbody>
</table>
<div class='barcode'>
<barcode code='$barcode' type='EAN13' size='2.0' height='0.5' />
</div>
</body>
</html>
";
var_dump($barcode);
try{
$mpdf = new \Mpdf\Mpdf([
	'margin_left' => 20,
	'margin_right' => 15,
	'margin_top' => 48,
	'margin_bottom' => 25,
	'margin_header' => 10,
	'margin_footer' => 10
]);
$mpdf->SetTitle('631290InfHaarlem.com - Invoice');
$mpdf->SetAuthor('631290InfHaarlem');
$mpdf->WriteHTML($html);
$mpdf->Output();
}catch (\Mpdf\MpdfException $e) { 
    echo $e->getMessage();
}