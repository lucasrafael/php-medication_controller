<?php

namespace App\Http\Util;

use Session;

/**
 * Class Useful
 * @package App\Http\Util
 * @author lucasrafael
 */
class Useful
{
    /**
     * Atribui-se mensagem de sucesso que deve ser exibida na tela.
     * @param string $msg
     */
    public static function setMsgSucesso(string $msg)
    {
        Session::flash('msg_sucesso', $msg);
    }

    /**
     * Atribui-se mensagem de erro que deve ser exibida na tela.
     * @param string $msg
     */
    public static function setMsgErro(string $msg)
    {
        Session::flash('msg_erro', $msg);
    }

}
