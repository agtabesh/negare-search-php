<?php
require('config.php');
require('../NegareSearch.php');

$searchInstance = new NegareSearch($apiUrl, $managementApiKey);
$searchInstance->enableVerbose();
$product = [
	"id" => 1001,
	"title" => "شلوار کتان مردانه",
	"description" => "طراحی ساده و کاربردی، در دو رنگ",
	"category" => "پوشاک",
	"published" => "1",
	"price" => 53901
];

// update document
$searchInstance->update(1001, $product);
