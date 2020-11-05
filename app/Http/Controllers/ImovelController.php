<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImovel;
use App\Models\Imovel;
use Illuminate\Http\Request;

class ImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Inertia\Response|\Inertia\ResponseFactory
     */
    public function index()
    {
        return inertia('Imovel/Index', [
            'imoveis' => Imovel::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Imovel/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreImovel $request)
    {
        $imovel = new Imovel();

        $imovel->email_proprietario = $request->get('email_proprietario');
        $imovel->rua = $request->get('rua');
        $imovel->numero = $request->get('numero');
        $imovel->complemento = $request->get('complemento');
        $imovel->bairro = $request->get('bairro');
        $imovel->cidade = $request->get('cidade');
        $imovel->estado = $request->get('estado');

        $imovel->save();

        return back()->with('success', 'Imóvel cadastrado!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Imovel $imovel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imovel $imovel)
    {
        $imovel->delete();

        return back()->with('success', 'Imóvel removido!');
    }
}
