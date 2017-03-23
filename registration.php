<?php 

$errors = [];

$lastName = $_POST['lastName'];
$firstName = $_POST['firstName'];
$fatherName = $_POST['fatherName'];
$login = $_POST['login'];
$passNum = $_POST['passNum'];
$pass = $_POST['pass'];

$lastName = htmlspecialchars($lastName);
$firstName = htmlspecialchars($firstName);
$fatherName = htmlspecialchars($fatherName);
$login= htmlspecialchars($login);
$passNum = htmlspecialchars($passNum);
$pass= htmlspecialchars($pass);

$login = mb_strtolower($login);

if ($lastName!="") {
	if (preg_match ('/\s/', $lastName)){
		$errors[] = 'Фамилия не должна содержать пробелов';
	}else{
		if (preg_match ('/[0-9]/', $lastName)){
			$errors[] = 'Фамилия не должна содержать цифр';
		}else{
			if (!preg_match("~^[a-zа-я]+$~ui",$lastName) ){
				$errors[] = 'Фамилия должна быть только из букв и без пробелов';
			}
		}
	}
}


if ($firstName!="") {
	if (preg_match ('/\s/', $firstName)){
		$errors[] = 'Имя не должно содержать пробелов';
	}else{
		if (preg_match ('/[0-9]/', $firstName)){
			$errors[] = 'Имя не должно содержать цифр';
		}else{
			if (!preg_match("~^[a-zа-я]+$~ui",$firstName)){
				$errors[] = 'Имя должно быть только из букв и без пробелов';
			}
		}
	}
}


if ($fatherName!="") {
	if (preg_match ('/\s/', $fatherName)){
		$errors[] = 'Отчество не должно содержать пробелов';
	}else{
		if (preg_match ('/[0-9]/', $fatherName)){
			$errors[] = 'Отчество не должно содержать цифр';
		}else{
			if (!preg_match("~^[a-zа-я]+$~ui",$firstName)){
				$errors[] = 'Отчество должно быть только из букв и без пробелов';
			}
		}
	}
}


if (!preg_match ('/[a-z]+$/i', $login))
	$errors[] = 'Не валидный логин. Введите только латинские буквы в нижнем регистре.';

if($passNum!=""){
	if (!preg_match ('/^\d{10}$/', $passNum))
		$errors[] = 'Не валидный номер паспорта. Должны быть только 10 цифр.';
}

if (preg_match ('/\s{10,}/', $pass)){
	$errors[] = 'В пароле не должно быть пробелов. Длина не менее 10 символов.';
}


if($_POST['dateBorn']!=""){
	if (!preg_match ('/^[0-9]{1,2}[.][0-9]{1,2}[.][0-9]{4}$/', $_POST['dateBorn'])){
		$errors[] = 'Не валидная дата.';
	}else{
		
		$date=date('Y-m-d', strtotime($_POST['dateBorn']));
		if ($date > date('Y-m-d')) {
			$errors[] = 'Дата должна быть меньше текущей';
		}
	}
}


if ($errors) {
	
	$content = '<div class="mistakes_head">При отправке формы произошли следующие ошибки:</div>';
	foreach ($errors as $error) $content .='<div class="mistake"> <span class="warn">*</span>'.$error.'</div>';

	$content.='<div class="mistakes_foot">Для продолжения регистрации исправьте ошибки.</div>';
	echo $content ;
	
}else{
	if (file_exists($_SERVER["DOCUMENT_ROOT"].'/users/'.$login.'.user')) // Если пользователь существует
	{
		echo '<div class="same_user">Пользователь с таким логином уже существует!</div>';
	}
	else{
	$file = fopen($_SERVER["DOCUMENT_ROOT"].'/users/'.$login.'.user', 'x'); // Создание файла пользователя
	$text = '<?php
	$lastName = "'.$lastName.'";
	$firstName = "'.$firstName.'";
	$fatherName = "'.$fatherName.'";
	$login = "'.$login.'";
	?>';
	fwrite ($file, $text); // Запись данных в файл
	fclose ($file);
	//header ('Location: success.php'); 
	echo '<div class="success">Вы успешно зарегистрировались!</div>';
}

}
?>