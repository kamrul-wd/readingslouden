/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here.
    // For complete reference see:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    config.uiColor = '#fafafa';

    config.forcePasteAsPlainText = true;
    config.extraAllowedContent = 'div[id](*); span[id](*); p[id](*); div[class](*); span[class](*); p[class](*)';
    //config.allowedContent = true;

    //config.width ='707';
    //config.resize_minWidth = '707';
    //config.resize_maxWidth = '707';
    config.height = '400';

    config.toolbar_Full = [{
        name: 'clipboard',
        groups: ['clipboard', 'undo'],
        items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
    }, {
        name: 'editing',
        groups: ['find', 'selection', 'spellchecker'],
        items: ['Scayt']
    }, {
        name: 'links',
        items: ['Link', 'Unlink', 'Anchor']
    }, {
        name: 'insert',
        items: ['Image', 'Table', 'HorizontalRule', 'SpecialChar']
    }, {
        name: 'tools',
        items: ['Maximize']
    }, {
        name: 'document',
        groups: ['mode', 'document', 'doctools'],
        items: ['Source']
    }, {
        name: 'others',
        items: ['-']
    },
        '/', {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup'],
            items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
        }, {
            name: 'paragraph',
            groups: ['list', 'indent', 'blocks', 'align'],
            items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote']
        }, {
            name: 'styles',
            items: ['Styles', 'Format']
        }, {
            name: 'about',
            items: ['About']
        }
    ];

    config.toolbar_Basic = [
        ['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink']
    ];

    config.toolbar_Default = [
        ['Source'],
        ['Cut', 'Copy', 'Paste'],
        ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'RemoveFormat'],
        ['Table', 'HorizontalRule', 'SpecialChar', 'Image'],
        ['Maximize'], ['Styles', '-', '-', 'Bold', 'Italic'],
        ['NumberedList', 'BulletedList'],
        ['JustifyLeft', 'JustifyCenter', 'JustifyRight'],
        ['OrderedList', 'UnorderedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'],
        ['Link', 'Unlink']
    ];

    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    config.removeButtons = 'Underline,Subscript,Superscript';

    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre';

    // Simplify the dialog windows.
    config.removeDialogTabs = 'image:advanced;link:advanced';
};
