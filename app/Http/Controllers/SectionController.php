<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    public function index()
    {
        $sections = Section::all();
        return view('sections.index', compact('sections'));
    }

    public function store(StoreSectionRequest $request)
    {
        Section::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'created_by' => auth()->user()->name
        ]);
        session()->flash('success', 'Section created successfully');
        return redirect()->route('sections.index');
    }

    public function edit(Section $section)
    {
        return view('sections.edit', compact('section'));
    }

    public function update(UpdateSectionRequest $request, Section $section)
    {
        $section->update([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
        ]);
        session()->flash('success', 'Section updated successfully');
        return redirect()->route('sections.index');
    }

    public function destroy(Section $section)
    {
        $section->delete();
        session()->flash('success', 'Section deleted successfully');
        return redirect()->route('sections.index');
    }
}
