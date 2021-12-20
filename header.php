<?php
    function generateMenu($links, $loginLinks) {
        foreach($links as $name => $link) {
            echo "<a href='?page=$name'>".ucfirst($name)."</a>";
        }

        echo "<div class='login'>";
        if(isset($_SESSION['user'])) {
            echo '<a href="?page=user"><h3>'.$_SESSION['user']->getLogin().'</h3></a>';
        } else {
            foreach($loginLinks as $name => $link) {
                echo "<a href='?page=$name'>".ucfirst($name)."</a>";
            }
        }
        echo "</div>";
    }
?>