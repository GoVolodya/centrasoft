<?php


namespace app\core\form;


use app\core\Model;

abstract class BaseField
{
    /**
     * Attributes for BaseField class.
     */
    public Model $model;
    public string $attribute;

    /**
     * Field constructor.
     * @param Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    /**
     * Methods for BaseField class.
     */

    /**
     * @return string
     */
    abstract public function renderInput(): string;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf('
            <div class="mb-3">
                <label class="form-label">%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
        ',
            $this->model->getLabel($this->attribute),
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}