# MJ Fewbricks

This is a fork of [folbert/fewbricks](https://github.com/folbert/fewbricks) but with some additional features.

## Installation

If you use our mjstack (mjbedrock, mjtheme, mjtheme-child) you don't need to
include this plugin manually since its built in within the mjbedrock/composer.json
file.

Composer:

```json
	"repositories": {
        "mj-acf-fields": {
            "type": "vcs",
            "url": "git@github.com:macherjek1/fewbricks.git"
        }
    },
    "require": {
		    "macherjek1/fewbricks": "~2.0.0"
    }
	}
```

## Release History

* 1.5.0
	* Added Child Theme Support
  * display => block as default
