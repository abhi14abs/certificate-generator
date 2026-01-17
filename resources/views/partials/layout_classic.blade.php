<div class="certificate-classic">
    <div class="classic-border"></div>
    <div class="classic-content">
        <!-- Header -->
        <div class="header">
            @if(!empty($data['logos']))
                <div class="logos">
                    @if(in_array('iso', $data['logos'])) 
                        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logos/iso.png'))) }}" class="classic-logo" alt="ISO">
                    @endif
                    @if(in_array('msme', $data['logos'])) 
                        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logos/msme.png'))) }}" class="classic-logo" alt="MSME">
                    @endif
                    @if(in_array('startup', $data['logos'])) 
                        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logos/startup.png'))) }}" class="classic-logo" alt="Startup">
                    @endif
                </div>
            @endif
            <h1>{{ $data['heading'] ?: 'Certificate of Achievement' }}</h1>
            <p class="sub-heading">This is to certify that</p>
        </div>

        <!-- Body -->
        <div class="body">
            <h2 class="candidate-name">{{ $data['candidate_name'] }}</h2>
            <p class="description">
                @if(!empty($data['content']))
                    {!! nl2br(e($data['content'])) !!}
                @else
                    For successfully completing the <strong>{{ $data['type'] }}</strong> in the field of <strong>{{ $data['domain'] }}</strong>.
                @endif
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="date-section">
                <p class="date">{{ \Carbon\Carbon::parse($data['issued_at'] ?? now())->format('F j, Y') }}</p>
                <div class="line"></div>
                <p class="label">Date</p>
            </div>
            
            <div class="signature-section">
                <p class="signature-font">
                    @if(($data['signature'] ?? '') == 'ceo') John CEO
                    @elseif(($data['signature'] ?? '') == 'hr') Jane HR
                    @elseif(($data['signature'] ?? '') == 'manager') Bob Manager
                    @elseif(($data['signature'] ?? '') == 'director') Alice Director
                    @endif
                </p>
                <div class="line"></div>
                <p class="label">Authorized Signature</p>
            </div>
        </div>
    </div>
</div>
