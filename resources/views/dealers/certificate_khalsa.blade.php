<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { font-family: 'Helvetica', Arial, sans-serif; margin: 0; padding: 0; text-align: center; color: #222; }
        
        /* Gold Border Pattern from image */
        .page-border {
            border: 25px solid transparent;
            border-image: url('https://www.transparenttextures.com/patterns/gold-scale.png') 30 round; /* Alternative pattern */
            border-color: #d4af37; 
            padding: 40px;
            height: 100vh;
            box-sizing: border-box;
            position: relative;
        }

        .header-meta { display: flex; justify-content: space-between; font-size: 12px; font-weight: bold; margin-bottom: 20px; }
        
        .logo-section img { width: 120px; margin-bottom: 5px; }
        .brand-name { font-size: 45px; font-weight: 900; color: #2b3a4a; margin-top: -10px; }

        .certify-text { font-size: 35px; font-weight: bold; margin: 20px 0; }

        .dynamic-info { font-size: 18px; line-height: 1.8; color: #444; }
        .dealer-name { font-size: 26px; font-weight: bold; color: #1a3a5a; text-transform: uppercase; border-bottom: 1px dotted #888; display: inline-block; width: 80%; }
        .details-line { border-bottom: 1px dotted #888; display: inline-block; width: 90%; margin: 5px 0; }

        .highlight-box { font-size: 28px; font-weight: bold; margin: 30px 0; }
        .period-text { font-size: 22px; font-weight: bold; color: #1a3a5a; }

        .footer { margin-top: 50px; text-align: left; padding: 0 40px; position: relative; }
        .company-address { font-size: 20px; font-weight: bold; line-height: 1.2; }
        
        .signature-section { position: absolute; right: 40px; bottom: 0; text-align: center; }
        .qr-code { position: absolute; right: 180px; bottom: -10px; }
    </style>
</head>
<body>
    <div class="page-border">
        <div style="text-align: left; font-size: 12px;"><strong>Certificate No.-</strong> {{ $dealer->dealer_id_custom }}</div>
        <div style="text-align: right; font-size: 12px; margin-top: -15px;"><strong>Certificate Date.-</strong> {{ date('d/m/Y') }}</div>

        <div class="logo-section" style="margin-top: 20px;">
            <div style="font-size: 60px; color: #1a3a5a;">⚙️</div> 
            <div class="brand-name">Khalsa</div>
        </div>

        <div class="certify-text">This is to certify that</div>

        <div class="dynamic-info">
            <div class="dealer-name">{{ $dealer->name }}</div><br>
            <div class="details-line">{{ $dealer->shop_name }}, {{ $dealer->address }}</div><br>
            <div class="details-line">DISTRICT - {{ $dealer->district }}, {{ $dealer->state }}, {{ $dealer->pincode }}</div><br>
            <div style="font-weight: bold; margin-top: 10px;">
                GST No. {{ $dealer->gst_no ?? 'N/A' }}, PAN No. {{ $dealer->pan_no ?? 'N/A' }}
            </div>
        </div>

        <div class="highlight-box">
            Is our Authorised Dealer for<br>
            <span style="font-size: 35px;">All</span><br>
            Farm Implements in {{ strtoupper($dealer->state) }}
        </div>

        <div class="period-text">
            For the period from {{ date('F d/Y', strtotime($dealer->valid_from)) }} to<br>
            {{ date('F d/Y', strtotime($dealer->valid_till)) }}
        </div>

        <div class="footer">
            <div class="company-address">
                Punjab Engineers<br>
                Baghpat Road,<br>
                Meerut (U.P.)
            </div>

            <div class="qr-code">
                <img src="data:image/svg+xml;base64, {{ $qrcode }}" width="80">
                <div style="font-size: 8px;">Scan to Verify</div>
            </div>

            <div class="signature-section">
                <img src="path_to_signature.png" width="120"><br>
                <strong style="font-size: 20px;">Director</strong>
            </div>
        </div>
    </div>
</body>
</html>