<?php


namespace app\core;


abstract class Model
{
    /**
     * Constants for Model class.
     */
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_UNIQUE = 'unique';

    /**
     * Attributes for Model class.
     */
    public array $errors = [];

    /**
     * Methods for Model class.
     */

    /**
     * @param $data
     */
    public function loadData($data){
        foreach ($data as $key => $value) {
            if(property_exists($this, $key)){
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @return array
     */
    public function labels(): array{
        return [];
    }

    /**
     * @return array
     */
    abstract public function rules(): array;

    /**
     * @return bool
     */
    public function validate(): bool{
        foreach ($this->rules() as $attribute => $rules){
            $value = $this->{$attribute};
            foreach ($rules as $rule){
                $ruleName = $rule;
                if(!is_string($ruleName)){
                    $ruleName = $rule[0];
                }
                if($ruleName === self::RULE_REQUIRED and !$value){
                    $this->addErrorForRule($attribute, self::RULE_REQUIRED);
                }
                if($ruleName === self::RULE_EMAIL and filter_var($value, FILTER_VALIDATE_EMAIL)){
                    $this->addErrorForRule($attribute, self::RULE_EMAIL);
                }
                if($ruleName === self::RULE_MIN and strlen($value) < $rule['min']){
                    $this->addErrorForRule($attribute, self::RULE_MIN, $rule);
                }
                if($ruleName === self::RULE_MAX and strlen($value) > $rule['max']){
                    $this->addErrorForRule($attribute, self::RULE_MAX, $rule);
                }
                if($ruleName === self::RULE_MATCH and $value !== $this->{$rule['match']}){
                    $rule['match'] = $this->getLabel($rule['match']);
                    $this->addErrorForRule($attribute, self::RULE_MATCH, $rule);
                }
                if($ruleName === self::RULE_UNIQUE){
                    $className = $rule['class'];
                    $uniqueAttr = $rule['attribute'] ?? $attribute;
                    $tableName = $className::tableName();
                    $statement = Application::$app->db->prepare("SELECT * FROM $tableName WHERE $uniqueAttr = :attr");
                    $statement->bindValue(":attr", $value);
                    $statement->execute();
                    $record = $statement->fetchObject();
                    if($record){
                        $this->addErrorForRule($attribute, self::RULE_UNIQUE, ['field' => $this->getLabel($attribute)]);
                    }
                }
            }
        }
        return empty($this->errors);
    }


    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }

    /**
     * @param string $attribute
     * @param string $rule
     * @param array $params
     */
    private function addErrorForRule(string $attribute, string $rule, $params = []){
        $message = $this->errorMessages()[$rule] ?? '';
        foreach ($params as $key => $value){
            $message = str_replace("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    /**
     * @param string $attribute
     * @param string $message
     */
    public function addError(string $attribute, string $message){
        $this->errors[$attribute][] = $message;
    }

    /**
     * @return string[]
     */
    public function errorMessages(): array{
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
            self::RULE_UNIQUE => 'Try another {field}',
        ];
    }


    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }


    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}