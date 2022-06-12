<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo Config::$git_folder; ?>css/generic.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Config::$git_folder; ?>css/guide-dekstop.css">
    <link rel="shortcut icon" href="<?php echo Config::$git_folder; ?>images/icon.gif" />
</head>

<body id="fon">
    <div id="menu">
        <div id="left-menu-items">
            <img id="logo" src="<?php echo Config::$git_folder; ?>images/icon.gif" alt="icon">
            <img id="telegram" src="<?php echo Config::$git_folder; ?>images/telegram.png" alt="telegram">
            <img id="instagram" src="<?php echo Config::$git_folder; ?>images/instagram.png"  alt="instagram">
            <img id="twitter" src="<?php echo Config::$git_folder; ?>images/twitter.png"  alt="twitter">
        </div>
        <div id="right-menu-items">
                <form method=post action="next-language.php">
                    <input type="image" id="language" src= "<?php echo Config::$git_folder; ?>images/ua.png"   alt="language" >
                </form>
            <div class="button" id="play">Грати</div>
            <img id="menu-button" src="<?php echo Config::$git_folder; ?>images/menu.png"  alt="menu icon">
        </div>
    </div>
</body>

</html>