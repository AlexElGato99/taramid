<?php

$target = __DIR__ . '/storage/app/public';
$link = __DIR__ . '/public/storage';

if (!is_dir($target)) {
    die("Error: Target directory does not exist: {$target}");
}

if (file_exists($link)) {
    if (is_link($link)) {
        unlink($link);
        echo "Removed existing symlink<br>";
    } else if (is_dir($link)) {
        echo "Warning: public/storage exists as a directory, not a symlink<br>";
        echo "Please manually delete it first<br>";
        die();
    }
}

if (@symlink($target, $link)) {
    echo "Storage link created successfully!<br>";
    echo "Target: {$target}<br>";
    echo "Link: {$link}<br>";
    echo "<br>You can now delete this file.";
} else {
    echo "Failed to create symlink. Trying alternative method...<br>";
    
    $htaccess = __DIR__ . '/public/.htaccess';
    $content = file_get_contents($htaccess);
    
    if (strpos($content, 'RewriteRule ^storage/') === false) {
        $storageRule = "\n# Serve storage files\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteRule ^storage/(.*)$ ../storage/app/public/$1 [L]\n\n";
        file_put_contents($htaccess, str_replace('RewriteEngine On', 'RewriteEngine On' . $storageRule, $content));
        echo "Added storage serving rule to .htaccess<br>";
    }
    
    echo "<br>If images still don't work, contact your hosting support to enable symlink() function.";
}
?>