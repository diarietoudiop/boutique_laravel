<?php

namespace App\Services;

use App\Services\Interfaces\QrCodeServiceInterface;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class QrCodeService implements QrCodeServiceInterface
{

    public function generateQrCode(string $data): string
    {
        // Crée une instance de QrCode
        $qrCode = new QrCode($data);
        $writer = new PngWriter();

        // Crée le QR code et sauvegarde l'image
        $result = $writer->write($qrCode);
        $fileName = 'qrcodes/' . uniqid() . '.png';
        Storage::disk('public')->put($fileName, $result->getString());

        return 'storage/' . $fileName;
    }
}
