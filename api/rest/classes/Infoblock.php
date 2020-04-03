<?php

class Infoblock
{

    public function addNewPortal($data)
    {

        $el = new CIBlockElement;

        //Создаем новый портал
        $arProperty = Array(
            "IBLOCK_ID"      => 53,
            "NAME"           => $data->MEMBER,
            "PROPERTY_VALUES"=> array(
                'PORTAL' => $data->PORTAL,
                'NAME' => $data->USER_NAME,
                'TARIF' => $data->LICENSE,
                'REFRESH' => $data->REFRESH,
                'MEMBER' => $data->MEMBER,
                'EMAIL' => $data->EMAIL,
                'PHONE_WORK' => $data->PHONE_WORK,
                'PHONE_PERSONAL' => $data->PHONE_PERSONAL,
            ),
        );

        $id = $el->Add($arProperty);


        return $id;

    }

    public function updatePortalData($id, $data)
    {

        $el = new CIBlockElement;

        $arFields = Array(
            "NAME" => $data->MEMBER,
            "PROPERTY_VALUES" => array(
                'PORTAL' => $data->PORTAL,
                'NAME' => $data->USER_NAME,
                'TARIF' => $data->LICENSE,
                'REFRESH' => $data->REFRESH,
                'MEMBER' => $data->MEMBER,
                'EMAIL' => $data->EMAIL,
                'PHONE_WORK' => $data->PHONE_WORK,
                'PHONE_PERSONAL' => $data->PHONE_PERSONAL,
            ),
        );

        $el->Update($id, $arFields);

    }

    public function chekPortal($member_id) {

        $el = new CIBlockElement;

        $res = $el->GetList(
            Array(),
            [
                "IBLOCK_ID"=>53,
                "NAME" => $member_id
            ],
            false,
            Array(),
            ["ID", "NAME"]
        );


        while ($obj = $res->GetNext())   {

            if ($obj['NAME'] == $member_id) {
                $id_property = $obj['ID'];
            }

        }

        return $id_property;

    }

}