<?php

namespace app\modules\frends\models;

use Faker\Provider\DateTime;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\authclient\clients\Odnoklassniki;
use dektrium\user\models\Account;




/**
 * FrendsSearch represents the model behind the search form about `app\modules\frends\models\Frends`.
 */
class FrendsSearch extends Frends
{
    /**
     * @inheritdoc
     */
    public $sexname;
    public $providerlogo;
    public $valid;
    public function rules()
    {
        return [
            [['id', 'user_id', 'enable', 'sex'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {

        $query = Frends::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }



        $query->orFilterWhere(['like', 'name', $this->name]);

        $user_id = Yii::$app->user->identity->getId();
        $query->andFilterWhere(['=', 'user_id', $user_id]);


        return $dataProvider;
    }

    private function getPost($fname, $p)
    {
        $PostCurl = curl_init();
        $goo = $fname;

        curl_setopt_array($PostCurl, array(
            CURLOPT_URL => $goo,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($p),
            CURLOPT_HEADER => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ));
        $response = curl_exec($PostCurl);
//        var_dump($response);
        return $response;
    }

    private function getGet($fname, $p)
    {
        $GetCurl = curl_init();
        $goo = $fname;
//        $headers = array(
//            "GET /images/test.gif HTTP/1.0",
//            "Accept: */*",
//            "Referer: http://www.test.ru/",
//            "User-Agent: Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)",
//            "Host: www.test.ru",
//            "Connection: Keep-Alive"
//        );
        curl_setopt_array($GetCurl, array(
            CURLOPT_URL => $goo,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 60,
//            CURLOPT_GETFIELDS => http_build_query($p),
            CURLOPT_HEADER => false,
//            CURLOPT_SSL_VERIFYPEER => false,
        ));
        $response = curl_exec($GetCurl);
//        var_dump($response);
        return $response;
    }

    public function searchAccountFrends()
    {
        $accounts = Account::findAll(['user_id' => Yii::$app->user->id]);
        $response = '';
//        $curl= new Curl();
        foreach ($accounts as $account) {

            if ($account->provider == 'vkontakte') {
                $params = ['user_id' => $account->client_id,
                    'fields' => 'nickname, domain, sex, bdate, city, country, timezone, photo_50, photo_100, photo_200_orig, has_mobile, contacts, education, online, relation, last_seen, status, can_write_private_message, can_see_all_posts, can_post, universities',
//                    'fields' => 'sex, bdate, city, country, timezone, photo_50, contacts, can_write_private_message',
//                    'count' => 10,
                    'name_case' => 'nom',
//                    'order' => 'hints',
                ];
                $response[$account->provider] = json_decode($this->getPost('https://api.vk.com/method/friends.get', $params), true)['response'];

//                var_dump($response);
            }
            if ($account->provider == 'odnoklassniki') {
               $o= new Odnoklassniki();
//                var_dump($o);die;
                var_dump($o->getFrends());die;
            }


        }
        return $response;
    }
    public function truedate($date,$delim)
    {
        $a=explode($delim,$date);
        $a[0]=(isset($a[0])?$a[0]:1);
        $a[1]=(isset($a[1])?$a[1]:1);
        $a[2]=(isset($a[2])?$a[2]:2000);
        $d=$a[2].'-'.$a[1].'-'.$a[0];
//        var_dump($d);
        return $d;


    }
    public function importAccountFrend()
    {
        $account_frends = $this->searchAccountFrends();

        foreach ($account_frends as $provider=>$frends) {
//            var_dump($account_frends);die;
            foreach ($frends as $frend) {
                if ($provider = 'vkontakte') {
                    $value = [];
//                    var_dump($frend);die;
                        $value['name'] = $frend['first_name'];
                        if (isset($frend['bdate'])) {
//                            var_dump($frend);
                            $value['bothday'] =$this->truedate($frend['bdate'],'.');
                        } else {
                            $value['bothday'] = null;
                        }
                        $value['user_id'] = Yii::$app->user->id;
                        $value['email'] = '';
                        $value['enable'] = 1;
                        $value['sex'] = $frend['sex'];
                        $value['prefics'] = ($frend['sex'] == 2) ? 'Уважаемый' : 'Уважаемая';
                        $value['fname'] = $frend['last_name'];
                        $value['photo'] = $frend['photo_50'];
                        $value['nati'] = 0;
                        $value['provider'] = $provider;
                        $value['pid'] = $frend['uid'];
                        if (isset($frends['domain'])) {
                            $value['domain'] = $frend['domain'];
                        }
//                    var_dump($value);
                    $model = new Frends();
                    $model_frend=$model->find()->andWhere('provider=:provider',[':provider'=>$value['provider']])
                        ->andWhere('pid=:pid',[':pid'=>$value['pid']])->all();
//                    var_dump($model_frend);
                    if ( empty($model_frend)){
                    $model->load(['Frends' => $value]);
                    $model->save();}

                }
//                if ($provider = 'facebook') {
//
//                }
            }
        }
    }
}
