# Kelso #

Contributors: chip sheppard
Tags: translation-ready, theme-options, full-width-template, footer-widgets, featured-images, featured-image-header, custom-logo, custom-colors, custom-background, flexible-header, grid-layout, right-sidebar, left-sidebar, two-columns

Requires at least: 4.0
Tested up to: 4.9.8
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A theme called Kelso, based on underscores.

## Description ##
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

Kelso is based on Underscores ( _s ) by Automatic, the keepers of WordPress. A basic but flexible that makes use of the WP Customizer.

## Installation ##
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

## Theme Stats ##
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

__ 7 Widget Areas __
  - Posts Sidebar
  - Pages Sidebar
  - Sub-Footer 1
  - Sub-Footer 2
  - Sub-Footer 3
  - Sub-Footer 4
  - Footer Widget Area

__ 2 Supported Post Formats
  - Aside
  - Status

__ 7 Theme Action Hooks for developers __
  - kelso_before_header
  - kelso_before_content
  - kelso_after_content
  - kelso_after_footer
  - kelso_single_before_entry
  - kelso_single_after_entry
  - kelso_inside_navigation : used for inserting search into the menu

__ 17 Customizer controls __
  - global_width_setting
  - nav_search
  - back_to_top
  - background_color
  - header_background_color
  - customheader_background_gradient_left
  - customheader_background_gradient_right
  - Logo color : if text
  - nav_link_color
  - text_color
  - link_color
  - link_color_hover
  - homepage_layout_setting
  - page_layout_setting
  - single_layout_setting
  - search_layout_setting
  - archive_layout_setting

__ 25 User CSS Classes __
  - arrow           = for LINKS, adds an arrow
  - line            = for LINKS, adds an underscore on hover
  - ta-center       = text-align: center
  - ta-right        = text-align: right
  - intro           = font-size: 150%
  - flex            = 100% width, responsive
  - pad             = padding: 1em
  - mobile-only     = does NOT show on desktops
  - desktop-only    = does NOT show on mobile
  - bg-base         = background-color:$color__base;
  - bg-base-medium  = background-color:$color__base-medium;
  - bg-base-light   = background-color:$color__base-light;
  - bg-base-xlight  = background-color:$color__base-xlight;
  - bg-base-xxlight = background-color:$color__base-xxlight;
  - bg-darklight    = background-color:$color__darklight;
  - text-highlight  = color:$color__highlight;
  - bg-highlight    = background-color:$color__highlight;
  - bb-highlight    = border-bottom: 2px solid $color__highlight;
  - text-secondary  = color:$color__secondary;
  - bg-secondary    = background-color:$color__secondary;
  - bb-secondary    = border-bottom: 2px solid $color__secondary;
  - bg-white        = background-color: #ffffff;
  - text-white      = color: #ffffff;
  - bg-black        = background-color: #000000;
  - text-black      = color: #000000;

__ 5 Button Classes __
  - button
  - button white
  - button secondary
  - button darklight
  - button wide

## THEME NOTES: ##
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

__ Logo __
The logo is constrained to 300px wide max.

__ HR (horizontal rule) __
<hr>             is 10% black
<hr class=“alt”> is 50% white

__ BlockQuote __
citations go in <cite> tags. A <span> tag inside the <cite> tag will unBold the text.

__ Display Featured Image __
The Display Featured Image checkbox does NOT appear when using Gutenberg.

__ Sidebar Widgets __
There are separate sidebars for Posts and Pages.

__ Footer Widgets __
Footer widget areas can be used as a single full-width column, two half-width columns, three third-width columns and four quarter-width columns.
If a widget is placed into the 4th widget area - all four widget areas are displayed at 25%.
If a widget is placed into the 3rd widget area and no widget is in the 4th - only widget areas 1, 2 & 3 are displayed at 33%.
If a widget is placed into the 2nd widget area and no widgets are in the 3rd or 4th - only widget areas 1 & 2 are displayed at 50%.
If a widget is placed into the 1st widget area and no widgets are in the 2nd, 3rd or 4th = only widget area 1 is displayed at 100%.


## Changelog ##
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

__ 1.0 - September 2018 __
 First deploy to GIT

__ 0.1 - April 24 2018 __
 _s downloaded and renamed to "Kelso"


## Credits ##
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

* Based on Underscores http://underscores.me/, (C) 2012-2018 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css http://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)
