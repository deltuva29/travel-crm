<?php

namespace App\Traits;

trait TipTapTrait
{
    public static function allButtons(): array
    {
        return [
            'heading',
            'italic',
            'bold',
            'code',
            'link',
            'strike',
            'underline',
            'superscript',
            'subscript',
            'bullet_list',
            'ordered_list',
            'code_block',
            'blockquote',
            'table',
            'edit_html',
        ];
    }

    public static function allHeadingsForFrontend(): array
    {
        return [2, 3, 4, 5, 6];
    }
}
