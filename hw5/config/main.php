<?php
define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT']."/../");
define("TEMPLATES_DIR", ROOT_DIR."views/");
/* --- namespaces */
define("DEV_NAMESPACE", "fadeev\\php2\\");
define("CONTROLLERS_NAMESPACE", DEV_NAMESPACE."controllers\\");
/* --- database --- */
require_once(ROOT_DIR."config/db.php");
?>