## Theme development setup
Go to `wp-content/themes/fivetwofive-theme` and run `npm install` in the command line.
Then initialize the theme’s task runner (gulp) by running `gulp` in the command line.

## Hooks and Filters

### Theme Options
Change the default values of the theme customizer.

#### Change the default selected values in the theme customizer.
Add a filter to `fivetwofive_theme_default_theme_mods` to change the default selected values 
in the theme customizer.


### Layout
Change the default layout of the theme through these filters.

#### Enable sidebar to a page
Add a filter to `fivetwofive_theme_enable_sidebar` to make a specific page have the sidebar
enabled. Simply add a condition and set the $show_sidebar to true.

#### Make a page content contained
Add a filter to `fivetwofive_theme_is_contained` to make a specific page content contained.

### Icons
Change the default Icons of the theme through these filters.

#### Change the default icons
Add a filter to `fivetwofive_theme_svg_icons_{$group}` to add/change an existing icon in the
theme. $group can be social or ui e.g. use the `fivetwofive_theme_svg_icons_ui` to filter the ui
Icons.
