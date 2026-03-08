<?php

namespace App\Http\Controllers;

use App\Models\Dealer;
use Illuminate\Http\Request;
use Exception;
use App\Exports\DealersExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DealerController extends Controller
{
    /**
     * Display a listing of the dealers with Advanced Search & Actions.
     */
    public function index(Request $request)
    {
        $query = Dealer::latest();

        // Enhanced Search Logic
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('shop_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%")
                  ->orWhere('gst_no', 'LIKE', "%{$search}%")
                  ->orWhere('dealer_id_custom', 'LIKE', "%{$search}%");
            });
        }

        // Export Logic
        if ($request->has('export')) {
            try {
                return Excel::download(new DealersExport, 'dealers_report_' . now()->format('Y-m-d') . '.xlsx');
            } catch (Exception $e) {
                return back()->with('error', 'Export failed: ' . $e->getMessage());
            }
        }

        // Print Logic
        if ($request->has('print')) {
            $dealers_all = $query->get();
            return view('dealers.print', compact('dealers_all'));
        }

        $dealers = $query->paginate(15)->withQueryString(); 
        
        return view('dealers.index', compact('dealers'));
    }

    public function create()
    {
        return view('dealers.create'); 
    }

    /**
     * Store new dealer with additional fields.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'shop_name'   => 'required|string|max:255',
            'email'       => 'required|email|unique:dealers,email',
            'phone'       => 'required',
            'address'     => 'required|string',
            'district'    => 'required|string',
            'state'       => 'required|string',
            'pincode'     => 'required|numeric|digits:6',
            'gst_no'      => 'nullable|string|max:15',
            'pan_no'      => 'nullable|string|max:10',
            'valid_from'  => 'required|date',
            'valid_till'  => 'required|date|after_or_equal:valid_from',
        ]);

        try {
            Dealer::create($request->all());
            return redirect()->route('dealers.index')->with('success', 'New Dealer registered successfully!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    public function edit(Dealer $dealer)
    {
        return view('dealers.edit', compact('dealer'));
    }

    /**
     * Update dealer with additional fields.
     */
    public function update(Request $request, Dealer $dealer)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'shop_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:dealers,email,' . $dealer->id, 
            'phone'      => 'required',
            'address'    => 'required',
            'district'   => 'required',
            'state'      => 'required',
            'pincode'    => 'required|digits:6',
            'gst_no'     => 'nullable|string',
            'pan_no'     => 'nullable|string',
            'valid_from' => 'required|date',
            'valid_till' => 'required|date',
            'status'     => 'required|in:active,inactive'
        ]);

        try {
            $dealer->update($request->all());
            return redirect()->route('dealers.index')->with('success', 'Dealer record updated successfully!');
        } catch (Exception $e) {
            return back()->withInput()->with('error', 'Update failed: ' . $e->getMessage());
        }
    }

    public function destroy(Dealer $dealer)
    {
        try {
            $dealer->delete();
            return redirect()->route('dealers.index')->with('success', 'Dealer deleted from system.');
        } catch (Exception $e) {
            return redirect()->route('dealers.index')->with('error', 'Operation failed.');
        }
    }

    /**
     * Certificate Generation with QR Code.
     */
public function generateCertificate($id)
{
    ini_set('memory_limit', '512M'); // Memory limit ko 512MB tak badhayein
    set_time_limit(300);             // Execution time ko bhi 5 minute kar dein
    
    $dealer = Dealer::findOrFail($id);

    // 1. QR Code ko PNG format mein base64 generate karein (PDF compatibility ke liye)
    $qrcode = base64_encode(QrCode::size(85)
    ->errorCorrection('H')
    ->generate(route('dealer.verify', $dealer->dealer_id_custom)));

    // 2. Local Image (image_2.png) ko Base64 mein convert karein
    $imagePath = public_path('images/certificate.png');
    $imageData = "";
    
    if (file_exists($imagePath)) {
        $type = pathinfo($imagePath, PATHINFO_EXTENSION);
        $data = file_get_contents($imagePath);
        $imageData = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }

    $data = [
        'dealer'    => $dealer,
        'qrcode'    => $qrcode,
        'logo_base64' => $imageData, // Isse view mein use karein
        'issueDate' => now()->format('d/m/Y'),
    ];

    // LIVE CHECK: Development ke waqt niche wali line uncomment rakhein
    // return view('dealers.certificate_final', $data); 

    // FINAL PDF: Jab design ok ho jaye toh ise chalayein
    $pdf = Pdf::loadView('dealers.certificate_final', $data)
              ->setPaper('a4', 'portrait')
              ->setOptions([
                  'isHtml5ParserEnabled' => true,
                  'isRemoteEnabled' => true // External images ke liye zaroori hai
              ]);

    return $pdf->stream('Certificate_'.$dealer->dealer_id_custom.'.pdf');
}
    /**
     * Public Verification (This matches the QR link)
     */
    public function verify($custom_id)
{
    // Custom ID se dealer dhoondhein
    $dealer = Dealer::where('dealer_id_custom', $custom_id)->firstOrFail();
    return view('dealers.verify_public', compact('dealer'));
}

    /**
     * Admin Side Quick Status Toggle (Optional)
     */
    public function toggleStatus($id)
    {
        $dealer = Dealer::findOrFail($id);
        $dealer->status = ($dealer->status == 'active') ? 'inactive' : 'active';
        $dealer->save();

        return back()->with('success', 'Dealer status updated successfully!');
    }
    
    public function show($id)
{
    $dealer = Dealer::findOrFail($id);
    return view('dealers.show', compact('dealer'));
}
}