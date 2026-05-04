<?php

/**
 * Однократно вставляет плейсхолдеры ${...} в document.xml шаблона Word.
 * Исходник — dogovor_sdelka.docx без плейсхолдеров; после патча файл готов для TemplateProcessor.
 *
 * php scripts/patch_contract_template.php
 */

declare(strict_types=1);

$root = dirname(__DIR__);
$path = $root.'/resources/templates/contract/dogovor_sdelka.docx';

$z = new ZipArchive;
if ($z->open($path) !== true) {
    fwrite(STDERR, "Cannot open {$path}\n");
    exit(1);
}
$xml = $z->getFromName('word/document.xml');
if ($xml === false) {
    fwrite(STDERR, "Missing word/document.xml\n");
    exit(1);
}

if (str_contains($xml, '${client_name}')) {
    echo "Template already patched, skip.\n";
    $z->close();
    exit(0);
}

$numOld = '<w:r w:rsidRPr="00437D84"><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial" w:cs="Arial"/><w:b/></w:rPr><w:t>№ __</w:t></w:r><w:r w:rsidR="008864D9" w:rsidRPr="00437D84"><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial" w:cs="Arial"/><w:b/></w:rPr><w:t>________</w:t></w:r><w:r w:rsidRPr="00437D84"><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial" w:cs="Arial"/><w:b/></w:rPr><w:t>_</w:t></w:r><w:r w:rsidR="008864D9" w:rsidRPr="00437D84"><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial" w:cs="Arial"/><w:b/></w:rPr><w:t xml:space="preserve"> </w:t></w:r>';

$numNew = '<w:r w:rsidRPr="00437D84"><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial" w:cs="Arial"/><w:b/></w:rPr><w:t>№ ${contract_number}</w:t></w:r>';

$dateOld = '<w:r w:rsidR="00A7701A" w:rsidRPr="00437D84"><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial" w:cs="Arial"/><w:b/></w:rPr><w:t>«_» __________ 20</w:t></w:r><w:r w:rsidRPr="00437D84"><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial" w:cs="Arial"/><w:b/></w:rPr><w:t>__</w:t></w:r><w:r w:rsidR="00A7701A" w:rsidRPr="00437D84"><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial" w:cs="Arial"/><w:b/></w:rPr><w:t xml:space="preserve"> г.</w:t></w:r>';

$dateNew = '<w:r w:rsidR="00A7701A" w:rsidRPr="00437D84"><w:rPr><w:rFonts w:ascii="Arial" w:hAnsi="Arial" w:cs="Arial"/><w:b/></w:rPr><w:t>${contract_date_header}</w:t></w:r>';

$replacements = [
    $numOld => $numNew,
    $dateOld => $dateNew,
    '. ____________' => '. ${contract_city}',
    'Заказчик: ___________________________' => 'Заказчик: ${client_name}',
    'Исполнитель: ___________________________' => 'Исполнитель: ${contractor_name}',
    '2.1. Исполнитель обязуется оказать услуги:' => '2.1. Исполнитель обязуется оказать услуги: ${service_description}',
    '3.1. Срок начала оказания услуг: «_» _________ 20 г.' => '3.1. Срок начала оказания услуг: ${service_start_clause}',
    '3.2. Срок выполнения услуг составляет ___ календарных дней с момента подписания договора' => '3.2. Срок выполнения услуг составляет ${offer_duration} календарных дней с момента подписания договора',
    '4.1. Общая стоимость услуг: _________ тенге.' => '4.1. Общая стоимость услуг: ${offer_price_spaced} тенге.',
    'к Договору № ___ от «_» ______ 20 г.' => 'к Договору № ${deal_number} от ${appendix_clause}',
    'Заказчик: __________' => 'Заказчик: ${client_name}',
    'Исполнитель: __________' => 'Исполнитель: ${contractor_name}',
    'Подпись: _______' => 'Подпись: ${signature_placeholder}',
];

$xml = str_replace(array_keys($replacements), array_values($replacements), $xml);

for ($i = 0; $i < 2; $i++) {
    $xml = preg_replace(
        '/ИИН\/БИН: ___________________________/u',
        $i === 0 ? 'ИИН/БИН: ${client_bin}' : 'ИИН/БИН: ${contractor_bin}',
        $xml,
        1
    );
}

for ($i = 0; $i < 2; $i++) {
    $xml = preg_replace(
        '/Адрес: ___________________________/u',
        $i === 0 ? 'Адрес: ${client_address}' : 'Адрес: ${contractor_address}',
        $xml,
        1
    );
}

for ($i = 0; $i < 2; $i++) {
    $xml = preg_replace(
        '/ФИО: __________/u',
        $i === 0 ? 'ФИО: ${client_sign_name}' : 'ФИО: ${contractor_sign_name}',
        $xml,
        1
    );
}

if (! $z->deleteName('word/document.xml')) {
    fwrite(STDERR, "deleteName failed\n");
    exit(1);
}
if (! $z->addFromString('word/document.xml', $xml)) {
    fwrite(STDERR, "addFromString failed\n");
    exit(1);
}

$z->close();
echo "Patched {$path}\n";
