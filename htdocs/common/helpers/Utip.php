<?php

namespace common\helpers;

use Yii;

class Utip
{

    private static function post($method, $data)
    {

        $rand_param = rand(1000000, 99999999);
        $key = md5(Yii::$app->params['utip']['utip_key'] . $rand_param);

        $data['key'] = $key;
        $data['rand_param'] = $rand_param;

        $data = http_build_query($data);

        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, 'http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/' . $method);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            //echo curl_exec($curl);die();
            $out = json_decode(curl_exec($curl), true);
            //print_r($out);
            curl_close($curl);
            if ($out['result'] == 'success') {
                if(!isset($out['values'])) {
                    return array('result' => true, 'data' => $out);
                }
                return array('result' => true, 'data' => $out['values']);
            } else {
                return array('result' => false, 'error_number' => $out['error_number']);
            }

        }
    }

    private static function get($method, $data)
    {
        $rand_param = rand(1000000, 99999999);
        $key = md5(Yii::$app->params['utip']['utip_key'] . $rand_param);

        $data['key'] = $key;
        $data['rand_param'] = $rand_param;

        $data = http_build_query($data);

        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, 'http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/' . $method.'?'.$data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, false);
            //echo curl_exec($curl);die();
            $out = json_decode(curl_exec($curl), true);
            //print_r($out);
            curl_close($curl);

            if ($out['result'] == 'success') {
                if(!isset($out['values'])) {
                    return array('result' => true, 'data' => $out);
                }
                return array('result' => true, 'data' => $out['values']);
            } else {
                return array('result' => false, 'error_number' => $out['error_number']);
            }

        }
    }

    public static function Request($url)
    {
        if( $curl = curl_init() ) {
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            $out = curl_exec($curl);
            curl_close($curl);

            return $out;
        }
    }

    public static function RegisterUser($login, $passwd, $sname, $fname, $email, $phone = null, $country = null)
    {
        $data = array(
            'login' => $login,
            'password' => $passwd,
            'password_repeat' => $passwd,
            'second_name' => $sname,
            'first_name' => $fname,
            'email' => $email,
            'phone' => $phone,
            'country' => $country
        );
        return self::post("page/RegisterUser", $data);
    }

    public static function Activation($activation_key, $activation_type = "registration")
    {
        $rand_param2 = rand(1000000, 99999999);
        $key2 = md5(Yii::$app->params['utip']['utip_key'] . $rand_param2);
        $out = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/page/Activation?key=' . $key2 . '&rand_param=' . $rand_param2 . '&activation_key=' . $activation_key . '&activation_type=' . $activation_type), true);
        if ($out['result'] == 'success') {
            return array('result' => true, 'data' => $out['values']);
        } else {
            return array('result' => false, 'error_number' => $out['error_number']);
        }
    }

    public static function Login($user_email, $password)
    {
        $data = array(
            'user_email' => $user_email,
            'password' => $password,
        );
        return self::post("page/Login", $data);
    }

    public static function UpdateAccountInfo($user_id, $auth_token, $data)
    {
        $data['auth_token'] = $auth_token;
        $data['user_id'] = $user_id;
        return self::post("page/UpdateAccountInfo", $data);
    }

    public static function ChangePassword($user_id, $passwd, $auth_token, $password_repeat = null, $old_password = null)
    {
        $data['auth_token'] = $auth_token;
        $data['user_id'] = $user_id;
        $data['new_password'] = $passwd;
        $data['password_repeat'] = $passwd;
        if ($old_password != null) {
            $data['password_repeat'] = $password_repeat;
            $data['old_password'] = $old_password;
        }
        return self::post("page/ChangePassword", $data);
    }

    public static function ChangeTradePassword($user_id = 1, $account_id, $passwd, $auth_token)
    {
        $data['user_id'] = $user_id;
        $data['account_id'] = $account_id;
        $data['auth_token'] = $auth_token;

        $data['new_password'] = $passwd;

        return self::post("trading/ChangeTradePassword", $data);

    }

    public static function EmailUnique($email)
    {
        $rand_param2 = rand(1000000, 99999999);
        $key2 = md5(Yii::$app->params['utip']['utip_key'] . $rand_param2);

        $out = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/page/EmailUnique?key=' . $key2 . '&rand_param=' . $rand_param2 . '&email=' . $email), true);
        if ($out['result'] == 'success') {
            return array('result' => true);
        } else {
            return array('result' => false, 'error_number' => $out['error_number']);
        }
    }

    public static function LoginUnique($login)
    {
        $rand_param2 = rand(1000000, 99999999);
        $key2 = md5(Yii::$app->params['utip']['utip_key'] . $rand_param2);
        $out = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/page/LoginUnique?key=' . $key2 . '&rand_param=' . $rand_param2 . '&login=' . $login), true);
        if ($out['result'] == 'success') {
            return array('result' => true);
        } else {
            return array('result' => false, 'error_number' => $out['error_number']);
        }
    }

    public static function ForgotYourPassword($user_email)
    {
        $data['user_email'] = $user_email;
        $data['send_email'] = 1;
        return self::post("page/ForgotYourPassword", $data);
    }

    public static function GetAccountInfo($user_id, $auth_token)
    {
        $data['auth_token'] = $auth_token;
        $data['user_id'] = $user_id;
        return self::get("page/GetAccountInfo", $data);
    }

    public static function GetAccountInfoByEmail($email, $auth_token)
    {
        $data['auth_token'] = $auth_token;
        $data['user_email'] = $email;
        return self::post("page/GetAccountInfo", $data);
    }

    public static function RegisterTradeAccount($user_id, $group_id, $auth_token, $leverage = 1, $password = false)
    {
        $data = array(
            'auth_token' => $auth_token,
            'user_id' => $user_id,
            'send_email' => 0,
            'group_id' => $group_id,
            'leverage' => $leverage
        );

        if($password) 
            $data['password'] = $password;

        return self::post("trading/RegisterTradeAccount", $data);
    }

    public static function GetGroups($auth_token)
    { // ошибка 601
        $rand_param = rand(1000000, 99999999);
        $key = md5(Yii::$app->params['utip']['utip_key'] . $rand_param);
        $api = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/settings/GetGroups?key=' . $key . '&rand_param=' . $rand_param . '&auth_token=' . $auth_token), true);
        print_r($api);
        $data = array();
        if ($api['result'] == 'success') {
            foreach ($api['values'] as $key => $row) {
                $data[$key] = $row;
            }
        }
    }

    public static function TradingTypesAccountsList($user_id, $auth_token)
    { // получение групп счетов
        $rand_param = rand(1000000, 99999999);
        $key = md5(Yii::$app->params['utip']['utip_key'] . $rand_param);
        $api = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/trading/TradingTypesAccountsList?key=' . $key . '&rand_param=' . $rand_param . '&user_id=' . $user_id . '&auth_token=' . $auth_token), true);
        if ($api['result'] == 'success') {
            return array('result' => true, 'data' => $api['values']);
        } else {
            return array('result' => false, 'error_number' => $api['error_number']);
        }
    }

    public static function Accounts($auth_token)
    { // ошибка 601
        $rand_param = rand(1000000, 99999999);
        $key = md5(Yii::$app->params['utip']['utip_key'] . $rand_param);
        $api = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/service/accounts?key=' . $key . '&rand_param=' . $rand_param . '&auth_token=' . $auth_token), true);
        if ($api['result'] == 'success') {
            return array('result' => true, 'data' => $api['values']);
        } else {
            return array('result' => false, 'error_number' => $api['error_number']);
        }
    }

    public static function InsertDeposit($account_id, $work_type, $value, $auth_token, $comment = null)
    {
        $data = array(
            'auth_token' => $auth_token,
            'account_id' => $account_id,
            'value' => $value,
            'work_type' => $work_type,
        );

        if ($comment != null) {
            $data['comment'] = $comment;
        }
        
        return self::post("service/InsertDeposit", $data);
    }

    public static function GetBalanceInfo($user_id, $auth_token, $view_demo = 1)
    {
        $rand_param = rand(1000000, 99999999);
        $key = md5(Yii::$app->params['utip']['utip_key'] . $rand_param);

        $api = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/trading/GetBalanceInfo?key=' . $key . '&rand_param=' . $rand_param . '&user_id=' . $user_id . '&auth_token=' . $auth_token . '&view_demo=' . $view_demo), true);
        if ($api['result'] == 'success') {
            return array('result' => true, 'data' => $api['values']);
        } else {
            return array('result' => false, 'error_number' => $api['error_number']);
        }
    }

    public static function Logout($auth_token)
    {
        $rand_param = rand(1000000, 99999999);
        $key = md5(Yii::$app->params['utip']['utip_key'] . $rand_param);
        $api = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/page/Logout?key=' . $key . '&rand_param=' . $rand_param . '&auth_token=' . $auth_token), true);
        if ($api['result'] == 'success') {
            return array('result' => true, 'data' => $api['values']);
        } else {
            return array('result' => false, 'error_number' => $api['error_number']);
        }
    }

    public static function GetExchangeRates()
    {
        $rand_param = rand(1000000, 99999999);
        $key = md5(Yii::$app->params['utip']['utip_key'] . $rand_param);
        $api = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/settings/GetExchangeRates?key=' . $key . '&rand_param=' . $rand_param . '&format=2'), true);
        if ($api['result'] == 'success') {
            return array('result' => true, 'data' => $api['values']);
        } else {
            return array('result' => false, 'error_number' => $api['error_number']);
        }

    }

    public static function GetTradingHistoryAccount($account_id, $auth_token)
    {
        $rand_param = rand(1000000, 99999999);
        $key = md5(Yii::$app->params['utip']['utip_key'] . $rand_param);
        $api = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/trading/GetTradingHistoryAccount?key=' . $key . '&rand_param=' . $rand_param . '&account_id=' . $account_id . '&auth_token=' . $auth_token), true);
        if ($api['result'] == 'success') {
            return array('result' => true, 'data' => $api['values']);
        } else {
            return array('result' => false, 'error_number' => $api['error_number']);
        }
    }

    public static function GetDeposits($account_id, $auth_token)
    {
        $rand_param = rand(1000000, 99999999);
        $key = md5(Yii::$app->params['utip']['utip_key'] . $rand_param);
        $api = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/trading/GetDeposits?key=' . $key . '&rand_param=' . $rand_param . '&account_id=' . $account_id . '&auth_token=' . $auth_token), true);
        if ($api['result'] == 'success') {
            return array('result' => true, 'data' => $api['values']);
        } else {
            return array('result' => false, 'error_number' => $api['error_number']);
        }
    }

    public static function RegisterV2($login, $passwd, $sname, $fname, $email, $phone = null, $country = null)
    {
        $rand_param = rand(1000000, 99999999);
        $key = md5(Yii::$app->params['utip']['utip_key'] . $rand_param);
        $api = json_decode(self::Request('http://' . Yii::$app->params['utip']['utip_server'] . '/api/v_2/page/RegisterUser?key=' . $key . '&rand_param=' . $rand_param . '&login=' . $login . "&password=" . $passwd . "&password_repeat=" . $passwd . "&first_name=" . $fname . "&second_name=" . $sname . "&email=" . $email . "&phone=" . $phone), true);
        if ($api['result'] == 'success') {
            return array('result' => true, 'data' => $api['values']);
        } else {
            return array('result' => false, 'error_number' => $api['error_number']);
        }
    }

    public static function DeleteUser($client_id, $auth_token)
    {
        $data = array(
            'auth_token'    => $auth_token,
            'client_id'     => $client_id
        );
        
        return self::post("crm/DeleteClient", $data);
    }

    public function UtipLogin()
    {
        $utip = Utip::Login(Yii::$app->params['utip']['admin_email'], Yii::$app->params['utip']['admin_password']);

        return $utip['data']['auth_token'];
    }

    public static function CreateTransfer($account_id, $account_out, $account_value, $auth_token)
    {
        $data = array(
            'account_id'    => $account_id,
            'account_out'   => $account_out,
            'account_value' => $account_value,
            'auth_token'    => $auth_token,
        );
        
        return self::post("payments/MoneyTransfer", $data);
    }

}

if ($_SERVER['REMOTE_ADDR'] == "171.6.242.255") {
    $o = Utip::RegisterUser("fxtra.n.d.com@gmail.com", "100500", "Nikita", "Lname", "fx.tra.n.d.com@gmail.com", "79000000000");
    print_r($o);
    die();
}

?>