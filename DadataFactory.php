<?php
/**
 * Created by PhpStorm.
 * User: ignatenkovnikita
 * Date: 28/08/16
 * Time: 16:08
 */

namespace ignatenkovnikita\dadata;


class DadataFactory
{
    /**
     * @param $string
     *
     * @return bool|Dadata
     */
    public static function fromJson($string) {
        $data = json_decode($string, true);

        if (empty($data)) {
            return false;
        }

        $model = new DadataModel();
        $model->load($data, '');

        $model->json = $string;

        return $model;
    }

}