<?php
namespace Serokuz\ReformaGkhApi;


use Config;
use SoapClient;
use SoapFault;
use SoapHeader;
use SoapVar;

class ReformaGkhApi
{
    protected $wsdl = '';
    protected $soapClient;
    protected $sessionGuid;

    public function __construct()
    {
        $this->wsdl = Config::get('reforma-gkh.wsdl');
    }

    /**
     * Получить клиента, если нет, создать подключение
     * @return SoapClient
     * @throws SoapFault
     */
    protected function getSoapClient(): SoapClient
    {
        if ($this->soapClient === null)
        {
            $this->soapClient = new SoapClient($this->wsdl, ['exceptions' => true,]);
        }

        return $this->soapClient;
    }

    /**
     * Аутентификация
     * @throws SoapFault
     */
    public function login()
    {
        $param = [
            'login'     => Config::get('reforma-gkh.login'),
            'password'  => Config::get('reforma-gkh.password'),
        ];

        try {
            $response = $this->getSoapClient()->__call('Login', $param);
        }
        catch (SoapFault $fault){
            throw $fault;
        }
        $this->sessionGuid = $response;

        $headerVar = new SoapVar('<authenticate>'.$this->sessionGuid.'</authenticate>', XSD_ANYXML);

        $headers = new SoapHeader('NAMESPACE', 'RequestParams', $headerVar);

        $this->getSoapClient()->__setSoapHeaders(array($headers));
    }

    /**
     * Получить данные о доме
     * @param string $aoguid
     * @return mixed|null
     */
    public function getHouseProfileActual(string $aoguid)
    {
        $param = [
            'house_id' => null,
            'houseguid' => $aoguid,
        ];

        try {
            $response = $this->getSoapClient()->__call('GetHouseProfileActual', $param);
        }
        catch (SoapFault $fault){
            return null;
        }
        return $response;
    }

}
