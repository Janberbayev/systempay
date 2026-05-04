<?php

namespace App\Services;

use App\Models\Deal;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;
use RuntimeException;

class ContractDocxGenerator
{
    private const RUSSIAN_MONTHS = [
        1 => 'января', 2 => 'февраля', 3 => 'марта', 4 => 'апреля',
        5 => 'мая', 6 => 'июня', 7 => 'июля', 8 => 'августа',
        9 => 'сентября', 10 => 'октября', 11 => 'ноября', 12 => 'декабря',
    ];

    public function generate(Deal $deal, array $snapshot, int $version): string
    {
        $templatePath = resource_path('templates/contract/dogovor_sdelka.docx');
        if (! is_file($templatePath)) {
            throw new RuntimeException('Файл шаблона договора не найден: '.$templatePath);
        }

        $formed = Carbon::parse($snapshot['formed_at'] ?? now());
        $proj = $snapshot['project'] ?? [];
        $offer = $snapshot['offer'] ?? [];
        $client = $snapshot['client'] ?? [];
        $contractor = $snapshot['contractor'] ?? [];

        $dateHeader = $this->russianQuotedDate($formed);
        $city = trim((string) ($proj['city'] ?? ''));

        $description = trim(strip_tags((string) ($proj['description'] ?? '')));
        $title = trim((string) ($proj['title'] ?? ''));
        $serviceBlock = $title !== '' && $description !== ''
            ? $title."\n\n".$description
            : ($title !== '' ? $title : $description);
        if ($serviceBlock === '') {
            $serviceBlock = '—';
        }

        $price = isset($offer['price']) ? (float) $offer['price'] : null;
        $priceSpaced = $price !== null ? number_format($price, 0, ',', ' ') : '—';

        $duration = isset($offer['duration']) ? (string) $offer['duration'] : '—';

        $processor = new TemplateProcessor($templatePath);
        $processor->setValue('contract_number', (string) $deal->id);
        $processor->setValue('contract_date_header', $dateHeader);
        $processor->setValue('contract_city', $city !== '' ? $city : '_______________');
        $processor->setValue('client_name', (string) ($client['name'] ?? '—'));
        $processor->setValue('client_bin', 'не указан');
        $processor->setValue('client_address', $this->partyAddressLine($client));
        $processor->setValue('contractor_name', (string) ($contractor['name'] ?? '—'));
        $processor->setValue('contractor_bin', 'не указан');
        $processor->setValue('contractor_address', $this->partyAddressLine($contractor));
        $processor->setValue('service_description', $serviceBlock);
        $processor->setValue('service_start_clause', $dateHeader);
        $processor->setValue('offer_duration', $duration);
        $processor->setValue('offer_price_spaced', $priceSpaced);
        $processor->setValue('client_sign_name', (string) ($client['name'] ?? '—'));
        $processor->setValue('contractor_sign_name', (string) ($contractor['name'] ?? '—'));
        $processor->setValue('signature_placeholder', '_________________');
        $processor->setValue('deal_number', (string) $deal->id);
        $processor->setValue('appendix_clause', $dateHeader);

        $relative = 'contracts/deal-'.$deal->id.'/contract-v'.$version.'.docx';
        $dir = dirname($relative);
        Storage::disk('local')->makeDirectory($dir);

        $fullPath = Storage::disk('local')->path($relative);
        $processor->saveAs($fullPath);

        return $relative;
    }

    private function partyAddressLine(array $party): string
    {
        $parts = array_filter([
            isset($party['phone']) ? 'тел. '.$party['phone'] : null,
            isset($party['email']) ? 'email: '.$party['email'] : null,
        ]);

        return $parts !== [] ? implode(', ', $parts) : 'не указан';
    }

    private function russianQuotedDate(Carbon $dt): string
    {
        $m = self::RUSSIAN_MONTHS[(int) $dt->month] ?? $dt->translatedFormat('F');

        return sprintf('«%02d» %s %d г.', $dt->day, $m, $dt->year);
    }
}
