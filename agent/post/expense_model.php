<?php
defined('FROM_POST_HANDLER') || die("Direct file access is not allowed");

$date = sanitizeInput($_POST['date']);
$amount = floatval($_POST['amount']);
$account = intval($_POST['account']);
$vendor = intval($_POST['vendor']);
$client_id = intval($_POST['client_id']);
$category = intval($_POST['category']);
$description = sanitizeInput($_POST['description']);
$reference = sanitizeInput($_POST['reference']);
