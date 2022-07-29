<div
     wire:ignore
     x-data
     x-init="() => {
        const post = FilePond.create($refs.uploadedFile);
        post.setOptions({
            server: {
                process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                },
                revert: (filename, load) => {
                    @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                },
            },
            acceptedFileTypes: ['image/*', 'application/pdf'],
            maxFileSize: '5MB',
        });
        this.addEventListener('filePondReset', e => {
            post.removeFiles();
        });
    }">

    <input type="file" x-ref="uploadedFile" name="uploadedFile">

</div>

@push('styles')
@once
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
@endonce
@endpush

@push('scripts')
@once
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>

<script>
    FilePond.registerPlugin(FilePondPluginFileValidateSize);
    FilePond.registerPlugin(FilePondPluginFileValidateType);

</script>
@endonce
<script>
    // Could be used for automatic upload
    document.addEventListener('FilePond:processfiles', (e) => {
        Livewire.emit('saveFile')
    });

</script>
@endpush
