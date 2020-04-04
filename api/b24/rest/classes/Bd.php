<?php

class Bd
{

    public function getPortal($portal)
    {

        $mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = "SELECT * FROM cameras WHERE PORTAL='$portal'";

        $arResult = [];

        if ($result = $mysql->query($query)) {

            while ($row = $result->fetch_assoc()) {
                $arResult[] = $row;
            }

            $result->close();
        }

        return $arResult[0];
    }

    public function addPortal($portal)
    {

        $mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $query = "INSERT INTO cameras (PORTAL) VALUES ('$portal')";

        $mysql->query($query);

        return true;
    }
}