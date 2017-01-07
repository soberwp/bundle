# Themer

Simple WordPress plugin for theme templating options and plugin activation using JSON files.

## Installation

#### Composer:

Recommended method; [Roots Bedrock](https://roots.io/bedrock/) and [WP-CLI](http://wp-cli.org/)
```shell
$ composer require soberwp/themer
$ wp plugin activate themer
```

#### Manual:

* Download the [zip file](https://github.com/soberwp/themer/archive.master.zip)
* Unzip to your sites plugin folder
* Activate via WordPress

#### Requirements:

* [PHP](http://php.net/manual/en/install.php) >= 5.6.x

## Setup

By default, files `templates.json` and `plugins.json` are used.

You can use a custom file for each using the filters below within your themes `functions.php` file; 
```php
add_filter('sober/themer/template/file', function () {
    return get_stylesheet_directory() . '/theme.json';
});

add_filter('sober/themer/plugin/file', function () {
    return get_stylesheet_directory() . '/plugin-activations.json';
});
```

## Usage

### Templates

The main purpose of themer is to provide template options that are developer friendly and avoid database connections or complicated user interfaces that so often come with themes.

#### Examples:

[templates.json](.github/templates.json)

```json
[
  {
    "template": "index",
    "config": {
      "show_introduction": true,
      "show_carousel": true,
      "carousel_items": 5
    }
  },
  {
    "template": "single",
    "config": {
      "show_sidebar": true
    }
  }
]
```

#### Three functions are made available for templating:

```php
use function Sober\Themer\template;
use function Sober\Themer\template_e;
use function Sober\Themer\template_debug;
```

#### Function `template()`
```php
template($config, $template)
```

* Parameter `$template` can be omitted if the filename and template name in `templates.json` match.
* Returns a config value from `templates.json`

```php
// within index.php

<?php if (template('show_introduction')) : ?> 
  // returns true if value is not false or null
<?php endif; ?>

<?php if (template(['carousel_items', 5])) : ?> 
  // returns true if carousel_items is equal to 5
<?php endif; ?>

<?php if (template('show_sidebar', 'single')) : ?> 
  // returns true within index.php 
<?php endif; ?>
```

#### Function `template_e()`
```php
template_e($config, $output, $template)
```

* Parameter `$template` can be omitted if the filename and template name in `templates.json` match.
* Echo a config or custom value from `templates.json`

```php
// within index.php

<?php template_e('show_carousel', 'carousel'); ?>
// outputs "carousel"

<?php template_e(['carousel_items', 5], 'carousel-five'); ?>
// outputs "carousel-five" if carousel_items is equal to 5

<?php template_e('show_sidebar', 'show-sidebar-class', 'single'); ?>
// outputs "show-sidebar-class" within index.php
```

#### Function `template_debug()`
```php
template_debug()
```

* For debugging purposes, outputs `template` and associated `config` values from `templates.json`.

### Plugins

Some themes require plugins in order to work &mdash; themer leverages the popular [tgmpa](http://tgmpluginactivation.com/) class to achieve plugin activation nags and actions.

#### Examples:

[plugins.json](.github/plugins.json)

```json
[
  {
    "name": "Disable Comments",
    "slug": "disable-comments",
    "required": false,
    "force_activation": true
  },
  {
    "name": "Models",
    "slug": "models",
    "source": "https://github.com/soberwp/models/archive/master.zip",
    "external_url": "https://github.com/models/intervention",
    "required": true,
    "force_activation": true,
    "force_deactivation": false
  }
]
```

You can read [tgmpa documentation](http://tgmpluginactivation.com/configuration/) for plugin activation options.

## Updates

#### Composer:

* Change the composer.json version to ^1.0.0**
* Check [CHANGELOG.md](CHANGELOG.md) for any breaking changes before updating.

```shell
$ composer update
```

#### WordPress:

Includes support for [github-updater](https://github.com/afragen/github-updater) to keep track on updates through the WordPress backend.
* Download [github-updater](https://github.com/afragen/github-updater)
* Clone [github-updater](https://github.com/afragen/github-updater) to your sites plugins/ folder
* Activate via WordPress

## Social

* Twitter [@withjacoby](https://twitter.com/withjacoby)
