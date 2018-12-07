<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $firstName;
    public $lastName;
    public $email;
    public $query;
	public $name;
	public $subject = 'Contact Enquiry';


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['firstName', 'lastName', 'email', 'query'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'firstName' => 'First Name',
        ];
    }
	
	public function beforeSave($query)
	{
		$this->name = $this->firstName.' '.$this->lastName;
		return true;
	}

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([$this->email => $this->name])
                ->setSubject($this->subject)
                ->setTextBody($this->query)
                ->send();

            return true;
        }
        return false;
    }
}
