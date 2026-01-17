<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function preview(Request $request)
    {
        $data = $request->validate([
            'candidate_name' => 'required|string|max:191',
            'domain' => 'required|string|max:191',
            'type' => 'required|string',
            'layout_type' => 'required|string',
            'heading' => 'nullable|string',
            'content' => 'nullable|string',
            'logos' => 'nullable|array',
            'signature' => 'nullable|string',
        ]);

        // Smart Content Logic
        if (empty($data['content'])) {
            $data['content'] = $this->generateContent($data);
        }

        return view('certificate.preview_v2', compact('data'));
    }

    public function download(Request $request)
    {
        $data = $request->validate([
            'candidate_name' => 'required|string|max:191',
            'domain' => 'required|string|max:191',
            'type' => 'required|string',
            'layout_type' => 'required|string',
            'heading' => 'nullable|string',
            'content' => 'nullable|string',
            'logos' => 'nullable|array',
            'signature' => 'nullable|string',
        ]);

        // Smart Content Logic
        if (empty($data['content'])) {
            $data['content'] = $this->generateContent($data);
        }

        $data['unique_id'] = strtoupper(Str::random(10));
        $data['issued_at'] = now();

        $certificate = Certificate::create($data);

        // Load specific layout/pdf view
        $pdf = Pdf::loadView('certificate.pdf', ['data' => $data, 'certificate' => $certificate]);
        $pdf->setPaper('a4', $data['type'] == 'Offer Letter' ? 'portrait' : 'landscape');

        return $pdf->download('certificate_' . $data['unique_id'] . '.pdf');
    }

    private function generateContent($data)
    {
        $name = $data['candidate_name'];
        $domain = $data['domain'];
        $type = $data['type'];

        if ($type == 'Offer Letter') {
            return "Dear $name,\n\nWe are pleased to offer you the position of Intern in the $domain department. We were impressed with your qualifications and believe you will be a valuable asset to our team.\n\nPlease sign and return the attached copy to accept this offer.";
        }

        if ($type == 'Experience') {
            return "This letter is to certify that $name was employed with us in the $domain field. During their tenure, they demonstrated excellent professional skills and dedication.";
        }

        // Default Internship/Completion
        return "For successfully completing the $type program in the field of $domain. We appreciate the dedication and hard work demonstrated during the tenure.";
    }
}
