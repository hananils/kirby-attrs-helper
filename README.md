[![Attributes Helper for Kirby CMS](header.png)](https://kirby.hananils.de/plugins/attrs-helper)

Setting attributes on elements in snippets and templates quickly becomes convoluted. This gets worse if attributes require additional logic, like conditionally adding segmented values like classnames or datasets. Attributes helper mitigates this issue by offering a simple interface to set attributes.

## Usage

Attributes helper takes an associative array with the keys specifying the attribute names and the values specifying the corresponding attribute values. Values can either be static if passed as string or conditional if passed as array.

### Static values

If values are passed as string, the plugin will create an attribute for each key using the given value.

```php
<p
    <?= attrs([
        'id' => 'introduction',
        'class' => 'highlighted'
    ])?>
>
    An introductory paragraph.
</p>
```

This will create the following markup:

```html
<p id="introduction" class="highlighted">An introductory paragraph.</p>
```

### Conditional values

The attribute values can also be constructed conditionally:

```php
<p
    <?=attrs([
        'id' => $page->isHomePage() ? 'home' : false
    ])?>
>
    A paragraph.
</p>
```

This will only add the `id` attribute if the current page is the homepage. Otherwise, the attribute will be omitted.

### Boolean values

If values evaluate to a boolean value, an attribute is only rendered if its value is `true`. In the following case, the `checked` attribute will only be added if the page is listed.

```php
<input
    <?=attrs([
        'type' => 'checkbox',
        'checked' => $page->isListed()
    ])?>
>
```

The result will either be a checked or unchecked checkbox:

```html
<!-- listed -->
<input type="checkbox" checked>
<!-- unlisted, draft -->
<input type="checkbox">
```

### Segmented values

If the value itself is an array, all keys will be considered value segments that will be joined by as separator (a space by default). The associated array value is used as the condition to determine whether a segment should be added to the attribute or skipped.

This is useful if you’d like to set classnames or datasets dynamically.

The following example will either create a class attribute with the value `published has-image`, `published`, `has-image` or none at all depending on the page settings:

```php
<article
    <?=attrs([
        'class' => [
            'published' => $page->published()->isTrue(),
            'has-image' => $page->images()->isNotEmpty()
        ]
    ])?>
>
    An example article.
</article>
```

The helper also allows you to combine static and dynamic segments:

```php
<article
    <?=attrs([
        'class' => [
            'some', 'static', 'classnames',
            'published' => $page->published()->isTrue(),
            'has-image' => $page->images()->isNotEmpty()
        ]
    ])?>
>
    An example article.
</article>
```

In this case, `some static classnames` will always be added to the `class` attribute.

### Custom delimiter

If you’d like to join segmented values with a custom delimiter, you can pass it as second argument to the `attrs` function:

```php
<article
    <?=attrs([
        'data-list' => [
            'some', 'static', 'values'
        ]
    ], '|')?>
>
    An example article.
</article>
```

This example will return `some|static|values` as value for the `data-list` attribute.

## Installation

By default, plugins in Kirby reside in a special folder located at `/site/plugins`. Each plugin is installed in its proprietary subfolder. This installation can be handled in four different ways: you can either install them manually or manage them using Kirby CLI, Git submodules or Composer. You can install Attributes Helper either way and should choose the method suiting your project best.

Please note that all examples given here assume you are using the default plugin root. [If you changed your plugin root](https://getkirby.com/docs/reference/system/roots/plugins), e. g. with a custom folder setup, you’ll also have to adjust the paths given in this guide. For further information on how to manage plugins, please read the [official Kirby plugin introduction](https://getkirby.com/docs/guide/plugins/plugin-basics).

### Download

Download and copy this repository to `/site/plugins/attrs-helper`.

### Kirby CLI

```shell
kirby plugin:install hananils/kirby-attrs-helper
```

### Git submodule

```bash
git submodule add \
    https://github.com/hananils/kirby-attrs-helper.git \
    site/plugins/attrs-helper
```

### Composer

```shell
composer require hananils/kirby-attrs-helper
```

## Documentation

[![Find all documentation at kirby.hananils.de](footer.png)](https://kirby.hananils.de/plugins/attrs-helper)

Where possible, files contain inline annotations. For extended documentation, please visit our dedicated plugin site at [kirby.hananils.de/​plugins/​attrs-helper](https://kirby.hananils.de/plugins/attrs-helper).

### Cookbook

- [Conditional classnames](https://kirby.hananils.de/plugins/attrs-helper/conditional-classnames)
- [Custom separators](https://kirby.hananils.de/plugins/attrs-helper/custom-separators)

### Reference

- [Helpers](https://kirby.hananils.de/plugins/attrs-helper/helpers)

## License

This plugin is provided freely under the [MIT license](https://kirby.hananils.de/plugins/attrs-helper/license) by [hana+nils · Büro für Gestaltung](https://kirby.hananils.de). We create visual designs for digital and analog media.