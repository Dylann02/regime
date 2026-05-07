<?php

/**
 * HTML Error View
 *
 * This is the HTML view used to display errors for the web
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
            max-width: 800px;
            width: 100%;
            padding: 40px;
        }
        .error-header {
            border-left: 5px solid #e74c3c;
            padding-left: 20px;
            margin-bottom: 30px;
        }
        .error-code {
            font-size: 3em;
            color: #e74c3c;
            font-weight: bold;
            margin: 0;
        }
        .error-title {
            font-size: 1.5em;
            color: #333;
            margin: 10px 0 0 0;
        }
        .error-message {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 15px;
            margin: 20px 0;
            font-family: "Courier New", monospace;
            word-break: break-word;
        }
        .error-details {
            margin: 30px 0;
        }
        .detail-section {
            margin: 20px 0;
        }
        .detail-title {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        .file-info {
            background: #f8f9fa;
            padding: 10px;
            border-left: 3px solid #667eea;
            margin: 10px 0;
            font-family: "Courier New", monospace;
            font-size: 0.9em;
        }
        .trace {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 15px;
            overflow-x: auto;
            margin-top: 10px;
        }
        .trace-item {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
            font-family: "Courier New", monospace;
            font-size: 0.85em;
        }
        .trace-item:last-child {
            border-bottom: none;
        }
        .trace-function {
            color: #667eea;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-header">
            <h1 class="error-code"><?= esc($code) ?></h1>
            <h2 class="error-title"><?= esc($title) ?></h2>
        </div>

        <div class="error-message">
            <strong>Message:</strong> <?= esc($message) ?>
        </div>

        <div class="error-details">
            <div class="detail-section">
                <div class="detail-title">File Location</div>
                <div class="file-info">
                    <?= esc($file) ?> <strong>Line:</strong> <?= esc($line) ?>
                </div>
            </div>

            <?php if (!empty($trace)): ?>
            <div class="detail-section">
                <div class="detail-title">Stack Trace</div>
                <div class="trace">
                    <?php foreach ($trace as $index => $row): ?>
                    <div class="trace-item">
                        <span class="trace-function">
                            <?= esc($row['function'] ?? 'unknown') ?>
                        </span>
                        (<?= esc($row['file'] ?? 'unknown') ?>:<?= esc($row['line'] ?? '?') ?>)
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
