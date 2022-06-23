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
     * @param string $input The input to validate.
     * @return string The validated input.
     */
    public function validateTrixInput(string $input)
    {
        return strip_tags($input, $this->trixEditorTags);
    }
}
