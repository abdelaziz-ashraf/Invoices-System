<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{

    public function index()
    {
        return view('invoices.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Invoices $invoices)
    {
        //
    }

    public function edit(Invoices $invoices)
    {
        //
    }

    public function update(Request $request, Invoices $invoices)
    {
        //
    }

    public function destroy(Invoices $invoices)
    {
        //
    }
}
