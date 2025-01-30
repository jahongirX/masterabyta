<?php
if (isset($_REQUEST['anketa']))
{
$to = 'info@d-mastera.ru'; 

$from = 'noreply@d-mastera.ru'; // Адрес email отправителя
// тема письма
$subject = 'Анкета жена на час';
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
	<title>Анкета жена на час</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<script type="text/javascript">

	
$(document).ready(function(){

	window.parent.showAferta();

	$(".form table").each(function(){
		$(this).wrap('<div class="table-responsive"></div>');
	})
	
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

	<div class="form" style="margin: 0 auto;display:none">
		<form action="" method="post">
		<h1>Анкета кандидата:</h1>
		<div class="d">
			<div class="d1"><b>На должность:</b></div>
			<div class="d2"><input type="text"></div>
		</div>
		<div class="d">
			<div class="d1"><b>Фамилия, имя, отчество:</b></div>
			<div class="d2"><input type="text"></div>
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
		<br><br>
		
		<h2>Укажите работы, которые Вы можете выполнить на высоком уровне:</h2>

		<p><label><input type="checkbox">Дать правильный совет или купить необходимые спец. средства для уборки. </label></p>
		<p><label><input type="checkbox">Произвести качественную уборку. (Возможно спец. средствами квартиры). </label></p>
		<p><label><input type="checkbox">Произвести качественную мойку окон. </label></p>
		<p><label><input type="checkbox">Произвести мойку, натирку спец. средствами зеркал, мебели, бытовой техники, сантехники. </label></p>
		<p><label><input type="checkbox">Произвести уборку квартиры моющим пылесосом. </label></p>
		<p><label><input type="checkbox">Произвести спец. обработку и обслуживание паркета. </label></p>
		<p><label><input type="checkbox">Очистка, мытье и  обработка ковра. </label></p>
		<p><label><input type="checkbox">Произвести глажку белья и т.п. </label></p>
		<p><label><input type="checkbox">Стирка, обработка белья (выведение пятен), умение пользоваться разными моделями автоматических стиральных машин. </label></p>
		<p><label><input type="checkbox">Посидеть с ребенком, занять его чем-нибудь, поиграть с ним и т.п. </label></p>
		<p><label><input type="checkbox">Произвести готовку пищи. </label></p>
		<p><label><input type="checkbox">Мойку посуды, в том числе в посудомоечной машине. </label></p>
		<p><label><input type="checkbox">Сервировку стола. </label></p>
		<p><label><input type="checkbox">шить, вязать и т.п.</label></p>
		
		<h3>Инструменты</h3>

		<p><label><input type="checkbox">Спец. средства для уборки квартиры, мебели, мойки окон, обработки ковров, мойки посуды, обслуживания паркета, выведения пятен на белье. </label></p>
		<p><label><input type="checkbox">Швабра, ведро, щетки. </label></p>
		<p><label><input type="checkbox">Резиновые скребки для мытья окон. </label></p>
		<p><label><input type="checkbox">Замшевая салфетка для натирки зеркал, стекол и т.п. </label></p>
		<p><label><input type="checkbox">Спец. губки для мытья тефлоновой посуды. </label></p>
		<p><label><input type="checkbox">Спец. щетки для обработки и очистки ковров.</label></p>

		<br><br>
		<p><label><input type="checkbox" id="warn"><b>Достоверность указанной информации подтверждаю. Не возражаю против проверки указанной информации. <span class="red">***</span></b></label></p>
		<p class="center"><input type="submit" class="submit" value="Отправить" disabled="disabled"></p>
		</form>
	</div>
	
</body>

</html>