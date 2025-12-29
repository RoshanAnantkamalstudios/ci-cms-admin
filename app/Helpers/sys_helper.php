<?php

function __encryptPassword($pPassword, $pSecurityString)
{
  $options = [
    'cost' => 12
  ];

  return password_hash($pPassword . $pSecurityString, PASSWORD_BCRYPT, $options);
}

function __verifyPassword($pPassword, $pHash)
{
  if (password_verify($pPassword, $pHash)) {
    return true;
  }

  return false;
}

function __getIPAddress()
{
  //whether ip is from the share internet 
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  }
  //whether ip is from the proxy 
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  //whether ip is from the remote address 
  else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }
  return $ip;
}
