<?php
/**
 * Created by PhpStorm.
 * User: ignatenkovnikita
 * Date: 28/08/16
 * Time: 16:17
 */

namespace ignatenkovnikita\dadata;


use Yii;
use yii\web\Response;

trait Addresses
{
    public function actionGetaddress($q)
    {
        Yii::$app->response->format = 'json';
        $address = Yii::$app->dadata->get_address($q);
        if (count($address->suggestions)) {
            return
                array_map(function ($suggestion) {
                    return ['id' => json_encode($suggestion->data), 'value' => $suggestion->value];
                }, $address->suggestions)
            ;
        } else {
            return $this->_noResults();
        }
    }

    public function actionGetFullAddress($q){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $address = Yii::$app->dadata->get_address($q);
        if (count($address->suggestions)) {
            return [
                'results' => array_map(function ($suggestion) {
                    return ['id' => json_encode($suggestion->data), 'text' => $suggestion->value];
                }, $address->suggestions)
            ];
        } else {
            return $this->_noResults();
        }
    }

    public function actionGetCityOrRegion($q = null)
    {
        Yii::$app->response->format = 'json';

        if (empty($q)) {
            return $this->_noResults();
        }

        $address = Yii::$app->dadata->getCityOrRegion($q);
        if (count($address->suggestions)) {
            $filtered = array_filter($address->suggestions, function($suggestion) {
                if ($suggestion->data->street == null) {
                    return true;
                } else {
                    return false;
                }
            });

            $results = [];
            foreach ($filtered as $suggestion) {
                $results[] = ['id' => json_encode($suggestion->data), 'text' => $suggestion->value];
            }

            return [
                'results' => $results
            ];
        } else {
            return $this->_noResults();
        }
    }

    public function actionGetCityOrSettlement($q = null)
    {
        Yii::$app->response->format = 'json';

        if (empty($q)) {
            return $this->_noResults();
        }

        $address = Yii::$app->dadata->getCityOrSettlement($q);

        if (count($address->suggestions)) {
            $filtered = array_filter($address->suggestions, function($suggestion) {
                if ($suggestion->data->street == null) {
                    return true;
                } else {
                    return false;
                }
            });

            $results = [];

            foreach ($filtered as $suggestion) {
                $results[] = ['id' => json_encode($suggestion->data), 'text' => $suggestion->value];
            }

            return [
                'results' => $results,
            ];
        } else {
            return $this->_noResults();
        }
    }

    private function _noResults() {
        return ['results' => [['id' => null, 'text' => 'Нет похожих результатов']]];
    }
}