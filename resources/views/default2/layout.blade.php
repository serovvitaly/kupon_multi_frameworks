<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<link rel="icon" href="/favicon.ico">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title')</title>
@yield('og_meta')
<link rel="stylesheet" href="/styles.css">
<link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300italic,700&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'>
<link href="//fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i&subset=cyrillic,cyrillic-ext" rel="stylesheet">
<link href='//fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css' />

<script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link href="/styles.css" rel="stylesheet"/>
<link href="/css/styles.css?1" rel="stylesheet"/>
<style>
    body {
        font-family: GraphikCy-Semibold,'Helvetica CY',Arial,sans-serif;
    }
    span.title{
        display: block;
        font-size: 34px;
        line-height: 36px;
    }
    .art-mini {
        color: inherit;
        text-decoration: none;
    }
    .art-mini:hover {
        color: inherit;
        text-decoration: none;
    }
    .art-mini:hover span.title{
        color: #3596df;
    }
</style>
</head>
<body>
@if($showMetric)
@include('default2.metric')
@endif
<div class="container-fluid container-main">
    <div class="row">
        <div class="col-lg-7">
            @yield('content')
        </div>
    </div>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//vk.com/js/api/openapi.js?139"></script>
</div>
</body>
</html>