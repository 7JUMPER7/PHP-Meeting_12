<?php
    // include_once('./models/User.php');
    // include_once('./models/Country.php');
    // include_once('./models/City.php');
    session_start();

    function connect($host, $user, $password, $dbname) {
        $res = mysqli_connect($host, $user, $password);
        if($res) {
            if(mysqli_select_db($res, $dbname)) {
                return $res;
            } else {
                $err = mysqli_errno($res);
                if($err == 1049) {
                    echo "<div>База данных не существует</div>";
                }
                echo "<div>$err</div>";
                return null;
            }
        }
    }

    function createDb($db, ...$queries) {
        $errors = false;
        foreach($queries as $k => $v) {
            mysqli_query($db, $v);
            $err = mysqli_errno($db);
            if($err) {
                echo "<div>$k. $err</div>";
                $errors = true;
            }
        }
        return $errors;
    }

    function isLoggedIn() {
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        if(isset($_SESSION['email'])) {
            return ['email' => $_SESSION['email'], 'login' => $_SESSION['login']];
        }
        return null;
    }

    function register($login, $email, $password, $password2) {
        $emailPattern = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
        
        $db = connect('localhost', 'root', 'root', 'agencydb');

        if(!preg_match($emailPattern, $email)) {
            return ['status' => false, 'message' => 'Wrong email'];
        }
        if($password != $password2) {
            return ['status' => false, 'message' => 'Passwords doest\' match'];
        }
        if(mysqli_query($db, "SELECT * FROM Users WHERE Login = '$login'")->num_rows > 0) {
            return ['status' => false, 'message' => 'Login already exsits'];
        }
        if(mysqli_query($db, "SELECT * FROM Users WHERE Email = '$email'")->num_rows > 0) {
            return ['status' => false, 'message' => 'Email already exists'];
        }


        if($db) {
            $query = "INSERT INTO `Users`(`Login`, `Password`, `Email`, `RoleId`) VALUES ('$login','".md5($password)."','$email',1)";
            mysqli_query($db, $query);
            $err = mysqli_error($db);
            if($err == '') {
                if(session_status() != PHP_SESSION_ACTIVE) {
                    session_start();
                }
                $user = new User($login, $email, $password);
                $_SESSION['user'] = $user;
                return ['status' => true, 'message' => 'Logged in successfully'];
            }
            mysqli_close($db);
        }
        return ['status' => false, 'message' => 'Some error happened'];
    }

    function login($email, $password) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $res = mysqli_query($db, "SELECT * FROM Users WHERE Email = '$email'");
            if($res->num_rows > 0) {
                $res = mysqli_fetch_assoc($res);
                if($res['Password'] == md5($password)) {
                    if(session_status() != PHP_SESSION_ACTIVE) {
                        session_start();
                    }
                    $user = new User($res['Login'], $res['Email'], $res['Password'], $res['RoleId']);
                    $_SESSION['user'] = $user;
                    return ['status' => true, 'message' => 'Logged in successfully'];
                }
                return ['status' => false, 'message' => 'Wrong password'];
            }
            mysqli_close($db);
            return ['status' => false, 'message' => 'Email doesn\'t found'];
        }
        return ['status' => false, 'message' => 'Some error happened'];
    }

    function getHotelById($id) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $res = mysqli_query($db, "SELECT * FROM Hotels WHERE Id = $id");
            if($res) {
                return ['status' => true, 'res' => mysqli_fetch_array($res, MYSQLI_ASSOC)];
            }
            mysqli_close($db);
            return ['status' => false, 'message' => 'Email doesn\'t found'];
        }
        return ['status' => false, 'message' => 'Some error happened'];
    }

    function getHotelImages($id) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $res = mysqli_query($db, "SELECT * FROM Images WHERE HotelId = $id");
            if($res) {
                $images = mysqli_fetch_all($res, MYSQLI_ASSOC);
                if(count($images) > 0) {
                    return ['status' => true, 'res' => $images];
                }
            }
            mysqli_close($db);
        }
        return ['status' => false];
    }

    function getPlaceByCityId($id) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $res = mysqli_query($db, "SELECT City, Country FROM Cities JOIN Countries ON Countries.Id = Cities.CountryId WHERE Cities.Id = $id");
            if($res) {
                $place = mysqli_fetch_row($res);
                return ['status' => true, 'res' => $place];
            }
            mysqli_close($db);
        }
        return ['status' => false];
    }

    function clearHotelImages($hotelId) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $res = mysqli_query($db, "SELECT * FROM `Images` WHERE HotelId = $hotelId");
            $images = mysqli_fetch_all($res, MYSQLI_ASSOC);
            $res = mysqli_query($db, "DELETE FROM `Images` WHERE HotelId = $hotelId");
            mysqli_close($db);
            if($res) {
                return ['status' => true, 'images' => $images];
            }
        }
        return ['status' => false];
    }

    function putImages($images) {
        $db = connect('localhost', 'root', 'root', 'agencydb');
        if($db) {
            $isGood = true;
            foreach($images as $k => $image) {
                $res = mysqli_query($db, "INSERT INTO `Images` (HotelId, Path) VALUES (".$image['hotelId'].", '".$image['filename']."')");
                if(!$res) $isGood = false;
            }
            return $isGood;
            mysqli_close($db);
        }
        return false;
    }

    function RedirectToNotFound(){
        echo "<script>
            window.location = '?page=notfound';
            </script>";
    }

    function logOut() {
        if(isset($_SESSION['user'])) {
            unset($_SESSION['user']);
            session_destroy();
            return true;
        }
        return false;
    }
?>