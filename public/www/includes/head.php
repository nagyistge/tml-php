<?php include('helpers.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php echo tml_current_locale(); ?>"
      dir="<?php echo tml_current_language_direction() ?>">
<head>
    <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php javascript_tag("jquery191.js") ?>
    <?php javascript_tag("bootstrap.js") ?>
    <?php javascript_tag("sh.js") ?>
    <?php stylesheet_tag("bootstrap.css") ?>
    <?php stylesheet_tag("sh.css") ?>
    <?php tml_scripts(); ?>

    <title><?php echo tml_application()->name ?></title>
    <link rel="SHORTCUT ICON" href="<?php echo url_for('assets/img/favicon.ico') ?>"/>
    <style>
        body {
            padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
            padding-bottom: 40px;
            background-color: white;
        }
    </style>
</head>

<body>