<?php

namespace NFePHP\NFSe\Models\Issnet\Factories;

class CancelarNfse extends Factory
{
    public function render(
        $versao,
        $remetenteTipoDoc,
        $remetenteCNPJCPF,
        $remetenteIM,
        $codigoMunicipio,
        $numero,
        $codigoCancelamento
    ) {
        $method = "CancelarNfseEnvio";
        $xsd = 'servico_cancelar_nfse_envio';

        $content = '<CancelarNfseEnvio xmlns="http://www.abrasf.org.br/nfse.xsd">';
        $content .= "<Pedido>";
        $content .= "<InfPedidoCancelamento>";
        $content .= "<IdentificacaoNfse>";
        $content .= "<Numero>$numero</Numero>";
        $content .= "<CpfCnpj>";
        $content .= "<Cnpj>$remetenteCNPJCPF</Cnpj>";
        $content .= "</CpfCnpj>";
        $content .= "<InscricaoMunicipal>$remetenteIM</InscricaoMunicipal>";
        $content .= "<CodigoMunicipio>$codigoMunicipio</CodigoMunicipio>";
        $content .= "</IdentificacaoNfse>";
        $content .= "<CodigoCancelamento>$codigoCancelamento</CodigoCancelamento>";
        $content .= "</InfPedidoCancelamento>";
        $content .= "</Pedido>";
        $content .= "</CancelarNfseEnvio>";

        $body = Signer::sign(
            $this->certificate,
            $content,
            'InfPedidoCancelamento',
            'http://www.w3.org/TR/2000/REC-xhtml1-20000126/',
            $this->algorithm,
            [false, false, null, null],
            'Pedido'
        );

        $body = $this->clear($body);


        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:nfse="http://nfse.abrasf.org.br">';
        $xml .= '<soapenv:Header/>';
        $xml .= '<soapenv:Body>';
        $xml .= '<nfse:CancelarNfse>';
        $xml .= '<nfseCabecMsg>';
        $xml .= '<cabecalho xmlns="http://www.abrasf.org.br/nfse.xsd" versao="2.04">';
        $xml .= '<versaoDados>2.04</versaoDados>';
        $xml .= '</cabecalho>';
        $xml .= '</nfseCabecMsg>';
        $xml .= '<nfseDadosMsg>';
        $xml .= $body;
        $xml .= '</nfseDadosMsg>';
        $xml .= '</nfse:CancelarNfse>';
        $xml .= '</soapenv:Body>';
        $xml .= '</soapenv:Envelope>';

        return $xml;
    }
}
