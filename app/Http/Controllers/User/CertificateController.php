<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    public function download($courseId)
    {
        $certificate = Certificate::where('user_id', auth()->id())
            ->where('course_id', $courseId)
            ->firstOrFail();

        $pdf = Pdf::loadView('certificates.template', compact('certificate'));

        return $pdf->download('Sertifikat-'.$certificate->certificate_code.'.pdf');
    }
}
