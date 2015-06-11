<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\authclient\clients;

use yii\authclient\OAuth2;

class Odnoklassniki extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'http://www.odnoklassniki.ru/oauth/authorize';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.odnoklassniki.ru/oauth/token.do';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'http://api.ok.ru/fb.do';
    /**
     * @inheritdoc
     */
    public $scope = 'VALUABLE_ACCESS';

    public $clientKey;

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $params = ['method' => 'users.getCurrentUser',
            'application_key' => $this->clientKey];
//        var_dump($this->clientKey);die;


        return $this->apiInternal($this->accessToken, $this->apiBaseUrl, "GET", $params, []);
    }

    public function getFrends(){
        $params = ['method' => 'friends.getAppUsers',
            'application_key' => 'CBAGHDJEEBABABABA'];
//
        return $this->apiInternal($this->accessToken,$this->apiBaseUrl,'GET',$params,[]);
    }

    protected function apiInternal($accessToken, $url, $method, array $params, array $headers)
    {

        $params['access_token'] = $accessToken->getToken();
        $r = 'application_key=' . $params['application_key'] . 'method='.$params['method'];
        $params['sig'] = md5($r . md5($params['access_token'] . $this->clientSecret));
        return $this->sendRequest($method, $url, $params, $headers);
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'odnoklassniki';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Одноклассники';
    }

    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'id' => 'uid'
        ];
    }
}
