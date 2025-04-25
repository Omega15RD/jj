<?php
class Repostatge {
    public $combustible;
    public $quantitat;
    public $pagament;
    public $surtidor;
    public $hora;

    // Constructor per inicialitzar els valors
    public function __construct($combustible = null, $quantitat = null, $pagament = null, $surtidor = null) {
        $this->combustible = $combustible;
        $this->quantitat = $quantitat;
        $this->pagament = $pagament;
        $this->surtidor = $surtidor;
        $this->hora = date("Y-m-d H:i:s");
    }

    // Mètode per actualitzar les dades
    public function actualitzar($combustible, $quantitat, $pagament, $surtidor) {
        $this->combustible = $combustible;
        $this->quantitat = $quantitat;
        $this->pagament = $pagament;
        $this->surtidor = $surtidor;
        $this->hora = date("Y-m-d H:i:s");
    }

    // Mètode per recuperar les dades de l'objecte com a array
    public function obtenirDades() {
        return [
            'combustible' => $this->combustible,
            'quantitat' => $this->quantitat,
            'pagament' => $this->pagament,
            'surtidor' => $this->surtidor,
            'hora' => $this->hora
        ];
    }
}
?>
