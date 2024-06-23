<?php

namespace ed;

use Abraham\TwitterOAuth\TwitterOAuth;


class Tweet
{

    public static function get($keyword = 'test', $limit = 50, array $opt = null)
    {
        require_once FCPATH . 'vendor/autoload.php';

        // ganti dengan API twitter anda
        $key = '';
        $secret_key = '';
        $token = '';
        $secret_token = '';

        // // membuka koneksi
        $conn = new TwitterOAuth($key, $secret_key, $token, $secret_token);

        $query = [
            'q' => $keyword,
            'count' => $limit,
            'to' => 'telkomsel'
        ];


        if (!empty($opt)) {
            $query = array_merge($query, $opt);
        }

        // // anda bisa merubah jumlah tweet yang akan di tampilkanb dengan merubah angka pada count
        $tweets = $conn->get('search/tweets', $query);

        $data = [];

        foreach ($tweets->statuses as $tweet) {

            $var = [
                'date' => date('Y-m-d h:i:s', strtotime($tweet->created_at)),
                'username' => $tweet->user->screen_name,
                'tweet' => $tweet->text,
                'id_tweet' => $tweet->id_str
            ];
            array_push($data, $var);
        }

        return $data;
    }
}
