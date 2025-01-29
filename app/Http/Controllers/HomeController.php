<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use Illuminate\Http\Request;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;


class HomeController extends Controller
{
    public function index()
    {
        $numberOfPaidInvoices = Invoices::where('status', 1)->count();
        $numberOfUnPaidInvoices = Invoices::where('status', 0)->count();
        $total = $numberOfPaidInvoices + $numberOfUnPaidInvoices;

        $chart = Chartjs::build()
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Label x', 'Label y'])
            ->datasets([
                [
                    "label" => "الفواتير المدفوعه",
                    'backgroundColor' => ['#195ff5'],
                    'data' => [($numberOfPaidInvoices/$total)*100]
                ],
                [
                    "label" => "الفواتير الغير مدفوعه",
                    'backgroundColor' => ['#19f553'],
                    'data' => [($numberOfUnPaidInvoices/$total)*100]
                ]
            ])
            ->options([
                "scales" => [
                    "y" => [
                        "beginAtZero" => true
                    ]
                ]
            ]);

        return view('dashboard', compact(['numberOfPaidInvoices', 'numberOfUnPaidInvoices', 'chart']));
    }
}
