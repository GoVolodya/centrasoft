<?php


namespace app\models;


use app\core\Application;
use app\core\Model;

class LoginForm extends Model
{
    /**
     * Attributes for LoginForm class.
     */
    public string $email = '';
    public string $password = '';

    /**
     * Methods for LoginForm class.
     */

    /**
     * @return array[]
     */
    public function rules(): array{
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED],
        ];
    }

    /**
     * @return string[]
     */
    public function labels(): array
    {
        return ['email' => 'Your Email',
            'password' => 'Your Password'];
    }

    /**
     * @return bool
     */
    public function login(): bool
    {
        $user = User::findOne(['email' => $this->email]);
        if(!$user){
            $this->addError('email', 'User with this email does not exist');
            return false;
        }
        if(!password_verify($this->password, $user->password)){
            $this->addError('password', 'Incorrect password');
            return false;
        }
        return Application::$app->login($user);
    }
}