<?php

class Infoblock
{

    public function getPortal($portal) {


        $res = CIBlockElement::GetList(
        [], [
            "IBLOCK_ID" => 56,
            "PROPERTY_PORTAL" => $portal
        ],false, [], [
            "PROPERTY_CAMERAS",
            "PROPERTY_PORTAL",
        ]);

        $element = '';

        while($obj = $res->GetNext()) {
            $element = $obj['PROPERTY_CAMERAS_VALUE'];
            $portal = $obj['PROPERTY_PORTAL_VALUE'];
        }


        if(!empty($element)) {

            $cameras = explode(",", $element);

            $res_cameras = [];
            foreach ($cameras as $item) {
                $res_cameras[] = [
                    'name_camera' => explode('-', $item)[0],
                    'id_camera' => explode('-', $item)[1]
                ];
            }

            return $res_cameras;

        } else {

            echo "<pre>";
            print_r($portal);
            echo "</pre>";

            if(empty($portal)) {
                return 'new';
            }

            return 0;

        }


    }

    public function addPortal($portal) {

        $el = new CIBlockElement;

        return $el->Add([
            "IBLOCK_ID"      => 56,
            "NAME"           => $portal,
            "PROPERTY_VALUES"=> array(
                'PORTAL' => $portal,
            ),
        ]);
    }







//    public function addNewPortal($data)
//    {
//        $el = new CIBlockElement;
//
//        //Создаем новый портал
//        $arProperty = Array(
//            "IBLOCK_ID"      => 22,
//            "NAME"           => $data->member_id,
//            "PROPERTY_VALUES"=> array(
//                'MEMBER_ID' => $data->member_id,
//                'REFRESH_TOKEN' => $data->REFRESH_ID,
//                'PORTAL' => $data->DOMAIN,
//                'TIME_UPDATE' => '99:99',
//            ),
//        );
//
//        $id = $el->Add($arProperty);
//
//        return $id;
//
//    }
//
//    public function updatePortalData($id, $data, $time, $currency, $last_time_update)
//    {
//
//        $el = new CIBlockElement;
//
//        $arFields = Array(
//            "NAME" => $data->member_id,
//            "PROPERTY_VALUES" => array(
//                'MEMBER_ID' => $data->member_id,
//                'REFRESH_TOKEN' => $data->REFRESH_ID,
//                'PORTAL' => $data->DOMAIN,
//                'CURRENCY' => $currency,
//                'TIME_UPDATE' => $time,
//                'LAST_TIME_UPDATE' => $last_time_update
//            ),
//        );
//
//        $el->Update($id, $arFields);
//
//    }
//
//    public function updatePortalDataCurrency($id, $data, $time, $currency, $last_time_update)
//    {
//
//        $el = new CIBlockElement;
//
//        $arFields = Array(
//            "NAME" => $data['MEMBER_ID'],
//            "PROPERTY_VALUES" => array(
//                'MEMBER_ID' => $data['MEMBER_ID'],
//                'REFRESH_TOKEN' => $data['REFRESH_TOKEN'],
//                'PORTAL' => $data['DOMAIN'],
//                'CURRENCY' => $currency,
//                'TIME_UPDATE' => $time,
//                'LAST_TIME_UPDATE' => $last_time_update
//            ),
//        );
//
//        $el->Update($id, $arFields);
//
//    }
//
//    public function chekPortal($member_id) {
//
//        $el = new CIBlockElement;
//        $id_property = 0;
//        $time = "";
//        $currency = "";
//
//        $arSelect = Array(
//            "ID",
//            "NAME",
//            "PROPERTY_CURRENCY",
//            "PROPERTY_TIME_UPDATE",
//            "PROPERTY_LAST_TIME_UPDATE"
//        );
//
//        $arFilter = Array(
//            "IBLOCK_ID"=>22,
//            "NAME" => $member_id
//        );
//
//        $res = $el->GetList(Array(), $arFilter, false, Array(), $arSelect);
//
//
//        while ($obj = $res->GetNext())   {
//
//           if ($obj['NAME'] == $member_id) {
//               $id_property = $obj['ID'];
//               $currency = $obj['PROPERTY_CURRENCY_VALUE'];
//               $time = $obj['PROPERTY_TIME_UPDATE_VALUE'];
//               $last_time_update = $obj['PROPERTY_LAST_TIME_UPDATE_VALUE'];
//           }
//
//        }
//
//        return array(
//            'id_property' => $id_property,
//            'time' => $time,
//            'currency' => $currency,
//            'last_time_update' => $last_time_update
//        );
//
//    }
//
//    public function getPortalAndCurrency() {
//        $time = date("H").":00";
//
//        $el = new CIBlockElement;
//
//        $arSelect = Array(
//            "*",
//            "PROPERTY_PORTAL",
//            "PROPERTY_REFRESH_TOKEN",
//            "PROPERTY_TIME_UPDATE",
//            "PROPERTY_CURRENCY",
//        );
//
//        $arFilter = Array(
//            "IBLOCK_ID"=>22,
//            "PROPERTY_TIME_UPDATE" => $time
//        );
//
//        $res = $el->GetList(Array(), $arFilter, false, Array(), $arSelect);
//
//        $arPortals = [];
//
//        while ($obj = $res->GetNext())   {
//
//            $arPortals[] = array(
//              'PORTAL' => $obj['PROPERTY_PORTAL_VALUE'],
//              'REFRESH_TOKEN' => $obj['PROPERTY_REFRESH_TOKEN_VALUE'],
//              'TIME_UPDATE' => $obj['PROPERTY_TIME_UPDATE_VALUE'],
//              'CURRENCY' => explode(",", $obj['PROPERTY_CURRENCY_VALUE']),
//              'UPDATE_CURRENCY' => array(),
//            );
//
//
//        }
//
//        return $arPortals;
//    }
//
//    public function getActualCurrency() {
//
//        $el = new CIBlockElement;
//
//        $arSelect = Array(
//            "*",
//            "PROPERTY_CHARCODE",
//            "PROPERTY_VALUE",
//            "PROPERTY_NOMINAL"
//        );
//
//        $arFilter = Array(
//            "IBLOCK_ID" => 20,
//        );
//
//        $res = $el->GetList(Array(), $arFilter, false, Array(), $arSelect);
//
//        $arCurrency = [];
//
//        while ($obj = $res->GetNext())   {
//
//            $arCurrency[] = array(
//                'CHARCODE' => $obj['PROPERTY_CHARCODE_VALUE'],
//                'VALUE' => $obj['PROPERTY_VALUE_VALUE'],
//                'NOMINAL' => $obj['PROPERTY_NOMINAL_VALUE']
//            );
//
//
//        }
//
//        return $arCurrency;
//    }
//
//    public function getPortal($member_id) {
//
//        $el = new CIBlockElement;
//
//        $arSelect = Array(
//            "*",
//            "PROPERTY_PORTAL",
//            "PROPERTY_REFRESH_TOKEN",
//            "PROPERTY_TIME_UPDATE",
//            "PROPERTY_CURRENCY",
//        );
//
//        $arFilter = Array(
//            "IBLOCK_ID"=>22,
//            "PROPERTY_MEMBER_ID" => $member_id
//        );
//
//        $res = $el->GetList(Array(), $arFilter, false, Array(), $arSelect);
//
//        $arPortals = [];
//
//        while ($obj = $res->GetNext())   {
//
//            $arPortals[] = array(
//                'PORTAL' => $obj['PROPERTY_PORTAL_VALUE'],
//                'REFRESH_TOKEN' => $obj['PROPERTY_REFRESH_TOKEN_VALUE'],
//                'TIME_UPDATE' => $obj['PROPERTY_TIME_UPDATE_VALUE'],
//                'CURRENCY' => explode(",", $obj['PROPERTY_CURRENCY_VALUE']),
//                'UPDATE_CURRENCY' => array(),
//            );
//
//
//        }
//
//        return $arPortals;
//    }
}