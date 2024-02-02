<div
    {{
        $attributes->class([
            'rich-text-editor'
        ])
    }}
    x-data="{
        content: '',
    }"
    x-init="initQuill_{{ $name }}($refs, $data)"
    x-cloak>

    <textarea class="rich-text-editor__hidden" name="{{ $name }}" :value="content"></textarea>
    <div x-ref="quillEditor" x-model="content">
        {!! old($name, $value ?? '') !!}
    </div>
</div>

@push('scripts')
    <script>
        function initQuill_{{ $name }}($refs, $data) {
            document.addEventListener('DOMContentLoaded', () => {
                quill_{{ $name }} = new Quill($refs.quillEditor, {
                    modules: {
                        toolbar: {
                            container: [
                                ['bold', 'italic', 'underline'],
                                ['blockquote'],
                                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                [{ 'header': [2, 3, false] }],
                                [{ 'color': [] }, { 'background': [] }],
                                ['clean']
                            ]
                        }
                    },
                    theme: 'snow',
                    placeholder: '{{ $placeholder ?? __('rich-text-editor.default') }}'
                });
                quill_{{ $name }}.on('text-change', function () {
                    let html = quill_{{ $name }}.root.innerHTML;
                    if (html === '<p><br></p>') html = ''
                    $data.content = html;

                });
                quill_{{ $name }}.clipboard.addMatcher(Node.ELEMENT_NODE, function (node, delta) {
                    var plaintext = node.innerText.replace(/\s+/g, ' ').trim();
                    var Delta = Quill.import('delta');
                    return new Delta().insert(plaintext);
                });

                $data.content = (quill_{{ $name }}.root.innerHTML === '<p><br></p>')
                    ? ''
                    : quill_{{ $name }}.root.innerHTML;
            })
        }
    </script>
@endpush
