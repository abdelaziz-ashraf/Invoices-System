<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoices;
use App\Models\Section;

class InvoicesController extends Controller
{

    public function index()
    {
        $invoices = Invoices::with(['section', 'product'])->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $sections = Section::all();
        return view('invoices.create', compact('sections'));
    }

    public function store(StoreInvoiceRequest $request)
    {
        $data = $request->validated();
        $data['status'] = 'Unpaid';
        $data['value_status'] = 2;
        $data['user_id'] = auth()->id();
        Invoices::create($data);
        session()->flash('success', 'Invoice has been created');
        return redirect()->route('invoices.index');
    }

    public function edit(Invoices $invoice)
    {
        $sections = Section::all();
        return view('invoices.edit', compact('invoice', 'sections'));
    }

    public function update(UpdateInvoiceRequest $request, Invoices $invoice)
    {
        $invoice->update($request->validated());
        session()->flash('success', 'Invoice has been updated');
        return redirect()->route('invoices.index');
    }

    public function destroy(Invoices $invoice)
    {
        $invoice->delete();
        session()->flash('success', 'Invoice has been deleted');
        return redirect()->route('invoices.index');
    }

    public function archive()
    {
        $invoices = Invoices::onlyTrashed()->get();
        return view('invoices.archive', compact('invoices'));
    }

    public function unarchive($id)
    {
        $invoice = Invoices::onlyTrashed()->where('id', $id)->first();
        $invoice->update(['deleted_at' => null]);
        session()->flash('success', 'Invoice has been unarchived');
        return redirect()->route('invoices.archive');
    }
}
