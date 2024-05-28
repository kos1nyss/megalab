<?php

use Kondrashov\Service\CurrencyConverterService;

require_once '../../src/Kondrashov/Service/CurrencyConverterService.php';

$currencyConverterService = new CurrencyConverterService();

$from = $argv[1];
$to = $argv[2];
$amount = (float)$argv[3];

$result = $currencyConverterService->convert($from, $to, $amount);

echo "Результат вычисления: $result";