<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Oscar Lonaeus">
        <meta name="description" content="see: https://moz.com/learn/seo/meta-description">

        <title>see: https://moz.com/learn/seo/title-tag</title>
        
        <link rel="stylesheet" href="css/custom.css?version=1631036042" type="text/css">
        <link rel="stylesheet" media="(max-width:800px)" href="css/tablet.css?version=1631036042" type="text/css">
        <link rel="stylesheet" media="(max-width: 600px)" href="css/phone.css?version=1631036042" type="text/css">

<!-- ************************ INCLUDE lib ************************ -->
<?php
include 'lib/constants.php';

print '<!-- ************************ Connecting to Database ************************ -->';
require_once(LIB_PATH . '/Database.php');

$thisDataBaseReader = new DataBase('jlonaeus_reader', 'r', DATABASE_NAME);
$thisDataBaseWriter = new DataBase('jlonaeus_writer', 'w', DATABASE_NAME);

?>
</head>
<?php

print '<body id="' . PATH_PARTS['filename'] . '">';
print '<!-- ************************ START OF BODY ************************ -->';

print PHP_EOL;

include 'header.php';
print PHP_EOL;

include 'nav.php';
print PHP_EOL;

?>
