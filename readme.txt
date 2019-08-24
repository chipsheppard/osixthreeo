=== OsixthreeO ===

Contributors: Chip Sheppard
Tags: translation-ready, theme-options, full-width-template, featured-image-header, featured-images, sticky-post, custom-logo, custom-header, custom-colors, custom-background, flexible-header, one-column, two-columns, wide-blocks, block-styles
Requires at least: 4.0
Tested up to: 5.2.2
Stable tag: 1.3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
OsixthreeO is a basic but flexible starter theme for WordPress 5.0+.

2 Widget Areas
  - Sidebar
  - Footer

2 Supported Post Formats
  - Aside
  - Status

34 Theme Action Hooks for developers
This theme follows the standard set by the Theme Hook Alliance (THA)
The THA repo is from 2012 and has been mostly dormant since, but,
I think a standardized system of hooks for WordPress themes is a GREAT idea.
https://github.com/zamoose/themehookalliance

  Header:
  - tha_html_before()
  - tha_head_top()
  - tha_head_bottom()
  - tha_body_top()
  - tha_header_before()
  - tha_header_top()
  - tha_header_bottom()
  - tha_header_after()

  Index:
  - tha_content_before()
  - tha_content_wrap_before()
  - tha_content_top()
  - tha_content_loop()
  - tha_content_bottom()
  - tha_content_wrap_after()
  - tha_content_after()

  Loop:
  - tha_content_while_before()
  - tha_entry_before()
  - tha_entry_after()
  - tha_content_while_after()

  Content:
  - tha_entry_top()
  - tha_entry_content_before()
  - tha_entry_content_after()
  - tha_entry_bottom()

  Comments:
  - tha_comments_before()
  - tha_comments_after()

  Sidebar:
  - tha_sidebars_before()
  - tha_sidebar_top()
  - tha_sidebar_bottom()
  - tha_sidebars_after()

  Footer:
  - tha_footer_before()
  - tha_footer_top()
  - tha_footer_bottom()
  - tha_footer_after()
  - tha_body_bottom()

= Anything else I should know? =

The logo is constrained to 300px wide max.

<hr>             is 10% black
<hr class=“alt”> is 50% white

BlockQuote:
If NOT using the WP Block Editor... citations go in <cite> tags. A <span> tag inside the <cite> tag will unBold the text.

Gutenberg column blocks:
Add a class of "boxed" to a Columns Block then add an image and a paragraph to each column. This will style the columns in nice boxes.
Put a 3 columns block at the top of your homepage then give it another class of "up160". This will scoot it up 160 pixels so it overlaps the custom-header area for a nice effect.
To accommodate different amounts of text on the homepage there are several options for the amount of scooting.
- "up100" - scoots up 100 pixels
- "up120" - scoots up 120 pixels
- "up140" - scoots up 140 pixels
- "up160" - scoots up 160 pixels
- "up180" - scoots up 180 pixels

== ChangeLog ==

= 1.3.0 - 07 30 2019 =
* Refine customizer interface.
* Add typography controls.

= 1.2.0 - 07 30 2019 =
* Customizer control for site containment, content containment, sidebar placements, colors.
* Added custom-header, customizer controls, page-by-page featured image display control.

= 1.1.0 - 06 30 2019 =
* Adjust for Gutenberg editor styles.

= 1.0.0 - 01 01 2019 =
* Stable

= 0.5.0 - 11 11 2018 =
* First deploy to GIT

= 0.0.1 - 11 07 2018 =
* _s downloaded and renamed to "osixthreeo"

== Credits ==
* Started out as an Underscores starter theme http://underscores.me/, (C) 2012-2018 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* Uses normalize.css http://necolas.github.io/normalize.css/, (C) 2012-2016 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)
