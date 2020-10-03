<?php

namespace App\Http\Controllers;

use App\Http\Util\DateUtil;

use App\Models\Util\OrmUtil;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

use Session;
use Throwable;

/**
 * Class Controller
 * @package App\Http\Controllers
 * @author lucasrafael
 */
class Controller extends BaseController
{
    /**
     * Execute an action on the parent controller.
     * @param string $method
     * @param array $parameters
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        try {
            return parent::callAction($method, $parameters);

        } catch (Throwable $e) {

            return self::getRedirectResponseWithErrors($e);
        }
    }

    /**
     * Retorna o "RedirectResponse" com os devidos erros...
     * @param Throwable $e
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function getRedirectResponseWithErrors($obj)
    {
        if ($obj instanceof Throwable) {

            $referer = request()->header('referer') ? request()->header('referer') : null;

            // Se houver um 'referer' e o conteúdo (end.) for o mesmo do end. atual,
            // não tem como redirecionar para a página anterior; isto, pois ficará em "loop"...
            if (!$referer || ($referer && $referer == url()->current())) {

                $code = $obj->getCode();
                $message = $obj->getMessage();

                return view('errors.minimal', compact('code', 'message'));
            }

            return redirect()->back()->withInput()->withErrors($obj->getMessage());

        } elseif ($obj instanceof MessageBag) {

            return redirect()->back()->withInput()->withErrors($obj);

        } else {
            $code = null;
            $message = $obj;

            return view('errors.minimal', compact('code', 'message'));
        }
    }

    /**
     * Retorna lista de objetos (model) paginada.
     * @param Request $request
     * @param string $nomeCampo
     * @param string $_class
     * @return mixed
     */
    protected static function getListaPaginada(Request $request, string $nomeCampo, string $_class, string $orderBy = 'nome')
    {
        $qtd = $request['qtd'] ?: \App\Http\Util\Config::QTD_REG_PAG;
        $page = $request['page'] ?: 1;
        $buscar = $request['buscar'];

        return OrmUtil::list($_class, $nomeCampo, $buscar, $orderBy)
            ->paginate($qtd)
            ->appends(Request::capture()->except('page'));
    }

}
