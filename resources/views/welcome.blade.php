@extends('layouts.app')

@section('content')
<div class="glass-card">
    <h1>Certificate Generator</h1>
    <p class="subtitle">Create professional certificates in seconds. No login required.</p>

    <form action="{{ route('certificate.preview') }}" method="POST">
        @csrf
        
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
            <!-- Left Column -->
            <div>
                <div class="form-group">
                    <label>Candidate Name</label>
                    <input type="text" name="candidate_name" placeholder="John Doe" required>
                </div>

                <div class="form-group">
                    <label>Domain / Field</label>
                    <input type="text" name="domain" placeholder="Web Development, Data Science..." required>
                </div>

                <div class="form-group">
                    <label>Certificate Type</label>
                    <select name="type" required>
                        <option value="Internship">Internship Certificate</option>
                        <option value="Experience">Experience Letter</option>
                        <option value="Offer Letter">Offer Letter</option>
                        <option value="Appreciation">Certificate of Appreciation</option>
                        <option value="Completion">Course Completion</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Heading</label>
                    <input type="text" name="heading" placeholder="Certificate of Achievement">
                </div>
            </div>

            <!-- Right Column -->
            <div>
                 <div class="form-group">
                    <label>Layout Style</label>
                    <div class="layout-options">
                        <label class="layout-option">
                            <input type="radio" name="layout_type" value="classic" checked>
                            <div class="layout-card">
                                <div class="layout-preview"><i class="fas fa-landmark"></i></div>
                                <span>Classic</span>
                            </div>
                        </label>
                        <label class="layout-option">
                            <input type="radio" name="layout_type" value="modern">
                            <div class="layout-card">
                                <div class="layout-preview"><i class="fas fa-layer-group"></i></div>
                                <span>Modern</span>
                            </div>
                        </label>
                        <label class="layout-option">
                            <input type="radio" name="layout_type" value="minimal">
                            <div class="layout-card">
                                <div class="layout-preview"><i class="fas fa-feather"></i></div>
                                <span>Minimal</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label>Signatories</label>
                    <select name="signature">
                        <option value="ceo">CEO & Founder</option>
                        <option value="hr">Head of HR</option>
                        <option value="manager">Project Manager</option>
                        <option value="director">Director</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Badges & Logos</label>
                    <div class="logo-options">
                        <label class="logo-option">
                            <input type="checkbox" name="logos[]" value="iso">
                            <i class="fas fa-certificate"></i> ISO Certified
                        </label>
                        <label class="logo-option">
                            <input type="checkbox" name="logos[]" value="msme">
                            <i class="fas fa-industry"></i> MSME
                        </label>
                        <label class="logo-option">
                            <input type="checkbox" name="logos[]" value="startup">
                            <i class="fas fa-rocket"></i> Startup India
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Custom Body Text (Optional)</label>
            <textarea name="content" rows="4" placeholder="This is to certify that [Name] has successfully completed... (Leave blank for default text)"></textarea>
        </div>

        <button type="submit" class="btn-primary">
            <i class="fas fa-magic"></i> Generate Preview
        </button>
    </form>
</div>
@endsection
