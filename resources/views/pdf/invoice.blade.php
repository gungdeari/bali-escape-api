{{-- resources/views/invoice.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice {{ $payment->booking->booking_code }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1a1a1a;
            font-size: 13px;
            background: #ffffff;
            padding: 40px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 40px;
            padding-bottom: 24px;
            border-bottom: 2px solid #17A2B8;
        }

        .brand-name {
            font-size: 22px;
            font-weight: bold;
            color: #1a1a1a;
        }

        .brand-name span {
            color: #17A2B8;
        }

        .brand-tagline {
            font-size: 11px;
            color: #888;
            margin-top: 2px;
        }

        .invoice-meta {
            text-align: right;
        }

        .invoice-label {
            font-size: 20px;
            font-weight: bold;
            color: #17A2B8;
            margin-bottom: 6px;
        }

        .invoice-code {
            font-size: 13px;
            font-weight: bold;
            color: #1a1a1a;
            letter-spacing: 0.5px;
        }

        .invoice-date {
            font-size: 11px;
            color: #888;
            margin-top: 4px;
        }

        .status-confirmed {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 99px;
            font-size: 11px;
            font-weight: bold;
            background: #d1fae5;
            color: #065f46;
            margin-top: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .section {
            margin-bottom: 28px;
        }

        .section-title {
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #17A2B8;
            margin-bottom: 10px;
        }

        .card {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 16px 20px;
            background: #fafafa;
        }

        .card-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .card-row:last-child {
            border-bottom: none;
        }

        .card-label {
            color: #888;
            font-size: 12px;
        }

        .card-value {
            font-weight: bold;
            font-size: 12px;
            color: #1a1a1a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        thead {
            background: #17A2B8;
        }

        th {
            text-align: left;
            padding: 10px 14px;
            font-size: 11px;
            font-weight: bold;
            color: #ffffff;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 12px 14px;
            border-bottom: 1px solid #f1f1f1;
            font-size: 12px;
            color: #333;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:nth-child(even) {
            background: #f9fafb;
        }

        .text-right { text-align: right; }

        .total-section {
            border-top: 2px solid #e5e7eb;
            margin-top: 4px;
            padding-top: 12px;
            text-align: right;
        }

        .total-label {
            font-size: 12px;
            color: #888;
        }

        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #17A2B8;
            margin-top: 2px;
        }

        .two-col {
            display: flex;
            gap: 16px;
        }

        .two-col .card {
            flex: 1;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 11px;
            color: #aaa;
            line-height: 1.8;
        }

        .footer-brand {
            font-weight: bold;
            color: #17A2B8;
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="header">
        <div>
            <div class="brand-name">
                Bali<span>Escape</span>
            </div>
            <div class="brand-tagline">Travel Booking System</div>
        </div>

        <div class="invoice-meta">
            <div class="invoice-label">INVOICE</div>
            <div class="invoice-code">{{ $payment->booking->booking_code }}</div>
            <div class="invoice-date">
                Issued: {{ \Carbon\Carbon::parse($payment->paid_at)->format('d F Y') }}
            </div>
            <div>
                <span class="status-confirmed">✓ Paid</span>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Customer & Payment Information</div>
        <div class="two-col">

            <div class="card">
                <div class="card-row">
                    <span class="card-label">Name</span>
                    <span class="card-value">{{ $payment->booking->user->name }}</span>
                </div>
                <div class="card-row">
                    <span class="card-label">Email</span>
                    <span class="card-value">{{ $payment->booking->user->email }}</span>
                </div>
            </div>

            <div class="card">
                <div class="card-row">
                    <span class="card-label">Payment method</span>
                    <span class="card-value">
                        {{ ucwords(str_replace('_', ' ', $payment->payment_method)) }}
                    </span>
                </div>
                <div class="card-row">
                    <span class="card-label">Reference</span>
                    <span class="card-value">{{ $payment->transaction_reference }}</span>
                </div>
                <div class="card-row">
                    <span class="card-label">Paid on</span>
                    <span class="card-value">
                        {{ \Carbon\Carbon::parse($payment->paid_at)->format('d F Y') }}
                    </span>
                </div>
            </div>

        </div>
    </div>

    <div class="section">
        <div class="section-title">Booking Details</div>

        <table>
            <thead>
                <tr>
                    <th>Package</th>
                    <th>Destination</th>
                    <th>Duration</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payment->booking->items as $item)
                    <tr>
                        <td><strong>{{ $item->travelPackage->title }}</strong></td>
                        <td>{{ $item->travelPackage->destination->name ?? '—' }}</td>
                        <td>{{ $item->travelPackage->duration_days }} days</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td class="text-right">
                            Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total-section">
            <div class="total-label">Total amount paid</div>
            <div class="total-amount">
                Rp {{ number_format($payment->amount, 0, ',', '.') }}
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="footer-brand">BaliEscape</div>
        Thank you for choosing us. We look forward to seeing you in Bali.<br>
        This invoice was generated automatically on
        {{ \Carbon\Carbon::now()->format('d F Y, H:i') }} WIB.
    </div>

</body>
</html>