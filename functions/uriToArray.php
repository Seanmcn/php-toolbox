<?php
    /**
     * Turns a URI into an named array
     *
     * EG: uriToArray(['controller', 'action', 'id'], 'post/edit/1')
     * returns ['controller' => 'post', 'action' => 'edit', 'id' => '1']
     *
     * Names without values return null and unmapped values return as 'unmapped_1, unmapped_2' etc.
     *
     * @param $keys
     * @param $uri
     * @return array
     */
    function uriToArray($keys, $uri)
    {
        $explodedUri = explode("/", $uri);
        $returnArray = array();
        for ($i = 0; $i < count($explodedUri); $i++) {
            if (array_key_exists($i, $keys)) {
                $returnArray[$keys[$i]] = $explodedUri[$i];
            } else {
                // Fail safe for when $keysAndValuesArray is > than $namedKeys
                $a = isset($a) ? $a + 1 : 1;
                $returnArray["unmapped_" . $a] = $explodedUri[$i];
            }
        }
        // For remaining namedKeys set value to null.
        if (count($keys) > count($explodedUri)) {
            for ($remainingKeys = count($keys) - count($explodedUri); $remainingKeys > 0; $remainingKeys--) {
                $currentKey = count($keys) - $remainingKeys;
                $returnArray[$keys[$currentKey]] = NULL;
            }
        }
        return $returnArray;
    }