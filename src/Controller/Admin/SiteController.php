<?php

declare(strict_types=1);

namespace Rb\Controller\Admin;

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version4X;
use ElephantIO\Exception\ServerConnectionFailureException;
use Rb\Infrastructure\Identity\OnlyRegisteredApps;
use Rb\Infrastructure\UserStory;
use Rb\UserStory\ExternalApplication\ViewVersion\ViewVersion;
use yii\rest\Controller;

class SiteController extends Controller
{
    /**
     *  @OA\OpenApi(
     *      @OA\Info(
     *          title="rb line application Admin",
     *          version="1.0"
     *      ),
     *      @OA\Server(
     *          url="http://localhost:1901",
     *          description="Dev"
     *     ),
     *      @OA\Server(
     *          url="https://",
     *          description="Test"
     *     ),
     *      @OA\Server(
     *          url="https://",
     *          description="Stage"
     *     ),
     *      @OA\Server(
     *          url="https://",
     *          description="Prod"
     *     ),
     * )
     */

    //use OnlyRegisteredApps;

    public function actionVersion(): UserStory
    {
        return new ViewVersion();
    }

    public function actionTest()
    {
        $data = [
            'Token' => $this->getToken()->access_token,
            'pId' => '10dddf80-fd76-4b32-937b-4e2c502b535c',
            'lIds' => 2,
            'tf' => 0,
            'mT' => 0,
            'fps' => false,
            'fSTs' => false,
            'fSs' => false,
            'cc' => 'DEF',
            'uT' => 2
        ];
        try {
            $client = new Client(new Version4X('wss://fefeedws.stgsportdigi.com/fews'));
            $client->initialize();
            $a = $client->emit('GetTree', $data);

            print_r($a); die();

            //$client->close();
        } catch (ServerConnectionFailureException $e) {
            print_r($e);
        }
        /*
        $token = ;

        $url = '';
        $client = new Client(Client::engine(Client::CLIENT_4X, $url));
        $client->initialize();


        $data = [
            'Token' => $token,
            'pId' => '10dddf80-fd76-4b32-937b-4e2c502b535c',
            'lIds' => 2,
            'tf' => 0,
            'mT' => 0,
            'fps' => false,
            'fSTs' => false,
            'fSs' => false,
            'cc' => 'DEF',
            'uT' => 2
        ];

        print_r( $client->emit('GetTree', $data)); die();*/



    }

    private function getToken()
    {

        $url = 'https://fefeedws.sportdigi.com/connect/token';

        $post = [
            'client_id' => 'UbetClient',
            'client_secret' => 'U8(+/2Bio0e7%54T(&',
            'grant_type' => 'client_credentials'
        ];

        $headers_arr = [
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post)); //json_encode($post)
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers_arr);
        $html = curl_exec($ch);
        curl_close($ch);

        return json_decode($html);

    }
}