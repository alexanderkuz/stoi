<?php

/**
 *
 * basic preset returns the basic toolbar configuration set for CKEditor.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 */
return [
    'height' => 60,
    'toolbarGroups' => [

        ['name' => 'clipboard', 'groups' => ['mode', 'undo', 'clipboard']],
        ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
        ['name' => 'colors'],
      //  ['name' => 'links', 'groups' => ['links', 'insert']],//'insert'
        ['name' => 'others', 'groups' => ['others', 'about']],
    ],
    'removeButtons' => 'Subscript,Superscript,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBretopak,Iframe',
    'removePlugins' => 'elementspath',
    'resize_enabled' => false,
];
