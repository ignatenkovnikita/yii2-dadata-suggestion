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
            [['fias_id', 'json'], 'required'],
            [
                [
                    'postal_code',
                    'country',
                    'region_fias_id',
                    'region_kladr_id',
                    'region_with_type',
                    'region_type',
                    'region_type_full',
                    'region',
                    'area_fias_id',
                    'area_kladr_id',
                    'area_with_type',
                    'area_type',
                    'area_type_full',
                    'area',
                    'city_fias_id',
                    'city_kladr_id',
                    'city_with_type',
                    'city_type',
                    'city_type_full',
                    'city',
                    'city_area',
                    'city_district',
                    'city_district_fias_id',
                    'city_district_kladr_id',
                    'city_district_with_type',
                    'city_district_type',
                    'city_district_type_full',
                    'settlement_fias_id',
                    'settlement_kladr_id',
                    'settlement_with_type',
                    'settlement_type',
                    'settlement_type_full',
                    'settlement',
                    'street_fias_id',
                    'street_kladr_id',
                    'street_with_type',
                    'street_type',
                    'street_type_full',
                    'street',
                    'house_fias_id',
                    'house_kladr_id',
                    'house_type',
                    'house_type_full',
                    'house',
                    'block_type',
                    'block_type_full',
                    'block',
                    'flat_type',
                    'flat_type_full',
                    'flat',
                    'flat_area',
                    'square_meter_price',
                    'flat_price',
                    'postal_box',
                    'fias_id',
                    'fias_level',
                    'kladr_id',
                    'capital_marker',
                    'okato',
                    'oktmo',
                    'tax_office',
                    'tax_office_legal',
                    'timezone',
                    'geo_lat',
                    'geo_lon',
                    'beltway_hit',
                    'beltway_distance',
                    'qc_geo',
                    'qc_complete',
                    'qc_house',
                    'unparsed_parts',
                    'qc',
                    'json',
                ],
                'safe'
            ]
        ];
    }

    public $postal_code;
    public $country;
    public $region_fias_id;
    public $region_kladr_id;
    public $region_with_type;
    public $region_type;
    public $region_type_full;
    public $region;
    public $area_fias_id;
    public $area_kladr_id;
    public $area_with_type;
    public $area_type;
    public $area_type_full;
    public $area;
    public $city_fias_id;
    public $city_kladr_id;
    public $city_with_type;
    public $city_type;
    public $city_type_full;
    public $city;
    public $city_area;
    public $city_district;
    public $city_district_fias_id;
    public $city_district_kladr_id;
    public $city_district_with_type;
    public $city_district_type;
    public $city_district_type_full;
    public $settlement_fias_id;
    public $settlement_kladr_id;
    public $settlement_with_type;
    public $settlement_type;
    public $settlement_type_full;
    public $settlement;
    public $street_fias_id;
    public $street_kladr_id;
    public $street_with_type;
    public $street_type;
    public $street_type_full;
    public $street;
    public $house_fias_id;
    public $house_kladr_id;
    public $house_type;
    public $house_type_full;
    public $house;
    public $block_type;
    public $block_type_full;
    public $block;
    public $flat_type;
    public $flat_type_full;
    public $flat;
    public $flat_area;
    public $square_meter_price;
    public $flat_price;
    public $postal_box;
    public $fias_id;
    public $fias_level;
    public $kladr_id;
    public $capital_marker;
    public $okato;
    public $oktmo;
    public $tax_office;
    public $tax_office_legal;
    public $timezone;
    public $geo_lat;
    public $geo_lon;
    public $beltway_hit;
    public $beltway_distance;
    public $qc_geo;
    public $qc_complete;
    public $qc_house;
    public $unparsed_parts;
    public $qc;
    public $json;

    public static function fromDadataSuggestion($object)
    {
        $model = new self();
        $model->load($object->data, '');
        $model->json = json_encode($object->data);

        return $model;
    }
}