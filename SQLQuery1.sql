USE master;
-- Please sort through these and keep what is required, and drop what isn't
-- I may or may not be avialable for contact on 03/31/2024 due to Holidays.
IF DB_ID(N'SDSDelivers') IS NOT NULL DROP DATABASE SDSDelivers;
CREATE DATABASE SDSDelivers;
GO

USE SDSDelivers;
GO
CREATE TABLE orders --Will we use this? I know some of it may not be necessary.
(	--each order has one or more inventory.
	orderId INT NOT NULL IDENTITY,
	creationDate DATETIME NOT NULL,
	shipperName NVARCHAR(120) NOT NULL,
	customerName NVARCHAR(120) NOT NULL,
	originRegion NVARCHAR(120) NOT NULL,
	destinationRegion NVARCHAR(120) NOT NULL,
	destinationSubRegion NVARCHAR(120) NOT NULL,
	serviceLevel NVARCHAR(120) NOT NULL,
	orderStatus NVARCHAR(120) NOT NULL, --(two options: Pending Arrival, Pending Pickup)
	scheduledDate DATETIME NOT NULL,
	CONSTRAINT pk_orderId PRIMARY KEY (orderId)
);

CREATE TABLE inventory
( -- each inventory (item) belongs to one order.
	inventoryId INT NOT NULL IDENTITY,
	creationDate DATETIME NOT NULL,
	inventoryName NVARCHAR(120) NOT NULL,
	arrivalDate DATETIME NOT NULL,
	departureDate DATETIME NOT NULL,
	CONSTRAINT pk_inventoryId PRIMARY KEY (inventoryId)
);

CREATE TABLE freight
( 
	manifestId INT NOT NULL IDENTITY,
	routeName NVARCHAR(120) NOT NULL,
	manifestStatus NVARCHAR(120) NOT NULL, --Open/Closed.
	originRegion NVARCHAR(120) NOT NULL,
	destinationRegion NVARCHAR(120) NOT NULL,
	stopOvers NVARCHAR(120) NOT NULL, --Any stops along the way?
	direction NVARCHAR(120) NOT NULL, --(Outbound or Inbound).
	arrivalDate DATETIME NOT NULL,
	departureDate DATETIME NOT NULL,
	CONSTRAINT pk_manifestId PRIMARY KEY (manifestId)
);

CREATE TABLE employee
(
	employeeId INT NOT NULL IDENTITY,
	employeeUsername NVARCHAR(120) NOT NULL,
	employeePassword NVARCHAR(120) NOT NULL,
	employeeType NVARCHAR(120) NOT NULL,
	CONSTRAINT pk_employeeId PRIMARY KEY (employeeId)
);

CREATE TABLE courierSurvey
(
	courierSurveyId INT NOT NULL IDENTITY,
	nameSurvey NVARCHAR(120) NOT NULL,
	emailAddress NVARCHAR(120) NOT NULL,
	feedback NVARCHAR(8000) NOT NULL,
	
	CONSTRAINT pk_courierSurveyId PRIMARY KEY (courierSurveyId),
);
