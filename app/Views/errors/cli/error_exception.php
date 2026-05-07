<?php

/**
 * CLI Error View
 *
 * This view is used to display errors in CLI mode
 */

// Only declare $message and $exception once
if (!isset($message)) {
    $message = '';
}

echo "\n";
echo str_repeat('=', 70) . "\n";
echo "AN ERROR OCCURRED\n";
echo str_repeat('=', 70) . "\n\n";

if (!empty($title)) {
    echo "[{$title}]\n\n";
}

echo "Message: ";
if (is_object($exception)) {
    echo $exception->getMessage();
} else {
    echo $message;
}
echo "\n\n";

if (is_object($exception)) {
    echo "File: " . $exception->getFile() . "\n";
    echo "Line: " . $exception->getLine() . "\n\n";

    if (isset($trace) && is_array($trace)) {
        echo "Stack Trace:\n";
        echo str_repeat('-', 70) . "\n";
        foreach ($trace as $index => $row) {
            echo "#" . str_pad($index, 3) . " ";
            echo (!empty($row['class']) ? $row['class'] . '::' : '');
            echo (!empty($row['function']) ? $row['function'] : '(main)');
            echo " called at [" . ($row['file'] ?? 'unknown') . ":" . ($row['line'] ?? '?') . "]\n";
        }
        echo str_repeat('-', 70) . "\n";
    }
}

echo "\n";
