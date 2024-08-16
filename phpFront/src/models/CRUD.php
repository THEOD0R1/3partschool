<?php




class CRUD
{

    function postOrPutProduct($url, $product, $post = true)
    {
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $post && curl_setopt($curl, CURLOPT_POST, true);

        $post || curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");

        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($product));

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        if ($response) {
            $response = json_decode($response);

            return $response;
        }
        return [];
    }

    function getProducts($url)
    {

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        if ($response) {
            $response = json_decode($response);

            return $response;
        }

        return [];

    }
    function deleteProduct($url)
    {

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");

        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]);

        $response = curl_exec($curl);

        curl_close($curl);

        if ($response) {
            $response = json_decode($response);
            return $response;
        }

        return [];

    }

}




?>