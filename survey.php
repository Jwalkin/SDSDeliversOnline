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
        <p>Courier Survey</p>
    </header>

    <nav>
        <a href="index.php">Login</a>
        <a href="survey.php">Survey</a>
        <a href="orders.php">Orders</a>
    </nav>

    <form action="" method="post">
        <h2>Survey Page</h2>
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email"><br>

        <label for="feedback">Feedback:</label><br>
        <textarea id="feedback" name="feedback" rows="4" cols="50"></textarea><br><br>
        <br>
            <input type="submit" name = "submit" value="Submit Survey">
            <input type = "submit" name = "viewAll" value = "View All Surveys">
        </br>
        
    </form>

    <?php
        //set up the connection.
        $conn = mysqli_connect('localhost', 'root', '', 'SDSDeliversDB');
        if($conn)
        {
            // connection is good,  add submit button code.
            // check that all forms are filled when submit is clicked.
            if( (isset($_POST['submit'])) && !empty($_POST['name'])
                && !empty($_POST['email']) && !empty($_POST['feedback']))
            {
                //id should be made by database, get values from form
                $nameSurvey = $_POST['name'];
                $emailAddress = $_POST['email'];
                $feedback = $_POST['feedback'];

                //sql insert statement.
                $query = "INSERT INTO courierSurvey
			        (nameSurvey, emailAddress, feedback)
			        VALUES ('$nameSurvey', '$emailAddress', '$feedback' )";
			    if(mysqli_query($conn, $query))
				    {echo "<p>Insert Successfully.</p>";}
			    else
			        { echo "<p>Insert failed.</p>";} 
            }
            
            //clicking the View all button for the surveys.
            if(isset($_POST['viewAll']))
            {
                //select statement
                $query = "SELECT * FROM courierSurvey";
                $result = mysqli_query($conn, $query);
                if(mysqli_num_rows($result) > 0)
			    {
				    $display = "<h3>All Surveys</h3>";
				    while($row = mysqli_fetch_assoc($result))
                    {
					    $display .= "Survey ID: " . $row["courierSurveyId"]. "<br>";
					    $display .= "Survey Name: " . $row["nameSurvey"]. "<br>";
					    $display .= "Survey Email: " . $row["emailAddress"]. "<br>";
                        $display .= "Survey Email: " . $row["feedback"]. "<br>";
				    }
			    } 
                else{
				    $display = "<p>No survey in the table.</p>";
			    }
			    echo $display;
            }
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
