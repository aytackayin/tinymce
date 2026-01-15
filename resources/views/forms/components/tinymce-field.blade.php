<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div
        x-data="{ state: $wire.$entangle('{{ $getStatePath() }}'), initialized: false }"
        x-load-js="[@js(\Filament\Support\Facades\FilamentAsset::getScriptSrc($getLanguageId(), 'aytackayin-tinymce'))]"
        x-init="(() => {
            let editor = null;
            const initEditor = () => {
                if (editor) return;
                editor = tinymce.createEditor('tiny-editor-{{ $getId() }}', {
                    target: $refs.tinymce,
                    deprecation_warnings: false,
                    language: '{{ $getInterfaceLanguage() }}',
                    language_url: 'https://cdn.jsdelivr.net/npm/tinymce-i18n@23.7.24/langs5/{{ $getInterfaceLanguage() }}.min.js',
                    menubar: {{ $getShowMenuBar() ? 'true' : 'false' }},
                    plugins: '{{ $getPlugins() }}',
                    external_plugins: @js($getExternalPlugins()),
                    toolbar: '{{ $getToolbar() }}',
                    toolbar_sticky: {{ $getToolbarSticky() ? 'true' : 'false' }},
                    toolbar_sticky_offset: 64,
                    toolbar_mode: 'sliding',
                    skin: {
                        light: 'oxide',
                        dark: 'oxide-dark',
                        system: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide',
                    }[typeof theme === 'undefined' ? 'light' : theme],
                    branding: false,
                    relative_urls: {{ $getRelativeUrls() ? 'true' : 'false' }},
                    remove_script_host: {{ $getRemoveScriptHost() ? 'true' : 'false' }},
                    convert_urls: {{ $getConvertUrls() ? 'true' : 'false' }},
                    images_upload_handler: (blobInfo, success, failure, progress) => {
                        if (!blobInfo.blob()) return

                        $wire.upload(`componentFileAttachments.{{ $getStatePath() }}`, blobInfo.blob(), () => {
                            $wire.getFormComponentFileAttachmentUrl('{{ $getStatePath() }}').then((url) => {
                                if (!url) {
                                    failure('{{ __('Error uploading file') }}')
                                    return
                                }
                                success(url)
                            })
                        })
                    },
                    automatic_uploads: true,
                    setup: function(editorInstance) {
                        if(!window.tinySettingsCopy) {
                            window.tinySettingsCopy = [];
                        }
                        window.tinySettingsCopy.push(editorInstance.settings);

                        editorInstance.on('blur', function(e) {
                            state = editorInstance.getContent()
                        })

                        editorInstance.on('init', function(e) {
                            if (state != null) {
                                editorInstance.setContent(state)
                            }
                        })

                        editorInstance.on('OpenWindow', function(e) {
                            target = e.target.container.closest('.fi-modal')
                            if (target) target.setAttribute('x-trap.noscroll', 'false')
                        })

                        editorInstance.on('CloseWindow', function(e) {
                            target = e.target.container.closest('.fi-modal')
                            if (target) target.setAttribute('x-trap.noscroll', 'isOpen')
                        })

                        function putCursorToEnd() {
                            editorInstance.selection.select(editorInstance.getBody(), true);
                            editorInstance.selection.collapse(false);
                        }

                        $watch('state', function(newstate) {
                            if (editorInstance.container && newstate !== editorInstance.getContent()) {
                                editorInstance.resetContent(newstate || '');
                                putCursorToEnd();
                            }
                        });
                    },
                    file_picker_callback : function(callback, value, meta) {
                        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                        var cmsURL = '/{{ $getFileManagerPath() }}?editor=' + meta.fieldname;
                        if (meta.filetype == 'image') {
                            cmsURL = cmsURL + '&type=Images';
                        } else {
                            cmsURL = cmsURL + '&type=Files';
                        }
                        tinyMCE.activeEditor.windowManager.openUrl({
                          url : cmsURL,
                          title : 'Filemanager',
                          width : x * 0.8,
                          height : y * 0.8,
                          resizable : 'yes',
                          close_previous : 'no',
                          onMessage: (api, message) => {
                            callback(message.content);
                          }
                        });
                    },
                    {{ $getCustomConfigs() }}
                });
                editor.render();
            };
            
            $nextTick(() => {
                initEditor();
            });

            return () => {
                if (editor) {
                    try {
                        tinymce.get('tiny-editor-{{ $getId() }}')?.remove();
                        editor = null;
                    } catch (e) {}
                }
            };
        })()"
        x-cloak
        wire:ignore
    >
        @unless($isDisabled())
            <input
                id="tiny-editor-{{ $getId() }}"
                type="hidden"
                x-ref="tinymce"
                placeholder="{{ $getPlaceholder() }}"
            >
        @else
            <div
                x-html="state"
                class="block w-full max-w-none rounded-lg border border-gray-300 bg-white p-3 opacity-70 shadow-sm transition duration-75 prose dark:prose-invert dark:border-gray-600 dark:bg-gray-700 dark:text-white"
            ></div>
        @endunless
    </div>
</x-dynamic-component>
