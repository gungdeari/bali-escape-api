<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Helpers\ApiResponse;
use App\Services\Pdf\InvoiceService;

class PaymentApiController extends Controller
{
    protected PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        try {
            $payments = $this->paymentService->getPayments(
                request()->user()
            );

            return ApiResponse::paginated(
                $payments,
                PaymentResource::collection($payments),
                'Payments retrieved successfully'
            );

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 400);
        }
    }

    public function show(int $id)
    {
        try {
            $payment = $this->paymentService->getPaymentDetail(
                $id,
                request()->user()
            );

            return ApiResponse::success(
                new PaymentResource($payment),
                'Payment retrieved successfully'
            );

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 404);
        }
    }

    public function store(PaymentRequest $request)
    {
        try {
            $payment = $this->paymentService->store(
                $request->validated(),
                $request->user()
            );

            return ApiResponse::success(
                new PaymentResource($payment),
                'Payment successful',
                201
            );

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 400);
        }
    }

    public function invoice(int $id, InvoiceService $invoiceService)
    {
        try {
            $payment = $this->paymentService->getPaymentDetail(
                $id, 
                request()->user()
            );

            $pdf = $invoiceService->stream($payment);

            return response($pdf, 200)
                ->header('Content-Type', 'application/pdf');

        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage(), 400);
        }
    }
}