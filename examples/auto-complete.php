<?php
require('config.php');
require('../NegareSearch.php');

$searchInstance = new NegareSearch($apiUrl, $accessApiKey);
$searchInstance->enableVerbose();
$params = [
	"query" => "شلوار",
	"inFields" => ["title", "description"],
	"returnFields" => ["id","title","description", "price"],
	"page" => 1,
	"perPage" => 10
];
$result = $searchInstance->autoComplete($params);
print_r($result);
