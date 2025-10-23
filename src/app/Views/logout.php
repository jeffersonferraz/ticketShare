<?php

// TO DO: put into AuthController

// finish session
session_destroy();

// redirect to login » home
echo '<meta http-equiv="refresh" content="0;url=index.php?route=home">';
exit();
