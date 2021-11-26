# WP Plugin Boilerplate

This is just a boilerplate plugin for developing something amazing.
It has autoloader which supports WordPress-style class naming and namespaces: 

For classes:
It converts class Good_Name in app/class-good-name.php path.

For interfaces:
Converts interface Good_Interface into interface-good-interface.php

For traits:
Converts trait Good_Trait into traid-good-trait.php

Feel free to fork or pull request.

## Steps to start
1. Clone the repository

   ```git clone https://github.com/zahardev/wp-plugin-boilerplate.git```

2. Remove .git folder
3. Rename folder wp-plugin-boilerplate and file wp-plugin-boilerplate.php to something unique.
4. Replace PBLRPLT with your unique plugin prefix in all the plugin files.
5. Replace \_\_WP_Plugin_Boilerplate\_\_ with your plugin namespace in all the plugin files
