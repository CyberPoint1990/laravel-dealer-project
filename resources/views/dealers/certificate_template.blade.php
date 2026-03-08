<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page { margin: 0; }
        body { 
            font-family: 'Times New Roman', serif; 
            margin: 0; 
            padding: 0; 
            background-color: #f8f9fa;
        }
        .certificate-container {
            width: 800px;
            height: 580px;
            padding: 30px;
            margin: auto;
            position: relative;
            background: white;
            border: 20px solid #2b3a4a; /* Sidebar Navy Blue */
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
        }
        /* Inner Gold Border */
        .inner-border {
            border: 4px double #d4af37; /* Gold Color */
            height: 100%;
            padding: 30px;
            box-sizing: border-box;
            position: relative;
        }
        .header { 
            font-size: 42px; 
            color: #2b3a4a; 
            font-weight: bold;
            letter-spacing: 2px;
            margin-top: 10px;
            text-transform: uppercase;
        }
        .brand-color { color: #448aff; }
        .sub-header { 
            font-size: 20px; 
            font-style: italic; 
            color: #777;
            margin-top: 15px;
        }
        .dealer-name { 
            font-size: 38px; 
            font-weight: bold; 
            color: #2b3a4a;
            border-bottom: 2px solid #d4af37; 
            display: inline-block; 
            padding: 5px 40px; 
            margin: 15px 0;
            text-transform: capitalize;
        }
        .shop-info { 
            font-size: 22px; 
            color: #333; 
            margin-bottom: 5px;
        }
        .location {
            font-size: 14px;
            color: #666;
            margin-bottom: 20px;
        }
        .content-body { 
            font-size: 18px; 
            line-height: 1.6;
            color: #444;
        }
        .meta-data {
            margin-top: 25px;
            display: table;
            width: 100%;
            font-size: 13px;
        }
        .meta-item { display: table-cell; text-align: left; color: #555; }
        
        .footer { 
            margin-top: 40px; 
            width: 100%;
            position: relative;
        }
        .seal {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: -20px;
            width: 80px;
            height: 80px;
            background: #d4af37;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 10px;
            text-align: center;
            border: 3px dashed white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .signature-box { 
            float: right; 
            text-align: center; 
            width: 200px; 
        }
        .signature-line {
            border-top: 2px solid #2b3a4a;
            margin-bottom: 5px;
            padding-top: 5px;
        }
        .id-badge { 
            float: left; 
            text-align: left;
            padding-top: 25px;
        }
        .validity-tag {
            color: #448aff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="inner-border">
            <div style="color: #d4af37; font-size: 30px;">★ ★ ★ ★ ★</div>
            
            <div class="header">Certificate <span class="brand-color">of</span> Authorization</div>
            <div class="sub-header">This prestigious document is proudly presented to</div>
            
            <div class="dealer-name">{{ $dealer_name }}</div>
            
            <div class="shop-info">Authorized Partner of <strong>KHDC ENTERPRISE</strong></div>
            <div class="location">Representing: <strong>{{ $shop_name }}</strong> | {{ $district }}, {{ $state }}</div>
            
            <div class="content-body">
                This certificate confirms that the above-named partner is officially authorized <br> 
                to distribute, manage, and represent <strong>KHDC ENTERPRISE</strong> products and services. <br>
                This authorization is granted under the compliance of corporate standards.
            </div>

            <div class="meta-data">
                <div class="meta-item"><strong>GSTIN:</strong> {{ $gst_no ?? 'N/A' }}</div>
                <div class="meta-item"><strong>PAN:</strong> {{ $pan_no ?? 'N/A' }}</div>
                <div class="meta-item"><strong>Validity:</strong> <span class="validity-tag">{{ date('d M Y', strtotime($valid_till)) }}</span></div>
            </div>

            <div class="footer">
                <div class="id-badge">
                    <small style="color:#777">Registration No:</small><br>
                    <strong>{{ $dealer_id }}</strong>
                </div>

                <div class="seal">
                    OFFICIAL<br>PARTNER<br>SEAL
                </div>

                <div class="signature-box">
                    <div style="height: 40px;"></div> <div class="signature-line">
                        <strong>Managing Director</strong><br>
                        <small>KHDC ENTERPRISE</small>
                    </div>
                </div>
                
                <div style="clear: both; padding-top: 30px; font-size: 11px; color: #999;">
                    Issued Date: {{ date('d F, Y', strtotime($date)) }} | This is a computer-generated document.
                </div>
            </div>
        </div>
    </div>
</body>
</html>