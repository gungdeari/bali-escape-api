<?php

namespace App\Services\Pdf;

use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceService
{
    public function stream($payment)
    {
        return Pdf::loadView('pdf.invoice', [
            'payment' => $payment
        ])->stream();
    }
}