<?php

require_once("models/login_model.php");

if (isset($_SESSION["usuario"])) {
    require_once("views/inicio_view.php");
} else {
    require_once("views/login_view.php");
}
