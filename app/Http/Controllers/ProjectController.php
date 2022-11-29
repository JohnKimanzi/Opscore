<?php

namespace App\Http\Controllers;

use App\Models\BillingFrequency;
use App\Models\BillingType;
use App\Models\Client;
use App\Models\Currency;
use App\Models\DeliveryType;
use App\Models\Project;
use App\Models\ProjectDocuments;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\ProjectType;
use App\Models\ServiceType;
use App\Models\Status;
use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole(['Operations Manager','Administration Assistant','Admin','BPO Director','Head of Operations','Operations Manager','Assistant Operations Manager','Business Development Executive','Administration Executive','Business Development Manager', 'Human Resource Manager', 'Human Resource Executive'])){
            // $projects=Project::with('project_type')
            //     ->with('client')
            //     ->with('serviceType')
            //     ->with('currency')
            //     ->with('billingType')
            //     ->with('billingFrequency')
            //     ->get();
            $projects = Project::all();
            $services=ServiceType::all();
            $project_types=ProjectType::all();
            $currencies=Currency::all();
            $billing_types=BillingType::all();
            $billing_frequencies=BillingFrequency::all();
            $delivery_types=DeliveryType::all();
            $statuses=Status::all();
            $clients = Client::all();
            $billing_frequencys = BillingFrequency::all();
            return view('projects.index')
                ->with('projects',$projects)
                ->with('service_types',$services)
                ->with('project_types',$project_types)
                ->with('currencies',$currencies)
                ->with('billing_types',$billing_types)
                ->with('delivery_types',$delivery_types)
                ->with('statuses',$statuses)
                ->with('billing_frequencies',$billing_frequencies)
                ->with('clients', $clients)
                ->with('billing_frequencys',$billing_frequencys);
        }
        return abort(403, 'Unauthorized');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // dd('store');
        $request->validate([
            'name'=>'required|string',
            'description'=>'nullable|string',
            'client_id'=>'required|numeric|min:1',
            'project_type_id'=>'required|numeric',
            'service_type_id'=>'required|string',
            'delivery_type_id'=>'required',
            'billing_type_id'=>'required|string',
            'billing_frequency_id'=>'required|string',
            'currency_id'=>'required|numeric',
            'status_id'=>'required|string',
            'pricing'=>'required|numeric',
            'start_date'=>'required|date|before:end_date',
            'end_date'=>'required|date|after:start_date',
            'po'=>'required',
            'contract'=>'required',
            'letterOfIntent'=>'required',
            'nda'=>'required',
            'sales_handover'=>'required'
        ]);

        $client=Client::find($request->client_id);
        $pCode=rand(10000,99999).'-'.$client->name;
        $project= Project::create([
            'code'=>$pCode,
            'name'=>$request->name,
            'client_id'=>$request->client_id,
            'project_type_id'=>$request->project_type_id,
            'service_type_id'=>$request->service_type_id,
            'delivery_type_id'=>$request->delivery_type_id,
            'billing_type_id'=>$request->billing_type_id,
            'billing_frequency_id'=>$request->billing_frequency_id,
            'currency_id'=>$request->currency_id,
            'status_id'=>$request->status_id,
            'pricing'=>$request->pricing,
            'description'=>$request->description,
            'start_date'=>Carbon::create($request->start_date),
            'end_date'=>Carbon::create($request->end_date),
        ]);

        if ($project){
            $contract=$request->file('contract');
            $po=$request->file('po');
            $letterOfIntent=$request->file('letterOfIntent');
            $nda=$request->file('nda');
            $sales_handover=$request->file('sales_handover');

            // $contractName=rand().'.'.$contract->extension();
            // $poName=rand().'.'.$po->extension();
            // $letterOfIntentName=rand().'.'.$letterOfIntent->extension();
            // $ndaName=rand().'.'.$nda->extension();
            // $sales_handover_name=rand().'.'.$sales_handover->extension();

            $contractName=rand().'.'.$contract->getClientOriginalName();
            $contractSize = $contract->getSize();
            $poName=rand().'.'.$po->getClientOriginalName();
            $poSize = $po->getSize();
            $letterOfIntentName=rand().'.'.$letterOfIntent->getClientOriginalName();
            $letterOfIntentSize = $letterOfIntent->getSize();
            $ndaName=rand().'.'.$nda->getClientOriginalName();
            $ndaSize = $nda->getSize();
            $sales_handover_name=rand().'.'.$sales_handover->getClientOriginalName();
            $sales_handover_size = $sales_handover->getSize();


            $contract->move(public_path('project_documents'),date('-Y_m_d_His').$contractName);
            $po->move(public_path('project_documents'),date('-Y_m_d_His').$poName);
            $letterOfIntent->move(public_path('project_documents'),date('-Y_m_d_His').$letterOfIntentName);
            $nda->move(public_path('project_documents'),date('-Y_m_d_His').$ndaName);
            $sales_handover->move(public_path('project_documents'),date('-Y_m_d_His').$sales_handover_name);
            
            $documentable_type = class_basename($project);
            $documentable_id = $project->id;
            $doc_types = DocumentType::all();
            Document::create([
                'name'=>$contractName,
                'document_type_id'=> DocumentType::where('name', 'like', '%Contract%')->pluck('id')->first(),
                'size'=>$contractSize,
                'uploaded_by_id'=>Auth::user()->id,
                'url'=>"app/public/Docs/{$documentable_type}/{$project->name}/{$doc_types->where('name', 'like', '%Contract%')->pluck('name')->first()}".$contractName,
                'documentable_type'=>$documentable_type,
                'documentable_id'=>$documentable_id,
            ]);

            Document::create([
                'name'=>$poName,
                'document_type_id'=> DocumentType::where('name', 'like', '%PO%')->pluck('id')->first(),
                'size'=>$poSize,
                'uploaded_by_id'=>Auth::user()->id,
                'url'=>"app/public/Docs/{$documentable_type}/{$project->name}/{$doc_types->where('name', 'like', '%PO%')->pluck('name')->first()}".$poName,
                'documentable_type'=>$documentable_type,
                'documentable_id'=>$documentable_id,
            ]);

            Document::create([
                'name'=>$letterOfIntentName,
                'document_type_id'=> DocumentType::where('name', 'like', '%Letter of Intent%')->pluck('id')->first(),
                'size'=>$letterOfIntentSize,
                'uploaded_by_id'=>Auth::user()->id,
                'url'=>"app/public/Docs/{$documentable_type}/{$project->name}/{$doc_types->where('name', 'like', '%Letter of Intent%')->pluck('name')->first()}".$letterOfIntentName,
                'documentable_type'=>$documentable_type,
                'documentable_id'=>$documentable_id,
            ]);

            Document::create([
                'name'=>$ndaName,
                'document_type_id'=> DocumentType::where('name', 'like', '%NDA%')->pluck('id')->first(),
                'size'=>$ndaSize,
                'uploaded_by_id'=>Auth::user()->id,
                'url'=>"app/public/Docs/{$documentable_type}/{$project->name}/{$doc_types->where('name', 'like', '%NDA%')->pluck('name')->first()}".$ndaName,
                'documentable_type'=>$documentable_type,
                'documentable_id'=>$documentable_id,
            ]);

            Document::create([
                'name'=>$sales_handover_name,
                'document_type_id'=> DocumentType::where('name', 'like', '%Sales Handover%')->pluck('id')->first(),
                'size'=>$sales_handover_size,
                'uploaded_by_id'=>Auth::user()->id,
                'url'=>"app/public/Docs/{$documentable_type}/{$project->name}/{$doc_types->where('name', 'like', '%Sales Handover%')->pluck('name')->first()}".$sales_handover_name,
                'documentable_type'=>$documentable_type,
                'documentable_id'=>$documentable_id,
            ]);

            return Redirect::back()->with('success', 'Project has been created successfully!');

        }

        return Redirect::back()->with('error', 'Project has not been created !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        if(Auth::user()->hasAnyRole('Operations Manager|Administration Assistant|Admin|BPO Director|Head of Operations|Operations Manager|Assistant Operations Manager|Business Development Executive|Administration Executive|Business Development Manager')){
            return view('projects.show', [
                'project'=>$project, 
                'members'=>$project->employees, 
                'client'=>$project->client,
                'employees'=>Employee::all(), 
                'projects'=>Project::all(),
                'billing_types'=>BillingType::all(),
            ]);
        }
        return abort(403, 'Unauthorized');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {

        if (Auth::user()->hasAnyRole('Operations Manager|Administration Assistant|Admin|BPO Director|Head of Operations|Operations Manager|Assistant Operations Manager|Business Development Executive|Administration Executive|Business Development Manager')) {
            // $project = Project::with('project_type')
            // ->with('client')
            // ->with('serviceType')
            // ->with('currency')
            // ->with('billingType')
            // ->with('billingFrequency')
            // ->where('id', $id)
            //     ->first();
            $project = Project::findOrFail($id);
            $clients = Client::all();
            $services = ServiceType::all();
            $project_types = ProjectType::all();
            $currencies = Currency::all();
            $billing_types = BillingType::all();
            $billing_frequencies = BillingFrequency::all();
            $delivery_types = DeliveryType::all();
            $statuses = Status::all();
            $project_docs = ProjectDocuments::all();

            return view('projects.edit')
                ->with('project', $project)
                ->with('service_types', $services)
                ->with('project_types', $project_types)
                ->with('currencies', $currencies)
                ->with('billing_types', $billing_types)
                ->with('delivery_types', $delivery_types)
                ->with('statuses', $statuses)
                ->with('billing_frequencies', $billing_frequencies)
                ->with('project_docs', $project_docs)
                ->with('clients', $clients);
        }

        return abort(403, 'Unauthorized');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Project $project)
    {

        // if (!$request->has(['contract','letterOfIntent','nda','sales_handover','po'])) {
        //     return response()->json(['message' => 'Missing file'], 422);
        // }

        $request->validate([
            'code' => 'required|string',
            'name' => 'required|string',
            'client_id' => 'required|numeric|min:1',
            'project_type_id' => 'required|string',
            'service_type_id' => 'required|string',
            'description' => 'nullable|string',
            'delivery_type_id' => 'required',
            'status_id' => 'required|string',
            'billing_type_id' => 'required|string',
            'billing_frequency_id' => 'required|string',
            'currency_id' => 'required|string',
            'pricing' => 'required|numeric',
            'start_date' => 'required|date|before:end_date',
            'end_date' => 'required|date|after:start_date',

        ]);

        $update_success = $project->update([
            'code' => $request->code,
            'name' => $request->name,
            'client_id' => $request->client_id,
            'project_type_id' => $request->project_type_id,
            'delivery_type_id' => $request->delivery_type_id,
            'billing_type_id' => $request->billing_type_id,
            'service_type_id' => $request->service_type_id,
            'billing_frequency_id' => $request->billing_frequency_id,
            'pricing' => $request->pricing,
            'currency_id' => $request->currency_id,
            'description' => $request->description,
            'status_id' => $request->status_id,
            'start_date' => Carbon::create($request->start_date),
            'end_date' => Carbon::create($request->end_date),
        ]);
        if ($update_success) {
            if ($request->has(['contract', 'letterOfIntent', 'nda', 'sales_handover', 'po'])) {
                $contract = $request->file('contract');
                $po = $request->file('po');
                $letterOfIntent = $request->file('letterOfIntent');
                $nda = $request->file('nda');
                $sales_handover = $request->file('sales_handover');

                $contractName = $contract->getClientOriginalName();
                $contractSize = $contract->getSize();
                $poName = $po->getClientOriginalName();
                $poSize = $po->getSize();
                $letterOfIntentName = $letterOfIntent->getClientOriginalName();
                $letterOfIntentSize = $letterOfIntent->getSize();
                $ndaName = $nda->getClientOriginalName();
                $ndaSize = $nda->getSize();
                $sales_handover_name = $sales_handover->getClientOriginalName();
                $sales_handover_size = $sales_handover->getSize();

                $contract->move(public_path('project_documents'), $contractName . date('-Y_m_d_His'));
                $po->move(public_path('project_documents'), $poName . date('-Y_m_d_His'));
                $letterOfIntent->move(public_path('project_documents'), $letterOfIntentName . date('-Y_m_d_His'));
                $nda->move(public_path('project_documents'), $ndaName . date('-Y_m_d_His'));
                $sales_handover->move(public_path('project_documents'), $sales_handover_name . date('-Y_m_d_His'));

                $documentable_type = class_basename($project);
                $documentable_id = $project->id;
                $doc_types = DocumentType::all();

                #Contract
                Document::create([
                    'name' => $contractName,
                    'document_type_id' => DocumentType::where('name', 'like', '%Contract%')->first()->id,
                    'size' => $contractSize,
                    'uploaded_by_id' => Auth::user()->id,
                    'url' => "app/public/Docs/".
                        $documentable_type."/".
                        $project->name."/".
                        DocumentType::where('name', 'like', '%Contract%')->first()->name."/".
                        date('Y_m_d_His'). $contractName,
                    'documentable_type' => $documentable_type,
                    'documentable_id' => $documentable_id,
                ]);

                #PO
                Document::create([
                    'name' => $poName,
                    'document_type_id' => DocumentType::where('name', 'like', '%PO%')->pluck('id')->first(),
                    'size' => $poSize,
                    'uploaded_by_id' => Auth::user()->id,
                    'url' => "app/public/Docs/".
                        $documentable_type."/".
                        $project->name."/".
                        DocumentType::where('name', 'like', '%PO%')->first()->name."/".
                        date('Y_m_d_His'). $poName,
                    'documentable_type' => $documentable_type,
                    'documentable_id' => $documentable_id,
                ]);

                Document::create([
                    'name' => $letterOfIntentName,
                    'document_type_id' => DocumentType::where('name', 'like', '%Letter of Intent%')->pluck('id')->first(),
                    'size' => $letterOfIntentSize,
                    'uploaded_by_id' => Auth::user()->id,
                    'url' => "app/public/Docs/".
                        $documentable_type."/".
                        $project->name."/".
                        DocumentType::where('name', 'like', '%Letter of Intent%')->first()->name."/".
                        date('Y_m_d_His').$letterOfIntentName,
                    'documentable_type' => $documentable_type,
                    'documentable_id' => $documentable_id,
                ]);

                Document::create([
                    'name' => $ndaName,
                    'document_type_id' => DocumentType::where('name', 'like', '%NDA%')->pluck('id')->first(),
                    'size' => $ndaSize,
                    'uploaded_by_id' => Auth::user()->id,
                    'url' => "app/public/Docs/".
                        $documentable_type."/".
                        $project->name."/".
                        DocumentType::where('name', 'like', '%NDA%')->first()->name."/".
                        date('Y_m_d_His'). $ndaName,
                    'documentable_type' => $documentable_type,
                    'documentable_id' => $documentable_id,
                ]);

                Document::create([
                    'name' => $sales_handover_name,
                    'document_type_id' => DocumentType::where('name', 'like', '%Sales Handover%')->pluck('id')->first(),
                    'size' => $sales_handover_size,
                    'uploaded_by_id' => Auth::user()->id,
                    'url' => "app/public/Docs/".
                        $documentable_type."/".
                        $project->name."/".
                        DocumentType::where('name', 'like', '%Sales Handover%')->first()->name."/".
                        date('Y_m_d_His') . $sales_handover_name,
                    'documentable_type' => $documentable_type,
                    'documentable_id' => $documentable_id,
                ]);
            }
            return Redirect::route('projects.index')->with('Success', 'Project has been updated successfully!');
        } else {
            return Redirect::back()->with('error', 'Project details have not been updated successfully!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\RedirectResponse
     */


    public function destroy(Project $project)
    {
        if ($project->delete()){

            return Redirect::back()->with('success', 'Project deleted successfully!');

        }
    }

    public function allocate_employees(Request $request, Project $project){
        // dd($request->all());
        $request->validate([
            'employee_ids'=>'required|array',
        ]);
        foreach($request->employee_ids as $employee_id){
            Employee::findOrFail($employee_id)->update(['project_id'=>$project->id]);
        }
        return Redirect::back()->with('success', "Employee added to {$project->name} successfully!");
    }
    public function re_allocate_employee(Employee $employee, Request $request)
    {
        // dd($request->all());
        
        $employee = Employee::findOrFail($request->employee_id);
        $employee->update(['project_id' => $request->new_project_id]);
        return back()->with('success', "Done! {$employee->name} has been re-allocated");
    }
}
