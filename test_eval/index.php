<?php
    session_start();
    var_dump($_SESSION);
    var_dump($_POST);
    include('Views/htmlTop.html');
    // Switch/case des familles
    switch(isset($_GET)):
        case(isset($_GET['page'])):
                switch($_GET['page']):
                    case($_GET['page'] === 'register'):
                            include('Controllers/register.php');
                        break;
                    case('settings'):
                            include('Controllers/manage.php');
                        break;
                    default:
                        echo "Hugo!";
                endswitch;
            break;
        default:
            include('Controllers/login.php');
    endswitch;
?>