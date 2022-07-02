<?php
//logout:on stop la seesion avec un commande de seesion_destroy() et envoie le user sut l'home page que j'ai nommé first.php
session_start();
session_destroy();
header('location:first.php');