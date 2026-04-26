<?php

namespace App\Services;

use App\Models\Deal;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class ContractDocxGenerator
{
    public function generate(Deal $deal, array $snapshot, int $version): string
    {
        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        $h = ['name' => 'Arial', 'size' => 14, 'bold' => true];
        $p = ['name' => 'Arial', 'size' => 11];
        $muted = ['name' => 'Arial', 'size' => 10, 'color' => '666666'];

        $section->addText('Договор возмездного оказания услуг (черновик)', $h);
        $section->addText('Версия '.$version.' · сделка №'.$deal->id, $muted);
        $section->addTextBreak(2);

        $proj = $snapshot['project'] ?? [];
        $section->addText('1. Предмет договора', $h);
        $section->addText($proj['title'] ?? '—', $p);
        $section->addTextBreak();
        $section->addText($proj['description'] ?? '', $p);
        $loc = trim(implode(', ', array_filter([$proj['region'] ?? '', $proj['city'] ?? ''])));
        if ($loc !== '') {
            $section->addTextBreak();
            $section->addText('Место: '.$loc, $p);
        }
        $section->addTextBreak(2);

        $client = $snapshot['client'] ?? [];
        $section->addText('2. Заказчик', $h);
        $section->addText($this->partyLine($client), $p);
        $section->addTextBreak(2);

        $contractor = $snapshot['contractor'] ?? [];
        $section->addText('3. Исполнитель', $h);
        $section->addText($this->partyLine($contractor), $p);
        $section->addTextBreak(2);

        $offer = $snapshot['offer'] ?? [];
        $section->addText('4. Цена и срок', $h);
        $price = isset($offer['price']) ? number_format((float) $offer['price'], 0, ',', ' ') : '—';
        $section->addText('Цена: '.$price.' ₸', $p);
        $section->addTextBreak();
        $section->addText('Срок выполнения: '.($offer['duration'] ?? '—').' календарных дней', $p);
        if (! empty($offer['comments'])) {
            $section->addTextBreak();
            $section->addText('Комментарий к предложению: '.$offer['comments'], $p);
        }
        $section->addTextBreak(2);

        $formed = $snapshot['formed_at'] ?? now()->toIso8601String();
        $section->addText('Дата формирования черновика: '.$formed, $muted);

        $relative = 'contracts/deal-'.$deal->id.'/contract-v'.$version.'.docx';
        $dir = dirname($relative);
        Storage::disk('local')->makeDirectory($dir);

        $fullPath = Storage::disk('local')->path($relative);
        IOFactory::createWriter($phpWord, 'Word2007')->save($fullPath);

        return $relative;
    }

    private function partyLine(array $party): string
    {
        $parts = array_filter([
            $party['name'] ?? null,
            isset($party['phone']) ? 'тел. '.$party['phone'] : null,
            isset($party['email']) ? 'email: '.$party['email'] : null,
        ]);

        return $parts !== [] ? implode(', ', $parts) : '—';
    }
}
