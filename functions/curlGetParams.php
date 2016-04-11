<?php
    /**
     * @param $url
     * @param array $params
     * @param array $options
     * @return bool|mixed
     */
    function simpleCurl($url, $params = [], $options = [])
    {
        $paramUrl = '';
        $c = 0;
        foreach ($params as $key => $param) {
            if (is_array($param)) {
                $param = implode(",", $param);
            }
            if ($c == 0) {
                $paramUrl .= '?' . $key . '=' . rawurlencode($param);
            } else {
                $paramUrl .= '&' . $key . '=' . rawurlencode($param);
            }
            $c++;
        }
        $url = $url . '/' . $paramUrl;
        $defaults = [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_CONNECTTIMEOUT => 15,
        ];
        if ($this->secure === FALSE) {
            $defaults[CURLOPT_SSL_VERIFYPEER] = FALSE;
            $defaults[CURLOPT_SSL_VERIFYHOST] = FALSE;
        }
        $ch = curl_init();
        curl_setopt_array($ch, ($options + $defaults));
        if (!$result = curl_exec($ch)) {
            error_log(curl_error($ch));
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($httpCode !== 200) {
            return FALSE;
        }
        curl_close($ch);
        return $result;
    }