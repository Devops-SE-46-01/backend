<?php

namespace App\Export;

use App\Models\Recruitation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class RecruitationExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $result = Recruitation::whereYear('created_at', '2024')
            ->select(
                'name',
                'email',
                'nim',
                'major',
                'generation',
                'division',
                'cv',
                'portofolio',
                'motivation_letter',
                'ksm',
                'share_poster',
                'yt_evidence',
                'linkedin_evidence',
                'instagram_evidence',
                'line_evidence',
                'twibbon_evidence',
                'whatsapp'
            )
            ->whereYear('created_at', '2024')
            ->get();
        return $result;
    }

    public function headings(): array
    {
        return [
            [
                'Nama',
                'Email',
                'Nim',
                'Jurusan',
                'Angkatan',
                'Divisi',
                'CV',
                'Portofolio',
                'Motivation Video',
                'KSM',
                'Share Poster',
                'Youtube',
                'Linkedin',
                'Instagram',
                'Line',
                'Twibbon',
                'Whatsapp',
            ],
        ];
    }
}
