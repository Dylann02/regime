<?php

/**
 * Production Error View
 *
 * This is the view used to display errors in production environments
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
            color: #333;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            padding: 60px 40px;
            text-align: center;
        }
        .error-code {
            font-size: 3em;
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .error-title {
            font-size: 1.5em;
            color: #333;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 1.1em;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code"><?= esc($code) ?></div>
        <div class="error-title">An Error Occurred</div>
        <div class="error-message">
            We apologize, but something went wrong on our end. Please try again later.
        </div>
    </div>
</body>
</html>
