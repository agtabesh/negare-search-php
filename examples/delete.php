<?php
require('config.php');
require('../NegareSearch.php');

$searchInstance = new NegareSearch($apiUrl, $managementApiKey);
$searchInstance->enableVerbose();

// delete document
$searchInstance->delete(1001);
