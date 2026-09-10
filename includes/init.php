<?php
include( 'includes/config.php' );

session_start();

date_default_timezone_set(SITE_TIMEZONE);

include( 'includes/functions-database.php' );
include( 'includes/database.php' );

include( 'includes/functions.php' );
include( 'includes/functions-user.php' );
include( 'includes/functions-task.php' );
include( 'includes/jdf.php' );