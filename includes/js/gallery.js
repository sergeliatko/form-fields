// noinspection JSUnresolvedFunction
jQuery(document).ready(function ($) {
    let fileFrame = null;
    let handleRemoveClick = function (e) {
        e.preventDefault();
        // noinspection JSUnresolvedFunction
        $(this).parents('.gallery-item').remove();
    };
    let insertGalleryImage = function (a, trigger) {
        try {
            let attachment = a.toJSON();
            let $size = $(trigger).data('image-size');
            let img = document.createElement('img');
            if ('undefined' !== typeof attachment.sizes[$size]) {
                img.setAttribute('src', attachment.sizes[$size]['url']);
                img.setAttribute('width', attachment.sizes[$size]['width']);
                img.setAttribute('height', attachment.sizes[$size]['height']);
            } else {
                img.setAttribute('src', attachment.url);
                img.setAttribute('width', '300');
                img.setAttribute('height', '200');
            }
            img.setAttribute('class', 'gallery-item-image');
            img.setAttribute('title', attachment.name);

            let remove = document.createElement('span');
            remove.setAttribute('class', 'gallery-item-remove');
            remove.setAttribute('title', $(trigger).data('remove-label'));
            $(remove).click(handleRemoveClick);

            let input = document.createElement('input');
            input.setAttribute('type', 'hidden');
            input.setAttribute('name', $(trigger).data('name'));
            input.setAttribute('value', attachment.id);

            let wrapper = document.createElement('div');
            wrapper.setAttribute('class', 'gallery-item');

            wrapper.appendChild(img);
            wrapper.appendChild(remove);
            wrapper.appendChild(input);

            let gallery = document.getElementById($(trigger).data('target-id'));
            gallery.appendChild(wrapper);
        } catch (e) {
            console.log('could not add attachment');
            console.log(e);
            console.log(a);
        }
    };
    $('.gallery-item-remove').click(handleRemoveClick);
    // noinspection JSUnresolvedFunction
    $('.gallery-items-wrapper').sortable({
        handle: '.gallery-item-image',
        placeholder: 'gallery-item gallery-item-placeholder',
        forcePlaceholderSize: true
    }).disableSelection();
    $('.edit-gallery-button').click(function (e) {
        e.preventDefault();
        let trigger = this;
        if (null === fileFrame) {
            fileFrame = wp.media.frames.downloadable_file = wp.media({
                title: $(trigger).data('window-title'),
                button: {
                    text: $(trigger).data('window-action')
                },
                multiple: true
            });
            // noinspection JSUnresolvedFunction
            fileFrame.on('select', function () {
                fileFrame.state().get('selection').map(function (a) {
                    insertGalleryImage(a, trigger);
                });
            });
            fileFrame.open();
        } else {
            fileFrame.open();
        }
    });
});
