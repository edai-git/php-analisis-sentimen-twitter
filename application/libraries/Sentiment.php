<?php

namespace ed;

require_once APPPATH . 'third_party/autoload.php';
require_once FCPATH . 'vendor/autoload.php';

class Sentiment
{

    public static function analisis($req)
    {
        $data = self::clean($req);
        $sentiment = new \PHPInsight\Sentiment();

        $tmp_skor = $sentiment->score($data);
        $skor = reset($tmp_skor);

        $result = [
            'tweet_clean' => $data,
            'sentiment' => $sentiment->categorise($data),
            'skor' => $skor
        ];

        return $result;
    }

    protected static function clean($req)
    {
        $str = strtolower($req);
        $str = self::remove_url($str);

        $str = preg_replace("/[^a-zA-Z0-9-]+/", " ", $str);

        $str = str_replace(array("\n", "\r"), ' ', $str);
        $str = ltrim(rtrim(trim(preg_replace('/\s\s+/', ' ', $str))));

        return $str;
    }

    // remove url 
    protected static function remove_url($str)
    {
        $regex = "@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?).*$)@";
        return preg_replace($regex, ' ', $str);
    }
}
