<?php


namespace app\core\form;


use app\core\Model;

class Form
{
    /**
     * Methods for Form class.
     */

    /**
     * @param $action
     * @param $method
     * @return Form
     */
    public static function begin($action, $method): Form
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    /**
     * Just end of the form.
     */
    public static function end(){
        echo '</form>';
    }

    /**
     * @param Model $model
     * @param $attribute
     * @return InputField
     */
    public function field(Model $model, $attribute): InputField
    {
        return new InputField($model, $attribute);
    }
}