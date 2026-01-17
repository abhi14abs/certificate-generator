@extends('layouts.app')

@section('content')
<div class="app-container">
    <!-- Left: Control Panel -->
    <div class="control-panel">
        <a href="{{ route('home') }}" style="color: #64748b; text-decoration: none; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
            <i class="fas fa-arrow-left"></i> Back to Editor
        </a>
        <h1 class="app-title">Preview & Download</h1>

        <div class="glass-card" style="padding: 1.5rem; background: #f8fafc; border: 1px solid #e2e8f0; margin-bottom: 2rem;">
            <h3 style="margin-top: 0; font-size: 1.1rem;">Summary</h3>
            <p style="margin: 0.5rem 0; font-size: 0.9rem;"><strong>Candidate:</strong> {{ $data['candidate_name'] }}</p>
            <p style="margin: 0.5rem 0; font-size: 0.9rem;"><strong>Type:</strong> {{ $data['type'] }}</p>
            <p style="margin: 0.5rem 0; font-size: 0.9rem;"><strong>Layout:</strong> {{ ucfirst($data['layout_type']) }}</p>
        </div>

        <form action="{{ route('certificate.download') }}" method="POST">
            @csrf
            @foreach($data as $key => $value)
                @if(is_array($value))
                     @foreach($value as $item)
                        <input type="hidden" name="{{ $key }}[]" value="{{ $item }}">
                     @endforeach
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach
            
            <button type="submit" class="btn-generate" style="background: var(--primary); display: flex; justify-content: center; align-items: center; gap: 0.5rem;">
                <i class="fas fa-download"></i> Download PDF
            </button>
        </form>
    </div>

    <!-- Right: Preview Canvas -->
    <div class="preview-panel">
        <!-- Scale Wrapper to fit A4 on screen -->
        <div class="scale-wrapper" style="transform: scale(0.65); box-shadow: 0 0 50px rgba(0,0,0,0.1);">
            <div class="certificate-canvas {{ $data['type'] == 'Offer Letter' ? 'portrait' : 'landscape' }} {{ 'layout-'.$data['layout_type'] }}">
                @if($data['layout_type'] == 'classic')
                    @include('partials.layout_classic')
                @elseif($data['layout_type'] == 'modern')
                    @include('partials.layout_modern')
                @else
                    @include('partials.layout_minimal')
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
