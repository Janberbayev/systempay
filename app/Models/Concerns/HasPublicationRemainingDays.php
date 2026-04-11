<?php

namespace App\Models\Concerns;

trait HasPublicationRemainingDays
{
    public function remainingPublicationDays(): ?int
    {
        if (!$this->expires_at || !$this->expires_at->isFuture()) {
            return null;
        }

        $days = (int) now()->startOfDay()->diffInDays($this->expires_at->copy()->startOfDay());

        return max(1, $days);
    }

    public function remainingActivePublicationLabel(): ?string
    {
        $days = $this->remainingPublicationDays();
        if ($days === null) {
            return null;
        }

        return 'Активна ещё '.$days.' '.$this->russianDaysWord($days);
    }

    private function russianDaysWord(int $n): string
    {
        $n = abs($n) % 100;
        $n1 = $n % 10;
        if ($n > 10 && $n < 20) {
            return 'дней';
        }
        if ($n1 > 1 && $n1 < 5) {
            return 'дня';
        }
        if ($n1 === 1) {
            return 'день';
        }

        return 'дней';
    }
}
