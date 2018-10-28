<?php

function CalDaysInYear($year)
// Служит для определения количества дней в году
// На вход поступает число, представляющее год
// Например: 2018
{
	$daysInYear = 0;
	$daysInMonth = 0;
	for ($month = 1; $month <= 12; $month++)
	{
		$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
		$daysInYear = $daysInYear + $daysInMonth;
	}
	return $daysInYear;
}

function DateAddingDays($counterDays, $dateBegin)
// Добавляем к переданной дате установленное количество дней
{
	$datePart = GetDateArray($dateBegin);
	$dateString = '';
	$dateString = $dateString . $datePart['yyyy'] . '-' . $datePart['mm'] . '-' . $datePart['dd'];
	$date = date_create($dateString);
	date_add($date, date_interval_create_from_date_string("$counterDays days"));
	$date = date_format($date, 'Y-m-d');
	return $date;
}

function AddingDaysOutput($finishDate)
// Приводим результат DateAddingDays к удобному формату
{
	$dateArray['dd'] = $finishDate{8} . $finishDate{9};
	$dateArray['mm'] = $finishDate{5} . $finishDate{6};
	$dateArray['yyyy'] = $finishDate{0} . $finishDate{1} . $finishDate{2} . $finishDate{3};
	return $dateArray;
}

function CalculateProfit($formData)
// Вычисляем прибыль от вклада
{
	// Определяем количество дней, прошедших с даты оформления вклада
	$counterYear = 0; 
	switch($formData['deposit-time'])
	{
		case 'one-year':
			$counterYear = 1;
			break;
		case 'two-years':
			$counterYear = 2;
			break;
		case 'three-years':
			$counterYear = 3;
			break;
		case 'four-years':
			$counterYear = 4;
			break;
		case 'five-years':
			$counterYear = 5;
			break;
	}
	$counterDays = 365 * $counterYear;
	
	$dateBegin = GetDateArray($formData['date']); // Дата начала расчета по вкладу
	$finishDate = DateAddingDays($counterDays, $formData['date']); // Дата окончания расчёта по вкладу
	$finishDate = AddingDaysOutput($finishDate); // Приведение даты окончания к нужному формату
	
	// Данный участок не должен учитываться в скрипте
	/*
	$string1 = $dateBegin['dd'] . '-' . $dateBegin['mm'] . '-' . $dateBegin['yyyy'];
	$string2 = $finishDate['dd'] . '-' . $finishDate['mm'] . '-' . $finishDate['yyyy'];
	*/
	
	// Определение переменных формулы
	// -----------------------------------------------------------------------
	$summn = $formData['deposit-sum']; // Сумма на счете на месяц [n] руб.
	$summnBefore = $formData['deposit-sum']; // (summn-1) Сумма на счёте на конец прошлого месяца
	$summadd = $formData['deposit-adding-sum']; // Сумма ежемесячного пополнения
	if ($formData['deposit-adding'] == 'no')
	// Будет ли пополнение вклада
	{
		$summadd = 0;
	}
	$daysn = 0; // Количество дней в данном месяце, на которые приходился вклад (заранее неизвестно)
	$percent = 0.1; // Процентная ставка банка
	$daysy = CalDaysInYear($dateBegin['yyyy']); // Количество дней в году (должны быть учтены високосные годы)
	// -----------------------------------------------------------------------
	
	$dd = $dateBegin['dd'];
	$mm = $dateBegin['mm'] - 1;
	$yyyy = $dateBegin['yyyy'];
	
	$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $dateBegin['mm'], $dateBegin['yyyy']); // Всего дней в месяце
	
	// $intermediateResults = ''; // Промежуточные результаты (отладка)
	
	do
	{
		// Правила перехода от даты к дате
		// +++++++++++++++++++++++++++++++
		$mm = $mm + 1;
		if ($mm == 13)
		{
			$mm = 1;
			$yyyy = $yyyy + 1;
			$daysy = CalDaysInYear($yyyy); // Считаем количество дней в году
			$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $mm, $yyyy); // Всего дней в месяце
		}
		// +++++++++++++++++++++++++++++++
		// Общие правила вычислений
		// +++++++++++++++++++++++++++++++
		$daysn = (int)(cal_days_in_month(CAL_GREGORIAN, $mm, $yyyy));
		if ($mm == $dateBegin['mm'] and $yyyy == $dateBegin['yyyy'])
		{
			$daysn = (int)($daysInMonth) - (int)($dateBegin['dd']) + 1;
		}
		if ($mm == $finishDate['mm'] and $yyyy == $finishDate['yyyy'])
		{
			$daysn = (int)($finishDate['dd']);
		}
		$summn = $summnBefore + ($summnBefore + $summadd) * $daysn * ($percent / $daysy);
		$summnBefore = $summn;
		// +++++++++++++++++++++++++++++++
		// $intermediateResults = $intermediateResults . " +($daysn)($mm)"; // Смотр промежуточных результатов
	}
	while($mm != $finishDate['mm'] or $yyyy != $finishDate['yyyy']);
	
	$profit = $summn; // Полученная прибыль
	$profit = round($profit, 2);
	$profit = "$profit руб.";
	return $profit;
}
