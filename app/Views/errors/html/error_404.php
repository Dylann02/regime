<?php

/**
 * 404 Error View
 *
 * This is the view used to display 404 errors
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
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
            font-size: 5em;
            color: #e74c3c;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .error-title {
            font-size: 2em;
            color: #333;
            margin-bottom: 20px;
        }
        .error-message {
            font-size: 1.1em;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .error-details {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 20px;
            margin: 20px 0;
            text-align: left;
        }
        .detail-label {
            font-weight: bold;
            color: #333;
        }
        .detail-value {
            font-family: "Courier New", monospace;
            color: #666;
            word-break: break-word;
            margin-top: 5px;
        }
        .back-link {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 30px;
            background: #667eea;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background 0.3s;
        }
        .back-link:hover {
            background: #764ba2;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">404</div>
        <div class="error-title">Page Not Found</div>
        <div class="error-message">
            The page you are looking for could not be found.
        </div>

        <div class="error-details">
            <div class="detail-label">Requested URL:</div>
            <div class="detail-value"><?= esc($file ?? 'Unknown') ?></div>
        </div>

        <a href="/" class="back-link">Go to Home</a>
    </div>
</body>
</html>
