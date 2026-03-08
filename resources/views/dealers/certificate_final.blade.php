<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0px; }
        body {
            margin: 0px;
            padding: 0px;
            font-family: 'Helvetica', Arial, sans-serif;
            width: 210mm;
            height: 297mm;
        }

        .container { 
            position: relative; 
            width: 210mm; 
            height: 297mm; 
        }

        /* Background image fix using Base64 */
        .bg-image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .field { position: absolute; font-weight: bold; color: #1a3a5a; }

        /* Coordinates adjustment based on your template */
        .cert-no { top: 36px; left: 60px; font-size: 14px; }
        .cert-date { top: 35px; left: 550px; font-size: 14px; }

        .dealer-name { top: 440px; left: 118px; font-size: 20px; width: 550px; text-transform: uppercase; }
        .shop-name { top: 482px; left: 115px; font-size: 20px; width: 550px; color: #333; }
        .district-info { top: 525px; left: 115px ; font-size: 20px; color: #333; }

        .gst-no { top: 565px; left: 85; font-size: 20px; color: #333;}
        .pan-no { top: 565px; left: 440px;font-size: 20px; color: #333;}

        .state-val {text-align:center; top: 625px; left: 118px; font-size: 28px; font-weight: 900; color: #1a3a5a; text-transform: uppercase; }

        .date-from { top: 750px; left: 110px; font-size: 22px; text-align:center;}
        .date-to { top: 775px; left: 450px; font-size: 16px; }

        .qr-code { top: 940px; left: 400px; }
        .signature { position: absolute; top: 820px; left: 680px; width: 130px; }
    </style>
</head>
<body>
    <div class="container">
        {{-- Background Image Fix: Direct embedding --}}
        @php
            $path = public_path('images/certificate.png');
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        @endphp
        <img src="{{ $base64 }}" class="bg-image">

        {{-- Dynamic Data --}}
        <div class="field cert-no">Certificate No - {{ $dealer->dealer_id_custom }}</div>
        <div class="field cert-date">Certificate Date.- {{ $issueDate }}</div>

        <div class="field dealer-name">M/S {{ $dealer->name }}</div>
        <div class="field shop-name">{{ $dealer->shop_name }}, {{ $dealer->address }}</div>
        <div class="field district-info">District - {{ $dealer->district }}, {{ $dealer->state }} - {{ $dealer->pincode }}</div>

        <div class="field gst-no">GST No. - {{ $dealer->gst_no ?? 'N/A' }}</div>
        <div class="field pan-no">PAN - {{ $dealer->pan_no ?? 'N/A' }}</div>

        <div class="field state-val">Is our Authorised Dealer for<br> All <br>Farm Implements in {{ $dealer->state }}</div>

        <div class="field date-from">For the period from {{ date('F d, Y', strtotime($dealer->valid_from)) }} to {{ date('F d, Y', strtotime($dealer->valid_till)) }}</div>
        <!-- <div class="field date-to">to {{ date('F d, Y', strtotime($dealer->valid_till)) }}</div> -->

        <div class="field qr-code">
            <img src="data:image/svg+xml;base64, {{ $qrcode }}" width="85">
        </div>
    </div>
</body>
</html>