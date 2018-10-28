<?php

function GetDateArray($date)
// Разбивает дату на составные элементы
{
	$dateArray['dd'] = $date{0} . $date{1};
	$dateArray['mm'] = $date{3} . $date{4};
	$dateArray['yyyy'] = $date{6} . $date{7} . $date{8} . $date{9};
	return $dateArray;
}

function CollectFormData()
// Собирает данные формы и записывает в массив
{
	$formData['date'] = $_POST['date'];
	$formData['deposit-sum'] = $_POST['deposit-sum'];
	$formData['deposit-time'] = $_POST['deposit-time'];
	$formData['deposit-adding'] = $_POST['deposit-adding'];
	$formData['deposit-adding-sum'] = $_POST['deposit-adding-sum'];
	return $formData;
}

function CheckSeparator($date)
// Проверяет разделители в дате
{
	
	$separatorCorrect = true;
	if ($date{2} != '.' or $date{5} != '.')
	{
		$separatorCorrect = false;
	}
	return $separatorCorrect;
}

function CheckFormData($formData)
// Проверяет данные формы
{
	$lowLevel = 1000;
	$highLevel = 3000000;
	$checkResult = '';
	$continue = true;
	
	// Проверка соответствия даты
	// ------------------------------------------------------
	if ($continue == true)
	// Является ли поле (Дата оформления вклада) пустым
	{
		$long = strlen($formData['date']);
		if ($long == 0)
		{
			$continue = false;
			$checkResult = 'Заполните поле (Дата оформления вклада)';
		}
	}
	if ($continue == true)
	// Имеет ли строка, представляющая дату, соответствующую длину 
	{
		$long = mb_strlen($formData['date']);
		if ($long < 10)
		{
			$continue = false;
			$checkResult = 'Поле (Дата оформления вклада) не соответствует шаблону: дд.мм.гггг [Пример: 25.04.2013]';
		}
	}
	if ($continue == true)
	// Использованы ли в дате правильные разделители
	{
		$separatorCorrect = CheckSeparator($formData['date']);
		if ($separatorCorrect == false)
		{
			$continue = false;
			$checkResult = 'Поле (Дата оформления вклада) не соответствует шаблону: дд.мм.гггг [Пример: 25.04.2013]';
		}
	}
	if ($continue == true)
	// Являются ли элементы даты приводимыми к числовому формату
	{
		$dateArray = GetDateArray($formData['date']);
		if (!is_numeric($dateArray['dd']) or !is_numeric($dateArray['mm']) or !is_numeric($dateArray['yyyy']))
		{
			$continue = false;
			$checkResult = 'Поле (Дата оформления вклада) не соответствует шаблону: дд.мм.гггг [Пример: 25.04.2013]';
		}
	}
	if ($continue == true)
	// Существует ли названная дата
	{
		$dateArray = GetDateArray($formData['date']);
		$dateExist = checkdate($dateArray['mm'], $dateArray['dd'], $dateArray['yyyy']);
		if ($dateExist == false)
		{
			$continue = false;
			$checkResult = 'Введённой вами даты не существует';
		}
	}
	// ------------------------------------------------------
	
	// Проверка суммы вклада
	// ------------------------------------------------------
	if ($continue == true)
	// Является ли поле (Сумма вклада) пустым
	{
		$long = strlen($formData['deposit-sum']);
		if ($long == 0)
		{
			$continue = false;
			$checkResult = 'Заполните поле (Сумма вклада)';
		}
	}
	if ($continue == true)
	// Являетя ли поле (Сумма вклада) приводимым к числовому типу
	{
		if (!is_numeric($formData['deposit-sum']))
		{
			$continue = false;
			$checkResult = 'В поле (Сумма вклада) должно быть число';
		}
	}
	if ($continue == true)
	// Соответствует ли поле (Сумма вклада) заданному диапазону
	{
		if ($formData['deposit-sum'] < $lowLevel or $formData['deposit-sum'] > $highLevel)
		{
			$continue = false;
			$checkResult = 'Поле (Сумма вклада) должно содержать числа в диапазоне от 1000 до 3000000';
		}
	}
	// ------------------------------------------------------
	
	// Проверка суммы пополнения вклада
	// ------------------------------------------------------
	if ($continue == true)
	// Является ли поле (Сумма пополнения вклада) пустым
	{
		if ($formData['deposit-adding'] == 'yes')
		{
			$long = strlen($formData['deposit-adding-sum']);
			if ($long == 0)
			{
				$continue = false;
				$checkResult = 'Заполните поле (Сумма пополнения вклада)';
			}
		}
	}
	if ($formData['deposit-adding'] == 'yes')
	{
		if ($continue == true)
		// Являетя ли поле (Сумма пополнения вклада) приводимым к числовому типу
		{
			if (!is_numeric($formData['deposit-adding-sum']))
			{
				$continue = false;
				$checkResult = 'В поле (Сумма пополнения вклада) должно быть число';
			}
		}
		if ($continue == true)
		// Соответствует ли поле (Сумма пополнения вклада) заданному диапазону
		{
			if ($formData['deposit-adding-sum'] < $lowLevel or $formData['deposit-adding-sum'] > $highLevel)
			{
				$continue = false;
				$checkResult = 'Поле (Сумма пополнения вклада) должно содержать числа в диапазоне от 1000 до 3000000';
			}
		}
	}
	// ------------------------------------------------------
	
	// Если ничего не нашлось
	// ------------------------------------------------------
	if ($continue == true)
	{
		$checkResult = 'Ошибок не выявлено';
	}
	return $checkResult;
	// ------------------------------------------------------
}
