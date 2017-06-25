<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller as BaseController;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Currencies;
use yii\web\Response;
use yii\helpers\Json;

/**
 * Base abstract controller
 */
abstract class Controller extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        	'corsFilter'  => [
        		'class' => \yii\filters\Cors::className(),
        		'cors'  => [
        			// restrict access to domains:
        			'Origin' => ["*"],
        			'Access-Control-Request-Method' => ["GET",'POST'],
        			'Access-Control-Allow-Credentials' => true,
        			'Access-Control-Max-Age' => 3600, // Cache (seconds)
        		],
        	],
        ];
    }
}
