<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>WORLD BANK Publications</title>
		<!-- Ссылка на внешний файл стилей -->
		<link href="styles.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
		<div id="page">
			<!-- Шапка сайта -->
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			<div id="header">
				<div class="company">
					<p class="company"><img src="world-2.png" alt="Эмблема компании" width="80" height="80" align="left"/>
						WORLD BANK <br />Publications</p>
				</div>
				<div class="space"></div>
				<div class="phone">
					<p class="phone-top">8-800-100-5005</p>
					<p class="phone-bottom">+7(3452)522-000</p>
				</div>
			</div>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			
			<!-- Панель навигации -->
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			<div id="navigation">
				<ul class="nav-link">
				<?php $counter = 0; ?>
				<?php foreach ($navMatrix as $link): ?>
				<?php $counter = $counter + 1; ?>
					<li class="nav-link"><a class="nav-link" href="<?php echo $link['location']; ?>"><?php echo $link['name']; ?></a></li>
					<?php if ($counter != $quantity): ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
				<?php endforeach; ?>
				</ul>
			</div>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			
			<!-- Хлебные крошки -->
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			<div id="breadcrumbs"></div>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			
			<!-- Основное содержимое страницы -->
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			<div id="content">
				<div class="calculator">
					<p class="site-section">Калькулятор</p>
					<form class="calc" action="?calculate-deposit" method="post">
						<div class="calc-elem">
							<label class= "calc" for="date">Дата оформления вклада</label>
							<input class= "calc" type="text" name="date" value="<?php echo $date; ?>" id="date">
						</div>
						<div class="calc-elem">
							<label class= "calc" for="deposit-sum">Сумма вклада</label>
							<input class= "calc" type="text" name="deposit-sum" value="<?php echo $depositSum; ?>" id="deposit-sum">
						</div>
						<div class="calc-elem">
							<label class= "calc" for="deposit-time">Срок вклада</label>
							<select class= "calc" name="deposit-time" id="deposit-time">
								<option value="one-year">1 год</option>
								<option value="two-years">2 года</option>
								<option value="three-years">3 года</option>
								<option value="four-years">4 года</option>
								<option value="five-years">5 лет</option>
							</select>
						</div>
						<div class="calc-elem">
							<label class= "calc">Пополнение вклада</label>
							<div class="calc-radio">
								<input class= "calc-radio" type="radio" name="deposit-adding" value="no" id="deposit-adding-no" checked>
								<label class= "calc-radio" for="deposit-adding-no">Нет</label>
								<input class= "calc-radio" type="radio" name="deposit-adding" value="yes" id="deposit-adding-yes">
								<label class= "calc-radio" for="deposit-adding-yes">Да</label>
							</div>
						</div>
						<div class="calc-elem">
							<label class= "calc" for="deposit-adding-sum">Сумма пополнения вклада</label>
							<input class= "calc" type="text" name="deposit-adding-sum" value="<?php echo $depositAddingSum; ?>" id="deposit-adding-sum">
						</div>
						<div class="calc-elem">
							<input class="calc-submit" type="submit" name="calculate" value="Рассчитать">
						</div>
					</form>
					<p class="output"><!-- Вывод результата должен был располагаться здесь. Перенаправлен в файл [output.php] --></p>
				</div>
			</div>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			
			<!-- Подвал сайта -->
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++ -->
			<div id="footer">
				<ul class="foot-link">
				<?php $counter = 0; ?>
				<?php foreach ($navMatrix as $link): ?>
				<?php $counter = $counter + 1; ?>
					<li class="foot-link"><a class="foot-link" href="<?php echo $link['location']; ?>"><?php echo $link['name']; ?></a></li>
					<?php if ($counter != $quantity): ?>
					&nbsp;&nbsp;&nbsp;
					<?php endif; ?>
				<?php endforeach; ?>	
				</ul>
			</div>
			<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++ -->
		</div>
	</body>
</html>

