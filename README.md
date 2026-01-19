# Filament TinyMCE Plugin

[![Latest Version on Packagist](https://img.shields.io/packagist/v/aytackayin/tinymce.svg?style=flat-square)](https://packagist.org/packages/aytackayin/tinymce)
[![Total Downloads](https://img.shields.io/packagist/dt/aytackayin/tinymce.svg?style=flat-square)](https://packagist.org/packages/aytackayin/tinymce)

A powerful TinyMCE integration for Filament PHP (Version 3.x & 4.x) with a built-in Code Editor, File Manager support, and comprehensive configuration options.

## Features

- **Filament V3 & V4 Support**: Fully compatible with the latest Filament versions.
- **Code Editor**: Integrated source code editor with syntax highlighting using Ace Editor.
- **Media Manager**: Easy integration with Filament's media handling.
- **Customizable**: Full control over toolbar, plugins, and profiles.
- **Multi-language**: Automatic language detection based on app locale.
- **Dark Mode**: Automatically adapts to system/Filament dark mode preferences.

## Installation

You can install the package via composer:

```bash
composer require aytackayin/tinymce
```

### Publish Assets (Required)
You **must** publish the package assets (JavaScript & CSS) for the editor to work correctly:

```bash
php artisan vendor:publish --tag="aytackayin-tinymce-assets"
```

### Publish Config (Optional)
If you want to customize the toolbar, plugins, or profiles, publish the config file:

```bash
php artisan vendor:publish --tag="aytackayin-tinymce-config"
```

## Usage

You can use the `TinyEditor` component in your Filament Forms resources:

```php
use Aytackayin\Tinymce\Forms\Components\TinyEditor;

TinyEditor::make('content')
    ->columnSpanFull()
    ->required();
```

### Advanced Usage

```php
TinyEditor::make('description')
    ->profile('default') // Select a profile from config
    ->minHeight(300)
    ->maxHeight(600)
    // ->toolbarSticky(true) // Enable sticky toolbar
    // ->language('en') // Force a specific language
    ->columnSpanFull();
```

## Configuration

You can configure different profiles (simple, full, etc.) in the `config/aytackayin-tinymce.php` file after publishing it.

```php
'profiles' => [
    'default' => [
        'plugins' => 'advlist codesample ... codeeditor', // 'codeeditor' enables the source code view
        'toolbar' => 'undo redo | formatselect | bold italic | ... | codeeditor',
        // ...
    ],
],
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
