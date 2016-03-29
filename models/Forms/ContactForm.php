<?php

namespace app\models\Forms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
  // public $subject;
    public $body;
   // public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'phone', 'body'], 'required', 'message' => 'Необходимо заполнить поле'],
           [
                'phone',
                'match',
                'pattern' => '/^((\+?7)(-?\d{3})-?)?(\d{3})(-?\d{2})(-?\d{2})$/',
               //+7 (999) 999 99 99
                'message' => 'Некорректный формат поля Телефона'
            ],
            // email has to be a valid email address
            ['email', 'email','message' => 'Некорректный формат'],
            // verifyCode needs to be entered correctly
           // ['verifyCode', 'captcha'],
        ];
    }



    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string  $email the target email address
     * @return boolean whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject('ФОРМА ОБРАТНОЙ СВЯЗИ - '.$this->phone)
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return [//'verifyCode'=>'Verification Code',
            'phone'=>'Телефон',
            'name'=>'ФИО',
            'body'=>'Текст сообщения',
            'email'=>'Email',];
    }
}
