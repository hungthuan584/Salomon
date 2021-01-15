<?php 
session_start();
session_destroy();
echo('<script>location.href = "session.php";</script>');
?>