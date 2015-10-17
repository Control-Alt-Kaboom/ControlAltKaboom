<?php
/* -------------------------------------------------------------------------------------------------
 * File:    ControlAltKaboom\Exception - tpl/error-header.tpl.php
 * Version: 1.0
 * Desc:    Custom Error/Exception Output Template (Header)
 * -------------------------------------------------------------------------------------------------
*/

$dir = "/libs/ControlAltKaboom/src/Exception/tpl";

print <<<END

<!DOCTYPE html>
<!--[if IE 9]><html class="lt-ie10" lang="en" > <![endif]-->
<html class="no-js" lang="en" >

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Control-Alt-Kaboom - An Error or Exception Was Triggered</title>
  <link rel="stylesheet" href="{$dir}/error-custom.css">
  <script src="{$dir}/error-custom.js"></script>

</head>
<body class="custom-error">
  
  <header>
  <div class="fixed error-head">
    <b>Control-Alt-Kaboom</b>
  </div>
  </header>
  
  <section class="error-body">
  
  
END;

