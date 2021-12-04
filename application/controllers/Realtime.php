<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Realtime extends CI_Controller
{

    public function index()
    {
        $data['title'] = "Realtime Analysis";

        $this->load->view('_template/header', $data);

        $this->load->view('realtime');

        $this->load->view('_template/footer');
    }

    public function ajax_step_1()
    {
        if (!$this->input->post()) redirect('404');
        $keyword = $this->input->post('keyword', true);

        require_once APPPATH . "libraries/Sentiment.php";
        $run_sentiment = new ed\Sentiment;

        require_once  APPPATH . 'libraries/Tweet.php';
        $run_tweet = new ed\Tweet();

        $tweets = $run_tweet::get($keyword, 500);
        $result = [];

        foreach ($tweets as $tweet) {
            $var = [
                'date' => $tweet['date'],
                'username' => $tweet['username'],
                'tweet' => $tweet['tweet'],
                'id_tweet' => $tweet['id_tweet']
            ];

            $tmp = $run_sentiment::analisis($tweet['tweet']);

            $res = array_merge($var, $tmp);
            array_push($result, $res);
        }

        echo json_encode($result);
    }
}

/* End of file Realtime.php */
