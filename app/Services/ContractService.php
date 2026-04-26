<?php

namespace App\Services;

use App\Models\ContractVersion;
use App\Models\Deal;
use Illuminate\Support\Facades\DB;

class ContractService
{
    public function __construct(
        private readonly ContractDocxGenerator $docxGenerator,
    ) {}

    public function createVersion(Deal $deal, array $snapshot, ?string $filePath = null): ContractVersion
    {
        return DB::transaction(function () use ($deal, $snapshot, $filePath) {

            // блокируем строки для избежания гонки версий
            $next = (int) $deal->contractVersions()
                ->lockForUpdate()
                ->max('version') + 1;

            $storedPath = $filePath ?? $this->docxGenerator->generate($deal, $snapshot, $next);

            return $deal->contractVersions()->create([
                'version' => $next,
                'snapshot' => $snapshot,
                'file_path' => $storedPath,
                'hash' => $this->hashSnapshot($snapshot),
                'status' => 'draft',
            ]);
        });
    }

    public function hashSnapshot(array $snapshot): string
    {
        // стабильный порядок ключей (важно!)
        ksort($snapshot);

        $canonical = json_encode(
            $snapshot,
            JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        return hash('sha256', $canonical);
    }

    public function latestVersion(Deal $deal): ?ContractVersion
    {
        return $deal->contractVersions()
            ->orderByDesc('version')
            ->first();
    }
}
