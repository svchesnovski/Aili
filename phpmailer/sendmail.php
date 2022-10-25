<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail ->CharSet = 'UTF-8'
$mail ->setLanguage('ru', 'phpmailer/language/');
$mail ->IsHTML(true);

$mail ->setForm('skaalfee@gmail.com', "Кафе-Кондитерская АйЛи");
$mail ->addAddress('svchesnovski@gmail.com');
$mail ->Subject = 'Новый заказ';

$body = '<h1>Поступил новый заказ!</h1>';

if(trim(!empty($_POST['name']))){
    $body.='<p><strong>Имя и фамилия:</strong> '.$_POST['name'].'</p>';
}

if(trim(!empty($_POST['E-mail']))){
    $body.='<p><strong>E-mail::</strong> '.$_POST['E-mail'].'</p>';
}

if(trim(!empty($_POST['Phone']))){
    $body.='<p><strong>Телефон:</strong> '.$_POST['Phone'].'</p>';
}

if(trim(!empty($_POST['weight']))){
    $body.='<p><strong>Выберете вес торта:</strong> '.$_POST['weight'].'</p>';
}

if(trim(!empty($_POST['Message']))){
    $body.='<p><strong>Выберите основной цвет:</strong> '.$_POST['Message'].'</p>';
}


if(trim(!empty($_POST['name']))){
    $body.='<p><strong>Забрать самому:</strong> '.$_POST['address'].'</p>';
}

if (!empty($_FILES['image']['tmp_name'])) {
    $filePath = __DIR__ . "/files/" .$_FILES['image'] ['name'];
    if (copy($_FILES['image']['tmp_name'], $filePath)){
        $fileAttach = $filePath;
        $body.='<p><strong>Фото в приложении</strong>';
        $mail->addAttachment($fileAttach);
    }
}

$mail->Body = $body;

if (!$mail->send()) {
    $message = 'Ошибка';
} else {
    $message = 'Данные отправлены!;'
}

$response = ['message' => $message];

header('Content-type: application/json');
echo json_encode($responce);

?>