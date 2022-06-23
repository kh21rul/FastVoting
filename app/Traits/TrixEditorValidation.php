<?php

namespace App\Traits;

trait TrixEditorValidation
{
    private array $trixEditorTags = [
        '<div>', '<strong>', '<em>', '<p>', '<a>', '<del>', '<br>', '<pre>', '<blockquote>', '<h1>', '<ul>', '<ol>', '<li>'
    ];

    /**
     * Validate the given input from trix editor.
     *
     * @param string|null $input The input to validate.
     * @return string The validated input.
     */
    public function validateTrixInput($input): string
    {
        if (empty($input)) {
            return '';
        }

        return strip_tags($input, $this->trixEditorTags);
    }
}
