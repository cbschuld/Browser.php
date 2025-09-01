<?php
/**
 * Backward compatibility bootstrap for Browser.php v1.x users
 * 
 * This file provides backward compatibility for users upgrading from v1.x to v2.x
 * 
 * Usage (v1.x style):
 *   $browser = new Browser();
 *   
 * This will automatically work with the new namespaced class.
 */

if (!class_exists('Browser', false) && class_exists('cbschuld\\Browser')) {
    class_alias('cbschuld\\Browser', 'Browser');
}