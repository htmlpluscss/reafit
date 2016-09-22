<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tinypng
{

    private $url = 'https://api.tinypng.com/shrink';
    private $curl = null;
    private $lastResult = null;

    public function initialize($key = null) {
        if(!empty($key)){
            if ($this->curl === null) {
                $this->curl = curl_init();
                $curlOpts = array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => $this->url,
                    CURLOPT_USERAGENT => 'TinyPNG PHP API v1',
                    CURLOPT_POST => 1,
                    CURLOPT_USERPWD => 'api:' . $key,
                    CURLOPT_BINARYTRANSFER => 1
                );
                curl_setopt_array($this->curl, $curlOpts);
            }
        } else {
            return false;
        }
    }

    /**
     * Send image shrink request
     * @param  string $file path to file to shrink
     * @return boolean|exception       Is HTTP response 200
     */
    public function shrink($file)
    {
        if (file_exists($file) === false) {
            throw new Exception(JText::_('PLG_CONTENT_TINYPNG_FILE_DOES_NOT_EXIST'));
        }
        curl_setopt($this->getCurl(), CURLOPT_POSTFIELDS, file_get_contents($file));
        $this->lastResult = curl_exec($this->getCurl());
        return curl_getinfo($this->getCurl(), CURLINFO_HTTP_CODE) === 201;
    }

    /**
     * Return API response object
     * @return object|exception
     */
    public function getResult() {
        return $this->_getResult();
    }

    /**
     * Return API response as JSON
     * @return string|exception
     */
    public function getResultJson() {
        return json_decode($this->_getResult());
    }

    /**
     * Return API response object
     * @return object|exception
     */
    protected function _getResult()
    {
        if ($this->lastResult === null) {
            throw new Exception(JText::_('PLG_CONTENT_TINYPNG_NO_CURRENT_RESULT'));
        }
        return $this->lastResult;
    }

    /**
     * Return Curl object
     * @return object|exception
     */
    protected function getCurl()
    {
        if ($this->curl === null) {
            throw new Exception(JText::_('PLG_CONTENT_TINYPNG_CURL_NOT_INITIALIZED'));
        }

        return $this->curl;
    }
}

/* End of file Logging.php */