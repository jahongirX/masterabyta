<?php
if (isset($_REQUEST['anketa']))
{
$to = 'remontm2004@mail.ru'; 

$from = 'noreply@d-mastera.ru'; // Адрес email отправителя
// тема письма
$subject = 'Анкета кандидата';
$message = $_REQUEST['anketa'];
$headers  = "Content-type: text/html; charset=utf-8 \r\n"; 
$headers .= "From: Домашние Мастера <".$from.">\r\n"; // От кого письмо меняем на свое имя
$headers .= "Reply-To: ".$from."\r\n"; 

// Отправляем
mail($to, $subject, $message, $headers);
}

?>


<!DOCTYPE HTML>

<html>

<head>
	<title>Анкета кандидата</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">

	
$(document).ready(function(){

	$(".form table").each(function(){
		$(this).wrap('<div class="table-responsive"></div>');
	})


	window.parent.showAferta();
	
	$('#warn').click(function(){
		if (this.checked == true) {
			$('.submit').removeAttr('disabled');
		} else {
			$('.submit').attr('disabled','disabled');
		}
		return true;
	});
	
	$('#remPC').change(function(){
		if ( $(this).val() == 0 ) { $('#hidden').slideUp(); }
		else { $('#hidden').slideDown();}
	return false;
	});

	$('.submito').click(function(event) {

		window.parent.scrollTo(0,0);
		
		$('.oferta').hide();

		$('.form').show();
	});
	
});

	$(document).on('submit', 'form', function(event) {

		$("p").each(function(e){
			if ($(this).find("input[type='checkbox']").length){
				if(!($(this).find("input[type='checkbox']").is(":checked"))){
					$(this).remove();
				}
			}
		});

		$("#hidden .d").each(function(e){
			if ($(this).find('select').length){
				if(!($(this).find('select').val()=="Да")){
					$(this).remove();
				}
			}
		});

		$("input[type='submit']").remove();
		event.preventDefault();
		$('#hidden').show();
		$('#remPC').remove()
		$('.oferta').remove()


		$('input[type=text], textarea, select:not(#remPC)').each(function(index, el) {

			newtext = ($(this).val() == '') ? ' --- ' : $(this).val();

			$(this).replaceWith( '<span>'  + newtext  + '</span>'); 
		});
		$('input[type=checkbox]:not(#warn)').each(function(index, el) {

			newtext = (this.checked == false)? '   Нет   ' : '    Да    ';

			$(this).parent().replaceWith( $(this).parent().text()  + "<span>"  + newtext  + "</span>" ); 
		});

		$('script').each(function () {
		    $(this).remove();
		});

		$.post(
			'anketa.php',
			{anketa: document.documentElement.outerHTML}).done(function() {
				window.parent.anketaThanks();
			})
		


 	});

	</script>
	<style type="text/css">
a { color: #348fab; outline: none; text-decoration: none; }
a:hover { text-decoration: underline; }
html{ overflow-y: scroll; }
html,body { height: 100%; margin: 0; padding: 0; width: 100%; }
body { color: #333; font-size: 11px; font-family: Tahoma, Arial, sans-serif; line-height: 15px; position: relative; }
form { margin: 0; }
img { border: none; vertical-align: middle; outline: 0; line-height: 0;}
input,input * { outline: none; }
input { color: #58585a; font-size: 12px; font-family: Arial, Helvetica, sans-serif; vertical-align: middle; border:1px solid #999; }
select { font-size: 12px; margin: 0; vertical-align: middle; box-sizing: border-box; }
textarea { font-size: 12px; margin: 0; width: 100%; height: 50px; outline: none; overflow-y: auto; box-sizing: border-box; padding: 2px 5px; border:1px solid #999; resize:none;}
label { vertical-align: middle; }
hr { height: 1px; color: #ddd; background-color: #ddd; border: 0; }
h1,h2,h3,h4,h5,h6,p { margin: 0 0 10px 0; padding: 0; font-weight: normal; }
table { border-collapse: collapse; border-spacing: 0; }
td,th { padding: 0; vertical-align: top; }
sup,sub { vertical-align: baseline; position: relative; }
sup { top: -0.4em; }
sub { bottom: -0.3em; }
a span, label { cursor: pointer; }
h1 { font-size: 23px; font-weight: normal; }
h2 { font-size: 18px; font-weight: normal; }
span { font-weight: 600;}

.clearfix:before, .clearfix:after { content: ""; display: table; }
.clearfix:after { clear: both; }
.clearfix { *zoom: 1; }

.center { text-align: center; }
.red { color: Red; }

.oferta { 
    margin: 0 auto;    
 }

.form { font-size: 14px; line-height: 20px; }
.form h1,
.form h2,
.form h3 { text-align: center; margin: 0 0 20px; color: Black; }
.form h3 { font-size: 16px; margin: 20px 0 10px; font-weight: bolder; }
.form .d { display: table; width: 100%; padding:5px 0; border-bottom: 1px solid #eee; }
.form .d:hover{
	background: #eee;
}
.form .d1 { display: table-cell; width: 300px; padding-right:30px; padding-left: 5px; vertical-align: top; }
.form .d2,
.form .d3 { display: table-cell; }
.form .d4 { display: table-cell; width: 1%; white-space: nowrap; padding: 0 15px; }
.form .d5 { display: table-cell; width: 1%; }
.form input[type='text'] { width: 100%; box-sizing: border-box; padding: 4px 5px; }
.form textarea {}
.form textarea:focus,
.form input:focus[type='text'] { box-shadow: 0 0 10px 0 #ccc; }
.form input[type='checkbox'] { width: 14px; height: 14px; margin: 0; padding: 0; position: absolute; top: 3px; left: 0; }
.form label { padding: 0 0 0 20px; position: relative; }
.form label:hover { color: Black; text-shadow: 1px 1px 0 #ccc; transition: color ease-out 70ms; }
.form table { width: 100%; margin: 0 0 20px; }
.form th { border: 1px solid #ccc; padding: 10px; background: #f9f9f9; }
.form td { border: 1px solid #ccc; padding: 10px; }
.form .ttl { font-weight: bolder; }
.form .submit { font-size: 18px; padding: 15px 20px; color: Black; cursor: pointer; margin: 20px 0 0; }
.form .submit[disabled='disabled'] { cursor: not-allowed; color: #666; }


.table-responsive {
	overflow-x:auto;
}

.table-responsive table {
	min-width: 480px;
}

@media only screen and (max-width: 480px) {
	.table-responsive::before{
		content:'Прокручивайте влево/вправо';
		display: block;
		font-size:12px;
		margin-bottom: 5px;
	}

	.submito{
		font-size: 14px !important;
		white-space: normal;
	}

	.form{
		font-size: 12px;
		line-height: 1.2;
	}
	.form .d {
		display:block;
	}

	.form .d1, .form .d2, .form .d3, .form .d4, .form .d5 {
		display: block;
		width:100%;
		padding:0;
	}
	.form .d1{
		margin-bottom: 5px;
	}
}


	</style>
</head>

<body>
	<div class="oferta">
<div id="oferta"></div>
<p>&nbsp;</p>
<p class="center"><input type="button" style="padding:10px 20px; font-size:16px" class="submito" value="С условиями договора и публичной оферты ознакомлен"></p>
	</div>

	<div class="form the-anketa" style="margin: 0 auto;display:none">
		<form action="" method="post">
		<h1>Анкета кандидата:</h1>
		<div class="d">
			<div class="d1"><b>На должность:</b></div>
			<div class="d2"><input type="text" required></div>
		</div>
		<div class="d">
			<div class="d1"><b>Фамилия, имя, отчество:</b></div>
			<div class="d2"><input type="text" required></div>
		</div>
		<div class="d">
			<div class="d1"><b>Дата и место рождения:</b></div>
			<div class="d2"><input type="text"></div>
		</div>		
		<div class="d">
			<div class="d1"><b>Адрес прописки:</b></div>
			<div class="d2">
				<table style="width:365px; min-width:0">
					<tr>
						<td>Город</td>
						<td colspan="2"><input type="text" required></td>
						<td>Улица</td>
						<td colspan="2"><input type="text" required></td>
					</tr>
					<tr>
						<td>Дом</td>
						<td><input style="width:30px" type="text" required></td>
						<td>Корпус</td>
						<td><input style="width:30px" type="text"></td>
						<td>Квартира</td>
						<td><input style="width:30px" type="text" required></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="d">
			<div class="d1"><b>Адрес проживания:</b></div>
			<div class="d2">
				<table style="width:365px; min-width:0">
					<tr>
						<td>Город</td>
						<td colspan="2"><input type="text" required></td>
						<td>Улица</td>
						<td colspan="2"><input type="text" required></td>
					</tr>
					<tr>
						<td>Дом</td>
						<td><input style="width:30px" type="text" required></td>
						<td>Корпус</td>
						<td><input style="width:30px" type="text"></td>
						<td>Квартира</td>
						<td><input style="width:30px" type="text" required></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="d">
			<div class="d1"><b>Мобильный № телефона:</b></div>
			<div class="d2"><input type="text" required></div>
		</div>
		<div class="d">
			<div class="d1"><b>Домашний № телефона:</b></div>
			<div class="d2"><input type="text" required></div>
		</div>
		<div class="d">
			<div class="d1"><b>Имеете ли Вы водительское удостоверение (категории):</b></div>
			<div class="d2"><input type="text" required></div>
		</div>
		<div class="d">
			<div class="d1"><b>Наличие автотранспорта:</b></div>
			<div class="d2"><input type="text" required></div>
		</div>		
		<br><br>
		<h2>Укажите работы, которые Вы можете выполнить на высоком уровне:</h2>
		<div class="d">
			<div class="d1">Самостоятельный ремонт квартиры:</div>
			<div class="d5"><select><option>Да</option><option>Нет</option></select></div>
			<div class="d4">, или ванной комнаты:</div>
			<div class="d5"><select><option>Да</option><option>Нет</option></select></div>
			<div class="d2"></div>
		</div>
		<h3>Сантехнические работы:</h3>
		<p><label><input type="checkbox">Установка биде, унитаза (с демонтажем);</label></p>
		<p><label><input type="checkbox">Установка, перенос полотенцесушителя;</label></p>
		<p><label><input type="checkbox">Установка ванн гидромассажных, чугунных, нестандартных размеров, ванны «Джакузи»;</label></p>
		<p><label><input type="checkbox">Монтаж водонагревателя накопительного, проточного;</label></p>
		<p><label><input type="checkbox">Установка «Мойдодыра», раковины, смесителя, «Тюльпана», «Елочки»;</label></p>
		<p><label><input type="checkbox">Подключение посудомоечной машины, стиральной машины;</label></p>
		<p><label><input type="checkbox">Установка перемычки на полотенцесушитель (байпас);</label></p>
		<p><label><input type="checkbox">Установка труб из металлопластика;</label></p>
		<p><label><input type="checkbox">Прокладка (сварка) труб горячего и холодного водоснабжения.</label></p>

		<h3>Плотницкие работы:</h3>
		<p><label><input type="checkbox">Монтаж (изготовление) арки в проеме;</label></p>
		<p><label><input type="checkbox">Врезка глазка в деревянную (металлическую) дверь;</label></p>
		<p><label><input type="checkbox">Установка межкомнатной (входной) двери;</label></p>
		<p><label><input type="checkbox">Монтаж доборов дверных; монтаж наличника;</label></p>
		<p><label><input type="checkbox">Монтаж подоконника из дерева и пластика;</label></p>
		<p><label><input type="checkbox">Настил доски половой;</label></p>
		<p><label><input type="checkbox">Врезка замка в деревянную дверь;</label></p>
		<p><label><input type="checkbox">Замена замка (с подгонкой) в металлическую дверь;</label></p>
		<p><label><input type="checkbox">Настил ламината;  настил оргалита;  настил линолеума;</label></p>
		<p><label><input type="checkbox">Сверление отверстий в кафеле;</label></p>
		<p><label><input type="checkbox">Оклейка потолка пенопластовыми панелями;</label></p>
		<p><label><input type="checkbox">Настил паркета, паркетной доски;</label></p>
		<p><label><input type="checkbox">Монтаж плинтуса (пол и потолок);</label></p>
		<p><label><input type="checkbox">Устройство потолка подвесного из ГКЛ, реечного, «Армстронг»;</label></p>
		<p><label><input type="checkbox">Обшивка стен и потолка деревянной вагонкой;</label></p>
		<p><label><input type="checkbox">Монтаж встроенного шкафа, антресоли по ГКЛ, ДСП;</label></p>
		<p><label><input type="checkbox">Ремонт оконных рам, установка (резка) стекла;</label></p>
		<p><label><input type="checkbox">Установка встроенной в стену двери, двери типа «Гармошка»;</label></p>
		<p><label><input type="checkbox">Шлифовка, окраска окна;</label></p>
		<p><label><input type="checkbox">Обивка деревянной (металлической) двери;</label></p>

		<h3>Электромонтажные работы:</h3>
		<p><label><input type="checkbox">Установка автомата электрического;</label></p>
		<p><label><input type="checkbox">Установка вытяжки с подключением;</label></p>
		<p><label><input type="checkbox">Проводка кабеля электрического к главному щиту; монтаж телевизионного кабеля;</label></p>
		<p><label><input type="checkbox">Установка люстры потолочной; монтаж электроточки и т.п.</label></p>
		<p><label><input type="checkbox">Подключение «Мойдодыра», плиты электрической, ванны «Джакузи», душевой кабины;</label></p>
		<p><label><input type="checkbox">Штробление стен;</label></p>
		<p><label><input type="checkbox">Установка трансформатора, щита электрического;</label></p>

		<h3>Плиточные работы:</h3>
		<p><label><input type="checkbox">Облицовка стен плиткой, с предварительным выравниванием стен;</label></p>
		<p><label><input type="checkbox">Укладка напольной плитки;</label></p>
		<p><label><input type="checkbox">Цементно-песчаная стяжка;</label></p>
		<p><label><input type="checkbox">Зачистка, затирка плитки.</label></p>

		<h3>Отделочные и малярные работы:</h3>
		<p><label><input type="checkbox">Выравнивание стен, потолков, откосов, проемов (штукатурка, шпатлевание, грунтовка);</label></p>
		<p><label><input type="checkbox">Малярные работы (окраска стен, потолков, полов, откосов, проемов);</label></p>
		<p><label><input type="checkbox">Оклейка стен обоями;</label></p>

		<h3>Мелкий бытовой ремонт:</h3>
		<p><label><input type="checkbox">Ремонт корпусной мебели; сборка мебели;</label></p>
		<p><label><input type="checkbox">Обивка мягкой мебели;</label></p>
		<p><label><input type="checkbox">Реставрация мебели;</label></p>
		
		<h3>Ремонт пластиковых окон:</h3>
		<p><label><input type="checkbox">Ремонт окон;</label></p>
		<p><label><input type="checkbox">Регулировка, замена уплотнителя, фурнитуры;</label></p>
		<p><label><input type="checkbox">Изготовление стеклопакета, москитной сетки;</label></p>
		<p><label><input type="checkbox">Откосы, отливы, замена подоконников;</label></p>

		<br><br>
		<p><label><input type="checkbox" id="warn"><b>Достоверность указанной информации подтверждаю. Не возражаю против проверки указанной информации. <span class="red">***</span></b></label></p>
		<p class="center"><input type="submit" class="submit" value="Отправить" disabled="disabled"></p>
		</form>
	</div>
	
</body>

</html>