<?php

use Sastrawi\StopWordRemover\StopWordRemover;
use Sastrawi\StopWordRemover\StopWordRemoverFactory;
use Abraham\TwitterOAuth\TwitterOAuth;
use ed\Tweet;

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $data['title'] = "Dashboard";
        $this->load->view('_template/header', $data);
        $this->load->view('_template/footer');
    }



    public function test()
    {

        require_once APPPATH . "libraries/Sentiment.php";
        $sent = new ed\Sentiment;


        require_once  APPPATH . 'libraries/Tweet.php';
        $tw = new Tweet();

        $data = $tw::get('harga telkomsel mahal', 20);
        // $result = [];

        echo "<pre>";
        print_r($data);
        echo "</pre>";


        // foreach ($data as $raw) {
        //     $var = [
        //         'date' => $raw['date'],
        //         'username' => $raw['username'],
        //         'tweet' => $raw['tweet']
        //     ];

        //     $tmp = $sent::analisis($raw['tweet']);

        //     $res = array_merge($var, $tmp);
        //     array_push($result, $res);
        // }
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
    }
}

/* End of file Home.php */
