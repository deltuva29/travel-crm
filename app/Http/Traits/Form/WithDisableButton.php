<?php

namespace App\Http\Traits\Form;

trait WithDisableButton
{
    public bool $isDisabled = true;

    private function checkForFieldEmptiness(): void
    {
        $this->isDisabled = $this->isFormEmpty($this->form);
    }

    private function isFormEmpty($form): bool
    {
        $isEmptyForms = array_map(function ($input) {
            if (is_array($input)) {
                $input = array_filter($input, function ($item) {
                    return !(is_null($item) || trim($item) === '');
                });
                return empty($input);
            }
            return false;
        }, $form);

        return array_reduce($isEmptyForms, function ($carry, $item) {
            return $carry || $item;
        }, false);
    }
}
