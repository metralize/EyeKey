<?php
/**
 * Class eyekey SDK
 * @author 小Z
 * @author 邮箱 784255790@qq.com
 * @since  2016年3月26日03:13:08
 * @version  1.0
 * @copyright 2016 - now 小Z
 **/

######################################################
### php 接口调用                                  ###
### 小Z                                          ###
### eyekey接口                                    ###
### http://www.eyekey.com                         ###
######################################################

class eyekey
{
    public $server          = 'http://api.eyekey.com';
    public $api_key         = '';        // 设置APP ID
    public $api_secret      = '';        // 设置APP KEY
    /**
     * @param $method
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function execute($method, array $params)
    {
        if( ! $this->apiPropertiesAreSet()) {
            throw new Exception('API properties are not set');
        }
        $params['app_id']      = $this->api_key;
        $params['app_key']   = $this->api_secret;
        return $this->request("{$this->server}{$method}", $params);
    }
    private function request($request_url, $request_body)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $request_url);
        curl_setopt($curl_handle, CURLOPT_FILETIME, true);
        curl_setopt($curl_handle, CURLOPT_FRESH_CONNECT, false);
        if(version_compare(phpversion(),"5.5","<=")){
            curl_setopt($curl_handle, CURLOPT_CLOSEPOLICY,CURLCLOSEPOLICY_LEAST_RECENTLY_USED);
        }else{
            curl_setopt($curl_handle, CURLOPT_SAFE_UPLOAD, false);
        }
        curl_setopt($curl_handle, CURLOPT_MAXREDIRS, 5);
        curl_setopt($curl_handle, CURLOPT_HEADER, 0);    // 是否需要带头信息
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_TIMEOUT, 5184000);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($curl_handle, CURLOPT_NOSIGNAL, true);
        curl_setopt($curl_handle, CURLOPT_REFERER, $request_url);

        if (extension_loaded('zlib')) {
            curl_setopt($curl_handle, CURLOPT_ENCODING, '');
        }
        curl_setopt($curl_handle, CURLOPT_POST, 1);
        if (array_key_exists('img', $request_body)) {
            $request_body['img'] = '@' . $request_body['img'];
        } else {
            $request_body = http_build_query($request_body);
        }
        var_dump($request_body);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $request_body);
        $response_text      = curl_exec($curl_handle);
        curl_close($curl_handle);
        return json_decode($response_text,true);
    }
    private function apiPropertiesAreSet()
    {
        if( ! $this->api_key) {
            return false;
        }
        if( ! $this->api_secret) {
            return false;
        }

        return true;
    }
}


// demo

$face = new eyekey();
$info = $face->execute('/face/Check/checking',array(
    'url'=>'http://img5q.duitang.com/uploads/item/201307/07/20130707215045_SJyRn.jpeg',
    'mode'=>'',
    'tip'=>''
    ));
echo '<pre>';
print_r($info);
