<?php

namespace App\View\Components;

use Closure;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class Sidebar extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    public function getSaldo()
    {
        $brimoId = auth()->user()->brimo_id;

        if (empty($brimoId)) {
            return 0;
        }

        try {
            $client = new Client();
            $baseUrl = env('BRIMO_BASE_URL');

            $response = $client->request('GET', "$baseUrl/rekening/showRekening/$brimoId");
            $content = $response->getBody()->getContents();

            $data = json_decode($content, true);

            if (($data['success'] ?? null) == true) {
                return $data['data']['saldo'] ?? 0;
            }

            return 0;
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $saldo = $this->getSaldo();
        return view('components.sidebar', compact('saldo'));
    }
}
