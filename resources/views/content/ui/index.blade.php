@extends('layouts.auth')

@section('title', __('UI'))

@section('content')
    <div class="container">
        <div class="content ui">

            <x-ui.title class="ui__title_big" tag="h2" size="large" >{{ __('UI examples') }}</x-ui.title>

            @include('content.ui.heading')

            @include('content.ui.post')

            @include('content.ui.grid')

            @include('content.ui.inputs')

            @include('content.ui.search')

            @include('content.ui.switchers')

            @include('content.ui.select')

            @include('content.ui.buttons')

            @include('content.ui.messages')

            @include('content.ui.popover')

            @include('content.ui.tabs')

            @include('content.ui.badges')

            @include('content.ui.tabulator')

            @include('content.ui.modal')

            @include('content.ui.accordion')

            @include('content.ui.swipper')

            @include('content.ui.filepond')

            @include('content.ui.starrating')

            @include('content.ui.likes')

            @include('content.ui.comments')

        </div>
    </div>

@endsection
@push('scripts')

    <script type="module">
        const element1 = document.querySelector('.choices-select-1');
        const choices1 = new Choices(element1, {
            itemSelectText: '',
            searchEnabled: false,
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        const element2 = document.querySelector('.choices-select-2');
        const choices2 = new Choices(element2, {
            itemSelectText: '',
            removeItems: true,
            removeItemButton: true,
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        const element3 = document.querySelector('.choices-select-3');
        const choices3 = new Choices(element3, {
            itemSelectText: '',
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        const element4 = document.querySelector('.choices-select-4');
        const choices4 = new Choices(element4, {
            itemSelectText: '',
            placeholder: true,
            placeholderValue: 'Input with items',
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        // const editor = new EditorJS({
        //     /**
        //      * Id of Element that should contain Editor instance
        //      */
        //     holder: 'editorjs',
        // })

        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],

            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction

            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],

            ['clean']                                         // remove formatting button
        ];

        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Compose an epic...',
            theme: 'snow'
        });

        var quill = new Quill('#new-comment', {
            modules: {
                toolbar: toolbarOptions
            },
            placeholder: 'Leave your comment',
            theme: 'snow'
        });

        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });


        //create Tabulator on DOM element with id "example-table"
        var table = new Tabulator("#example-table", {
            layout:"fitColumns",
            rowHeight:'auto',
            footerElement:"<button class='button button_submit'>Custom Button</button class='button button_submit'>",
            responsiveLayout:"collapse",  //fit columns to width of table (optional)
            columns:[
                {
                    title: "Name"
                },
                {
                    title: "Age"
                },
                {
                    title: "Gender"
                },
                {
                    title: "Height"
                },
                {
                    title: "Favourite Color"
                },
                {
                    title: "Date of Birth"
                },
                {
                    title: "Edit",
                    formatter: (cell) => cell.getValue()
                },
            ],
        });

        //trigger an alert message when the row is clicked
        table.on("rowClick", function(e, row){
            alert("Row " + row.getData().id + " Clicked!!!!");
        });

        const swiper = new Swiper('.swiper__carousel', {
            // Optional parameters
            direction: 'horizontal',
            spaceBetween: 16,
            slidesPerView: 1,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination_1',
                clickable: true
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            breakpoints: {
                768: {
                    slidesPerView: 3,
                },
                576: {
                    slidesPerView: 2,
                },
            }


        });

        const swiperFull = new Swiper('.swiper__full', {
            // Optional parameters
            direction: 'horizontal',
            slidesPerView: 1,
            height: "300px",

            // If we need pagination
            pagination: {
                el: '.swiper-pagination_2',
                clickable: true
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },


        });

        const inputElement = document.querySelector('.filepond1');
        const pond = FilePond.create(inputElement, {
            credits: false,
            labelIdle: '{{ __('Перетащите файлы или') }} <span class="filepond--label-action"> {{ __('загрузите') }}</span>'
        });

        const inputElement2 = document.querySelector('.filepond2');
        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginImageCrop,
            FilePondPluginImageResize,
            FilePondPluginImageTransform,
        );
        const pond2 = FilePond.create(inputElement2, {
            credits: false,
            labelIdle: '{{ __('Перетащите файлы или') }} <span class="filepond--label-action"> {{ __('загрузите') }}</span>',
            labelMaxFileSizeExceeded: 'Файл слишком большой',
            labelMaxFileSize: 'Максимальный размер {filesize}',
            labelFileLoading: 'Загрузка',
            labelTapToCancel: 'отменить',
            labelFileWaitingForSize: 'подождите'
        });


        const inputElement3 = document.querySelector('.filepond3');
        const pond3 = FilePond.create(inputElement3, {
            credits: false,
            labelIdle: '{{ __('Перетащите файлы или') }} <span class="filepond--label-action"> {{ __('загрузите') }}</span>',
            labelMaxFileSizeExceeded: 'Файл слишком большой',
            labelMaxFileSize: 'Максимальный размер {filesize}',
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            styleLoadIndicatorPosition: 'center bottom',
            styleProgressIndicatorPosition: 'right bottom',
            styleButtonRemoveItemPosition: 'left bottom',
            styleButtonProcessItemPosition: 'right bottom',
        });

    </script>
@endpush

