<!DOCTYPE html>
<html>
<head>
	<meta charset = "utf-8">
	<title>Create SDSDelivers Database</title>
</head>
<body>
<?php
	$conn = mysqli_connect('localhost', 'root', '');

	if($conn)
		echo "<p>Connection set up successfully.</p>";

	$query = "DROP DATABASE IF EXISTS SDSDeliversDB";

	mysqli_query($conn, $query);
	
	$query = "CREATE DATABASE SDSDeliversDB";
	if (mysqli_query($conn, $query))
		echo "<p>Database created successfully.</p>";

	mysqli_select_db($conn, "SDSDeliversDB");
		
//create orders table
	$query = "CREATE TABLE orders 
	(	
	orderId INTEGER UNSIGNED AUTO_INCREMENT,
	creationDate DATE NOT NULL,
	shipperName VARCHAR(120) NOT NULL,
	customerName VARCHAR(120) NOT NULL,
	serviceLevel VARCHAR(120) NOT NULL,
	orderStatus VARCHAR(120) NOT NULL, 
	scheduledDate DATE NOT NULL,
	PRIMARY KEY (orderId)
	)";
	if (mysqli_query($conn, $query))
		echo "<p>orders Table created successfully.</p>";


//create inventory table
	$query = "CREATE TABLE inventory
	(	 
	inventoryId INTEGER UNSIGNED AUTO_INCREMENT,
	inventoryName VARCHAR(120) NOT NULL,
	description VARCHAR(8000) NOT NULL,
	deliveryAddress VARCHAR(120) NOT NULL,
	recepientInformation VARCHAR(120) NOT NULL,
	received DATE NOT NULL,
	shipped DATE,
	CONSTRAINT pk_inventoryId PRIMARY KEY (inventoryId)
	)";
	if (mysqli_query($conn, $query))
		echo "<p>inventory Table created successfully.</p>";



//create freight table
	$query = "CREATE TABLE freight
	(	manifestId INTEGER UNSIGNED AUTO_INCREMENT,
	routeName VARCHAR(120) NOT NULL,
	manifestStatus VARCHAR(120) NOT NULL,
	originRegion VARCHAR(120) NOT NULL,
	destinationRegion VARCHAR(120) NOT NULL,
	stopOvers VARCHAR(120) NOT NULL, 
	direction VARCHAR(120) NOT NULL, 
	arrivalDate DATE NOT NULL,
	departureDate DATE NOT NULL,
	CONSTRAINT pk_manifestId PRIMARY KEY (manifestId)
	)";
	if (mysqli_query($conn, $query))
		echo "<p>freight Table created successfully.</p>";
		


//create employee Table
mysqli_select_db($conn, "SDSDeliversDB");
	$query = "CREATE TABLE employee 
	(
	employeeId INTEGER UNSIGNED AUTO_INCREMENT,
	employeeUsername VARCHAR(120) NOT NULL,
	employeePassword VARCHAR(120) NOT NULL,
	employeeType VARCHAR(120) NOT NULL,
	CONSTRAINT pk_employeeId PRIMARY KEY (employeeId)
	)";
	if (mysqli_query($conn, $query))
		echo "<p>Employee Table created successfully.</p>";



//create courierSurvey Table
mysqli_select_db($conn, "SDSDeliversDB");
	$query = "CREATE TABLE courierSurvey
	(
	courierSurveyId INTEGER UNSIGNED AUTO_INCREMENT,
	nameSurvey VARCHAR(120) NOT NULL,
	emailAddress VARCHAR(120) NOT NULL,
	feedback VARCHAR(8000) NOT NULL,
	CONSTRAINT pk_courierSurveyId PRIMARY KEY (courierSurveyId)
	)";
	if (mysqli_query($conn, $query))
		echo "<p>courierSurvey Table created successfully.</p>";



//NOW! To create intial employees and surveys for the tables.


	//create an administrator account.
	$sql = "INSERT INTO employee (employeeUsername, employeePassword, employeeType)
	VALUES ('JohnDoe', 'ASDF1234', 'administrator')";
	if ($conn->query($sql) === TRUE) {
	  echo "<p>New Administrator record created successfully.</p>";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}




	//create an employee account.
	$sql = "INSERT INTO employee (employeeUsername, employeePassword, employeeType)
	VALUES ('JohnDeer', 'ASDF1234', 'employee')";
	if ($conn->query($sql) === TRUE) {
	  echo "<p>New Employee record created successfully.</p>";
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$sql = "INSERT INTO courierSurvey
				(nameSurvey, emailAddress, feedback)
			    VALUES ('John Deer', 'jdear@gmail.com', 'Hello World!' )";
		if ($conn->query($sql) === TRUE) {
		  echo "<p>New Survey record created successfully.</p>";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

	$sql = "INSERT INTO courierSurvey
				(nameSurvey, emailAddress, feedback)
			    VALUES ('Mr. Rodgers', 'mrrodgers@gmail.com', 'Beautiful day in the neighborhood.' )";
		if ($conn->query($sql) === TRUE) {
		  echo "<p>New Survey record created successfully.</p>";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}


	
	$sql = "INSERT INTO inventory
				(inventoryName, description, deliveryAddress, recepientInformation, received, shipped)
			    VALUES ('UPS Package', '.5 lbs manila folder', '1234 Seasame Street', 'Jack Daniels', '2024-04-14', NULL )";
		if ($conn->query($sql) === TRUE) {
		  echo "<p>New inventory record created successfully.</p>";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

	$sql = "INSERT INTO inventory
				(inventoryName, description, deliveryAddress, recepientInformation, received, shipped)
			    VALUES ('Bird Mail', '2 lbs Bird Seed', '1234 Seasame Street', 'Mr Big Bird', '2024-04-15', NULL )";
		if ($conn->query($sql) === TRUE) {
		  echo "<p>New inventory record created successfully.</p>";
		} else {
		  echo "Error: " . $sql . "<br>" . $conn->error;
		}

?>
</body>
</html>