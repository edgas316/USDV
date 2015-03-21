<?php
/*
        form.php
        Тестовая форма для демонстрации обработки данных из формы в PHP
        Файл должен быть сохранён в кодировке utf-8
*/
header('Content-Type: text/html; charset=utf-8');
// Куда отправлять сообщения
$emailAddress = 'edgas3_16@mail.ru';
// Адрес сайта, с которого он отправляет сообщения
$siteEmail = 'emailt@sims.beget.ru';
// Тема сообщения
$emailTheme = 'US DV LOTTERY';
?>
<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Тестовая форма и её обработка</title>
</head>
<body>
        <h3>Тестовая форма и её обработка</h3>
        <form name="testForm" method="post" action="<?php echo($_SERVER['PHP_SELF']); ?>">
        <table>
                <tr>
                        <td>Фамилия Имя Отчество</td>
                        <td><input type="text" name="first" value="" /></td>
                </tr>
                <tr>
                        <td>Телефон (Формат +79008889977)</td>
                        <td><input type="phone" name="second" value="" /></td>
                </tr>
                <tr>
                        <td>Email</td>
                        <td><input type="email" name="third" value="" /></td>
                </tr>
                <tr>
                        <td>В сообщении укажите: <br> 
                        дату и время оплаты,<br> 
                        ФИО плательщика,<br> 
                        выбранный пакет.</td>
                        <td><textarea name="seventh"></textarea></td>
                </tr>
                <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="sended" value="Отправить форму!" /></td>
                </tr>
        </table>
        <input type="hidden" name="eighth" value="Какое-нибудь значение скрытого поля" />
</form>
<?php
// Проверяем была ли отправлена форма
if(isset($_POST['sended'])) {
        // Переменная, в которую будем собирать текст нашего сообщения
        $message = 'Форма была отправлена!<br />';
        // Текстовый инпут теперь ы переменной $first
        $first = isset($_POST['first']) ? $_POST['first'] : '';
        $message .= 'Ф.И.О.: ' . htmlspecialchars($first) . '<br />';
        $second = isset($_POST['second']) ? $_POST['second'] : '';
        $message .= 'Тел.: ' . htmlspecialchars($second) . '<br />';
        $third = isset($_POST['third']) ? $_POST['third'] : '';
        $message .= 'Email: ' . htmlspecialchars($third) . '<br />';
        // Раскрывающийся список
        //$second = isset($_POST['second']) ? $_POST['second'] : '';
        //$message .= 'В раскрывающемся списке был выбран элемент, у которого value = ' . htmlspecialchars($second) . '<br />';
        // Чекбоксы
        //if(isset($_POST['third']))
           //     $message .= 'Первый чекбокс был выбран<br />';
        //if(isset($_POST['fourth']))
             //   $message .= 'Второй чекбокс был выбран<br />';
        //if(isset($_POST['fifth']))
               // $message .= 'Третий чекбокс был выбран<br />';
        // Переключатели
        //$sixth = isset($_POST['sixth']) ? $_POST['sixth'] : '';
        //if(empty($sixth))
          //      $message .= 'Никакой переключатель не был выбран<br />';
        //else
          //      $message .= 'Был выбран переключатель, у которого value = ' . htmlspecialchars($sixth) . '<br />';
        // Поле для текста
        $seventh = isset($_POST['seventh']) ? $_POST['seventh'] : '';
        $message .= 'Текст: ' . nl2br(htmlspecialchars($seventh)) . '<br />';
        // Значение скрытого поля
        $eighth = isset($_POST['eighth']) ? $_POST['eighth'] : '';
        //$message .= 'В скрытом поле было: ' . htmlspecialchars($eighth);
        // Отправляем письмо
        $headers = array(
                'MIME-Version: 1.0',
                'From: ' . $siteEmail,
                'Reply-To: ' . $siteEmail,
                'Content-Type: text/html; charset=utf-8'
        );
        if(mail($emailAddress, $emailTheme, $message, implode("\r\n", $headers)))
                $message .= '<br /> Ваше письмо отправлено, в ближайшее время мы с Вами свяжемся!';
        else
                $message .= '<br /> Письмо отправить не удалось попробуйте еще раз!';
        // А также покажем на странице введённые данные и результат отправки письма
        echo($message);
}
?>
        </body>
</html>