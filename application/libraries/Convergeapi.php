<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * A PHP class that acts as wrapper for the Elavon Converge API
 *
 * @author Mark Roland Implemented by SAEED ULLAH 
 * @About Saeed Ullah please visit smxoft Solution fb page 
 * @copyright 2014 Mark Roland
 * @license http://opensource.org/licenses/MIT
 * @link http://github.com/markroland/converge-api-php
 *
 **/
class Convergeapi
{

    /**
     * Merchant ID
     * @var string
     */
    // private $merchant_id = '776136'; // live
    private $merchant_id = '000095'; // demo

    /**
     * User ID
     * @var string
     */
    // private $user_id = 'xyzcart'; //live
    private $user_id = 'webpage'; //demo

    /**
     * Pin
     * @var string
     */
    // private $pin = '1M1TFEEQXRJ02E130LLSR1MW4ME2E59NQQ8O0TKCQ89ODKJ4MXTHLX859FVTKNDN'; //live
    private $pin = 'QRHUSL'; //demo

    /**
     * API Live mode
     * @var boolean
     */
    private $live = false;
    private $test_mode = false;

    /**
     * A variable to hold debugging information
     * @var array
     */
    public $debug = array();

    /**
     * Class constructor
     *
     * @param string $merchant_id Merchant ID
     * @param string $user_id User ID
     * @param string $pin PIN
     * @param boolean $live True to use the Live server, false to use the Demo server
     * @return null
     **/
   /* public function __construct()
    {
        $this->merchant_id = '007982';
        $this->user_id = 'webpage';
        $this->pin = 'IWJGHM';
        $this->live = false;
    }*/

    /**
     * Send a HTTP request to the API
     *
     * @param string $api_method The API method to be called
     * @param string $http_method The HTTP method to be used (GET, POST, PUT, DELETE, etc.)
     * @param array $data Any data to be sent to the API
     * @return string
     **/
    private function sendRequest($api_method, $http_method = 'GET', $data = null)
    {

        // Standard data
        $data['ssl_merchant_id'] = $this->merchant_id;
        $data['ssl_user_id'] = $this->user_id;
        $data['ssl_pin'] = $this->pin;
        $data['ssl_show_form'] = 'false';
        $data['ssl_result_format'] = 'ascii';
        $data['ssl_test_mode'] = $this->test_mode;

        // Set request
        if ($this->live) {
            // $request_url = 'https://api.convergepay.com/VirtualMerchant/process.do';
            $request_url = 'https://www.myvirtualmerchant.com/VirtualMerchant/process.do';
        } else {
            $request_url = 'https://api.demo.convergepay.com/VirtualMerchantDemo/process.do';
            
        }

        // Debugging output
        $this->debug = array();
        $this->debug['HTTP Method'] = $http_method;
        $this->debug['Request URL'] = $request_url;

        // Create a cURL handle
        $ch = curl_init();

        // Set the request
        curl_setopt($ch, CURLOPT_URL, $request_url);

        // Save the response to a string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Set HTTP method
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $http_method);

        // This may be necessary, depending on your server's configuration
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // This may be necessary, depending on your server's configuration
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        // Send data
        if (!empty($data)) {

            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

            // Debugging output
            $this->debug['Posted Data'] = $data;

        }

        // Execute cURL request
        $curl_response = curl_exec($ch);

        // Save CURL debugging info
        $this->debug['Last Response'] = $curl_response;
        $this->debug['Curl Info'] = curl_getinfo($ch);

        // Close cURL handle
        curl_close($ch);

        // Parse response
        $response = $this->parseAsciiResponse($curl_response);

        // Return parsed response
        return $response;
    }

    /**
     * Parse an ASCII response
     * @param string $ascii_string An ASCII (plaintext) Response
     * @return array
     **/
    private function parseAsciiResponse($ascii_string)
    {
        $data = array();
        $lines = explode("\n", $ascii_string);
        if (count($lines)) {
            foreach ($lines as $line) {
                $kvp = explode('=', $line);
                $data[$kvp[0]] = $kvp[1];
            }
        }
        return $data;
    }

    /**
     * Submit "ccsale" request
     * @param array $parameters Input parameters
     * @return array Response from Converge
     **/
    public function ccsale(array $parameters = array())
    {
        $parameters['ssl_transaction_type'] = 'ccsale';
        return $this->sendRequest('ccsale', 'POST', $parameters);
    }
    /**
     * Submit "ccauthonly" request
     * @param array $parameters Input parameters
     * @return array Response from Converge
     **/
    public function ccauthonly(array $parameters = array())
    {
        $parameters['ssl_transaction_type'] = 'ccauthonly';
        return $this->sendRequest('ccauthonly', 'POST', $parameters);
    }
     /**
     * Submit "cccomplete" request
     * @param array $parameters Input parameters
     * @return array Response from Converge
     **/
    public function cccomplete(array $parameters = array())
    {
        $parameters['ssl_transaction_type'] = 'cccomplete';
        return $this->sendRequest('cccomplete', 'POST', $parameters);
    }
     /**
     * Submit "ccdelete" request
     * @param array $parameters Input parameters
     * @return array Response from Converge
     **/
    public function ccdelete(array $parameters = array())
    {
        $parameters['ssl_transaction_type'] = 'ccdelete';
        return $this->sendRequest('ccdelete', 'POST', $parameters);
    }
    /**
     * Submit "ccverify" request
     * @param array $parameters Input parameters
     * @return array Response from Converge
     **/
    public function ccverify(array $parameters = array())
    {
        $parameters['ssl_transaction_type'] = 'ccverify';
        return $this->sendRequest('ccverify', 'POST', $parameters);
    }
    /**
     * Submit "ccaddinstall" request
     * @param array $parameters Input parameters
     * @return array Response from Converge
     **/
    public function ccaddinstall(array $parameters = array())
    {
        $parameters['ssl_transaction_type'] = 'ccaddinstall';
        return $this->sendRequest('ccaddinstall', 'POST', $parameters);
    }

    /**
     * Submit "ccaddrecurring" request
     * @param array $parameters Input parameters
     * @return array Response from Converge
     **/
    public function ccaddrecurring(array $parameters = array())
    {
        $parameters['ssl_transaction_type'] = 'ccaddrecurring';
        return $this->sendRequest('ccaddrecurring', 'POST', $parameters);
    }

    /**
     * Submit "ccupdaterecurring" request
     * @param array $parameters Input parameters
     * @return array Response from Converge
     **/
    public function ccupdaterecurring(array $parameters = array())
    {
        $parameters['ssl_transaction_type'] = 'ccupdaterecurring';
        return $this->sendRequest('ccupdaterecurring', 'POST', $parameters);
    }

    /**
     * Submit "ccdeleterecurring" request
     * @param array $parameters Input parameters
     * @return array Response from Converge
     **/
    public function ccdeleterecurring(array $parameters = array())
    {
        $parameters['ssl_transaction_type'] = 'ccdeleterecurring';
        return $this->sendRequest('ccdeleterecurring', 'POST', $parameters);
    }

    /**
     * Submit "ccresurringsale" request
     * @param array $parameters Input parameters
     * @return array Response from Converge
     **/
    public function ccresurringsale(array $parameters = array())
    {
        $parameters['ssl_transaction_type'] = 'ccresurringsale';
        return $this->sendRequest('ccresurringsale', 'POST', $parameters);
    }
}
