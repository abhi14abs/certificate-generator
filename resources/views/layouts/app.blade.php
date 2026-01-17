<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificate Generator</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&family=Playfair+Display:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <style>
        :root {
            --primary: #4f46e5;
            --secondary: #ec4899;
            --dark: #1e1b4b;
            --light: #f8fafc;
            --glass-bg: rgba(255, 255, 255, 0.9); /* Increased opacity for better visibility */
            --glass-border: rgba(255, 255, 255, 0.5);
            
            /* Layout Colors */
            --gold: #d4af37;
            --modern-accent: #0ea5e9;
            --minimal-text: #334155;
        }

        body {
            font-family: 'Outfit', sans-serif;
            color: var(--dark);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #e0c3fc 0%, #8ec5fc 100%);
            overflow-x: hidden;
        }

        .app-container {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        
        /* Background Animation */
        .app-background::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.4) 0%, transparent 60%);
            animation: rotate 20s linear infinite;
            z-index: -1;
        }
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2.5rem;
            box-shadow: 0 8px 32px rgba(31, 38, 135, 0.15);
        }

        h1 {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
            text-align: center;
        }
        
        .subtitle {
            text-align: center;
            color: #4b5563;
            margin-bottom: 2rem;
            font-size: 1.1rem;
        }

        .control-panel {
            width: 400px;
            background: white;
            padding: 2rem;
            overflow-y: auto;
            border-right: 1px solid #e2e8f0;
            box-shadow: 4px 0 24px rgba(0,0,0,0.05);
            z-index: 10;
        }

        .preview-panel {
            flex: 1;
            background: #cbd5e1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            position: relative;
            background-image: radial-gradient(#94a3b8 1px, transparent 1px);
            background-size: 20px 20px;
        }

        h1.app-title {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            color: var(--dark);
            font-weight: 800;
            letter-spacing: -0.5px;
            /* Reset specific styling for dashboard title */
            background: none;
            -webkit-text-fill-color: var(--dark);
            text-align: left;
        }

        .form-group { margin-bottom: 1.25rem; }
        label { font-size: 0.875rem; color: #64748b; font-weight: 600; margin-bottom: 0.5rem; display: block; }
        
        input[type="text"], input[type="email"], select, textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.95rem;
            background: rgba(255,255,255,0.9);
            transition: all 0.3s ease;
            box-sizing: border-box; /* Fix width issues */
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        /* Layout Options Radio Replacement */
        .layout-options {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        .layout-option { position: relative; }
        .layout-option input { opacity: 0; position: absolute; width: 0; height: 0; }
        .layout-card {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.8rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
        }
        .layout-card i { font-size: 1.5rem; color: #94a3b8; transition: color 0.3s; }
        .layout-option input:checked + .layout-card {
            border-color: var(--primary);
            background: #eef2ff;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.2);
        }
        .layout-option input:checked + .layout-card i, 
        .layout-option input:checked + .layout-card span {
            color: var(--primary);
            font-weight: 600;
        }

        /* Logo Options */
        .logo-options { display: flex; flex-direction: column; gap: 0.5rem; }
        .logo-option {
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            transition: all 0.2s;
            background: white;
        }
        .logo-option:hover { background: #f8fafc; }
        .logo-option input { width: auto; margin: 0; }
        .logo-option:has(input:checked) {
            background: #f0fdf4;
            border-color: #22c55e;
            color: #15803d;
        }

        .btn-primary, .btn-generate {
            width: 100%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 1rem;
        }
        .btn-primary:hover, .btn-generate:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(79, 70, 229, 0.4);
        }
        
        .btn-download {
            position: absolute;
            top: 2rem;
            right: 2rem;
            background: white;
            color: var(--primary);
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-decoration: none;
            font-weight: 700;
            z-index: 20;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }
        .btn-download:hover { background: var(--primary); color: white; }

        /* A4 Canvas */
        .certificate-canvas {
            width: 297mm; /* A4 Landscape */
            height: 210mm;
            background: white;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
            position: relative;
            overflow: hidden;
            transform-origin: center center;
            transition: all 0.3s ease;
        }
        .certificate-canvas.portrait {
            width: 210mm;
            height: 297mm;
        }
        
        /* Layout Specific: Classic */
        .certificate-classic { width: 100%; height: 100%; padding: 15mm; box-sizing: border-box; font-family: 'Playfair Display', serif; display: flex; justify-content: center; align-items: center; position: relative;}
        .classic-border { position: absolute; top: 10mm; left: 10mm; right: 10mm; bottom: 10mm; border: 2px solid var(--gold); outline: 10px solid double var(--gold); pointer-events: none; }
        .classic-content { width: 100%; text-align: center; z-index: 1;}
        .classic-content h1 { font-size: 3.5rem; color: var(--dark); margin: 0; background: none; -webkit-text-fill-color: initial; }
        .classic-logo { height: 80px; margin: 0 10px; width: auto; object-fit: contain; }
        
        /* Layout Specific: Modern */
        .certificate-modern { width: 100%; height: 100%; display: flex; font-family: 'Outfit', sans-serif; }
        /* Fix Sidebar Width to 30% for better presence */
        .certificate-modern .sidebar { width: 30%; background: var(--dark); color: white; display: flex; flex-direction: column; align-items: center; justify-content: center; position: relative; overflow: hidden; }
        .certificate-modern .main-content { flex: 1; padding: 3rem; display: flex; flex-direction: column; justify-content: center; }
        .logo-box { margin: 20px 0; background: rgba(255,255,255,0.1); padding: 15px; border-radius: 12px; }
        .logo-img { width: 80px; height: 80px; object-fit: contain; filter: brightness(0) invert(1); /* Make logos white for dark sidebar */ }
        
        /* Layout Specific: Minimal */
        .certificate-minimal { width: 100%; height: 100%; padding: 3rem; border: 20px solid #f1f5f9; display: flex; flex-direction: column; justify-content: space-between; font-family: 'Outfit', sans-serif; }
        .minimal-logos { display: flex; gap: 15px; }
        .mini-logo-img { height: 50px; width: auto; }

        @media print {
            .control-panel, .btn-download, .preview-panel { display: none; }
            .certificate-canvas { margin: 0; box-shadow: none; page-break-inside: avoid; }
        }
    </style>
</head>
<body class="antialiased">
    <div class="app-background"></div>
    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
