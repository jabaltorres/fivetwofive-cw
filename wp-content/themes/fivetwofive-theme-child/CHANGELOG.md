# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.1.3] - 2025-05-08

### Fixed
- Prevented animation logic in [animations.js file](assets/src/js/animations.js) from targeting shortcode-based CTA modules by excluding elements with `.ftf-module.ftf-module-code.cta-shortcode` in `initInnerPageAnimations()`

## [1.1.2] - 2025-02-06

### Changed
- Refactored animations.js for better organization and performance
  - Added centralized ANIMATION_CONFIG for consistent animation settings
  - Split animation logic into separate specialized functions
  - Improved documentation with detailed function descriptions
  - Optimized work cards animation sequence
  - Enhanced inner page module animations
  - Standardized animation timing and easing

### Fixed
- Sequential animation issues on inner pages
- Work cards animation visibility
- Above-fold content animation timing
- Module animation consistency across different page types

## [1.1.1] - 2025-02-04

### Changed
- Moved GSAP files from node_modules to dist/js/vendor
- Updated build process to handle vendor files
- Improved dependency management best practices

### Fixed
- GSAP file loading issues
- Script dependency order

## [1.1.0] - 2025-02-04

### Added
- Integrated GSAP (GreenSock Animation Platform) for enhanced animations
  - Installed GSAP via npm
  - Added GSAP core and ScrollTrigger plugin
  - Created animations.js for centralized animation management

### Enhanced
- Homepage animations:
  - Hero section: Staggered entrance animations for title, text, and profile image
  - Services section: Scroll-triggered fade-in animations with stagger effect
  - Recent Works: Sequential animations for portfolio items with alternating directions
  - Testimonials: Bounce effect for avatars and smooth fade-in for testimonial text
  - CTA section: Subtle entrance animation
  - Buttons: Interactive hover animations

### Technical Details
- Added GSAP dependencies to package.json
- Updated gulpfile.js to handle JavaScript processing
- Configured ScrollTrigger plugin for scroll-based animations
- Implemented JavaScript build process with minification and sourcemaps
- Added proper script enqueuing in functions.php

### Developer Notes
- GSAP animations are modular and easily customizable
- ScrollTrigger configurations can be adjusted per section
- Animation timings and effects can be modified in animations.js
- Build process automatically handles JavaScript minification

## [1.0.0] - Initial Release
- Base child theme functionality 