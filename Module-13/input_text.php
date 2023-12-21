<?php

require_once '.' . DIRECTORY_SEPARATOR . 'autoload.php';

use Entities\TelegraphText;
use Entities\FileStorage;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

?>

<?php

function exception_handler(Throwable $exception)
{
    echo $exception->getMessage();
}

set_exception_handler('exception_handler');

$author = "";
$email = "";
$text = "";

$author = $_POST['author'] ?? '';
$email = $_POST['email'] ?? '';
$text = $_POST['text'] ?? '';

if ($author !== '' && $email !== '') {
    $telegraphText = new TelegraphText($author, 'text_test_file');
    $telegraphText->editText($email, $text);
    $fileStorage = new FileStorage();
    $fileStorage->create($telegraphText);
    $fileStorage->delete('text_test_file_12.20.2023_2');
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host   = 'smtp.yandex.ru';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'SkahdaJI2012';
    $mail->Password   = 'vpudcurithknvlmp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;
    $mail->setFrom('Skahdaji2012@yandex.ru', 'Mailer');
    $mail->addAddress($email, $author);

    $mail->isHTML(true);
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $ok = 'Все хорошо';
} catch (Exception $e) {
    if ($author !== '' && $email !== '' && $text !== '') {
        $error = 'Все хуево';
    }
}

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>input_text</title>

</head>

<body>
    <style>
        .green {
            display: flex;
            margin: 0 auto;
            padding: 15px;
            width: 300px;
            border: 1px solid green;
            border-radius: 10px;
            background-color: green;
            color: white;
        }

        .red {
            display: flex;
            margin: 0 auto;
            padding: 15px;
            width: 300px;
            border: 1px solid red;
            border-radius: 10px;
            background-color: red;
            color: white;
        }

        form {
            margin: 0 auto;
            padding: 15px;
            width: 300px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input,
        form>textarea {
            padding: 10px;
            border: 1px solid tomato;
            border-radius: 5px;
            color: blue;
        }
    </style>
    <?php

    if (!empty($ok)) : ?>
        <div class="green">
            <?php
            echo '<div>' . $ok . '</div>';

            ?>
        </div>
    <?php
    endif;
    ?>
    <?php
    if (!empty($error)) : ?>
        <div class="red">
            <?php
            echo '<div>' . $error . '</div>';

            ?>
        </div>
    <?php

    endif;
    ?>
    <form action="input_text.php" method="post">
        <input type="text" name="author" placeholder="Имя автора" required pattern="^[^\s]+$">
        <input type="email" name="email" placeholder="Введите email" required>
        <textarea name="text" placeholder="Введите текст" required></textarea>
        <input class="btn" type="submit" name="button" value="Отправить">
    </form>
</body>

</html>