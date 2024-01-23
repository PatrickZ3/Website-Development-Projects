#!/usr/bin/perl -wT
use CGI ':standard';
use strict;
print "Content-type: text/html\n\n";

print <<"HTML CODE";
<!DOCTYPE html>
<html>
<head>
    <title>Lab07a</title>
    <link rel="stylesheet" href="https://https://fonts.google.com/specimen/Roboto+Mono">
    <style>
    body{
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }   
    h1{
        font-family: Roboto+Mono;
        color:#fdeb37;
        text-shadow: 1px 1px black;
    }
    </style>
</head>
<body>
    <h1>This is my first Perl Program</h1>
</body>
</html>
HTML CODE