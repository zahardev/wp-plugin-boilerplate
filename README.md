# WP Plugin Boilerplate

This is just a boilerplate for developing your new amazing WordPress plugin.
Here are some features that already available out of the box:

1. An autoloader that supports WordPress-style class naming and namespaces. 
2. A well-organized folder structure to facilitate your work.
3. A singleton trait to ensure certain classes are only initialized once. 
4. Support for SCSS and JS minification. 
5. An example of PHP configuration. 
6. A Renderer class and template examples. 
7. A DB manager class with usage examples. 
8. An example of shortcode registration. 
9. An example of registering ajax calls.

## Steps to start
1. Clone the repository

   ```git clone https://github.com/zahardev/wp-plugin-boilerplate.git```

2. Remove .git folder
3. Enable the plugin
4. To check the plugin functionality, please try the following shortcode:

```[example_shortcode]```

## Customization steps
1. Rename folder wp-plugin-boilerplate and file wp-plugin-boilerplate.php.
2. Replace WPPLGNBLRPLT with your unique plugin prefix in all the plugin files.
3. Replace WP_Plugin_Boilerplate with your plugin namespace in all the plugin files.
4. Update your package.json file with your plugin description.
5. Replace translation domain 'wp-plugin-boilerplate-domain' with your translation domain.
6. For JS data: replace `boilerplateData` with your unique data key.
7. Remove all the unnecessary functionality.


Please feel free to fork or pull request.
