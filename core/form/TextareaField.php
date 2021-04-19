<?php
/**
 * This type of field is not used in application.
 */

namespace app\core\form;


class TextareaField extends BaseField
{
    /**
     * Methods for TextareaField class.
     */

    /**
     * @return string
     */
    public function renderInput(): string
    {
        return sprintf('<textarea name="%s" class="form-control%s">%s</textarea>',
            $this->attribute,
        $this->model->hasError($this->attribute) ? ' is-invalid' : '',
        $this->model->{$this->attribute},
        );
    }
}