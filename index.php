<?php

use MintyPHP\Debugger;
use MintyPHP\Core\Debugger\View;
use MintyPHP\Session;
use MintyPHP\Router;

// Change directory to project root
chdir(__DIR__ . '/../..');
// Use default autoload implementation
require 'vendor/autoload.php';
// Load the config parameters
require 'config/config.php';

Debugger::$enabled = false;
Session::$enabled = true;
// Start the session
Session::start();

$requests = Debugger::getHistory();

?>
<!DOCTYPE html>
<html>

<head>
    <base href="<?php echo Router::getBaseUrl(); ?>">
    <title>MintyPHP Debugger</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="debugger/img/favicon.ico">
    <!-- Bootstrap -->
    <link href="debugger/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="debugger/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

    <!-- jDB (necessary for Bootstrap's JavaScript plugins) -->
    <script src="debugger/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="debugger/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">

        <div class="row">
            <div class="col-md-4">
                <h3>
                    <img src="debugger/img/minty_square.png" alt="MintyPHP logo" style="height: 24px; float:left; margin-right:10px;">
                    MintyPHP Debugger
                </h3>
            </div>
        </div>

        <?php echo (new View())->getMainView($requests); ?>

        <script>
            $(function() {
                var classes = [];
                $('#debug-request-0 a[data-toggle="tab"]').each(function(e) {
                    classes.push($(this).attr('class'));
                });
                $(classes).each(function(i, c) {
                    $('a[data-toggle="tab"].' + c).on('shown.bs.tab', function() {
                        $('a[data-toggle="tab"].' + c).each(function() {
                            $(this).tab('show');
                        });
                    });
                });
            });
        </script>

    </div>
</body>

</html>