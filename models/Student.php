<?php


namespace app\models;


use app\core\UserModel;


class Student extends UserModel
{
    /**
     * Attributes for Student class.
     */
    public string $firstname = '';
    public string $lastname = '';
    public string $age = '';
    public string $gender = '';
    public string $class = '';
    public string $faculty = '';

    /**
     * Methods for Student class.
     */

    /**
     * @return array[]
     */
    public function rules(): array{
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'age' => [self::RULE_REQUIRED],
            'gender' => [self::RULE_REQUIRED],
            'class' => [self::RULE_REQUIRED],
            'faculty' => [self::RULE_REQUIRED],
        ];
    }

    /**
     * @return string[]
     */
    public function labels(): array{
        return [
            'firstname' => 'Your first name',
            'lastname' => 'Your last name',
            'age' => 'Your age',
            'gender' => 'Your gender',
            'class' => 'Which class you want to study?',
            'faculty' => 'Please enter faculty',
        ];
    }

    /**
     * @return bool
     */
    public function send(): bool
    {
        return parent::save();
    }

    /**
     * @return string
     */
    public function primaryKey(): string
    {
        return 'id';
    }

    /**
     * @return string
     */
    public function tableName(): string
    {
        return 'students';
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return ['firstname', 'lastname', 'age', 'gender', 'class', 'faculty'];
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->firstname.' '.$this->lastname;
    }
}