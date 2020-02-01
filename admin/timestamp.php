<?php
$date = new DateTime();
$date2 = date_timestamp_get($date)+600;
var_dump($date);
var_dump($date2);
echo variant_date_from_timestamp($date2);