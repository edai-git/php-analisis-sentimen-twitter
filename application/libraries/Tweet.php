<?php

namespace ed;

use Abraham\TwitterOAuth\TwitterOAuth;


class Tweet
{

    public static function get($keyword = 'test', $limit = 50, array $opt = null)
    {
        require_once FCPATH . 'vendor/autoload.php';

        // ganti dengan API twitter anda
        $key = 'AbyvtiguFlUdXaV89ezG7cVV5';
        $secret_key = '5oZ7HHT1rdtDO1vYNUkb2ujgi5Qp8tmHEOdceDBxxoqlu9paJp';
        $token = '1382920208822673409-yDKO0c09zQ4Hs0qHAvmX0CCvhSTiNT';
        $secret_token = 'JbCknojYQjTbTnXujPm2kNQ2bIYRfiHWQT4TErmVUb21a';

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
