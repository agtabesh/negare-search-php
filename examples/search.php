<?php
require('config.php');
require('../NegareSearch.php');

$searchInstance = new NegareSearch($apiUrl, $accessApiKey);
$searchInstance->enableVerbose();
$params = [
	"query" => "شلوار",
	"inFields" => ["title", "description"],
	"returnFields" => ["id", "title", "description", "price"],
	"page" => 1,
	"perPage" => 10
];

// search for documents
$result = $searchInstance->search($params);
print_r($result);
