<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Bunkers On The Air Czech</title>
    <link rel="icon" type="image/x-icon" href="https://www.okbota.cz/img/favicon.ico">
    <!--

    Template 2103 Central

	http://www.tooplate.com/view/2103-central

    -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
    <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://www.okbota.cz/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://www.okbota.cz/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://www.okbota.cz/slick/slick-theme.css" />
    <link rel="stylesheet" href="https://www.okbota.cz/css/tooplate-style.css">
    <!-- tooplate style -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables CSS and JS -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <!-- Include PapaParse -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>
    <style>
        /* Změna velikosti písma v tabulce */
        table.dataTable {
            font-size: 14px; /* Změňte na požadovanou velikost */
        }
        /* Změna velikosti písma v záhlaví tabulky */
        table.dataTable thead th {
            font-size: 14px; /* Změňte na požadovanou velikost */
        }
        /* Změna velikosti písma v těle tabulky */
        table.dataTable tbody td {
            font-size: 14px; /* Změňte na požadovanou velikost */
        }
        
        tr.licha {
    background: #f2f2f2;
    }
    
    td {
        padding-left: 5px;
        padding-right: 5px;
    }
    </style>

    <script>
        var renderPage = true;

        if (navigator.userAgent.indexOf('MSIE') !== -1
            || navigator.appVersion.indexOf('Trident/') > 0) {
            /* Microsoft Internet Explorer detected in. */
            alert("Please view this in a modern browser such as Chrome or Microsoft Edge.");
            renderPage = false;
        }
    </script>

</head>

<body>
    <!-- Loader -->
    <div class="container">
        <section class="tm-section-head" id="top">
            <h1>OKBOTA admin page</h1> <br>
            | <a href="logimport.php">Log import</a> |
            <a href="logstore.php">Logstore</a> |<br><br><br>
        </section>

        
<?php 
include_once "connect.php";
?>        
