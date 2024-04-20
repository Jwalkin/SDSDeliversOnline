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
        <p>Log In</p>
    </header>

    <nav>
        <a href="index.php">Login</a>
        <a href="survey.php">Survey</a>
        <a href="orders.php">Orders</a>
    </nav>

    <form action="login.php" method="post">
        <h2>Login Page</h2>
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="submit" value="Login">
    </form>

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