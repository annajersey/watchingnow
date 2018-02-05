<?php

/**
 * This is the model class for table "user_messages".
 *
 * The followings are the available columns in table 'user_messages':
 * @property integer $id
 * @property integer $user_id
 * @property integer $from_user_id
 * @property string $title
 * @property string $data
 * @property integer $is_read
 * @property integer $created_at
 *
 * The followings are the available model relations:
 * @property Users $fromUser
 * @property Users $user
 */
class Emails extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return UserMessages the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	
    public static function SendActivateKey($model) {
		
		$subject = 'Registration key';
		$activation_url = Yii::app()->createAbsoluteUrl('userinfo/Activate', array('key'=>$model->activation_key));
		$message = 'Thanks for registration :) Here is your activation link: <a href="'.$activation_url.'">'.$activation_url.'</a>. ';
        $errors = self::SendEmail(array('admin@watchingnow.info'=>'Watchingnow.Info'), array($model->email=>$model->name), $subject, $message);
		return $errors;
    }


	private static function SendEmail(array $from, array $to, $subject, $message_text) {

        if (empty($subject)) {
            throw new CException('Subject can not be empty.');
            return false;
        }
        if (empty($message_text)) {
            throw new CException('Message can not be empty.');
            return false;
        }
        if (empty($from)) {
            throw new CException('Please specify email from.');
            return false;
        }
        if (empty($to)) {
            throw new CException('Please specify email to.');
            return false;
        }
        $validator = new CEmailValidator();
        $SM = Yii::app()->swiftMailer;
        $transport = $SM->mailTransport();

        $mailer = $SM->mailer($transport);
        $message = $SM->newMessage($subject);
        list($mail_from,$name_from) = each($from);
        if (is_numeric($mail_from)) {
            if (!$validator->validateValue($name_from)) {
                throw new CException('From email adress is not valid.');
                return false;
            }
            $message->setFrom(array($name_from=>$name_from));
        } else {
            if (!$validator->validateValue($mail_from)) {
                throw new CException('From email adress is not valid.');
                return false;
            }
            $message->setFrom($from);
        }
		 //$message->setSender('test@test.com');
        foreach ($to as $to_email=>$to_name) {
            if (!$validator->validateValue($to_email)) {
                throw new CException('One or more recipient adresses is not valid email adress.');
            } else {
                $message->setTo(array($to_email=>$to_name));
            }
        }
        if (!count($message->getTo())) {
            throw new CException('No recipients was found.');
            return false;
        }
        
        
        $message->setBody(strip_tags($message_text));
		
		$send = $mailer->send($message);
        //return $mailer->send($message);
		return $send;
    }

    
}