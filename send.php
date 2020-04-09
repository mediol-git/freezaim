<?php
$msg_box = ""; // в этой переменной будем хранить сообщения формы

if($_POST['btn_submit']){
	$errors = array(); // контейнер для ошибок
	// проверяем корректность полей
	if($_POST['name'] == "") $errors[] = "Поле 'Ваше имя' не заполнено!";
	if($_POST['phone'] == "") $errors[] = "Поле 'Ваш e-mail' не заполнено!";

	// если форма без ошибок
	if(empty($errors)){
	// собираем данные из формы
	$message = "Имя пользователя: " . $_POST['name'] . "<br/>";
	$message .= "Телефон пользователя: " . $_POST['phone'] . "<br/>";
	send_mail($message); // отправим письмо
	// выведем сообщение об успехе
	$msg_box = "<span style='color: green;'>Сообщение успешно отправлено!</span>";
	}else{
		// если были ошибки, то выводим их
		$msg_box = "";
		foreach($errors as $one_error){
			$msg_box .= "<span style='color: red;'>$one_error</span><br/>";
		}
	}
}
// функция отправки письма
function send_mail($message){
	// почта, на которую придет письмо
	$mail_to = "info@credlt.com.ua";
	// тема письма
	$subject = "Письмо с обратной связи";

	// заголовок письма
	$headers= "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
	$headers .= "From: Тестовое письмо <info@credlt.com.ua>\r\n"; // от кого письмо

	// отправляем письмо
	mail($mail_to, $subject, $message, $headers);
}
?>