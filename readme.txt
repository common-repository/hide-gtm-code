=== Hide GTM code ===
Contributors: createaccord
Tags: SEO, meta, GTM, japan, meta tag
Requires at least: 6.6
Tested up to: 6.6.1
Stable tag: 1.0.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires PHP: 7.4

The plugin embeds GTM code with minimal impact on your theme and performance, preventing unnecessary measurement.


== Description ==


"Hide GTM Code" is a very simple plugin.

GTM code will not be output when a user with "Create/Edit Articles" permissions is logged in, so it is recommended for people who do not want to measure their own access.

- Embed GTM tags without customizing the theme yourself.
- The insertion position is also taken into consideration, preventing a decrease in performance due to GTM tag insertion.
- Prevents GTM code from being output when a user with "Create/Edit Articles" permissions is logged in.

== Installation ==


1. Enter "Hide GTM code" in the plugin search field.
2. Once you find this plugin, click "Install Now" to install and activate it.


== Frequently asked questions ==


The code to fill in is only the tag that starts with "GTM". No JavaScript code required.


== Screenshots ==


1. "Dashboard" screen
2. "Settings" screen
3. "GSC Settings" screen"


== Changelog ==

1.0.8
The update was not reflected so I updated the version.

1.0.7
Previously, the specification was "logged-in users will not be measured," but in this case, there was a risk that view-only users (such as subscribers) who do not have permission to create or edit articles and need to log in would not be measured, so the specification was changed to "output GTM code when not logged in or when a user without permission to create or edit articles logs in (measurement will not be performed while a user with permission to create or edit articles is logged in)." In addition, the message has been revised to match the new specification, and a supplementary explanation regarding initialization has been added.

1.0.6
Fixed an issue where a PHP warning due to insufficient data would be displayed if data was not migrated when moving the homepage.

1.0.5
Some themes embed HTML tags directly under the body tag as theme-specific elements, so selecting GTM in How to verify ownership of GSC fails. Added "HTML code setting screen" to solve this problem.

1.0.4
Since the specification to embed svg immediately after the body element added from WordPress 5.9 is prioritized, GTM's noscript was not detected, and GSC's ownership verification using GTM failed again. Fixed again.
Fix details:
Fixed code output priority again to output GTM noscript code before svg (priority set to '0').

1.0.3
Fixed a bug that the value was not displayed on the screen when registering the input for the first time. (Because it was saved as data, it was displayed when you accessed it again. Please be assured that the data has not disappeared.)

1.0.2
Fixed a bug that GSC's ownership verification using GTM failed due to GTM's noscript not being judged due to the specification to embed svg immediately after the body element added from WordPress 5.9.
Fix details:
Fixed code output precedence to output GTM noscript code before svg.

1.0.1
Changed the translation method.

1.0.0
released.


== Upgrade notice ==

1.0.8
The update was not reflected so I updated the version.

1.0.7
Previously, the specification was "logged-in users will not be measured," but in this case, there was a risk that view-only users (such as subscribers) who do not have permission to create or edit articles and need to log in would not be measured, so the specification was changed to "output GTM code when not logged in or when a user without permission to create or edit articles logs in (measurement will not be performed while a user with permission to create or edit articles is logged in)." In addition, the message has been revised to match the new specification, and a supplementary explanation regarding initialization has been added.

1.0.6
Fixed an issue where a PHP warning due to insufficient data would be displayed if data was not migrated when moving the homepage.

1.0.5
Some themes embed HTML tags directly under the body tag as theme-specific elements, so selecting GTM in How to verify ownership of GSC fails. Added "HTML code setting screen" to solve this problem.

1.0.4
Since the specification to embed svg immediately after the body element added from WordPress 5.9 is prioritized, GTM's noscript was not detected, and GSC's ownership verification using GTM failed again. Fixed again.
Fix details:
Fixed code output priority again to output GTM noscript code before svg (priority set to '0').

1.0.3
Fixed a bug that the value was not displayed on the screen when registering the input for the first time. (Because it was saved as data, it was displayed when you accessed it again. Please be assured that the data has not disappeared.)

1.0.2
Fixed a bug that GSC's ownership verification using GTM failed due to GTM's noscript not being judged due to the specification to embed svg immediately after the body element added from WordPress 5.9.
Fix details:
Fixed code output precedence to output GTM noscript code before svg.

1.0.1
Changed the translation method.


== Arbitrary section ==

There are a few things to note.

Because this plugin uses functions that embed GTM code and/or GSC HTML tags, it cannot be used with themes that do not call the functions.

If you want to register GA4 with GTM and GSC after embedding GTM code on your website, select GTM in "How to verify GSC ownership". If you try to verify ownership in GA4, it will fail with an error.

Depending on the theme, some tags (such as the "a" tag) are embedded directly under the body tag as theme-specific elements. In that case, selecting GTM in "How to verify GSC ownership" will unfortunately fail, so please set it in "HTML tag". If you want to set HTML tags on your website, please set them from "GSC settings".

Be sure to clear your cache after setting.

There is no initialization function. If you want to erase the information you entered, please reinstall the plugin. If there is any necessary information, we apologize for the inconvenience, but please enter it again.
