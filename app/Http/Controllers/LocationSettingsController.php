<?php

namespace App\Http\Controllers;

use App\BusinessLocation;
use App\InvoiceLayout;
use App\InvoiceScheme;
use App\Printer;
use App\System;
use Illuminate\Http\Request;

class LocationSettingsController extends Controller
{
    /**
     * All class instance.
     */
    protected $printReceiptOnInvoice;
    protected $receiptPrinterType;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->printReceiptOnInvoice = ['1' => __('messages.yes'), '0' => __('messages.no')];
        $this->receiptPrinterType = ['browser' => __('lang_v1.browser_based_printing'), 'printer' => __('lang_v1.configured_printer')];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($location_id)
    {
        //Check for locations access permission
        if (
            !auth()->user()->can('business_settings.access') ||
            !auth()->user()->can_access_this_location($location_id)
        ) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');

        $location = BusinessLocation::where('business_id', $business_id)
            ->findorfail($location_id);

        $printers = Printer::forDropdown($business_id);

        $printReceiptOnInvoice = $this->printReceiptOnInvoice;
        $receiptPrinterType = $this->receiptPrinterType;

        $invoice_layouts = InvoiceLayout::where('business_id', $business_id)
            ->get()
            ->pluck('name', 'id');
        $invoice_schemes = InvoiceScheme::where('business_id', $business_id)
            ->get()
            ->pluck('name', 'id');

        return view('location_settings.index')
            ->with(compact('location', 'printReceiptOnInvoice', 'receiptPrinterType', 'printers', 'invoice_layouts', 'invoice_schemes'));
    }

    /**
     * Update the settings
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateSettings($location_id, Request $request)
    {
        try {
            //Check for locations access permission
            if (
                !auth()->user()->can('business_settings.access') ||
                !auth()->user()->can_access_this_location($location_id)
            ) {
                abort(403, 'Unauthorized action.');
            }

            $input = $request->only(['print_receipt_on_invoice', 'receipt_printer_type', 'printer_id', 'invoice_layout_id', 'invoice_scheme_id']);

            //Auto set to browser in demo.
            if (config('app.env') == 'demo') {
                $input['receipt_printer_type'] = 'browser';
            }

            $business_id = request()->session()->get('user.business_id');

            $location = BusinessLocation::where('business_id', $business_id)
                ->findorfail($location_id);

            $location->fill($input);
            $location->update();

            $output = [
                'success' => 1,
                'msg' => __('receipt.receipt_settings_updated'),
            ];
        } catch (\Exception $e) {
            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong'),
            ];
        }

        return back()->with('status', $output);
    }

    public function settingSizePaper(Request $request)
    {
        if ($request->ajax()) {
            if ($request->size_paper_value) {
                $size = explode(',', $request->size_paper_value);
                $value = [
                    'panjang' => $size[0],
                    'lebar' => $size[1],
                ];
                $system = System::updateOrCreate(['key' => $request->size_paper], ['value' => json_encode($value)]);
            }
            if ($request->wifi) {
                $system = System::updateOrCreate(['key' => 'wifi'], ['value' => $request->wifi]);
            }

            if ($request->instagram) {
                $system = System::updateOrCreate(['key' => 'instagram'], ['value' => $request->instagram]);
            }

            return [
                'success' => true
            ];
        }
        $system = System::where('key', 'size_paper')->first();
        $data = [];
        if ($system) {
            $data = json_decode($system->value);
        }

        $wifi = System::where('key', 'wifi')->first();
        $instagram = System::where('key', 'instagram')->first();

        return view('location_settings.size_papper', compact('data', 'wifi', 'instagram'));
    }
}
