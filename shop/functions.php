<?php

function pdo_connect_mysql()
{
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = 'Saxonia1850!';
    $DATABASE_NAME = 'shop';
    try {
        return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
        exit('Failed to connect to database!');
    }
}

function template_header($title)
{

    $num_items_in_cart = 0;
    foreach ($_SESSION['cart'][$_SESSION['id']] as $pr) {
        $num_items_in_cart += $pr;
    }
    if ($_SESSION['usertype'] == 1) {
        echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Gib deine Träume nicht auf - schlafe weiter!</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Produkte</a>
                </nav>
                <div class="link-icons">
                    <a href="index.php?page=userprofil">
                    <i class="fas fa-user"></i>
                    <a href="index.php?page=logout">
                    <i class="fas fa-sign-out-alt"></i>
<a href="index.php?page=cart">
    <i class="fas fa-shopping-cart"></i>
<span>$num_items_in_cart</span>
</a>

					</a>
                </div>
            </div>
        </header>
        <main>
EOT;
    } else if ($_SESSION['usertype'] == 0) {
        echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
        <header>
            <div class="content-wrapper">
                <h1>Gib deine Träume nicht auf - schlafe weiter!</h1>
                <nav>
                    <a href="index.php">Home</a>
                    <a href="index.php?page=products">Produkte</a>
                </nav>
                <div class="link-icons">
                    <a href="index.php?page=addproduct">
                    <i class="fas fa-plus"></i>
                    <a href="index.php?page=logout">
                    <i class="fas fa-sign-out-alt"></i>
<a href="index.php?page=seebuyments">
    <i class="fas fa-shopping-cart"></i>

</a>

					</a>
                </div>
            </div>
        </header>
        <main>
EOT;
    }
}

function template_footer()
{
    $year = date('Y');
    echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper">
                <p>&copy; $year, Ein Projekt von bla bla</p>
            </div>
        </footer>
        <script src="script.js"></script>
    </body>
</html>
EOT;
}
