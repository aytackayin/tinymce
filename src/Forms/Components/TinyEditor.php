<?php

namespace Aytackayin\Tinymce\Forms\Components;

use Illuminate\Support\Arr;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\Concerns;
use Filament\Forms\Components\Contracts;

class TinyEditor extends Field implements Contracts\CanBeLengthConstrained
{
    use Concerns\HasPlaceholder;
    use Concerns\CanBeLengthConstrained;
    use Concerns\HasFileAttachments;

    protected string $view = 'aytackayin-tinymce::forms.components.tinymce-field';

    protected string $language;

    protected bool $showMenuBar = false;

    protected int $maxHeight = 0;

    protected int $minHeight = 0;

    //protected string $plugins = 'advlist codesample directionality emoticons fullscreen image link lists media table wordcount';
    protected array $externalPlugins;
    protected string $profile = 'default';

    protected string $toolbar;

    protected bool $toolbarSticky = false;

    // TinyMCE var: relative_urls
    protected bool $relativeUrls = true;

    // TinyMCE var: remove_script_host
    protected bool $removeScriptHost = true;

    // TinyMCE var: convert_urls
    protected bool $convertUrls = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->language = app()->getLocale();
    }

    public function getMaxHeight(): int
    {
        return $this->maxHeight;
    }

    public function getMinHeight(): int
    {
        return $this->minHeight;
    }

    public function getInterfaceLanguage(): string
    {
        return match ($this->language) {
            'ar' => 'ar',
            'az' => 'az',
            'bg' => 'bg_BG',
            'bn' => 'bn_BD',
            'ca' => 'ca',
            'cs' => 'cs',
            'cy' => 'cy',
            'da' => 'da',
            'de' => 'de',
            'dv' => 'dv',
            'el' => 'el',
            'eo' => 'eo',
            'es' => 'es',
            'et' => 'et',
            'eu' => 'eu',
            'fa' => 'fa',
            'fi' => 'fi',
            'fr' => 'fr_FR',
            'ga' => 'ga',
            'gl' => 'gl',
            'he' => 'he_IL',
            'hr' => 'hr',
            'hu' => 'hu_HU',
            'hy' => 'hy',
            'id' => 'id',
            'is' => 'is_IS',
            'it' => 'it',
            'ja' => 'ja',
            'kab' => 'kab',
            'kk' => 'kk',
            'ko' => 'ko_KR',
            'ku' => 'ku',
            'lt' => 'lt',
            'lv' => 'lv',
            'nb' => 'nb_NO',
            'nl' => 'nl',
            'oc' => 'oc',
            'pl' => 'pl',
            'pt' => 'pt_BR',
            'ro' => 'ro',
            'ru' => 'ru',
            'sk' => 'sk',
            'sl' => 'sl',
            'sq' => 'sq',
            'sr' => 'sr',
            'sv' => 'sv_SE',
            'ta' => 'ta',
            'tg' => 'tg',
            'th' => 'th_TH',
            'tr' => 'tr',
            'ug' => 'ug',
            'uk' => 'uk',
            'vi' => 'vi',
            'zh' => 'zh_CN',
            default => 'en',
        };
    }

    public function getLanguageId(): string
    {
        return match ($this->getInterfaceLanguage()) {
            'ar' => 'tinymce-lang-ar',
            'az' => 'tinymce-lang-az',
            'bg' => 'tinymce-lang-bg_BG',
            'bn' => 'tinymce-lang-bn_BD',
            'ca' => 'tinymce-lang-ca',
            'cs' => 'tinymce-lang-cs',
            'cy' => 'tinymce-lang-cy',
            'da' => 'tinymce-lang-da',
            'de' => 'tinymce-lang-de',
            'dv' => 'tinymce-lang-dv',
            'el' => 'tinymce-lang-el',
            'eo' => 'tinymce-lang-eo',
            'es' => 'tinymce-lang-es',
            'et' => 'tinymce-lang-et',
            'eu' => 'tinymce-lang-eu',
            'fa' => 'tinymce-lang-fa',
            'fi' => 'tinymce-lang-fi',
            'fr' => 'tinymce-lang-fr_FR',
            'ga' => 'tinymce-lang-ga',
            'gl' => 'tinymce-lang-gl',
            'he' => 'tinymce-lang-he_IL',
            'hr' => 'tinymce-lang-hr',
            'hu' => 'tinymce-lang-hu_HU',
            'hy' => 'tinymce-lang-hy',
            'id' => 'tinymce-lang-id',
            'is' => 'tinymce-lang-is_IS',
            'it' => 'tinymce-lang-it',
            'ja' => 'tinymce-lang-ja',
            'kab' => 'tinymce-lang-kab',
            'kk' => 'tinymce-lang-kk',
            'ko' => 'tinymce-lang-ko_KR',
            'ku' => 'tinymce-lang-ku',
            'lt' => 'tinymce-lang-lt',
            'lv' => 'tinymce-lang-lv',
            'nb' => 'tinymce-lang-nb_NO',
            'nl' => 'tinymce-lang-nl',
            'oc' => 'tinymce-lang-oc',
            'pl' => 'tinymce-lang-pl',
            'pt' => 'tinymce-lang-pt_BR',
            'ro' => 'tinymce-lang-ro',
            'ru' => 'tinymce-lang-ru',
            'sk' => 'tinymce-lang-sk',
            'sl' => 'tinymce-lang-sl',
            'sq' => 'tinymce-lang-sq',
            'sr' => 'tinymce-lang-sr',
            'sv' => 'tinymce-lang-sv_SE',
            'ta' => 'tinymce-lang-ta',
            'tg' => 'tinymce-lang-tg',
            'th' => 'tinymce-lang-th_TH',
            'tr' => 'tinymce-lang-tr',
            'ug' => 'tinymce-lang-ug',
            'uk' => 'tinymce-lang-uk',
            'vi' => 'tinymce-lang-vi',
            'zh' => 'tinymce-lang-zh_CN',
            default => 'tinymce',
        };
    }

    public function language(string $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getToolbarSticky(): bool
    {
        return $this->toolbarSticky;
    }

    public function toolbarSticky(bool $toolbarSticky): static
    {
        $this->toolbarSticky = $toolbarSticky;

        return $this;
    }

    public function getShowMenuBar(): bool
    {
        return $this->showMenuBar;
    }
    public function maxHeight(int $maxHeight): static
    {
        $this->maxHeight = $maxHeight;

        return $this;
    }

    public function minHeight(int $minHeight): static
    {
        $this->minHeight = $minHeight;

        return $this;
    }
    public function getToolbar(): string
    {
        if (config('aytackayin-tinymce.profiles.' . $this->profile . '.toolbar')) {
            return config('aytackayin-tinymce.profiles.' . $this->profile . '.toolbar');
        }

        return 'undo redo removeformat | formatselect fontsizeselect | bold italic | rtl ltr | alignjustify alignright aligncenter alignleft | numlist bullist | forecolor backcolor | blockquote table toc hr | image link media codesample emoticons | wordcount fullscreen';
    }

    public function getPlugins(): string
    {
        if (config('aytackayin-tinymce.profiles.' . $this->profile . '.plugins')) {
            return config('aytackayin-tinymce.profiles.' . $this->profile . '.plugins');
        }

        return 'advlist codesample directionality emoticons fullscreen hr image imagetools link lists media table toc wordcount';
    }

    public function getExternalPlugins(): array
    {
        $files = scandir(__DIR__ . '/../../../assets/js/tinymce/plugins/');
        $extPlugins = array();
        foreach ($files as $file) {
            if (!str_contains($file, '.')) {
                $extPlugins = $array = Arr::add($extPlugins, $file, '/vendor/aytackayin-tinymce/js/tinymce/plugins/' . $file . '/plugin.min.js');
            }
        }
        //return $this->externalPlugins ?? $extPlugins; //if do u wanna get all plugins in plugin folder
        return $this->externalPlugins ?? [];
    }

    public function setExternalPlugins(array $plugins): static
    {
        $this->externalPlugins = $plugins;

        return $this;
    }
    public function getFileAttachmentsDirectory(): ?string
    {
        return filled($directory = $this->evaluate($this->fileAttachmentsDirectory)) ? $directory : config('aytackayin-tinymce.profiles.' . $this->profile . '.upload_directory');
    }

    public function profile(string $profile): static
    {
        $this->profile = $profile;

        return $this;
    }

    public function getRelativeUrls(): bool
    {
        return $this->relativeUrls;
    }

    public function setRelativeUrls(bool $relativeUrls): static
    {
        $this->relativeUrls = $relativeUrls;

        return $this;
    }

    public function getRemoveScriptHost(): bool
    {
        return $this->removeScriptHost;
    }

    public function setRemoveScriptHost(bool $removeScriptHost): static
    {
        $this->removeScriptHost = $removeScriptHost;

        return $this;
    }

    public function getConvertUrls(): bool
    {
        return $this->convertUrls;
    }

    public function setConvertUrls(bool $convertUrls): static
    {
        $this->convertUrls = $convertUrls;

        return $this;
    }
    public function getCustomConfigs(): string
    {
        if (config('aytackayin-tinymce.profiles.' . $this->profile . '.custom_configs')) {
            return '...' . json_encode(config('aytackayin-tinymce.profiles.' . $this->profile . '.custom_configs'));
        }

        return '';
    }
    public function getFileManagerPath()
    {
        return config('aytackayin-tinymce.file_manager');
    }
}
