<?php

namespace App\Http\Controllers;

use App\Models\EProcurement;
use App\Models\EProcurementHistory;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EProcurementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('manage eprocurement'))
        {
            // Get source_data_eproc from the logged-in user
            $userSourceDataEproc = Auth::user()->source_data_eproc;
            
            // Filter EProcurements by this source value or get all if source is null
            if ($userSourceDataEproc === null) {
                $eprocurements = [];
            } else {
                $eprocurements = EProcurement::where('source_data_eproc', $userSourceDataEproc)->where('status', '<>', 'approved')->get();
            }

            return view('eprocurement.index', compact('eprocurements'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    
    public function verified()
    {
        if(Auth::user()->can('manage eprocurement'))
        {
            // Get source_data_eproc from the logged-in user
            $userSourceDataEproc = Auth::user()->source_data_eproc;
            
            // Filter EProcurements by this source value or get all if source is null
            if ($userSourceDataEproc === null) {
                $eprocurements = [];
            } else {
                $eprocurements = EProcurement::where('source_data_eproc', $userSourceDataEproc)->where('status', 'approved')->get();
            }
            
            $mode = 'view';

            return view('eprocurement.index', compact('eprocurements', 'mode'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('create eprocurement'))
        {
            $userId = Auth::id();

            $eprocurement = EProcurement::where('created_by', $userId)->first();
            return view('eprocurement.create', compact('eprocurement'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
    
    public function view($id)
    {
        if(Auth::user()->can('manage eprocurement'))
        {
            $eprocurement = EProcurement::findOrFail($id);
            $mode = "view";

            return view('eprocurement.show', compact('eprocurement', 'mode'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->can('create eprocurement')) {
            $currentStep = $request->input('current_step', session('current_step', 1));
            $formAction = $request->input('form_action', 'next');
            
            // Get existing form data
            $oldFormData = session('eprocurement_form_data', []);
            
            // Merge form data (excluding files)
            $formInputs = $request->except(['_token', 'current_step', 'form_action']);
            
            // Remove any file objects to prevent serialization issues
            foreach ($formInputs as $key => $value) {
                if ($value instanceof \Illuminate\Http\UploadedFile) {
                    unset($formInputs[$key]);
                }
            }
            
            $newFormData = array_merge($oldFormData, $formInputs);
    
            // Validate current step before handling file uploads
            if ($formAction != 'previous') {
                $validator = $this->getValidatorForStep($currentStep, $request);
                if ($validator && $validator->fails()) {
                    session(['current_step' => $currentStep]);
                    session(['eprocurement_form_data' => $newFormData]);
                    return redirect()->route('eprocurement.create')
                        ->withErrors($validator)
                        ->withInput();
                }
            }

            $userId = Auth::id();

            $eprocurement = EProcurement::firstOrNew([
                'created_by' => $userId
            ]);

            if ($eprocurement->exists && in_array($eprocurement->status, ['approved', 'rejected'])) {
                return redirect()->back()->with('error', __('Cannot modify this E-Procurement as it has already been ' . ucfirst($eprocurement->status)));
            }

            // Process file uploads only if validation passes
            $uploadedFiles = [];
            foreach ($request->allFiles() as $key => $file) {
                if ($request->file($key)->isValid()) {
                    $uploadedFiles[$key] = $this->storeFile($request, $key);
                }
            }
            
            // Add uploaded files to form data
            $newFormData = array_merge($newFormData, $uploadedFiles);
            session(['eprocurement_form_data' => $newFormData]);

            $eprocurement->fill($newFormData);
            $eprocurement->status = 'draft';
            $eprocurement->source_data_eproc = config('app.url');
            $eprocurement->save();
            // Create History Record
            $this->createEProcurementHistory($eprocurement);
    
            if ($formAction == 'previous') {
                session(['current_step' => max(1, $currentStep - 1)]);
            } elseif ($formAction == 'next') {
                session(['current_step' => min(4, $currentStep + 1)]);
            } elseif ($formAction == 'submit') {
                $eprocurement->status = 'pending';
                $eprocurement->save();
                session()->forget('eprocurement_form_data');
                session()->forget('current_step');
                // Create History Record on Status Change to 'pending'
                $this->createEProcurementHistory($eprocurement, $formAction);

                return redirect()->route('eprocurement.dashboard.view')
                    ->with('success', 'E-Procurement application submitted successfully.');
            }
    
            return redirect()->route('eprocurement.create');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    private function getValidatorForStep(int $step, Request $request)
    {
        switch ($step) {
            case 1:
                return Validator::make($request->all(), [
                    'nama_perusahaan' => 'required',
                    'nomor_sk_menkumham' => 'required',
                    'no_akta' => 'required|numeric',
                    'nomor_nib_oss' => 'required|numeric',
                    'npwp' => 'required|numeric',
                    'izin_operasional' => 'required',
                    'nomor_telpon' => 'required|numeric',
                    'email' => 'required|email',
                    'website' => 'nullable',
                    'sk_menkumham_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                    'akta_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                    'nib_oss_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                    'npwp_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                    'siup_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                ]);
            case 2:
                return Validator::make($request->all(), [
                    'nama_direksi' => 'required',
                    'nama_komisaris' => 'required',
                    'ktp_direksi' => 'required|numeric',
                    'ktp_komisaris' => 'required|numeric',
                    'ktp_direksi_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                    'ktp_komisaris_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                    'npwp_direksi' => 'required|numeric',
                    'npwp_komisaris' => 'required|numeric',
                    'npwp_direksi_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                    'npwp_komisaris_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                    'hp_direksi' => 'required|numeric',
                    'hp_komisaris' => 'required|numeric',
                ]);
            case 3:
                return Validator::make($request->all(), [
                    'nomor_rekening' => 'required|numeric',
                    'nama_bank' => 'required',
                    'cabang_bank' => 'required',
                    'atas_nama' => 'required',
                    'rekening_koran_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                    'neraca_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                ]);
            case 4:
                return Validator::make($request->all(), [
                    'company_profile_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                    'portfolio_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                    'cv_tenaga_ahli_file' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
                ]);
        }
        return null;
    }

    private function createEProcurementHistory(EProcurement $eprocurement)
    {
        $history = EProcurementHistory::firstOrNew(
            [
                'eprocurement_id' => $eprocurement->id,
                'status' => $eprocurement->status,
            ],
            [
                'note' => 'E-Procurement data updated',
            ]
        );

        // If it's a new record, set additional attributes
        if (!$history->exists) {
            $history->note = 'E-Procurement data created';
        } else {
            $history->note = 'E-Procurement data updated';
        }

        $history->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::user()->can('manage eprocurement'))
        {
            $eprocurement = EProcurement::findOrFail($id);
            $eprocurement->status = 'review';
            $eprocurement->save();
            $this->createEProcurementHistory($eprocurement);

            return view('eprocurement.show', compact('eprocurement'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        if(Auth::user()->can('manage eprocurement'))
        {
            if($request->action == 'approved') {
                $eprocurement = EProcurement::findOrFail($id);
                $eprocurement->status = 'approved';
                $eprocurement->save();
        
                $this->createEProcurementHistory($eprocurement);
        
                return redirect()->route('eprocurement.index')->with('success', 'E-Procurement approved successfully.');
            }else if($request->action == 'rejected') {
                $eprocurement = EProcurement::findOrFail($id);
                $eprocurement->status = 'rejected';
                $eprocurement->save();
        
                $this->createEProcurementHistory($eprocurement);
                return redirect()->route('eprocurement.index')->with('success', __('E-Procurement data successfully rejected.'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Auth::user()->can('manage e-procurement'))
        {
            // Update logic - similar to store but for existing record
            return redirect()->route('e-procurement.index')->with('success', __('E-Procurement data successfully updated.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->can('manage e-procurement'))
        {
            // Delete logic
            return redirect()->route('e-procurement.index')->with('success', __('E-Procurement data successfully deleted.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    private function storeFile($request, $key)
    {
        $dir = 'uploads/eprocurement/';
        $timestamp = now()->format('YmdHis');
        $fileName = $timestamp . '_' . $request->{$key}->getClientOriginalName();
        $path = Utility::upload_file($request, $key, $fileName, $dir);
        return $path['url'];
    }

    public function loadFile(Request $request)
    {
        if (!Auth::user()->can('manage eprocurement')) {
            return response()->json(['error' => __('Permission denied.')], 403);
        }

        $path = $request->query('path');
        if (!$path) {
            return response()->json(['error' => 'File path is required'], 400);
        }

        // Ensure the path is within the uploads/eprocurement directory
        if (!str_starts_with($path, 'uploads/eprocurement/')) {
            return response()->json(['error' => 'Invalid file path'], 400);
        }

        $filePath = storage_path($path);
        if (!file_exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        $mimeType = mime_content_type($filePath);
        $fileContent = base64_encode(file_get_contents($filePath));
        return response()->json([
            'type' => $mimeType,
            'content' => $fileContent
        ]);
    }


    public function pdffromcontract($id)
    {
        $id = \Illuminate\Support\Facades\Crypt::decrypt($id);
        $eprocurement = Eprocurement::findOrFail($id);
        $settings = Utility::settings();

        //Set your logo
        $logo         = asset(Storage::url('uploads/logo/'));
        $company_logo = Utility::getValByName('company_logo');
        $img          = asset($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png'));

        if($eprocurement)
        {
            $color      = '#' . $settings['invoice_color'];
            $font_color = Utility::getFontColor($color);

            return view('eprocurement.template-pdf', compact('eprocurement', 'color', 'img', 'settings', 'font_color'));
        }
        else
        {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }
}