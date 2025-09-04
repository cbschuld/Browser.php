<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class AliasTest extends TestCase
{
    public function testBackwardCompatibilityAlias()
    {
        // Test that the global Browser class alias exists
        $this->assertTrue(class_exists('Browser', false), 'Global Browser class alias should exist');
        
        // Test that we can instantiate using the global alias
        $browser = new Browser('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
        $this->assertInstanceOf('Browser', $browser);
        $this->assertSame('Chrome', $browser->getBrowser());
    }
    
    public function testNamespacedClassExists()
    {
        // Test that the namespaced class exists
        $this->assertTrue(class_exists('cbschuld\\Browser', true), 'Namespaced Browser class should exist');
        
        // Test that we can instantiate using the namespaced class
        $browser = new \cbschuld\Browser('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
        $this->assertInstanceOf('cbschuld\\Browser', $browser);
        $this->assertSame('Chrome', $browser->getBrowser());
    }
    
    public function testAliasAndNamespacedClassAreIdentical()
    {
        // Test that both instances behave identically
        $userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36';
        
        $globalBrowser = new Browser($userAgent);
        $namespacedBrowser = new \cbschuld\Browser($userAgent);
        
        $this->assertSame($globalBrowser->getBrowser(), $namespacedBrowser->getBrowser());
        $this->assertSame($globalBrowser->getVersion(), $namespacedBrowser->getVersion());
        $this->assertSame($globalBrowser->getPlatform(), $namespacedBrowser->getPlatform());
        $this->assertSame($globalBrowser->isMobile(), $namespacedBrowser->isMobile());
    }
}