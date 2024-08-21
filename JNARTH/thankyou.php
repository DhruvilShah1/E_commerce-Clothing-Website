<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Thank You</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f5;
            color: #333;
            text-align: center;
        }
        .container {
            max-width: 600px;
            padding: 40px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        h1 {
            font-size: 3em;
            margin-bottom: 20px;
            color: #ff5722;
        }
        p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: #666;
        }
        .icon {
            font-size: 5em;
            margin-bottom: 30px;
            color: #ff5722;
            animation: bounce 1s ease infinite alternate;
        }
        @keyframes bounce {
            0% {
                transform: translateY(0);
            }
            100% {
                transform: translateY(-10px);
            }
        }
        .button {
            display: inline-block;
            padding: 15px 35px;
            background: #ff5722;
            color: #fff;
            font-size: 1.2em;
            text-decoration: none;
            border-radius: 30px;
            transition: background 0.3s ease;
        }
        .button:hover {
            background: #e64a19;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="icon">🎉</div>
        <h1>Thank You!</h1>
        <p>Your message has been sent successfully. We appreciate your feedback and will get back to you shortly.</p>
        <a href="index.php" class="button">Go to Home</a>
    </div>
</body>
</html>
