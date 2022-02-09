<?php
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename=contacts.csv');
header('Pragma: no-cache');
readfile('contacts.csv');
?>