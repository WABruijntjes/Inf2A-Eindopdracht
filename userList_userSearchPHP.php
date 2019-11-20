<?php

$searchTerm =  strip_tags((string)$_POST['search']);
header("location:userList.php?search=$searchTerm");


