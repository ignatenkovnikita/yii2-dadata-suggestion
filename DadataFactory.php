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
        $model->city = $data['city'];
        $model->cityWithType = $data['city_with_type'];
        $model->block = $data['block'];
        $model->blockType = $data['block_type'];
        $model->country= $data['country'];
        $model->fiasId = $data['fias_id'];
        $model->fiasLevel = $data['fias_level'];
        $model->house = $data['house'];
        $model->houseType = $data['house_type'];
        $model->kladrId = $data['kladr_id'];
        $model->region = $data['region'];
        $model->regionWithType = $data['region_with_type'];
        $model->streetWithType = $data['street_with_type'];
        $model->flat = $data['flat'];

        $model->rawData = $string;

        return $model;
    }

}