<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        // Perguntas frequentes relacionadas ao GetTogether
        $faqs = [
            [
                'pergunta' => 'Como posso criar um evento?',
                'resposta' => 'Para criar um evento, clique no botão "Create Event" no header e siga as instruções.'
            ],
            // Adicione mais perguntas conforme necessário
        ];

        return view('faq.index', compact('faqs'));
    }
}
