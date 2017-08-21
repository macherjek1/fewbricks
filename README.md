# MJ Fewbricks

This is a fork of [folbert/fewbricks](https://github.com/folbert/fewbricks) which has an extendable Page Builder and supports parent -> child Theme hierachy.

Create your own set of bricks in a parent Theme and share them in multiple projects. For specific clients you sometimes need additional bricks which you store in the clients child Theme


## Advanced Features

* Child Theme Support
* Page Builder

## Installation


##### Install with Composer

1. Extend your `composer.json`
```javascript
{
  "repositories": {
        "fewbricks": {
            "type": "vcs",
            "url": "git@github.com:macherjek1/fewbricks.git"
        }
    },
    "require": {
      "macherjek1/fewbricks": "~2.0.0"
    }
  }
}
```
2. Install the plugin with `composer update


> **Hint:** If you use our mjstack (mj-bedrock, mj-theme, mj-theme-child) you don't need to include this plugin manually since its built in within the `mj-bedrock/composer.json` file.


## Setup


1. Either you copy the `fewbricks` folder from the plugin into your `theme` root folder or you just use our default Page Builder which we deliver with this plugin.

2. Create a new Wordpress Template inside your Theme-

```php
<?php
/**
 Template Name: Visual Editor
*/
while(have_rows('visual_editor')) : the_row();
  echo \fewbricks\acf\fields\flexible_content::get_sub_field_brick_instance()
        ->get_html(false, 'row-layout');
endwhile;
```

3. Read the docs from [fewbricks](https://github.com/folbert/fewbricks) on how to use this plugin. All the features from fewbricks are included.


### Use a child Theme

You can easily extend fewbricks with your own bricks without changing anything in the main theme or inside the plugin. 

1. Create a `fewbricks` folder in your child Theme.
2. Now write your own `Bricks` / `Fields` / `Layouts` in this folder. (Depends on what you want to extend)
3. If you want to extend the Page Builder you'll need to hook into 


#### Create a cite field.

We use a flexible content Field for our Page Builder. 



## Release History

* 2.0.4
  * Fixed a shortcode error

* 2.0.3
  * Added our Page Builder to fewbricks
  * Hook renamed to fewbricks/visual-editor/flexible/set_fields

* 2.0.2
  * Fixed an issue where you can't define Bricks in Child Theme

* 2.0.1
  * Version Bump

* 2.0.0
	* Added Child Theme Support
  * display => block as default

## Known Issues

If the plugin is installed as symlink it won't work since the paths 
use the base path of the symlink and it fails!
