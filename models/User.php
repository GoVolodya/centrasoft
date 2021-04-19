<?php


namespace app\models;


use app\core\UserModel;


class User extends UserModel
{
    /**
     * Constants for users roles.
     * Not implemented yet. All users have STATUS_INACTIVE by default;
     */
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_ADMIN = 2;

    /**
     * Attributes for User class.
     */
    public string $firstname = "";
    public string $lastname = "";
    public string $email = "";
    public int $status = self::STATUS_INACTIVE;
    public string $password = "";
    public string $confirmPassword = "";

    /**
     * Methods for User class.
     */

    /**
     * @return string
     */
    public function tableName(): string
    {
        return 'users';
    }

    /**
     * @return string
     */
    public function primaryKey(): string
    {
        return 'id';
    }

    /**
     * @return array[]
     */
    public function rules(): array{
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 8], [self::RULE_MAX, 'max' => 24]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }

    /**
     * @return bool
     */
    public function save(): bool{
        $this->status = self::STATUS_INACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    /**
     * @return string[]
     */
    public function attributes(): array{
        return ['firstname', 'lastname', 'email', 'password', 'status'];
    }

    /**
     * @return string[]
     */
    public function labels(): array
    {
        return [
            'firstname' => 'First name',
            'lastname' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm password',
        ];
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return $this->firstname.' '.$this->lastname;
    }
}