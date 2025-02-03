# Changelog

## [1.0.1] - 2024-03-19

### Added
- Browser-sync integration for automatic browser reloading on file changes
- Environment configuration support via .env files
- Watch script in package.json for easier development workflow

### Changed
- Updated gulpfile.js with browser-sync integration and enhanced watch tasks
- Modified .gitignore to exclude .env files

### Dependencies
- Added browser-sync package for live reload functionality
- Added dotenv package for environment variable management

### Developer Experience
- Developers can now configure their local development URL via .env file
- Automatic browser reloading when SCSS or PHP files change
- New watch command available via 'npm run watch' or 'npm start'