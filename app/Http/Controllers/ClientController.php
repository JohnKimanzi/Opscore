<?php

namespace App\Http\Controllers;

use App\Models\BillingFrequency;
use App\Models\BillingType;
use App\Models\Client;
use App\Models\ContactPerson;
use App\Models\Currency;
use App\Models\DeliveryType;
use App\Models\Industry;
use App\Models\Project;
use App\Models\ProjectType;
use App\Models\ServiceType;
use App\Models\Status;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->hasAnyRole(['Operations Manager','Administration Assistant','Admin','BPO Director','Head of Operations','Operations Manager','Assistant Operations Manager','Business Development Executive','Administration Executive','Business Development Manager', 'Human Resource Manager', 'Human Resource Executive'])) {
            return view('clients.index', ['clients' => Client::all(),'statuses' =>$statuses=Status::all()]);
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        if ($request) {

        //try {

        $request->validate([
            'name'=>'required|string',
            'country_id'=>'required|numeric|min:1',
            'industry_id'=>'required|string',
            'physical_address'=>'required|string',
            'phone1'=>'required|string',
            'phone2'=>'nullable|string',
            'description'=>'nullable|string',
            'contract_start'=>'date|before:contract_expiry',
            'contract_expiry'=>'date|after:contract_start',
            'cp_phone1'=>'required|string',
            'cp_phone2'=>'nullable|string',
            'cp_email'=>'required|string',
            'cp_first_name'=>'required|string',
            'cp_last_name'=>'required|string',
            'cp_designation'=>'required|string',
        ]);

        // $industry=Industry::firstOrCreate([
        // 'name'=>$request->industry_name,
        // ]);

        // dd('input validated');
      }

      else{

        return redirect()->back();

      }
        //catch (\Throwable $th) {
        //throw $th;





    $client=Client::create([
        'name'=>$request->name,
        'country_id'=>$request->country_id,
        'industry_id'=>$request->industry_id,
        'physical_address'=>$request->physical_address,
        'phone1'=>$request->phone1,
        'phone2'=>$request->phone2,
        'status_id'=>Status::where('name', 'like', '%Active%')->pluck('id')->first(),
        'description'=>$request->description,
        'contract_start'=>Carbon::Create($request->contract_start),
        'contract_expiry'=>Carbon::Create($request->contract_expiry),
    ]);

    ContactPerson::create([
        'client_id'=>$client->id,
        'first_name'=>$request->cp_first_name,
        'last_name'=>$request->cp_last_name,
        'email'=>$request->cp_email,
        'physical_address'=>$request->physical_address,
        'phone1'=>$request->cp_phone1,
        'phone2'=>$request->cp_phone2,
        'designation'=>$request->cp_designation,
        'description'=>'primary',
    ]);

    return Redirect::back()->with('success', 'Client details have been saved');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        if(Auth::user()->hasAnyRole('Operations Manager|Administration Assistant|Admin|BPO Director|Head of Operations|Operations Manager|Assistant Operations Manager|Business Development Executive|Administration Executive|Business Development Manager')){
            return view('clients.show', ['client'=>$client]);

        }

        return abort(403, 'Unauthorized');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Client $client, Project $project)
    {
        if (Auth::user()->hasAnyRole('Operations Manager|Administration Assistant|Admin|BPO Director|Head of Operations|Operations Manager|Assistant Operations Manager|Business Development Executive|Administration Executive|Business Development Manager')) {
            $services = ServiceType::all();
            $projects = Project::all();
            $clients = Client::all();
            $project_types = ProjectType::all();
            $currencies = Currency::all();
            $industries = Industry::all();
            $billing_types = BillingType::all();
            $billing_frequencies = BillingFrequency::all();
            $delivery_types = DeliveryType::all();
            $statuses = Status::all();
        // dd($project);

            return view('clients.edit', ['editable_client' => $client])
                ->with('service_types', $services)
                ->with('project_types', $project_types)
                ->with('projects', $projects)
                ->with('project', $project)
                ->with('currencies', $currencies)
                ->with('billing_types', $billing_types)
                ->with('billing_frequencies', $billing_frequencies)
                ->with('delivery_types', $delivery_types)
                ->with('statuses', $statuses)
                ->with('clients', $clients)
                ->with('industries', $industries);
        }

        return abort(403, 'Unauthorized');


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        // dd($request->all());
        try {
            //code...
            $request->validate([
            'name'=>'required|string',
            'country_id'=>'required|numeric|min:1',
            'industry_id'=>'required|string',
            'physical_address'=>'required|string',
            'phone1'=>'required|string',
            'phone2'=>'nullable|string',

            'contract_start'=>'', #requireddate|before:contract_expiry
            'contract_expiry'=>'', #required|date|after:contract_start
            'status_id'=>'required|string',


            'cp_phone1'=>'nullable|string',
            'cp_phone2'=>'nullable|string',
            'cp_email'=>'nullable|string',
            'cp_first_name'=>'nullable|string',
            'cp_last_name'=>'nullable|string',
            'cp_designation'=>'nullable|string',
        ]);
        } catch (\Throwable $th) {
            dd ($th);
        }

        // $industry=Industry::firstOrCreate([
        //     'name'=>$request->industry_name,
        // ]);
        $client->update([
            'name'=>$request->name,
            'country_id'=>$request->country_id,
            'industry_id'=>$request->industry_id,
            'physical_address'=>$request->physical_address,
            'phone1'=>$request->phone1,
            'phone2'=>$request->phone2,
            'email'=>$request->email,
            'status_id'=>$request->status_id,
            'contract_start'=>Carbon::Create($request->contract_start),
            'contract_expiry'=>Carbon::Create($request->contract_expiry),
        ]);

        if($request->cp_first_name<>null &&
            $request->cp_last_name<>null &&
            $request->cp_designation<>null &&
            $request->cp_phone1<>null &&
            $request->cp_email<>null)
        {
            ContactPerson::create([
                'client_id'=>$client->id,
                'first_name'=>$request->cp_first_name,
                'last_name'=>$request->cp_last_name,
                'email'=>$request->cp_email,
                'physical_address'=>$request->physical_address,
                'phone1'=>$request->cp_phone1,
                'phone2'=>$request->cp_phone2,
                'designation'=>$request->cp_designation,
                'description'=>'secondary',
            ]);
            Session::flash('success', "Contact person has been added");
        }
        return redirect()->route('clients.index')->with('Success', 'Succcess! Client details have been updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return Redirect::back()->with('success', 'Client has been deleted successfully');
    }


}
