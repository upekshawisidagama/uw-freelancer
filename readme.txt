=== UW Freelancer ===
Contributors: Upeksha Wisidagama
Donate link: http://www.php-sri-lanka.blogspot.com
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.txt
Tags: freelancer, freelancer.com, profile widget, feedback widget, affiliate widget
Requires at least: 3.1
Tested up to: 3.5.1
Stable tag: 0.2

Display your freelancer.com profile details and project feedback on your WordPress site using widgets. Display an affiliate project listing widget.

== Description ==

UW Freelancer plugin allows you to display your freelancer.com profile information on your WordPress site using configurable widgets. This plugin allows you to display the feedbacks you received for your recent projects easily with auto update feature. Display freelancer.com projects relevant to your WordPress site and participate in the referral program.

= Freelancer Profile Widget =

Profile widget enables you to display freelancer.com profile details in one of your sidebars. You need to enter your freelancer.com username in the admin panel. This widget automatically queries the freelancer.com api to obtain your profile information and formats it for the display in sidebars. The api response is cached. So you don’t need to query the freelancer.com api for each and every visitor for your site.

= Freelancer Feedback Widget =

You can display the feedback you received for your freelancer.com projects using this widget. You can configure the number of items to display in widget settings admin panel. It displays the review/description you received together with the rating. A link to the relevant project will also be appear in the feedback snippet. This enables your visitor to verify the details are correct and updated by visiting freelancer.com itself.

= Freelancer Affiliate Widget =

If you refer a person to freelancer.com you can get a commission each time freelancer.com receives their service charges.
WordPress freelancer affiliate widget enables you to list the latest projects related to a chosen keyword with affiliate links. e.g. You can list latest WordPress projects in your blog sidebar using this widget. Number of projects to list and the project listing keyword is configurable from the admin panel.

= Extend with hooks =

Plugin hooks allows you to hook into and alter almost any aspect of this plugin. Be it either customizing the front end appearance of a widget or back end options of a widget, just hook into the correct filter with your custom function to do whatever you want.

= Further Reading =
For more info, check out the following site:

* [UW Freelancer Widget](http://www.github.com/upekshawisidagama).

== Installation ==

1. Upload the `uw-freelancer` folder to the `/wp-content/plugins/` directory
1. Activate the UW Freelancer plugin through the 'Plugins' menu in WordPress
1. Configure the plugin by going to the `Freelancer` menu that appears in your admin menu

== Frequently Asked Questions ==

= WordPress Freelancer Profile Widget shows a profile information about someone else (not mine)? = 

After activating the widget for the first time, the default values are used to generate the widget front end output. You need to enter your freelancer.com username into the username field in the plugin settings page.

= UW Freelancer Widgets show only the plain information without styling. Why widget styles are missing? =

You need to have wp_head() function in your theme template. This plugin uses wp_head() to output enqueued styles. Put wp_head(); in the page HTML head section.

= Where are the 'Freelancer Wigets' ? I can't find Appearance > Widgets? =

You need to have at least one sidebar in your theme. Otherwise there will be no Appearance > Widgets section in the WordPress Admin. Register a new sidebar in your 'functions.php' and add it to your theme template.

= I don't like the default appearance of the widgets. How do I change the styling of widgets? =

Go to Plugin Dashboard in the WordPress Admin. At the bottom of the Profile Tab, you can find the link to the Customizer. You can change the colors, borders, etc. and see the effects of the changes you made in the preview panel. After you are done with tweaking the widget appearance click 'Save'.

The other option is to use a filter hook of this plugin.

= No output seems to be generated in for Affiliate Widget? =

Affiliate widget uses javascript to obtain and display affiliate project listing. This plugin needs 'wp_footer()' function in your theme functions file. WordPress Freelancer Affiliate Widget javascripts enqueue in the footer through 'wp_footer()'. Put wp_footer(); in your theme template footer.

= Can I see the raw (xml or json) api query responses ? =

Yes you can view the raw responses that are returned by freelancer.com api upon querying for information. Those responses are stored in WordPress transients. WordPress Freelancer Plugin allows you to extend the plugin itself using WordPress Freelancer Hooks API.

Whenever you hook into the WordPress Freelancer Hooks API you are given these api response object for manipulation. You can view all of them in one place.

Go to WordPress plugin dashboard and then to settings tab. In the tabbed panel you'll find the information about raw api responses.

= I need to reset this plugin to the initial state. How do I do that? =

Under each of the settings tabs, there is a 'Reset Defaults' button which you can use to reset the settings of that tab to defaults.

Data retrieved by querying the freelancer.com api is stored in WordPress transients. If you need to clear all transients ( There are only two transients at a given time if you didn't change the username ) go to settings tab in the WordPress Freelancer Plugin Dashboard and check the settings field for 'Clear transients on Save'. Upon saving all transients will be deleted.

= Can you add feature X, Y, Z, etc. to this plugin? =

Let us know about the new feature you like to see in this plugin. We'll let you know our response after considering it.

= I need this plugin translated into my language. Can you provide a translated copy? =

Let us know which language you need. We will probably be able to translate this plugin into your language.

== Screenshots ==

1. Freelancer Profile Widget
2. Freelancer Feedback Widget
3. Freelancer Affiliate Widget
4. Admin interface in English language
5. Admin interface in Sinhala language
6. Widget appearance in Appearance > Widgets section

== Changelog ==

= 0.1 =

* Initial release.

== Upgrade Notice ==

= 0.1 =

* Initial release.
