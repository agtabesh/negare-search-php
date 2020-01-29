<?php
require('config.php');
require('../NegareSearch.php');

$searchInstance = new NegareSearch($apiUrl, $managementApiKey);
$searchInstance->enableVerbose();
$products = [
  	[
		"id" => 1001,
		"title" => "شلوار کتان مردانه",
		"description" => "طراحی ساده و کاربردی، در دو رنگ",
		"category" => "پوشاک",
		"published" => "1",
		"price" => 53900
	],[
		"id" => 1002,
		"title" => "شلوار پارچه ای مردانه",
		"description" => "ساده و کلاسیک،دوخت تمیز در 5 رنگ",
		"category" => "پوشاک",
		"published" => "1",
		"price" => 38500
	],[
		"id" => 1003,
		"title" => "پیراهن پشمی",
		"description" => "دوخت تمیز،سبک و راحت،در 7 رنگ",
		"category" => "پوشاک",
		"published" => "0",
		"price" => 62400
	]
];

// store documents
$searchInstance->store($products);
