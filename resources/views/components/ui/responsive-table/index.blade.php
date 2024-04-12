<div x-data="selected"
    {{ $attributes->class([
            'responsive-table'
        ])
    }}>
    <span x-text="selected_examinations"></span>
    {{ $slot }}
</div>

@push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('selected', () => ({
                selected_examinations:[],
                    download(e) {
                        this.countSelectedRow += e.currentTarget.dataset.id;
                        console.log(this.countSelectedRow);
                    },

                    selectRow() {
                        if (selected_examinations.includes(id)) {
                            const index = selected_examinations.indexOf(id);
                            selected_examinations.splice(index, 1)
                        } else {
                            selected_examinations.push(id)
                        }
                    },

                    addRow() {
                        let row = this.$refs.row.attributes['data-id'].value;
                        console.log(row);
                        // if(!file || file.type.indexOf('image/') === -1) {
                        //     this.imgSrc = null;
                        //     this.uploadedSrc = null;
                        //     return;
                        // }
                        // this.imgSrc = null;
                        // let reader = new FileReader();
                        //
                        // reader.onload = e => {
                        //     this.uploadedSrc = null;
                        //     this.imgSrc = e.target.result;
                        // }
                        //
                        // reader.readAsDataURL(file);
                    },
                    // clearFile() {
                    //     this.imgSrc = null;
                    //     this.$refs.myFile.value = null;
                    // },
                    // clearUploaded() {
                    //     this.uploadedSrc = null;
                    //     this.$refs.uploadedFile.value = null;
                    // }
                })
            )
        });
    </script>
@endpush
