=== Page Context Menu ===
Contributors: renvrant
Tags: menu, navigation, section, nav, context, hierarchy, child, parent
Requires at least: 3.0.1
Tested up to: 4.1.1
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Shows a menu based on the hierarchical (parent/child/sibling) relationships of the page you're viewing. Widget and shortcode enabled.

== Description ==

This plugin will allow you to show an automatically generated menu based on the hierarchy of the page being viewed. This makes creating navigation for subsections or related pages easy.

Use the shortcodes `[pcm]` or `[page_context_menu]` to show a list of related links, including parent page, children and siblings. To use in a template, call `do_action('pcm_show_menu')`

Features:
*   Comes with shortcodes, widget, and template hook.
*   Simple and stylable
*   Settings page to customize classes and markup

== Installation ==

To install the plugin:

1. Upload all plugin files to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress

**Shortcodes:**
`[pcm]`
`[page_context_menu]`

**Use in a Template**
 `do_action('pcm_show_menu')`

== Frequently Asked Questions ==

= Will it work with Custom Post Types? =

Yes - any post type with hierarchy is supported.

= What if the page has no parent, child or sibling? =

The menu will fail gracefully and nothing will appear.

== Changelog ==

= 1.0 =
* Launch!
