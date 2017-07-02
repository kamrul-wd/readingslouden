<?php

namespace App\Http\Controllers\Backend\Company;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\CompanyDetail;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'List Company Details';

        $companies = CompanyDetail::all();
        //return $companies;

        return view('pages.backend.company.index', compact('title', 'companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'New Company Entry';

        return view('pages.backend.company.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\CompanyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CompanyRequest $request)
    {
        if (! CompanyDetail::create($request->all())) {
            return back()
                ->with('error', 'Could not create that company.');
        }

        return redirect()
            ->route('admin.company.index')
            ->with('success', 'Created that company.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! $company = CompanyDetail::where('id', $id)->first()) {
            return redirect()
                ->route('admin.company.index')
                ->with('error', 'Could not find that company.');
        }
        //return $company;

        $title = 'Edit Company Entry: '.$company->label;

        return view('pages.backend.company.edit', compact('title', 'company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Requests\CompanyRequest $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CompanyRequest $request, $id)
    {
        if (! $company = CompanyDetail::find($id)) {
            return redirect()
                ->route('admin.company.index')
                ->with('error', 'Could not find that company.');
        }

        if (! $company->update($request->all())) {
            return back()
                ->withInput()
                ->with('error', 'Failed to edited that company.');
        }

        return redirect()
            ->route('admin.company.index')
            ->with('success', 'Edited that company.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $company = CompanyDetail::find($id)) {
            return redirect()
                ->back()
                ->with('error', 'Could not find that company.');
        }

        if (! $company->delete()) {
            return redirect()
                ->back()
                ->with('error', 'Could not delete that company.');
        }

        return redirect()
            ->back()
            ->with('success', 'Deleted that company.');
    }
}
