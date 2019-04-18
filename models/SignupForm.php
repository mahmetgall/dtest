<?php
namespace app\models;

use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $fio;
    public $password;
    public $password_repeat;
    public $id_city, $adres;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            ['username', 'required', 'message' => 'Email не может быть пустым'],
            ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Такой email уже существует'],
            ['username', 'filter' , 'filter'=>'strip_tags'],
            ['username', 'filter' , 'filter'=>'trim'],
            ['username', 'email','message'=>"Неправильный email"],

            ['fio', 'trim'],
            ['fio', 'required', 'message' => 'ФИО не может быть пустым'],
            ['fio', 'filter' , 'filter'=>'strip_tags'],
            ['fio', 'filter' , 'filter'=>'trim'],

            ['password', 'required', 'message' => 'Пароль не может быть пустым'],

            ['password', 'string', 'min' => 6, 'tooShort'=>'Пароль не может быть меньше 6 символов'],

            ['password_repeat', 'required', 'message' => 'Пароль не может быть пустым'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Пароль не совпадает'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->fio = $this->fio;
        $user->email = $this->username;



        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }

    public function attributeLabels()
    {
        return array(
            'username' => "Введите email",

            'password' => 'Введите Ваш Пароль',
            'password_repeat' => 'Повторите пароль',
            'fio' => 'Введите Ваше ФИО',

        );
    }
}
