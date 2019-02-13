<?php
	ini_set('display_errors', 'On');

	###############
	# ENVIRONMENT #
	###############
	require_once(__DIR__ . '/descartes/load-environment.php');

    ###########
	# ROUTING #
	###########
    require_once(PWD . '/routes.php'); //Include routes

	############
	# SESSIONS #
	############
	session_name(SESSION_NAME);
	session_start();

    //Create csrf token if it didn't exist
	if (!isset($_SESSION['csrf']))
	{
		$_SESSION['csrf'] = str_shuffle(uniqid().uniqid());
	}

	//Create logged token if it didn't exist
	if (!isset($_SESSION['logged']))
	{
		$_SESSION['logged'] = false;
		echo $_SESSION['logged'];
	}

	##############
	# INCLUDE    #
	##############
    //Use autoload
	require_once(PWD . '/descartes/autoload.php');
	require_once(PWD . '/vendor/autoload.php');

	#########
	# MODEL #
	#########
    //Create new PDO instance
	$pdo = Model::connect(DATABASE_HOST, DATABASE_NAME, DATABASE_USER, DATABASE_PASSWORD);

    //Routing current query
    Router::route(ROUTES, $_SERVER['REQUEST_URI'], $pdo);

