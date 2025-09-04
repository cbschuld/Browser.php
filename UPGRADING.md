# Upgrading from v1.x to v2.0

## Breaking Changes

### PHP Version Requirement
- **Minimum PHP version**: 8.0+ (was 7.2+)
- **Reason**: Enables modern PHP features and improved performance

### Namespace Introduction
- **New namespace**: `cbschuld\Browser`
- **Migration path**: See usage examples below

### Return Type Declarations
- Added return type hints to protected methods
- **Impact**: If you extend the `Browser` class and override protected methods, you'll need to add matching return types
- **Example**: `protected function checkBrowserEdge(): bool` (was `protected function checkBrowserEdge()`)

## Migration Guide

### For Composer Users

#### Option 1: Use Namespaced Class (Recommended)
```php
// Old (v1.x)
$browser = new Browser();

// New (v2.x) - Recommended
use cbschuld\Browser;
$browser = new Browser();
```

#### Option 2: Keep Using Global Class (Backward Compatible)
```php
// Still works in v2.x due to automatic aliasing
$browser = new Browser();
```

### For Non-Composer Users

#### Direct Include (Still Works)
```php
// Include the root Browser.php file
require_once '/path/to/Browser.php';
$browser = new Browser(); // Works via automatic aliasing
```

#### Manual Namespace Include
```php
// Include the namespaced file directly
require_once '/path/to/src/Browser.php';
use cbschuld\Browser;
$browser = new Browser();
```

### For Class Extenders

If you extend the Browser class, update your method signatures:

```php
// Old (v1.x)
class MyBrowser extends Browser {
    protected function checkBrowserEdge() {
        // your implementation
    }
}

// New (v2.x)
use cbschuld\Browser;

class MyBrowser extends Browser {
    protected function checkBrowserEdge(): bool {
        // your implementation
    }
}
```

## New Features in v2.0

### Improved Version Comparison
Use the new `compareVersion()` method for PHP 8+ compatible version comparisons:

```php
$browser = new Browser();
// Instead of: $browser->getVersion() >= '10.0'
// Use: $browser->compareVersion('10.0', '>=')
```

### Enhanced Edge Detection
- Better support for modern Edge user agents
- Handles Edge/, Edg/, EdgA/, and EdgiOS/ patterns

## Troubleshooting

### Tests Failing After Upgrade
- Ensure you're using PHP 8.0+
- Run `composer install` to get compatible dependencies
- Update any custom test classes that extend Browser

### Class Not Found Errors
- For Composer users: Run `composer dump-autoload`
- For direct includes: Ensure you're including the root `Browser.php` file

### Version Comparison Issues
- Replace direct version comparisons with `compareVersion()` method
- This handles PHP 8's stricter type comparison rules

## Need Help?

- [GitHub Issues](https://github.com/cbschuld/Browser.php/issues)
- [Documentation](https://github.com/cbschuld/Browser.php)