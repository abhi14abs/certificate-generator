<div class="certificate-minimal">
    <div class="minimal-header">
        <div class="minimal-logos">
             @if(!empty($data['logos']))
                @foreach($data['logos'] as $logo)
                    <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logos/' . $logo . '.png'))) }}" class="mini-logo-img" alt="{{ $logo }}">
                @endforeach
            @endif
        </div>
        <p class="sc-id">ID: {{ $data['unique_id'] ?? 'PREVIEW' }}</p>
    </div>

    <div class="minimal-body">
        <h1 class="min-title">{{ $data['heading'] ?: 'Certificate.' }}</h1>
        
        <div class="min-content-block">
            <p>This certifies that <strong>{{ $data['candidate_name'] }}</strong></p>
            <p>has achieved the qualification of</p>
            <p class="min-course">{{ $data['type'] }}</p>
            <p>in the field of {{ $data['domain'] }}.</p>
            
            <p class="custom-note">
                 @if(!empty($data['content']))
                    {!! nl2br(e($data['content'])) !!}
                @endif
            </p>
        </div>
    </div>

    <div class="minimal-footer">
        <div class="min-sig">
            <p class="sig-img">
                 @if(($data['signature'] ?? '') == 'ceo') J. Doe
                @elseif(($data['signature'] ?? '') == 'hr') J. Smith
                @else A. Signature
                @endif
            </p>
            <span>Signatory</span>
        </div>
        <div class="min-date">
            <p>{{ \Carbon\Carbon::parse($data['issued_at'] ?? now())->format('F Y') }}</p>
            <span>Date</span>
        </div>
    </div>
</div>
