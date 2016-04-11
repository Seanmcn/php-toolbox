<?php
    /**
     * @param $url
     * @param array $options
     * @return mixed
     */
    function curlIt($url, $options = [])
    {
        $defaults = [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_CONNECTTIMEOUT => 15
        ];

        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));

        if (!$result = curl_exec($ch)) {
            error_log(curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }