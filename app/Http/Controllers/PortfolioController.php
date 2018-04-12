<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $portfolio = Portfolio::latest()->paginate(5);


        return view('portfolio.index',compact('portfolio'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'port_titulo' => 'required',
            'port_desc' => 'required',
            'port_thumb' => 'required',
        ]);


        Portfolio::create($request->all());


        return redirect()->route('portfolio.index')
                        ->with('success','Post foi criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function show(Portfolio $portfolio)
    {
        return view('portfolio.show',compact('portfolio'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\m_responsekeys(conn, identifier)
     */
    public function edit(Portfolio $portfolio)
    {
        return view('portfolio.edit',compact('portfolio'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Portfolio $portfolio)
    {
         request()->validate([
            'port_titulo' => 'required',
            'port_desc' => 'required',
            'port_thumb' => 'required',
        ]);


        $portfolio->update($request->all());


        return redirect()->route('portfolio.index')
                        ->with('success','Post editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Portfolio  $portfolio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();


        return redirect()->route('portfolio.index')
                        ->with('success','Post deletado com sucesso!');
    }
}
