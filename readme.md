# Kelso #

Contributors: chip sheppard  
Tags: translation-ready, theme-options, full-width-template, footer-widgets, featured-images, featured-image-header, custom-logo, custom-colors, custom-background, flexible-header, grid-layout, right-sidebar, left-sidebar, two-columns

Requires at least: 4.0  
Tested up to: 4.9.8  
Stable tag: 1.0.0  
License: GPLv2 or later  
License URI: http://www.gnu.org/licenses/gpl-2.0.html  

## Description ##

Kelso is based on Underscores ( \_s ) by Automatic, the keepers of WordPress. A basic but flexible theme that makes use of the WP Customizer.

## Theme Stats ##

**7 Widget Areas**
  - Posts Sidebar
  - Pages Sidebar
  - Sub-Footer 1
  - Sub-Footer 2
  - Sub-Footer 3
  - Sub-Footer 4
  - Footer Widget Area

**2 Supported Post Formats**
  - Aside
  - Status

**35 Theme Action Hooks for developers**

header.php (8)
  - tha_html_before()
  - tha_head_top()
  - tha_head_bottom()
  - tha_body_top()
  - tha_header_before()
  - tha_header_top()
  - tha_header_bottom()
  - tha_header_after()

footer.php (5)
  - tha_footer_before()
  - tha_footer_top()
  - tha_footer_bottom()
  - tha_footer_after()
  - tha_body_bottom()

sidebar.php (4)
  - tha_sidebars_before()
  - tha_sidebar_top()
  - tha_sidebar_bottom()
  - tha_sidebars_after()

index.php (7)
  - tha_content_before()
  - tha_content_wrap_before()
  - tha_content_top()
  - tha_content_loop()
  - tha_content_bottom()
  - tha_content_wrap_after()
  - tha_content_after()

loop.php (4)
  - tha_content_while_before()
  - tha_entry_before()
  - tha_entry_after()
  - tha_content_while_after()

content.php (5)
  - tha_entry_top()
  - tha_entry_content_before()
  - tha_entry_content_after()
  - tha_entry_bottom()
  - kelso_inside_navigation : used for inserting search into the menu

comments.php (2)
  - tha_comments_before()
  - tha_comments_after()

**33 Customizer controls**
  - Logo color : if text
  - background_color
  - content_background_color
  - text_color
  - link_color
  - link_color_hover
  - header_background_color
  - nav_link_color
  - stickyheader_background_color
  - stickyheader_link_color
  - footerwidgets_background_color
  - footerwidgets_text_color
  - footerwidgets_link_color
  - footerwidgets_link_color_hover
  - footer_background_color
  - footer_text_color
  - footer_link_color
  - footer_link_color_hover
  - global_width_setting
  - home_layout_setting
  - page_layout_setting
  - single_layout_setting
  - search_layout_setting
  - archive_layout_setting
  - back_to_top
  - nav_search
  - home_header_height
  - header_bg_color_left
  - header_bg_color_right
  - hero_text_primary
  - hero_text_secondary
  - hero_text_primary_color
  - hero_text_secondary_color

**25 User CSS Classes**
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

**5 Button Classes**
  - btn
  - btn white
  - btn secondary
  - btn darklight
  - btn wide

## THEME NOTES: ##

**Logo**
The logo is constrained to 300px wide max.

**HR (horizontal rule)**
&lt;hr>             is 10% black
&lt;hr class=“alt”> is 50% white

**BlockQuote**
citations go in &lt;cite> tags. A &lt;span> tag inside the &lt;cite> tag will unBold the text.

**Display Featured Image**
The Display Featured Image checkbox does NOT appear when using Gutenberg.

**Sidebar Widgets**
There are separate sidebars for Posts and Pages.

**Footer Widgets**
Footer widget areas can be used as a single full-width column, two half-width columns, three third-width columns and four quarter-width columns.

If a widget is placed into the 4th widget area - all four widget areas are displayed at 25%.

If a widget is placed into the 3rd widget area and no widget is in the 4th - only widget areas 1, 2 & 3 are displayed at 33%.

If a widget is placed into the 2nd widget area and no widgets are in the 3rd or 4th - only widget areas 1 & 2 are displayed at 50%.

If a widget is placed into the 1st widget area and no widgets are in the 2nd, 3rd or 4th = only widget area 1 is displayed at 100%.


## Changelog ##

**1.0 - September 2018**
 First deploy to GIT

**0.1 - April 24 2018**
 \_s downloaded and renamed to "Kelso"


## Credits ##

* Based on Underscores http://underscores.me/, (C) 2012-2018 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css http://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)
