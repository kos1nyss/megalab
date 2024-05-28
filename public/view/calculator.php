<?php

use Kondrashov\Manager\CurrencyManager;
use Kondrashov\Service\CurrencyConverterService;

require_once '../../src/Kondrashov/Service/CurrencyConverterService.php';
require_once '../../src/Kondrashov/Manager/CurrencyManager.php';

$request = $_SERVER;
$requestMethod = $request['REQUEST_METHOD'];
$isPost = $requestMethod === 'POST';

$currencyManager = new CurrencyManager();
$currencies = $currencyManager->getAll();
$currencyKeys = array_keys($currencies);

if ($isPost)
{
	$from = $_POST['from'];
	$to = $_POST['to'];
	$amount = $_POST['amount'];

	$currencyConverterService = new CurrencyConverterService();
	$resultOfCalculation = $currencyConverterService->convert($from, $to, $amount);
}

?>

<html>
<head>
	<link rel="stylesheet" href="../static/style.css">
</head>

<body>
<div class="content">
	<div class="result">
		<?php
		if ($isPost): ?>

			<p>Результат вычисления: <?= $resultOfCalculation ?></p>

		<?php
		endif; ?>
	</div>

	<form method="post" class="form-calculate">
		<ul>
			<li>
				<label>
					Из:

					<select name="from">
						<?php
						foreach ($currencyKeys as $currencyKey): ?>
							<option value="<?= $currencyKey ?>"><?= $currencyKey ?></option>
						<?php
						endforeach; ?>
					</select>
				</label>
			</li>

			<li>
				<label>
					В:

					<select name="to">
						<?php
						foreach ($currencyKeys as $currencyKey): ?>
							<option value="<?= $currencyKey ?>"><?= $currencyKey ?></option>
						<?php
						endforeach; ?>
					</select>
				</label>
			</li>

			<li>
				<label>
					Сумма:
					<input type="number" name="amount" required step="0.01">
				</label>
			</li>
		</ul>

		<button type="submit" class="button-calculate">Посчитать</button>
	</form>
</div>
</body>
</html>

