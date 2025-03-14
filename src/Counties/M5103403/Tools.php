<?php

namespace NFePHP\NFSe\Counties\M5103403;

/**
 * Classe para a comunicação com os webservices da
 * Cidade de Cuiabá MT
 * conforme o modelo ISSNET
 *
 * @category  NFePHP
 * @package   NFePHP\NFSe\Counties\M5103403\Tools
 * @copyright NFePHP Copyright (c) 2016
 * @license   http://www.gnu.org/licenses/lgpl.txt LGPLv3+
 * @license   https://opensource.org/licenses/MIT MIT
 * @license   http://www.gnu.org/licenses/gpl.txt GPLv3+
 * @author    Roberto L. Machado <linux.rlm at gmail dot com>
 * @link      http://github.com/nfephp-org/sped-nfse for the canonical source repository
 */

use NFePHP\NFSe\Models\Issnet\Tools as ToolsModel;

class Tools extends ToolsModel
{
    /**
     * Webservices URL
     * @var array
     */
    protected $url = [
        1 => 'https://wscuiaba.issnetonline.com.br/webservicenfse204/nfse.asmx',
        2 => 'http://www.issnetonline.com.br/webserviceabrasf/homologacao/servicos.asmx'
    ];
    /**
     * County Namespace
     * @var string
     */
    protected $xmlns = 'http://nfse.abrasf.org.br';

    /**
     * Soap Version
     * @var int
     */
    protected $soapversion = SOAP_1_2;
    /**
     * SIAFI County Cod
     * @var int
     */
    protected $codcidade = 9067;
    /**
     * Indicates when use CDATA string on message
     * @var boolean
     */
    protected $withcdata = true;
    /**
     * Encription signature algorithm
     * @var string
     */
    protected $algorithm = OPENSSL_ALGO_SHA1;
    /**
     * Version of schemas
     * @var int
     */
    protected $versao = 1;
    /**
     * namespaces for soap envelope
     * @var array
     */
    protected $namespaces = [
        1 => [
            'xmlns:soapenv' => "http://schemas.xmlsoap.org/soap/envelope",
            'xmlns' => "http://nfse.abrasf.org.br"
        ],
        2 => [
            'xmlns:soap' => "http://schemas.xmlsoap.org/soap/envelope",
            'xmlns' => "http://nfse.abrasf.org.br"
        ]
    ];
}
