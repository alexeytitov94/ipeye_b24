<?php

class Lead
{

    public function addLead($data)
    {

        $arGet = restquery('crm.lead.add', [
            'fields' => [
                "TITLE" => 'Установка приложения: IPEYE - '.$data->PORTAL,
                "COMMENTS" => "
                    <b>ПОРТАЛ</b> - $data->PORTAL,<br>
                    <b>ТАРИФ</b> - $data->LICENSE,<br>
                    <b>РАБОЧИЙ</b> - $data->PHONE_WORK,<br>
                    <b>ПЕРСОНАЛЬНЫЙ</b> - $data->PHONE_PERSONAL
                ",
                "PHONE" => [
                    [
                        'VALUE' => $data->PHONE_WORK,
                        'VALUE_TYPE' => 'WORK',

                    ],
                    [
                        'VALUE' => $data->PHONE_PERSONAL,
                        'VALUE_TYPE' => 'WORK',

                    ]
                ],
                "EMAIL" => [
                    [
                        'VALUE' => $data->EMAIL,
                        'VALUE_TYPE' => 'WORK',

                    ]
                ],
            ],
            'params' => [
                'REGISTER_SONET_EVENT' => "Y"
            ],
        ]);

        return $arGet['result'];
    }
}