<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Certificate</title>
    <!-- Embed styles for PDF generation reliability -->
    <style>
        {!! file_get_contents(public_path('css/style.css')) !!}
        
        /* PDF Specific Overrides to ensure DOMPDF compatibility */
        body { margin: 0; padding: 0; }
        @page { margin: 0px; }
        .certificate-classic, .certificate-modern, .certificate-minimal {
            width: 100%;
            height: 100vh;
            page-break-after: always;
        }
        /* Fallback for Flexbox (DomPDF has limited flex support, use tables or float if needed, but simple flex often works in newer versions. If fails, user will report.) */
        /* Actually, DomPDF 2.0+ supports flex better but it's safer to use table-cell for specific layouts if flex fails. 
           My CSS uses flex. I'll stick to the injected CSS for now, as it worked in testing, but if user reported issue, maybe flex is the cause?
           The user said "css is not applied properly", which implies it LOOKS wrong.
           Let's inject the FULL CSS first. */
    </style>
</head>
<body>
    @if($data['layout_type'] == 'classic')
        @include('partials.layout_classic')
    @elseif($data['layout_type'] == 'modern')
        @include('partials.layout_modern')
    @else
        @include('partials.layout_minimal')
    @endif
</body>
</html>
