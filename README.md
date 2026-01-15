# TinyMce Component for Filamentphp 3

## Integration

- TinyMCE 5 Test v0.0.1

## Installation

You can install the package via composer:

```bash
composer require aytackayin/tinymce:dev-main
```
Publish the assets:
```bash
php artisan vendor:publish --tag="aytackayin-tinymce-assets"
```
Optionally, you can publish the config file for customization:

```bash
php artisan vendor:publish --tag="aytackayin-tinymce-config"
```
## Usage

```php
use Aytackayin\Tinymce\Forms\Components\TinyEditor;

TinyEditor::make('description');
```

## Customization
