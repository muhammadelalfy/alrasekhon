<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DriverContract;
use App\Repositories\Contracts\OrderContract;
use App\Traits\ExcelTrait;
use Illuminate\Http\JsonResponse;

class ReportExportController extends Controller
{
    use ExcelTrait;

    private OrderContract $orderContract;
    private DriverContract $driverContract;
    private String $path = '/storage/downloaded/excel/reports';

    public function __construct()
    {
        $this->orderContract = app(OrderContract::class);
        $this->driverContract = app(DriverContract::class);
    }

    public function deliveryTimeExport(): JsonResponse
    {
        return $this->generateExcelFromView(
            $this->orderContract,
            "delivery-report-report.xlsx",
            "delivery-report", $this->path
        );
    }

    public function driverOrderCountExport(): JsonResponse
    {
        return $this->generateExcelFromView(
            $this->driverContract,
            "driver-order-count-report.xlsx",
            "driver-order-count",
            $this->path
        );
    }

    public function OrdersDeliveryDurationExport(): JsonResponse
    {
        return $this->generateExcelFromView(
            $this->driverContract,
            "orders-delivery-duration-report.xlsx",
            "orders-delivery-duration",
            $this->path
        );
    }

    public function salesOrdersExport(): JsonResponse
    {
        return $this->generateExcelFromView(
            $this->orderContract,
            "sales-orders-report.xlsx",
            "sales-orders",
            $this->path
        );
    }

    public function customerOrdersExport(): JsonResponse
    {
        return $this->generateExcelFromView(
            $this->orderContract,
            "customer-orders-report.xlsx",
            "customer-orders",
            $this->path
        );
    }

    public function driversExport(): JsonResponse
    {
        return $this->generateExcelFromView(
            $this->driverContract,
            "drivers-report.xlsx",
            "drivers",
            $this->path
        );
    }

}
