<?php

require 'vendor/autoload.php';

$accessToken = 'TOKEN_KEY_HERE'; // replace with your own access token key here

$client = new \GuzzleHttp\Client(['base_uri' => 'https://magic.cloud.tyk.io/']);
$headers = array('Authorization'=>"Bearer {$accessToken}", 'Accept'=>'application/json');
$response = $client->request('POST', 'getMagicWpLatestNews', array('headers'=>$headers));
$content = $response->getBody()->getContents();
$result = json_decode($content, true);

if($result['status'] == 'success')
{
    foreach($result['data'] as $news)
    {
        echo sprintf('<li><a href="%s">%s - %s</a></li>', $news['guid'], date('Y-M-d', strtotime($news['gmtDatePosted'])), $news['title']);
    }
}
else
{
    echo sprintf('Failed: %s', $result['msg']);
}