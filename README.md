# WP Plugin Boilerplate

This is just a boilerplate for developing your new amazing WordPress plugin.
Here are some features that already available out of the box:

1. Easy configurable plugin settings.
2. An autoloader that supports WordPress-style class naming and namespaces.
3. A well-organized folder structure to facilitate your work.
4. A singleton trait to ensure certain classes are only initialized once.
5. Support for SCSS and JS minification.
6. An example of PHP configuration.
7. A Renderer class and template examples.
8. A DB manager class with usage examples.
9. An example of shortcode registration.
10. An example of registering ajax calls.

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
3. Replace wpplgnblrplt with your unique plugin prefix in all the plugin files.
4. Replace WP_Plugin_Boilerplate namespace with your plugin namespace in all the
   plugin files.
5. Update your package.json file with your plugin description.
6. Replace translation domain 'wp-plugin-boilerplate-domain' with your
   translation domain.
7. For JS data: replace `boilerplateData` with your unique data key.
8. Remove all the unnecessary functionality.

## Development process

For frontend development, you need to install development dependencies:

```npm install```

After that, you can run the watch process:

```npm run watch```

And, when you're ready to push your changes live, run:

```npm run prod```

Please feel free to fork or pull request.
