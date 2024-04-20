<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SDS Delivers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #000;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #f8f9fa;
            padding: 10px;
            text-align: center;
        }

            nav a {
                text-decoration: none;
                color: #007bff;
                padding: 10px;
            }

        section {
            padding: 20px;
        }

        footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>SDS Delivers</h1>
        <p>Orders</p>
    </header>

    <nav>
        <a href="index.php">Login</a>
        <a href="survey.php">Survey</a>
        <a href="orders.php">Orders</a>
    </nav>

    <section>
        
        <!-- Display orders here -->
        <!--<p>This section will display orders...</p>-->
        <form action="" method="post">
            <h2>Orders Page</h2>
            <p>'*' designates required feilds at time of inventory item creation.<br>
            Inventory ID will fill itself out when adding a new item.<br>
            To edit an inventory item, type in it's ID and click Select Inventory Item.<br>
            Copy and paste the information you want to keep, and update the rest.<br>
            Then, click Update Inventory Item.</p>
        <label for="inventoryId">Inventory ID:</label><br>
        <input type="inventoryId" id="inventoryId" name="inventoryId"><br>
        
        <label for="inventoryName">*Inventory Name:</label><br>
        <input type="text" id="inventoryName" name="inventoryName"><br>

        <label for="description">*Description</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>
        
        <label for="deliveryAddress">*Delivery Address:</label><br>
        <input type="text" id="deliveryAddress" name="deliveryAddress"><br>

        <label for="recepientInformation">*Recepient Information:</label><br>
        <input type="text" id="recepientInformation" name="recepientInformation"><br>

        <label for="received">*Received:</label><br>
        <input type="date" id="received" name="received"><br>

        <label for="shipped">Shipped:</label><br>
        <input type="date" id="shipped" name="shipped"><br>
        <p>Note: Update Inventory Item Requires Shipped to be filled.</p>
        <br>
            <input type="submit" name = "insert" value="Add to Inventory">
            <input type = "submit" name = "view" value = "View Inventory">
            <input type = "submit" name = "select" value = "Select Inventory Item">
            <input type = "submit" name = "update" value = "Update Inventory Item">
            <input type = "submit" name = "delete" value = "Delete Inventory Item">
        </br>
        
    </form>
    </section>
     <?php
        //set up the connection.
        $conn = mysqli_connect('localhost', 'root', '', 'SDSDeliversDB');
        if($conn)
        {
            // connection is good,  add submit button code.
            // check that all forms are filled when submit is clicked.
            if ( isset($_POST['insert']) && !empty($_POST['inventoryName'])
                && !empty($_POST['description']) && !empty($_POST['received']) 
                && !empty($_POST['deliveryAddress']) && !empty($_POST['recepientInformation'])
            )
            {
                    //id should be made by database, get values from form
                    $inventoryName = $_POST['inventoryName'];
                    $description = $_POST['description'];
                    $deliveryAddress = $_POST['deliveryAddress'];
                    $recepientInformation = $_POST['recepientInformation'];
                    $received = $_POST['received'];
                    $shipped = $_POST['shipped'];

                    //sql insert statement.
                    $query = "INSERT INTO inventory
			            (inventoryName, description, deliveryAddress, recepientInformation, received)
			            VALUES ('$inventoryName', '$description', '$deliveryAddress', '$recepientInformation', '$received' )";
			        if(mysqli_query($conn, $query))
				        {echo "<p>Insert Successfully.</p>";}
			        else
			            { echo "<p>Insert failed.</p>";} 
            }//end of the create new inventory item.

            
            //clicking the View all button for the surveys.
            if(isset($_POST['view']))
            {
                //select statement
                $query = "SELECT * FROM inventory";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
			    {
				    $display = "<h3>All items in Inventory</h3>";
                    
				    while($row = mysqli_fetch_assoc($result))
                    {
					    $display .= "Inventory ID: " . $row["inventoryId"]. "<br>";
					    $display .= "Inventory Name: " . $row["inventoryName"]. "<br>";
					    $display .= "Description: " . $row["description"]. "<br>";
                        $display .= "Delivery Address: " . $row["deliveryAddress"]. "<br>";
					    $display .= "Recepient Information: " . $row["recepientInformation"]. "<br>";
                        $display .= "Received: " . $row["received"]. "<br>";
                        $display .= "Shipped: " . $row["shipped"]. "<br>";
				    }
			    } 
                else{
				    $display = "<p>No inventory in the table.</p>";
			    }
			    echo $display;
            }//end of the View All button

            //This is made to select an inventory item and it's data from the inventory table.
            if( isset($_POST['select']) && !empty($_POST['inventoryId']))
            {
                 $id = $_POST['inventoryId'];   

                $query = "SELECT * FROM inventory WHERE inventoryId = '$id'"; // works! Finds the right item.
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
			    {
				    $display = "<h3>All items in Inventory</h3>";
                    
				    while($row = mysqli_fetch_assoc($result))
                    {
					    $display .= "Inventory ID: " . $row["inventoryId"]. "<br>";
					    $display .= "Inventory Name: " . $row["inventoryName"]. "<br>";
					    $display .= "Description: " . $row["description"]. "<br>";
                        $display .= "Delivery Address: " . $row["deliveryAddress"]. "<br>";
					    $display .= "Recepient Information: " . $row["recepientInformation"]. "<br>";
                        $display .= "Received: " . $row["received"]. "<br>";
                        $display .= "Shipped: " . $row["shipped"]. "<br>";
				    }
			    } 
                else{
				    $display = "<p>No such inventory item exists in the table. Try again.</p>";
			    }
			    echo $display;
            }//End of the Select an inventory item.

            //Now, to update the inventory item!
            if( isset($_POST['update']) && !empty($_POST['inventoryId']) 
                && !empty($_POST['inventoryName']) && !empty($_POST['description'])
                && !empty($_POST['received'])  && !empty($_POST['deliveryAddress']) && !empty($_POST['recepientInformation']) )
            {   
			    //get values from the form
                        $inventoryId = $_POST['inventoryId'];
			            $inventoryName = $_POST['inventoryName'];
                        $description = $_POST['description'];
                        $deliveryAddress = $_POST['deliveryAddress'];
                        $recepientInformation = $_POST['recepientInformation'];
                        $received = $_POST['received'];
                        $shipped = $_POST['shipped'];
			    //sql update statement
			    $query = "  UPDATE inventory 
                            SET inventoryName = '$inventoryName', description = '$description', deliveryAddress = '$deliveryAddress', recepientInformation = '$recepientInformation', received = '$received', shipped = '$shipped'
			                WHERE inventoryId = '$inventoryId'  ";
			    if((mysqli_query($conn, $query)) &&
				    mysqli_affected_rows($conn)>0)
                    {
				        echo "<p>Updated Successfully.</p>";
			        }
                    else
			        { echo "<p>Update failed.</p>";} 
		    }

            //This is made to delete an inventory item and it's data from the inventory table.
            if( isset($_POST['delete']) && !empty($_POST['inventoryId']))
            {
                 $inventoryId = $_POST['inventoryId'];   
            $query = "DELETE FROM Inventory WHERE inventoryId = '$inventoryId'";
			if((mysqli_query($conn, $query)) &&
				mysqli_affected_rows($conn)>0)
			{
					echo "<p>Deleted successfully.</p>";
			}
			else
			{ echo "<p>Delete failed.</p>";} 
                
            }//End of the Delete an inventory item.



        }//connected to the if($ statementconn)
        else{
            echo "<p>Connection failed.</p>";
        }
        ?>



    <section id="contact">
        <h2>Contact Us</h2>
        <p>Have a question or need assistance? Reach out to us!</p>
        <p>Email: info@sdsdelivers.com</p>
    </section>

    <footer>
        <p>&copy; 2024 SDS Delivers. All rights reserved.</p>
    </footer>

</body>
</html>