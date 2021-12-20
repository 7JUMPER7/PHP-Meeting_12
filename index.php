<?php
    $links = ['home' => './pages/Store.php'];
    $loginLinks = ['register' => './pages/Registration.php', 'login' => './pages/Login.php'];
    $hideLinks = ['admin' => './pages/Admin.php', 'notfound' => './pages/NotFound.php', 'good' => './pages/Good.php', 'cart' => './pages/Cart.php'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/header.css" rel="stylesheet">
</head>
<body>
    <header id="header">
        <?php
            include_once('./functions.php');
            include_once('./header.php');
            generateMenu($links, $loginLinks);
        ?>
    </header>

    <main>
        <?php
            if(!isset($_GET['page'])) {
                $_GET['page'] = 'home';
            } 

            if(array_key_exists($_GET['page'], $links)) {
                include_once($links[$_GET['page']]);
            } else if(array_key_exists($_GET['page'], $loginLinks)) {
                include_once($loginLinks[$_GET['page']]);
            } else if(array_key_exists($_GET['page'], $hideLinks)) {
                include_once($hideLinks[$_GET['page']]);
            } else {
                include_once('./pages/notfound.php');
            }
        ?>
    </main>

    <footer>

    </footer>
    
    <script src="./js/header.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
</body>
</html>