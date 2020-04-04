<?php

class Auth
{

    public function getAccessToken($request, $update)
    {

        if ($update == 'update') {

            $ref = file_get_contents(
                $request["PORTAL"]."/oauth/token/?"
                ."client_id=app.5c6ff0197c59e0.09613427&"
                ."grant_type=refresh_token&"
                ."client_secret=vjoE6AFzlypdqqJ4wtL6fMEdFbSzFhl3Vr4PXBB56BEotymyLr&"
                ."redirect_uri=https%3A%2F%2Fsite.ru%3Aindex.php&"
                ."refresh_token=".$request["REFRESH_TOKEN"]
            );
            $ref = json_decode($ref);
            $ref = (array)$ref;
            $new_token = $ref['access_token'];
            $domain = 'https'.'://'.$ref['domain'];


            $data_query = array(
                "ACCESS_TOKEN" => $new_token,
                "DOMAIN" => $domain,
                "MEMBER_ID" => $ref['member_id'],
                "REFRESH_TOKEN" => $ref['refresh_token']
            );


            if ($data_query['ACCESS_TOKEN'] == '') {
                $ref = file_get_contents(
                    "https://oauth.bitrix.info/oauth/token/?"
                    ."client_id=app.5c6ff0197c59e0.09613427&"
                    ."grant_type=refresh_token&"
                    ."client_secret=vjoE6AFzlypdqqJ4wtL6fMEdFbSzFhl3Vr4PXBB56BEotymyLr&"
                    ."redirect_uri=https%3A%2F%2Fsite.ru%3Aindex.php&"
                    ."refresh_token=".$request["REFRESH_TOKEN"]
                );

                $ref = json_decode($ref);
                $ref = (array)$ref;

                $new_token = $ref['access_token'];
                $domain = 'https'.'://'.$ref['domain'];

                $data_query = array(
                    "ACCESS_TOKEN" => $new_token,
                    "DOMAIN" => $request["PORTAL"],
                    "MEMBER_ID" => $ref['member_id'],
                    "REFRESH_TOKEN" => $ref['refresh_token']
                );
            }


        } else {

                $ref = file_get_contents(
                    $request->DOMAIN."/oauth/token/?"
                    ."client_id=app.5c6ff0197c59e0.09613427&"
                    ."grant_type=refresh_token&"
                    ."client_secret=vjoE6AFzlypdqqJ4wtL6fMEdFbSzFhl3Vr4PXBB56BEotymyLr&"
                    ."redirect_uri=https%3A%2F%2Fsite.ru%3Aindex.php&"
                    ."refresh_token=".$request->REFRESH_ID
                );

                $ref = json_decode($ref);

                $ref = (array)$ref;

                $new_token = $ref['access_token'];
                $domain = 'https'.'://'.$ref['domain'];

                $data_query = array(
                    "ACCESS_TOKEN" => $new_token,
                    "DOMAIN" => $domain,
                    "MEMBER_ID" => $ref['member_id'],
                    "REFRESH_TOKEN" => $ref['refresh_token']
                );


                if ($data_query['ACCESS_TOKEN'] == '') {
                    $ref = file_get_contents(
                        "https://oauth.bitrix.info/oauth/token/?"
                        ."client_id=app.5c6ff0197c59e0.09613427&"
                        ."grant_type=refresh_token&"
                        ."client_secret=vjoE6AFzlypdqqJ4wtL6fMEdFbSzFhl3Vr4PXBB56BEotymyLr&"
                        ."redirect_uri=https%3A%2F%2Fsite.ru%3Aindex.php&"
                        ."refresh_token=".$request->REFRESH_ID
                    );

                    $ref = json_decode($ref);

                    $ref = (array)$ref;

                    $new_token = $ref['access_token'];
                    $domain = 'https'.'://'.$ref['domain'];

                    $data_query = array(
                        "ACCESS_TOKEN" => $new_token,
                        "DOMAIN" => $request->DOMAIN,
                        "MEMBER_ID" => $ref['member_id'],
                        "REFRESH_TOKEN" => $ref['refresh_token']
                    );
                }




        }


        return $data_query;
    }



}