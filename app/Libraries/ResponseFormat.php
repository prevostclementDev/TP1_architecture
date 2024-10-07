<?php

namespace App\Libraries;

trait ResponseFormat
{
    // response
    private $rResponse = [
        'statusBool' => true,
        'status' => 'success',
        'code' => '200',
        'message' => 'OK - Requête réussie',
        'data' => []
    ];

    // data of code message
    private array $rCodeMessage = array(
        // Codes de succès
        200 => "OK - Requête réussie",
        201 => "Created - Ressource créée avec succès",
        204 => "No Content - Pas de contenu à renvoyer",

        // Codes d'erreur courants
        400 => "Bad Request - La requête est incorrecte",
        401 => "Unauthorized - Authentification requise",
        403 => "Forbidden - Accès refusé",
        404 => "Not Found - Ressource non trouvée",
        405 => "Method Not Allowed - Méthode non autorisée",
        500 => "Internal Server Error - Erreur interne du serveur",
        502 => "Bad Gateway - Mauvaise passerelle",
        503 => "Service Unavailable - Service non disponible",

        // Autres codes d'erreur possibles
        301 => "Moved Permanently - Ressource déplacée de manière permanente",
        302 => "Found - Ressource trouvée",
        303 => "See Other - Redirection vers une autre ressource",
        304 => "Not Modified - Aucune modification",
        406 => "Not Acceptable - Requête non acceptable",
        408 => "Request Timeout - Délai d'attente de la requête dépassé",
        409 => "Conflict - Conflit de requêtes",
        410 => "Gone - Ressource n'est plus disponible",
        413 => "Payload Too Large - Charge de la requête trop importante",
        415 => "Unsupported Media Type - Type de média non supporté",
        429 => "Too Many Requests - Trop de requêtes",
    );

    // *******************************
    //             GETTER
    // *******************************

    // return array rResponse
    public function r() : array {
        return $this->rResponse;
    }

    // get code rResponse set
    public function getCode() : int {
        return $this->rResponse['code'];
    }

    // return specific data
    public function getData(string $element) : mixed {
        return (isset($this->rResponse['data'][$element])) ? $this->rResponse['data'][$element] : false;
    }

    // *******************************
    //             SETTER
    // *******************************

    // add data to rResponse
    public function addData(mixed $data,string $key = null): static
    {

        if (is_null($key)) {
            $this->rResponse['data'][] = $data;
        } else {
            $this->rResponse['data'][$key] = $data;
        }


        return $this;
    }

    // remove data
    public function removeData(string $element): bool {
        if ( isset($this->rResponse['data'][$element]) ) {
            unset($this->rResponse['data'][$element]);
            return true;
        }
        return false;
    }

    // set rResponse in error
    public function setError(int $code = 500, mixed $details = null,?string $type = null): static
    {
        $this->rResponse['status'] = 'error';
        $this->rResponse['statusBool'] = false;
        $this->setCode($code);

        if ( ! is_null($details) ) {
            $this->addData($details,'details');
        }

        if ( ! is_null($type) ) {
            $this->addData($type,'TypeError');
        }

        return $this;
    }

    // set code
    public function setCode(int $code) : static {
        $this->rResponse['code'] = $code;
        $this->setMessageByCode($code);

        return $this;
    }

    // set global message
    public function setMessage(string $message) : static {
        $this->rResponse['message'] = $message;
        return $this;
    }

    // set message by code
    public function setMessageByCode(int $code = null) : static {

        if ( is_null($code) ) {
            $code = $this->rResponse['code'];
        }

        $this->rResponse['message'] = (isset($this->codeMessage[$code])) ? $this->codeMessage[$code] : '';

        return $this;

    }

}