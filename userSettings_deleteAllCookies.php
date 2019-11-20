<?php

setcookie("userBackgroundColor", null, -3600);

header("Location: userSettings.php?cookiesDeleted=success");

