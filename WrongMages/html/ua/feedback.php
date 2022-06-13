<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Недомаги - зворотній зв'язок</title>
    <link rel="stylesheet" type="text/css" href="https://demareaktor.github.io/Wrong-Mages-site/css/generic.css">
    <link rel="stylesheet" type="text/css" href="https://demareaktor.github.io/Wrong-Mages-site/css/feedback.css">
    <link rel="shortcut icon" href="https://demareaktor.github.io/Wrong-Mages-site/images/icon.gif" />
</head>

<body id="fon">
    <h1>Зворотній зв'язок</h1>
    <p>Наша команда заківлена мати зв’язок з нашими магами. Ви можете коментувати наші оновлення, тестувати бета-версії, задавати питання і навіть критикувати нас.</p>
    <h2>Тестування</h2>
    <p>Наша команда заківлена мати зв’язок з нашими магами. Ви можете коментувати наші оновлення, тестувати бета-версії, задавати питання і навіть критикувати нас.</p>
    <h2>FAQ</h2>
    <p>Тут ви можете отримати відповіді на найпоширеніші питання, якщо ваше питання лишилось, можете звернутись до служби пітримки, </p>
    <div id="buttons">
        <div class="button">FAQ</div>
        <div class="button">задати питання</div>
    </div>
    <h2>Коментарі</h2>
    <p>Хочете побажати нам удачі, розкритикувати нас за руки із не того місця, дати рекомендацію чи просто поспілкуватись? Тоді вам сюди.</p>
    <div id="comment-left">
    <form method=post class="comment-table" action="index.php<?php echo Settings::get_inst()->get_gets(); ?>">
            <p>Ім'я</p><input id="comment-name" type="comment-name">
            <p>Коментар</p>
            <textarea name="comment-text" rows="6" cols="70"></textarea>
            <input type=button name="comment-button" value="click">Відправити коментарій</input>
    </form> 
    </div>
</body>

</html>