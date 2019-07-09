# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project **attempts** to adhere to [Semantic Versioning](https://semver.org/spec/v2.0.0.html) while applying
changes when it socially makes sense.

## [Unreleased]

## [1.9.4] - 2019-07-09
### Added
- Added better support for Firefox Mobile
- Added support for the Brave browser
- Added support for the UCBrowser
- Added more tests for specific User Agents and more IE tests (removed duplicate UAs as well)

## [1.9.3] - 2019-07-08
### Added
- Added support for curl, wget and the Palemoon browser

## [1.9.2] - 2019-06-26
### Added
- PHPUnit Tests for Firefox, Opera and Chrome (3684 tests, 7368 assertions)
- Stronger tests for Firefox and Chrome
### Removed
- Dropped support for 5.x PHP due to updates to PHPUnit and legacy nature of 5.X

## [1.9.1] - 2019-06-19
### Added
6/19/2019: Update (Version 1.9.1)
* Added Firefox iOS (gejobj)
* Corrected 'Vivalidi' to 'Vivaldi' (adaxi)
* Reset enhancement (yahasana)
* Enforce using precise distribution until End Of Life for Travis CI (bburnichon)
* Lazy load browser class on demand (bburnichon)

## 1.9.0 - 2010-08-20
### Added
* Added MSN Explorer Browser
* Added Bing/MSN Robot
* Added the Android Platform
### Fixed
* Fixed issue with Android 1.6/2.2

## 1.8.0 - 2010-04-27
## Fixed
* Added iPad support

## 1.7.0 - 2010-03-07
### Added
* Added FreeBSD Platform
* Added OpenBSD Platform
* Added NetBSD Platform
* Added SunOS Platform
* Added OpenSolaris Platform
* Added support of the Iceweazel Browser
* Added isChromeFrame() call to check if chromeframe is in use
* Moved the Opera check in front of the Firefox check due to legacy Opera User Agents
* Added the __toString() method (Thanks Deano)
## Removed
* Almost all of Gary's original code has been replaced
## Fixed
* Version 1.7 was a *MAJOR* Rebuild (preg_match and other *slow* routine removal(s)) included the following

## 0.0.9 - 2008-12-09
### Fixed
* removed an unused constant and renamed the constructor to use the PHP magic method __construct (thanks to Robin for locating the legacy constant and suggesting the use of the magic method).

## 0.0.8 - 2009-11-08
### Fixed
* A lot of changes to the script, thank you to everyone for the suggestions and emails. This release should add all of the requested features. Added BlackBerry, mobile detection, Opera Mini support, robot detection, Opera 10's UserAgent mess, detection for IceCat and Shiretoko!

## 0.0.7 - 2009-04-27
### Fixed
* John pointed out a terrible typo (see below) - removed the typo

## 0.0.6 - 2009-04-22
### Added
* added support for GoogleBot, the W3C Validator and Yahoo! Slurp

## 0.0.5 - 2009-03-14
### Added
* added support for the iPod; added iPod and iPhone as platforms; added Google.s Android

## 0.0.4 - 2009-02-24
### Fixed
* fixed typo in the usage! (thanks Adam!)

## 0.0.3 - 2009-02-19
### Fixed
* updated typical usage to show a correct example! (thanks David!)
* Updated the version detection for Amaya
* Updated the version detection for Firefox
* Updated the version detection for Lynx
* Updated the version detection for WebTV
* Updated the version detection for NetPositive
* Updated the version detection for IE
* Updated the version detection for OmniWeb
* Updated the version detection for iCab
* Updated the version detection for Safari
* Updated Safari to remove mobile devices (iPhone)
### Added
* Added version detectionf for edge via [pixelbacon](https://github.com/pixelbacon)
* Added detection for Chrome
* Added detection for iPhone
* Added detection for robots
* Added detection for mobile devices
* Added detection for BlackBerry
* Added detection for iPhone
* Added detection for iPad
* Added detection for Android
### Removed
* Removed Netscape checks
