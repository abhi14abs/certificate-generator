<div class="certificate-modern">
    <div class="sidebar">
        <div class="sidebar-decoration">
            <!-- Geometric Shapes -->
            <div class="circle"></div>
            <div class="square"></div>
        </div>
        <div class="logos-vertical">
             @if(!empty($data['logos']))
                @if(in_array('iso', $data['logos'])) 
                    <div class="logo-box">
                        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logos/iso.png'))) }}" alt="ISO" class="logo-img">
                    </div> 
                @endif
                @if(in_array('msme', $data['logos'])) 
                    <div class="logo-box">
                        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logos/msme.png'))) }}" alt="MSME" class="logo-img">
                    </div> 
                @endif
                @if(in_array('startup', $data['logos'])) 
                    <div class="logo-box">
                        <img src="{{ 'data:image/png;base64,' . base64_encode(file_get_contents(public_path('images/logos/startup.png'))) }}" alt="Startup" class="logo-img">
                    </div> 
                @endif
            @endif
        </div>
    </div>
    
    <div class="main-content">
        <h1 class="modern-heading">{{ $data['heading'] ?: 'CERTIFICATE' }}</h1>
        <p class="modern-sub">OF EXCELLENCE</p>
        
        <div class="recipient-section">
            <p class="presented-to">PROUDLY PRESENTED TO</p>
            <h2 class="modern-name">{{ $data['candidate_name'] }}</h2>
        </div>

        <div class="modern-body">
             <p>
                @if(!empty($data['content']))
                    {!! nl2br(e($data['content'])) !!}
                @else
                    In recognition of their outstanding performance and completion of the <strong>{{ $data['type'] }}</strong> program in <strong>{{ $data['domain'] }}</strong>.
                @endif
            </p>
        </div>

        <div class="modern-footer">
            <div class="sig-block">
                <p class="sig-name">
                     @if(($data['signature'] ?? '') == 'ceo') John CEO
                    @elseif(($data['signature'] ?? '') == 'hr') Jane HR
                    @elseif(($data['signature'] ?? '') == 'manager') Bob Manager
                    @elseif(($data['signature'] ?? '') == 'director') Alice Director
                    @endif
                </p>
                <p class="sig-title">AUTHORIZED SIGNATORY</p>
            </div>
            
            <div class="date-block">
                <p class="date-text">{{ \Carbon\Carbon::parse($data['issued_at'] ?? now())->format('d/m/Y') }}</p>
                <p class="date-label">DATE OF ISSUE</p>
            </div>
        </div>
    </div>
</div>
