<?php
if (!session_id()) session_start();
session_unset();
session_destroy();
header("Location: /intern_app/index.php");
exit();
