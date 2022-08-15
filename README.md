# Loop Theme
CMS developer test

Loop Theme is a custom starter theme for the Loop CMS developer test.

## Instructions to get started
* Install the theme directly within [WP-CLI](http://wp-cli.org/) or uploading through SFTP to your dedicated server or in the Wordpress admin
* Once active, SSH into your server as the user that owns the website you would like to install the theme on
  Use the cd command to switch to the document root directory of your website
  **Example: ```cd public_html/wp-content/themes/loop```**
* If you have not already installed WP-CLI on your server, please follow the instructions here [WP-CLI Install](https://wp-cli.org/#installing)
* Activate the theme through SSH or in the admin
  **Example:  ```wp theme activate Loop```**
* When activated the new custom post type called Events will be added to the admin, you can find it below Posts in the admin menu
* In your terminal run ```wp import_data insert_or_update_events``` to import the new events and to also update existing ones if required
* The events will now be displayed on the front page of your website based on the ones that are upcoming soonest
* To access the data as JSON, add the following string to the end of your site's url: ```/wp-json/loop/v1/events```


###### Estimated time of Task
6-8 hours

* Import Data: 3-5 hours
* Show Data: 2 hours
* Export data: 1 hour

###### Actual time with some estimates regarding tasks
6 hours 47mins

* Import Data: 4 hours 47mins
* Show Data: 1 hours 30mins
* Export data: 30mins
