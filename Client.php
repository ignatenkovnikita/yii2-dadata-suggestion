<?php
/**
 * Created by PhpStorm.
 * User: ignatenkovnikita
 * Date: 28/08/16
 * Time: 16:01
 */

namespace ignatenkovnikita\dadata;


use yii\base\Component;

class Client extends Component
{
// todo refactoring all component
    public $token;
    public $secret;
    public $query_path = 'http://suggestions.dadata.ru';
    const GET = 1;
    const POST = 2;

    private function send_request($path, $type, $params)
    {
        $ch = curl_init();
        $url = $this->query_path . $path;

        if ($type == self::GET) {
            $url = $url . '?' . http_build_query($params);
        }

        curl_setopt($ch, CURLOPT_URL, $url);
        // curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 3);
        if ($type == self::POST) {
            curl_setopt($ch, CURLOPT_POST, 1);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization: Token ' . $this->token,
            'X-Secret: ' . $this->secret
        ]);

        if ($type == self::POST) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }

        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }


    public function getCityOrRegion($query)
    {
        $params = [
            'query' => $query,
            'from_bound' => ['value' => 'region'],
            'to_bound' => ['value' => 'city']
        ];
        return $this->send_request('/suggestions/api/4_1/rs/suggest/address', self::POST, $params);
    }

    public function get_address($address)
    {
        return $this->send_request('/suggestions/api/4_1/rs/suggest/address', self::POST, ['query' => $address]);
    }

    public function get_geo($IP_address)
    {
        return $this->send_request('/detectAddressByIp', self::GET, ['ip' => $IP_address]);
    }

    /**
     * @param $fiasId
     * @return Dadata
     */
    public function getLocationById($fiasId)
    {
        $this->query_path = 'https://dadata.ru';
        $request = $this->send_request('/api/v2/findById/address', self::POST, ['query' => $fiasId]);
        if (isset($request->suggestions[0])) {
            return DadataModel::fromDadataSuggestion($request->suggestions[0]);
        }
        return false;
    }

    /**
     * @param $ip
     *
     * @return bool|Dadata
     */
    public function getLocationByIp($ip)
    {
        $this->query_path = 'https://dadata.ru';
        $response = $this->send_request('/api/v2/detectAddressByIp', self::GET, ['ip' => $ip]);
        if (!empty($response->location)) {
            return DadataModel::fromDadataSuggestion($response->location);
        }
        return false;
    }

    

}