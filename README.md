# Bundle

WordPress plugin to enable plugin activation using a JSON, YAML or PHP file.

## Installation

#### Composer:

Recommended method/s; 

[Roots Bedrock](https://roots.io/bedrock/) and [WP-CLI](http://wp-cli.org/)
```shell
$ composer require soberwp/bundle
$ wp plugin activate bundle
```

[Roots Sage](https://roots.io/sage/)
```shell
$ composer require soberwp/bundle:1.0.2-p
```

#### Manual:

* Download the [zip file](https://github.com/soberwp/themer/archive/master.zip)
* Unzip to your sites plugin folder
* Activate via WordPress

#### Requirements:

* [PHP](http://php.net/manual/en/install.php) >= 5.6.x

## Setup

By default either `bundle.json`, `bundle.yaml` or `bundle.php` is used.

You can use a custom file for each using the filters below within your themes `functions.php` file; 
```php
add_filter('sober/bundle/file', function () {
    return get_stylesheet_directory() . '/plugin-dependencies.yaml';
});
```

## Usage

Themes often require plugins in order to work &mdash; bundle leverages the popular [tgmpa](http://tgmpluginactivation.com/) class to achieve plugin activation nags and actions.

#### Examples:

[bundle.json](.github/bundle.json)

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

[bundle.yaml](.github/bundle.yaml)

```yaml
---
- name: Disable Comments
  slug: disable-comments
  required: false
  force_activation: true
- name: Models
  slug: models
  source: https://github.com/soberwp/models/archive/master.zip
  external_url: https://github.com/models/intervention
  required: true
  force_activation: true
  force_deactivation: false

```

[bundle.php](.github/bundle.php)

```php
<?php
return [
    [
        'name' => 'Disable Comments',
        'slug' => 'disable-comments',
        'required' => false,
        'force_activation' => true
    ],
    [
        'name' => 'Models',
        'slug' => 'models',
        'source' => 'https://github.com/soberwp/models/archive/master.zip',
        'external_url' => 'https://github.com/models/intervention',
        'required' => true,
        'force_activation' => true,
        'force_deactivation' => false
    ]
];
```

You can read [tgmpa documentation](http://tgmpluginactivation.com/configuration/) for plugin activation options.

## Updates

#### Composer:

* Change the composer.json version to ^1.0.2**
* Check [CHANGELOG.md](CHANGELOG.md) for any breaking changes before updating.

```shell
$ composer update
```

#### WordPress:

Includes support for [github-updater](https://github.com/afragen/github-updater) to keep track on updates through the WordPress backend.
* Download [github-updater](https://github.com/afragen/github-updater)
* Clone [github-updater](https://github.com/afragen/github-updater) to your sites plugins/ folder
* Activate via WordPress

## Other

* For updates follow [@withjacoby](https://twitter.com/withjacoby)
* You can also [hire me](mailto:darren@jacoby.co.za) for WordPress or frontend work
