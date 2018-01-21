<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url = 'http://tj.nineton.cn/Heart/index/all';
        $params['city'] = 'CHSH000000';
        // 发送请求
        $result = $this->curl($url, $params, 0);
        // 收到的数据需要转化一下
        $json = json_decode($result, true); dd($json);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function curl($url, $params = false, $ispost = 0, $https = 0)
    {
        $httpInfo = array();
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.118 Safari/537.36');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($https) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // 对认证证书来源的检查
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); // 从证书中检查SSL加密算法是否存在
        }
        if ($ispost) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_URL, $url);
        } else {
            if ($params) {
                if (is_array($params)) {
                    $params = http_build_query($params);
                }
                curl_setopt($ch, CURLOPT_URL, $url . '?' . $params);
            } else {
                curl_setopt($ch, CURLOPT_URL, $url);
            }
        }

        $response = curl_exec($ch);

        if ($response === FALSE) {
            //echo "cURL Error: " . curl_error($ch);
            return false;
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $httpInfo = array_merge($httpInfo, curl_getinfo($ch));
        curl_close($ch);
        return $response;
    }
}
