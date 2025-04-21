<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        /* Container Styling */
        .container {
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Heading Styling */
        h1 {
            font-size: 6rem;
            color: #e74c3c;
            margin-bottom: 20px;
        }

        /* Message Styling */
        .message {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .sub-message {
            font-size: 1rem;
            color: #777;
            margin-bottom: 20px;
        }

        /* Home Link Styling */
        .home-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .home-link:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p class="message">Oops! The page you're looking for doesn't exist.</p>
        <p class="sub-message">You may have mistyped the address or the page may have moved.</p>
        <a href="/" class="home-link">Go back to the homepage</a>
    </div>

    <script>
        // JavaScript for additional functionality
        // Example: Redirect to homepage after 10 seconds
        setTimeout(function() {
            window.location.href = "/";
        }, 10000); // 10000 milliseconds = 10 seconds
    </script>
</body>
</html>