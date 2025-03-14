<?php

namespace NFePHP\NFSe\Models\Issnet\Factories;

class ConsultarUrlVisualizacaoNfse extends Factory
{
    public function render(
        $versao,
        $remetenteTipoDoc,
        $remetenteCNPJCPF,
        $inscricaoMunicipal,
        $numero,
        $codigoTributacao
    ) {
        $method = "ConsultarUrlNfse";
        
        $body = '<ConsultarUrlNfseEnvio xmlns="http://www.abrasf.org.br/nfse.xsd">';
        $body .= "<Pedido>";
        $body .= "<Prestador>";
        $body .= "<CpfCnpj>";
        $body .= "<Cnpj>$remetenteCNPJCPF</Cnpj>";
        $body .= "</CpfCnpj>";
        $body .= "<InscricaoMunicipal>$inscricaoMunicipal</InscricaoMunicipal>";
        $body .= "</Prestador>";
        $body .= "<NumeroNfse>$numero</NumeroNfse>";
        $body .= "<Pagina>1</Pagina>";
        $body .= "</Pedido>";
        $body .= "</ConsultarUrlNfseEnvio>";
        
        $body_signed = Signer::sign(
            $this->certificate,
            $body,
            'ConsultarUrlNfseEnvio',
            '',
            $this->algorithm,
            [false, false, null, null]
        );

        $body_signed = $this->clear($body_signed);

        $content = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:nfse="http://nfse.abrasf.org.br">';
        $content .= '<soapenv:Body>';
        $content .= "<nfse:ConsultarUrlNfse>";
        $content .= '<nfseCabecMsg>';
        $content .= '<cabecalho xmlns="http://www.abrasf.org.br/nfse.xsd" versao="2.04">';
        $content .= '<versaoDados>2.04</versaoDados>';
        $content .= '</cabecalho>';
        $content .= '</nfseCabecMsg>';
        $content .= "<nfseDadosMsg>";
        $content .= $body_signed;
        $content .= "</nfseDadosMsg>";
        $content .= "</nfse:ConsultarUrlNfse>";
        $content .= "</soapenv:Body>";
        $content .= "</soapenv:Envelope>";



        $xml = $this->clear($content);
        return $xml;
    }
}
