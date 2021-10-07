// Rename this file to gulpfile-config and change the browserSync proxy below to your setup for the autoloading to work.

let config = {
  browserSync: {
    proxy: 'https://fivetwofive.local/', // Change this to your local site URL.
  }
};

module.exports = config;
