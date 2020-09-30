<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected static function getModelPaginado(Request $request, string $nomeCampo, string $_class) {

        $qtd = $request['qtd'] ?: \App\Http\Util\Config::QTD_REG_PAG;
        $page = $request['page'] ?: 1;
        $buscar = $request['buscar'];

        if ($buscar){
            $ret = $_class::where($nomeCampo,'=',$buscar)->paginate($qtd);
        } else{
            $ret = $_class::paginate($qtd);
        }

        return $ret->appends(Request::capture()->except('page'));
    }

    protected static function execTrans($_proc, string $msg_sucesso, string $route_sucesso) {
        try {
            DB::beginTransaction();
            $_proc();
            DB::commit();

            self::setMsgSucesso($msg_sucesso);

            return redirect()->route($route_sucesso);
        }
        catch (\Throwable $e) {
            DB::rollback();

            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }
    }

    protected static function setMsgSucesso(string $msg) {
        \Session::flash('msg_sucesso', $msg);
    }

    protected static function setMsgErro(string $msg) {
        \Session::flash('msg_erro', $msg);
    }

}
