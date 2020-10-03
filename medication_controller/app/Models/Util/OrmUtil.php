<?php

namespace App\Models\Util;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Http\Util\Useful;

use Throwable;

/**
 * Class OrmUtil
 * @package App\Models\Util
 * @author lucasrafael
 */
class OrmUtil {

    /**
     * Executa a "function" informada dentro de um bloco transacional e redireciona para a rota informada em caso de sucesso;
     * caso ocorra erro, retorna para a tela anterior com a mensagem de erro.
     * @param $_proc
     * @param string $msg_sucesso
     * @param string $route_sucesso
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function execTrans($_proc, string $msg_sucesso, string $route_sucesso)
    {
        try {
            DB::beginTransaction();
            $_proc();
            DB::commit();

            Useful::setMsgSucesso($msg_sucesso);

            return redirect()->route($route_sucesso);

        } catch (Throwable $e) {
            DB::rollback();

            return Controller::getRedirectResponseWithErrors($e->getMessage());
        }
    }

    /**
     * Retorna lista de objetos ordenada de acordo com os parâmetros informados.
     * @param string $_class
     * @param string $nomeCampo
     * @param string $buscar
     * @param string $orderBy
     * @return mixed
     */
    public static function list(string $_class, string $nomeCampo, $buscar, string $orderBy = 'nome') {
        if ($buscar) {
            return $_class::where($nomeCampo, 'like', $buscar . '%')->orderBy($orderBy);
        } else {
            return $_class::orderBy($orderBy);
        }
    }

}
