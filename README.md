![Kirby Attributes helper](.github/title.png)

**Attributes Helper** is a plugin for [Kirby 3](https://getkirby.com) providing a helper method to build attributes based on conditions, like conditionally adding classes to an element.

## Example

```php
<h1
    <?=attrs([
        'id' => 'static-value',
        'class' => [
            'headline' => true // will always be added
            'is-active' => $page->active()->isTrue() // will only be added when the field value is true
        ]
    ])?>
>
    This is a headline with conditional class names.
</h1>

```

## Installation

### Download

Download and copy this repository to `/site/plugins/attrs-helper`.

### Git submodule

```
git submodule add https://github.com/hananils/kirby-attrs-helper.git site/plugins/attrs-helper
```

### Composer

```
composer require hananils/kirby-attrs-helper
```

# License

This plugin is provided freely under the [MIT license](LICENSE.md) by [hana+nils · Büro für Gestaltung](https://hananils.de).  
We create visual designs for digital and analog media.
