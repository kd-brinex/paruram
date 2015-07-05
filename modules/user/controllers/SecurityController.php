<?php
namespace app\modules\user\controllers;
use dektrium\user\controllers\SecurityController as BaseController;
use dektrium\user\models\Account;
use yii\helpers\Url;
class SecurityController extends BaseController
{
    public function authenticate($client)
    {
        $attributes = $client->getUserAttributes();
        $provider   = $client->getId();
        $clientId   = $attributes['id'];

        $account = $this->finder->findAccountByProviderAndClientId($provider, $clientId);
//var_dump($client->getAccessToken()->params['access_token']);die;
        if ($account === null) {
            $account = \Yii::createObject([
                'class'      => Account::className(),
                'provider'   => $provider,
                'client_id'  => $clientId,
                'data'       => json_encode($attributes),
                'token'     => $client->getAccessToken()->params['access_token'],
            ]);
            $account->save(false);
        }

        if (null === ($user = $account->user)) {
            $this->action->successUrl = Url::to(['/user/registration/connect', 'account_id' => $account->id]);
        } else {
            \Yii::$app->user->login($user, $this->module->rememberFor);
        }

    }
}
/**
 * Created by PhpStorm.
 * User: marat
 * Date: 12.04.15
 * Time: 21:11
 */