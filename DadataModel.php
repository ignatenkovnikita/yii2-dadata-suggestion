<?php
/**
 * Created by PhpStorm.
 * User: ignatenkovnikita
 * Date: 28/08/16
 * Time: 16:08
 */

namespace ignatenkovnikita\dadata;


use yii\base\Model;

class DadataModel extends Model
{
    public function rules()
    {
        return [
            [['fiasId', 'fiasLevel'], 'required'],
            [
                [
                    'kladrId',
                    'country',
                    'region',
                    'regionWithType',
                    'city',
                    'cityWithType',
                    'streetWithType',
                    'house',
                    'houseType',
                    'block',
                    'blockType',
                    'flat',
                    'rawData'
                ],
                'safe'
            ]
        ];
    }

    public $fiasId;

    public $fiasLevel;

    public $kladrId;

    public $country;

    public $region;

    public $regionWithType;

    public $city;

    public $cityWithType;

    public $streetWithType;

    public $house;

    public $houseType;

    public $block;

    public $blockType;

    public $flat;

    public $rawData;


    public static function fromDadataSuggestion($object, $className = '')
    {
        $model = !empty($className) ? new $className : new DadataModel();
        $model->fiasId = $object->data->fias_id;
        $model->fiasLevel = $object->data->fias_level;
        $model->kladrId = $object->data->kladr_id;
        $model->country = $object->data->country;
        $model->region = $object->data->region;
        $model->regionWithType = $object->data->region_with_type;
        $model->city = $object->data->city;
        $model->cityWithType = $object->data->city_with_type;
        $model->streetWithType = $object->data->street_with_type;
        $model->house = $object->data->house;
        $model->houseType = $object->data->house_type;
        $model->block = $object->data->block;
        $model->blockType = $object->data->block_type;
        $model->flat = $object->data->flat;
        $model->rawData = json_encode($object->data);

        return $model;
    }

}