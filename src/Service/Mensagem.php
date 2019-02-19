<?php

namespace App\Service;

class Mensagem
{

    public function escreverMensagem ( $nome )
    {

        return "Olá {$nome} eu sou o serviço";
    }
}