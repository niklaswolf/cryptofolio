<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
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
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * returns updated values for currencies from API
     * @return string
     */
    public function actionUpdate(){
    	$selectedData = $this->queryAPI();
    	
    	// respond as JSON
    	\Yii::$app->getResponse()->format = Response::FORMAT_JSON;
    	return array_values($selectedData);
    }
    
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
    	$currencies = Currencies::find()->all();
        return $this->render('index', [
        	'currencies' => $currencies,
        ]);
    }

    
    public function actionCurrencies(){
    	$data = Currencies::find()->all();
    	$apiData = $this->queryAPI();
    	
    	$bitcoinValue = $apiData[0]['price_eur'];
    	
    	$filteredData = array();
    	foreach ($data as $dataset){
    		$currency = array();
    		$currency["name"] = $dataset->name;
    		$currency["symbol"] = $dataset->symbol;
    		$currency["amount"] = $dataset->amount;
    		$currency["api_identificator"] = $dataset->api_identificator;
    		$currency["percent_change_24h"] = 0;
    		$currency["percent_change_7d"] = 0;
    		$currency["value_btc"] = 0;
    		$currency["value_eur"] = 0;
    		$currency["price_btc"] = 0;
    		$currency["price_eur"] = 0;
    		
    		foreach ($apiData as $apiDataset){
    			if($apiDataset['id'] == $dataset->api_identificator){
    				$currency["percent_change_24h"] = $apiDataset["percent_change_24h"];
    				$currency["percent_change_7d"] = $apiDataset["percent_change_7d"];
    				
    				$currency["price_btc"] = $apiDataset['price_btc'];
    				/*calculate it by self until apiData returns the correct value for price_eur*/
    				//$currency["price_eur"] = round($apiDataset['price_eur'], 4);
    				$currency["price_eur"] = round($apiDataset['price_btc'] * $bitcoinValue, 4);
    				
    				$currency["value_btc"] = $currency["price_btc"] * $dataset->amount;
    				$currency["value_eur"] = round($currency["price_eur"] * $dataset->amount, 2);
    				break;
    			}
    		}
    		
    		$filteredData[] = $currency;
    	}
    	\Yii::$app->getResponse()->format = Response::FORMAT_JSON;
    	return $filteredData;
    }
    
    private function queryAPI(){
    	// fetch API
    	$fullJsonData = file_get_contents("https://api.coinmarketcap.com/v1/ticker/?convert=EUR");
    	$fullData = Json::decode($fullJsonData);
    	 
    	// filter only those coins needed
    	$filter = array();
    	foreach(Currencies::find()->select("api_identificator")->where(['not like', 'api_identificator', 'euro'])->all() as $currency){
    		$filter[] = $currency->api_identificator;
    	}
    	 
    	$selectedData = array_filter($fullData, function ($item) use ($filter){
    		if(in_array($item['id'], $filter )){
    			return true;
    		}
    		return false;
    	});
    	
    	return $selectedData;
    }
    
    
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
