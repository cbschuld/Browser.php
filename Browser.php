<?php
/**
 * Browser.php v2.x Backward Compatibility Shim
 * 
 * This file provides backward compatibility for users who include Browser.php directly
 * without using Composer's autoloader.
 * 
 * For new projects, please use the namespaced class:
 *   use cbschuld\Browser;
 *   $browser = new Browser();
 * 
 * Legacy usage (deprecated but still works):
 *   require_once 'Browser.php';
 *   $browser = new Browser();
 */

// Include the actual Browser class
require_once __DIR__ . '/src/Browser.php';

// Create global alias for backward compatibility
if (!class_exists('Browser', false)) {
    class_alias('cbschuld\\Browser', 'Browser');
}

// Optional: Trigger deprecation notice (uncomment if desired)
// trigger_error(
//     'Using the global Browser class is deprecated. Please use cbschuld\\Browser instead.',
//     E_USER_DEPRECATED
// );