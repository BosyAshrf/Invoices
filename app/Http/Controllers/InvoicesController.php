<?php

namespace App\Http\Controllers;

use App\invoices;
use App\invoices_details;
use App\invoice_attachments;
use App\sections;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\AddInvoice;
use App\Exports\InvoicesExport;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = invoices::all();
        return view('invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections = sections::all();
        return view('invoices.add_invoice', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       // ده للفاتوره الام
        invoices::create([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => $request->note,
        ]);
        // ده لتفاصيل الفاتوره
        //(id) هنعمل متغير جديد = هنروح لجدول الفواتيراخر حاجه تمت في جدول الفواتير هاتلى ال 
        $invoice_id = invoices::latest()->first()->id;
        invoices_details::create([
            //  الامid = المتغير الجديد
            'id_Invoice' => $invoice_id,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->section,
            'status' => 'غير مدفوعة',
            'value_status' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name),
        ]);
        // ده للجزء الثالث مرفقات الفاتوره
        if ($request->hasFile('picture')) {
            //(id) هنعمل متغير جديد = هنروح لجدول الفواتيراخر حاجه تمت في جدول الفواتير هاتلى ال 
            $invoice_id = Invoices::latest()->first()->id;
            // هاتلى الاسم الموجود فى الفورم
            $image = $request->file('picture');
            $file_name = $image->getClientOriginalName();
            $invoice_number = $request->invoice_number;
            // متغير جديد = نعمل نسخه جديده من الموديل
            $attachments = new invoice_attachments();
            $attachments->file_name = $file_name;
            $attachments->invoice_number = $invoice_number;
            $attachments->Created_by = Auth::user()->name;
            $attachments->invoice_id = $invoice_id;
            $attachments->save();

            // move picture
            $imageName = $request->picture->getClientOriginalName();
            // الصوره اللى جات من المستخدم (public)انقلها ف ا اعمل فولدر جوا  رقم الفاتوره جواها اسم الصوره
            $request->picture->move(public_path('Attachments/' . $invoice_number), $imageName);
        }

        // ده خاص بجزء الميل وارسال الايميل

        // $user = User::first();
        // Notification::send($user, new AddInoices($invoice_id));
        // $user = User::first();       
        // Notification::send($user, new AddInvoice($invoice_id));

        $user = User::get();

        $invoices = Invoices::latest()->first();

        Notification::send($user, new \App\Notifications\Add_Invoices($invoices));
    
        //$user->notify(new \App\Notifications\Add_Invoices($invoices));

        session()->flash('Add', 'تم اضافة الفاتورة بنجاح');
        return redirect()->route('invoices.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.status_update', compact('invoices'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoices = invoices::where('id', $id)->first();
        $sections = sections::all();
        return view('invoices.edit', compact('invoices', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $invoices = invoices::find($id);
        $invoices->update([
            'invoice_number' => $request->invoice_number,
            'invoice_Date' => $request->invoice_Date,
            'Due_date' => $request->Due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'Amount_collection' => $request->Amount_collection,
            'Amount_Commission' => $request->Amount_Commission,
            'Discount' => $request->Discount,
            'Value_VAT' => $request->Value_VAT,
            'Rate_VAT' => $request->Rate_VAT,
            'Total' => $request->Total,
            'note' => $request->note,
        ]);
        
        session()->flash('Edit', 'تم تعديل الفاتورة بنجاح');
        return redirect()->route('invoices.index');
    }


    public function Status_Update(Request $request, $id)
    {
        $invoices = invoices::find($id);

        if ($request->Status === 'مدفوعة') {
            $invoices->update([
                'Value_Status' => 1,
                'status' => $request->status,
                'Payment_Date' => $request->Payment_Date,

            ]);

            invoices_details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'status' => $request->status,
                'value_status' => 1,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        } else {
            $invoices->update([
                'Value_Status' => 3,
                'status' => $request->status,
                'Payment_Date' => $request->Payment_Date,
            ]);

            invoices_details::create([
                'id_Invoice' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'status' => $request->status,
                'value_status' => 3,
                'note' => $request->note,
                'Payment_Date' => $request->Payment_Date,
                'user' => (Auth::user()->name),
            ]);
        }
        session()->flash('Status_Update');
        return redirect('/invoices');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $invoices = invoices::where('id', $id)->first();
        $attachments = invoice_attachments::where('invoice_id', $id)->first();

        $id_page = $request->id_page;

        if (!$id_page == 2) {

            if (!empty($attachments->invoice_number)) {

                Storage::disk('public_uploads')->deleteDirectory($attachments->invoice_number);
            }

            $invoices->forceDelete();
            session()->flash('delete_invoice');
            return redirect('invoices');
        } else {

            $invoices->delete();
            session()->flash('Archfa_invoices');
        }

        session()->flash('Archfa_invoices_add');
        return redirect('Archive');

    }


    public function getproducts($id)
    {
        $products = DB::table("products")->where("section_id", $id)->pluck("product_name", "id");
        return json_encode($products);
    }

    public function Invoice_Paid()
    {
        $invoices = invoices::where('Value_Status', 1)->get();
        return view('invoices.invoices_paid', compact('invoices'));
    }
    public function Invoice_UnPaid()
    {
        $invoices = invoices::where('Value_Status', 2)->get();
        return view('invoices.invoices_unpaid', compact('invoices'));
    }
    public function Invoice_Partial()
    {
        $invoices = invoices::where('Value_Status', 3)->get();
        return view('invoices.invoices_partial', compact('invoices'));
    }

    public function print_invoice($id)
    {
        $invoices = invoices::where('id', $id)->first();
        return view('invoices.print_invoice', compact('invoices'));
    }

    public function export() 
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }
    
    public function MarkAsRead_all (Request $request)
    {
        $userUnreadNotification= auth()->user()->unreadNotifications;
        
        if($userUnreadNotification) {
            $userUnreadNotification->markAsRead();
            return back();
        }

    }

    
}
