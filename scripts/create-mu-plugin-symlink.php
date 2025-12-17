<?php
/**
 * Create symlink for mu-plugin loader.
 * This allows WordPress to auto-load the mu-plugin from its subdirectory.
 */

$src = 'wp-content/mu-plugins/digital-governance-platform/digital-governance-platform-mu-plugin.php';
$dest = 'wp-content/mu-plugins/digital-governance-platform-mu-plugin.php';

if (!file_exists($src)) {
    echo "Source file not found: $src" . PHP_EOL;
    exit(0);
}

if (file_exists($dest)) {
    if (is_link($dest)) {
        echo "Symlink already exists: $dest" . PHP_EOL;
    } else {
        echo "File already exists (not a symlink): $dest" . PHP_EOL;
    }
    exit(0);
}

$targetPath = 'digital-governance-platform/digital-governance-platform-mu-plugin.php';

if (symlink($targetPath, $dest)) {
    echo "✓ Symlink created: $dest -> $targetPath" . PHP_EOL;
} else {
    echo "✗ Failed to create symlink: $dest" . PHP_EOL;
    exit(1);
}
