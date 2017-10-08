<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Phalcon PHP Framework</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <?= $this->tag->javascriptInclude('public/js/jquery.min.js') ?>

    </head>
    <body>
            <?= $this->getContent() ?>
            <?= $this->tag->javascriptInclude('public/js/bootstrap.min.js') ?>


    </body>
</html>
