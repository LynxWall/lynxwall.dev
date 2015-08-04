{# whared\layouts\main.volt #}
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
        <meta name="keywords" content="phalcon multi-module" />
        <meta name="description" content="Mist â€” Multi-Purpose HTML Template" />
        <meta name="author" content="lynxwall.com" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>Common Layout</title>

        <!-- Bootstrap core CSS -->
        <link href="/public/css/bootstrap/bootstrap.min.css" rel="stylesheet" />

    </head>
    <body>
        <div class="container">
            <?php echo $this->getContent(); ?>
        </div>
        <!-- Scripts -->
        <script type="text/javascript" src="/public/js/jquery/jquery-2.1.4.min.js"></script>
        <script type="text/javascript" src="/public/js/bootstrap/bootstrap.min.js"></script>
    </body>
</html>