<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Вывод скрипта</title>
	</head>
	<body>
		<p><?php echo 'Дата оформления вклада: ' . $formData['date']; ?></p>
		<p><?php echo 'Сумма вклада: ' . $formData['deposit-sum']; ?></p>
		<p><?php echo 'Срок вклада: ' . $formData['deposit-time']; ?></p>
		<p><?php echo 'Пополнение вклада: ' . $formData['deposit-adding']; ?></p>
		<p><?php echo 'Сумма пополнения вклада: ' . $formData['deposit-adding-sum']; ?></p>
		<p><?php echo 'Валидация формы: ' . $checkResult; ?></p>
		<p><?php echo 'Ответ: ' . $answer; ?></p>
	</body>
</html>
