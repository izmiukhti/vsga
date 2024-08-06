<?php
$font_size = '15px';
$background_color = '#4e79a0';

if ($_POST) {
    $background_color = $_POST['background_color'];
    $font_size = $_POST['font_size'];
} else {
    if (isset($_COOKIE['background-color'])) {
        $_POST['background_color'] = $background_color = $_COOKIE['background-color'];
    }
    if (isset($_COOKIE['font-size'])) {
        $_POST['font_sixe'] = $font_size = $_COOKIE['font-size'];
    }
}

//Delete
$msg = false;
if (isset($_POST['hapus_cookie'])) {
    setcookie('background-color', '', 0, '/');
    setcookie('font-size', '', 0, '/');
    $msg = 'Data cookie berhasil dihapus';
}

//Set cookie 7 hari
if (isset($_POST['remember'])) {
    setcookie('background-color', $_POST['background_color'], strtotime('+7 days'), '/');
    $msg = 'Data cookie berhasil disimpan';
}
?>

<html>
    <head>
        <title>Demo Cookie pada PHP</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style type="text/css">
            body {
                font: <?=$font_size?> "open sans", "sagoe ui", tahoma;
            }
            h3 {
                margin-top: 0;
                margin-bottom: 10px;
            }
            div {
                margin-bottom: 5px;
            }
            select {
                padding: 5px 10px;
                font-size: <?=$font_size?>;
                border: 1px solid #CCCCCC;
                color: #5d5d5d;
                text-align: right;
                width: 200px;
                margin-bottom: 10px;
            }
            form {
                margin: 0;
            }
            .container {
                width: 250px;
                margin: auto;
                margin-top: 15px;
                border: 0;
                padding: 20px 20px 15px;
                background-color: #FFFFFF;
            }
            .copyright {
                padding: 0;
                background: none;
                text-align: center;
                margin-top: 10px;
                color: #FFFFFF;
                font-size: smaller;
            }
            .button {
                border: 0;
                padding: 7px 20px;
                float: left;
                font-family: "open sans";
                color: #FFFFFF;
                font-size: <?=$font_size?>;
                margin-right: 5px;
                margin-bottom: 5px;
                cursor: pointer;
            }
            .blue {
                background-color: #3e97e2;
            }
            .copyright a {
                text-decoration: none;
                color: #e4e4e4;
                margin-top: 3px;
                display: inline-block;
            }
            .red {
                background-color: #e26b3e;
            }
            .clearfix: ::before,
            .clearfix: ::after
            {
                content: "";
                float: none;
                clear: both;
                display: block;
            }
            .remember {
                margin-bottom: 12px;
            }
            .success {
                background-color: #abffc1;
                padding: 5px 10px;
                color: #696969;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form method="post" action="">
                <h3>SETTINGS</h3>
                <?php
                if ($msg) {
                    echo '<div class="success">' . $msg . '</div>';
                }
                ?>
                <div>Background</div>
                <select name="background_color">
                    <?php
                    $colors = array ('#4e79a0' => 'Biru', '#75b14a' => 'Hijau', '#d06353' => 'Merah');
                    foreach ($colors as $name => $value) {
                        $selected = $name == @$_POST['background_color'] ? 'SELECTED = "SELECTED"' : '';
                        echo '<option value = "' . $name . '"' . $selected . '>' . $value . '</option>';
                    }
                    ?>
                </select>
                <div>Font Size</div>
                <select name="font_size">
                    <?php
                    $font_size = array ('15px', '17px', '20px', '25px');
                    foreach ($font_size as $value) {
                        $selected = $value == @$_POST['font_size'] ? 'SELECTED = "SELECTED"' : '';
                        echo '<option value = "' . $value . '"' . $selected . '>' . $value . '</option>';
                    }
                    ?>
                </select>
                <div>Font Size</div>
                <select name="font_size">
                    <?php
                    $font_size = array ('15px', '17px', '20px', '25px');
                    foreach ($font_size as $value) {
                        $selected = $value == @$_POST['font_size'] ? 'SELECTED = "SELECTED"' : '';
                        echo '<option value = "' . $value . '"' . $selected . '>' . $value . '</option>';
                    }
                    ?>
                </select>
                <div class="remember">
                    <input type="checkbox" id="remember" name="remember"/>>
                    <label for="remember">Remember</label>
                </div>
                <div class="clearfix">
                    <input type="submit" class="button blue" name="submit" value="Simpan"/>
                    <input type="submit" class="button red" name="submit" value="Hapus Cookie"/>
                </div>
            </form>
        </div>
        <div class="container copyright">&copy; <?=date('Y')?> JagoWebDev.com<br/>
        <a href="https://jagowebdev.com/cookie-pada-php/">Tutorial &raquo;</a></div>
    </body>
</html>