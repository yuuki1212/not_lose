<?php

$log = file_get_contents('/var/log/mysqld.log');
preg_match("/temporary password is generated for .*?\n/", $log, $matches);
$str = rtrim(str_replace('temporary password is generated for ','',$matches[0]));
$p = explode(' ', $str)[1];
file_put_contents('temp_password',$p);

