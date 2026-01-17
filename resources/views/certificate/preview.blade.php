@extends('layouts.app')

@section('content')
<div class="glass-card" style="text-align: center; margin-bottom: 2rem;">
    <h1>Preview Your Certificate</h1>
    <div style="display: flex; justify-content: center; gap: 1rem; margin-top: 1rem;">
        <a href="javascript:history.back()" class="btn-primary" style="background: #94a3b8; width: auto; font-size: 1rem; padding: 0.8rem 2rem;">
            <i class="fas fa-edit"></i> Edit Details
        </a>
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
            <button type="submit" class="btn-primary" style="width: auto; font-size: 1rem; padding: 0.8rem 2rem;">
                <i class="fas fa-download"></i> Save & Download PDF
            </button>
        </form>
    </div>
</div>

<div class="certificate-preview-container {{ $data['layout_type'] }}">
    <!-- Certificate Content Wrapper -->
    <div style="border: 10px double #4b5563; padding: 40px; height: 600px; position: relative; background: #fffbe6; color: #1f2937; text-align: center; display: flex; flex-direction: column; justify-content: space-between;">
        
        <!-- Header -->
        <div>
            <!-- Logos -->
            @if(!empty($data['logos']))
            <div style="display: flex; justify-content: center; gap: 20px; margin-bottom: 20px;">
                @if(in_array('iso', $data['logos'])) <div style="font-size: 40px; color: #d97706;"><i class="fas fa-certificate"></i></div> @endif
                @if(in_array('msme', $data['logos'])) <div style="font-size: 40px; color: #2563eb;"><i class="fas fa-industry"></i></div> @endif
                @if(in_array('startup', $data['logos'])) <div style="font-size: 40px; color: #dc2626;"><i class="fas fa-rocket"></i></div> @endif
            </div>
            @endif

            <h2 style="font-family: 'Playfair Display', serif; font-size: 3rem; margin: 0; color: #b45309;">{{ $data['heading'] ?: 'Certificate of Achievement' }}</h2>
            <p style="font-size: 1.2rem; margin-top: 10px; color: #4b5563;">This certificate is proudly presented to</p>
        </div>

        <!-- Main Body -->
        <div>
            <h1 style="font-family: 'Great Vibes', cursive, 'Playfair Display', serif; font-size: 4rem; margin: 10px 0; color: #1e3a8a; border-bottom: 2px solid #e5e7eb; display: inline-block; padding-bottom: 10px; min-width: 400px;">
                {{ $data['candidate_name'] }}
            </h1>
            
            <p style="font-size: 1.2rem; margin: 20px auto; max-width: 600px; line-height: 1.6;">
                @if(!empty($data['content']))
                    {{ $data['content'] }}
                @else
                    For successfully completing the <b>{{ $data['type'] }}</b> in result-driven <b>{{ $data['domain'] }}</b>. 
                    We appreciate your dedication and hard work.
                @endif
            </p>
        </div>

        <!-- Footer -->
        <div style="display: flex; justify-content: space-around; align-items: flex-end; margin-top: 40px;">
            <div style="text-align: center;">
                <div style="font-family: 'Qwitcher Grypen', cursive, serif; font-size: 2rem; color: #1f2937;">{{ date('d M, Y') }}</div>
                <div style="border-top: 2px solid #9ca3af; width: 150px; margin: 5px auto 0;">Date</div>
            </div>

            <div style="text-align: center;">
                <!-- Signature Placeholder -->
                <div style="font-family: 'Great Vibes', cursive, serif; font-size: 2.5rem; color: #1f2937;">
                    @if($data['signature'] == 'ceo') John CEO @endif
                    @if($data['signature'] == 'hr') Jane HR @endif
                    @if($data['signature'] == 'manager') Bob Manager @endif
                    @if($data['signature'] == 'director') Alice Director @endif
                </div>
                <div style="border-top: 2px solid #9ca3af; width: 150px; margin: 5px auto 0;">Authorized Signature</div>
            </div>
        </div>
    </div>
</div>
@endsection
