<?php
/**
* HELPER CODES FOR BMGT407
* CREATED BY: CYRUS SAADAT
*/

// Used to connect to the database -- DO NOT CALL THIS FUNCTION OUTSIDE OF THIS FILE
function makeTheConnection() {

	// FILL IN YOUR DATABASE NAME
	$db = "asts";
	
	// UNCOMMENT THIS IF YOU ARE USING MYSQL
	$connection = "mysql:host=localhost;dbname=".$db;

	// ENTER YOUR INFORMATION FOR LOGGING IN
	$user = "root";
	$pwd = "";

	try {
		$GLOBALS['conn']  = new PDO($connection, $user, $pwd);
		$GLOBALS['conn']->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		return $GLOBALS['conn'];
	}
	catch(Exception $e){
		die(var_dump($e));
	}
}

// DO NOT MODIFY ANY OF THE FUNCTIONS BELOW

// For an INSERT or UPDATE query, where there is NO output returned
function runQuery($query) {
	if (!isset($GLOBALS['conn'])) {
		$GLOBALS['conn'] = makeTheConnection();
	}

	try {
		$stmt = $GLOBALS['conn']->prepare($query);
		$stmt->execute();
	} catch(Exception $e) {
		die(var_dump($e));
	}
}

// For SELECT query that returns MULTIPLE rows
function getRows($query) {
	if (!isset($GLOBALS['conn'])) {
		$GLOBALS['conn'] = makeTheConnection();
	} 

	$stmt = $GLOBALS['conn']->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//For SELECT query that returns ONLY ONE row
function getOneRow($query) {
	if (!isset($GLOBALS['conn'])) {
		$GLOBALS['conn'] = makeTheConnection();
	}
	
	$stmt = $GLOBALS['conn']->query($query);
	$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return (empty($rows)) ? null : $rows[0];
}

?>