<?php

/* Послан запрос на вычисление прибыли */
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
if (isset($_GET['calculate-deposit']))
{
	include_once 'validation.php'; // Функции проверки данных
	
	$formData = CollectFormData(); // Собираем данные формы и записываем в массив
	$checkResult = CheckFormData($formData); // Проверяем данные формы и отчитываемся о результате
	if ($checkResult == 'Ошибок не выявлено')
	{
		include_once 'calc.php'; // Функции расчёта прибыли
		$answer = CalculateProfit($formData); // Вычисляем прибыль от вклада и записываем ответ
		include 'output.php'; // Вывод результата в новом окне
		exit();
	}
	else
	{
		$answer = 'Невозможно получить';
		include 'output.php'; // Вывод результата в новом окне
		exit();
	}
}
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */

/* Первое посещение */
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
function CreateNavigationMatrix()
// Создаёт данные, используемые в панели навигации сайта
// Данные включают наименование раздела сайта и текст ссылки, по которой доступен раздел
{
	$navMatrix[] = array('name' => 'Кредитные карты', 'location'=> '');
	$navMatrix[] = array('name' => 'Вклады', 'location'=> '');
	$navMatrix[] = array('name' => 'Дебетовая карта', 'location'=> '');
	$navMatrix[] = array('name' => 'Страхование', 'location'=> '');
	$navMatrix[] = array('name' => 'Друзья', 'location'=> '');
	$navMatrix[] = array('name' => 'Интернет-банк', 'location'=> '');
	return $navMatrix;
}
$navMatrix = CreateNavigationMatrix();
$quantity = count($navMatrix);
$depositSum = 1000;
$depositAddingSum = 1000;
$date = 'дд.мм.гггг';
include 'template.php'; // Файл-шаблон. Содержит вёрстку страницы и форму
/* +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */
