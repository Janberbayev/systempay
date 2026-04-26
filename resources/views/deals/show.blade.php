@extends('layout.app')

@section('content')

    @php
        $project = $deal->project;
    @endphp

    <section class="section-creative deal-show-page">
        <div class="container-fluid">
            <div class="row">
                <x-dashboard-sidebar />

                <div class="col-lg-9 col-md-8">
                    <a href="{{ route('my-deal') }}" class="deal-show-back text-decoration-none d-inline-flex align-items-center gap-1 mb-3">
                        <i class="bi bi-arrow-left"></i> Мои сделки
                    </a>

                    <div class="deal-show-shell card-creative">
                        <header class="deal-show-head">
                            <div class="deal-show-head__top">
                                <span class="deal-show-kicker">Сделка №{{ $deal->id }}</span>
                                <div class="deal-show-badges">
                                    <span class="deal-badge deal-badge--muted">
                                        <i class="bi bi-calendar3"></i>
                                        {{ $deal->created_at->format('d.m.Y') }}
                                    </span>
                                    <span class="deal-badge deal-badge--accent">{{ $deal->status_text }}</span>
                                </div>
                            </div>
                            <h1 class="deal-show-title mb-0">
                                @if($project)
                                    <a href="{{ route('show-project', $project) }}">{{ $project->title ?? 'Проект' }}</a>
                                @else
                                    Проект недоступен
                                @endif
                            </h1>
                            @if($project)
                                <p class="deal-show-meta deal-show-meta--tight mb-0">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $project->region->name ?? 'Регион не указан' }}
                                    @if($project->city)
                                        · {{ $project->city->name }}
                                    @endif
                                </p>
                            @endif
                        </header>

                        <div class="row g-3 g-lg-4 deal-show-body">
                            <div class="col-lg-7">
                                @if($project)
                                    <p class="deal-show-desc">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($project->description), 280) }}
                                    </p>
                                    <div class="deal-person deal-person--client">
                                        <span class="deal-person__label">Заказчик</span>
                                        <span class="deal-person__name">{{ $deal->client->name ?? '—' }}</span>
                                        @if($deal->client && $deal->client->phone)
                                            <a href="tel:{{ preg_replace('/\s+/', '', $deal->client->phone) }}" class="deal-person__contact">
                                                <i class="bi bi-telephone"></i>{{ $deal->client->phone }}
                                            </a>
                                        @endif
                                    </div>
                                @else
                                    <p class="text-muted small mb-0">Карточка проекта недоступна.</p>
                                @endif
                            </div>

                            <div class="col-lg-5">
                                <div class="deal-show-aside">
                                    <h2 class="deal-show-h2">Условия</h2>
                                    <div class="deal-terms-row">
                                        <div class="deal-term">
                                            <span class="deal-term__label">Сумма</span>
                                            <span class="deal-term__value">
                                                {{ number_format((float) $deal->price, 0, ',', ' ') }}
                                                <span class="deal-term__unit">₸</span>
                                            </span>
                                        </div>
                                        <div class="deal-term">
                                            <span class="deal-term__label">Срок</span>
                                            <span class="deal-term__value">
                                                {{ $deal->duration }}
                                                <span class="deal-term__unit">дн.</span>
                                            </span>
                                        </div>
                                    </div>

                                    @if($deal->offer && $deal->offer->comments)
                                        <div class="deal-offer-block">
                                            <h3 class="deal-show-h3">Комментарий к предложению</h3>
                                            <div class="deal-offer-comment-scroll">
                                                <p class="deal-show-note mb-0">{{ $deal->offer->comments }}</p>
                                            </div>
                                            <div class="deal-person deal-person--contractor mt-3">
                                                <span class="deal-person__label">Исполнитель</span>
                                                <span class="deal-person__name">{{ $deal->contractor->name ?? '—' }}</span>
                                                @if($deal->contractor && $deal->contractor->phone)
                                                    <a href="tel:{{ preg_replace('/\s+/', '', $deal->contractor->phone) }}" class="deal-person__contact">
                                                        <i class="bi bi-telephone"></i>{{ $deal->contractor->phone }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(!empty($contractVersion))
                            <div class="deal-contract-block mt-3 pt-3" style="border-top: 1px solid var(--border-color);">
                                <h2 class="deal-show-h2">Договор</h2>
                                <p class="small mb-2" style="color: var(--text-secondary);">
                                    Версия {{ $contractVersion->version }} · черновик ·
                                    {{ $contractVersion->created_at->format('d.m.Y H:i') }}
                                </p>
                                <p class="deal-show-note mb-3">
                                    Условия зафиксированы в системе. Контрольная сумма:
                                    <code class="user-select-all" style="font-size: 0.75rem;">{{ \Illuminate\Support\Str::limit($contractVersion->hash, 24, '…') }}</code>
                                </p>
                                <a href="{{ route('deals.contract-word', $deal) }}" class="btn btn-creative d-inline-flex align-items-center gap-2">
                                    <i class="bi bi-file-earmark-word"></i>
                                    Скачать договор в Word (.docx)
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .deal-show-page {
            padding: 1.25rem 0 2rem;
        }
        .deal-show-shell {
            border: 1px solid var(--border-color);
            border-radius: 14px;
            padding: 1.1rem 1.25rem 1.35rem;
            background: linear-gradient(160deg, var(--bg-card) 0%, var(--bg-darker) 100%);
        }
        @media (min-width: 768px) {
            .deal-show-shell {
                padding: 1.35rem 1.5rem 1.5rem;
            }
        }
        .deal-show-back {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 0.875rem;
            transition: color 0.2s ease;
        }
        .deal-show-back:hover {
            color: var(--accent-green);
        }
        .deal-show-head {
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        .deal-show-head__top {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem 0.75rem;
            margin-bottom: 0.5rem;
        }
        .deal-show-kicker {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--accent-green);
        }
        .deal-show-badges {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.4rem;
        }
        .deal-show-title {
            font-size: clamp(1.2rem, 2.2vw, 1.55rem);
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.28;
        }
        .deal-show-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .deal-show-title a:hover {
            color: var(--accent-green);
        }
        .deal-show-meta {
            color: var(--text-secondary);
            font-size: 0.8125rem;
            line-height: 1.45;
        }
        .deal-show-meta--tight {
            margin-top: 0.35rem;
        }
        .deal-show-meta i {
            margin-right: 0.2rem;
            opacity: 0.85;
        }
        .deal-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
            padding: 0.22rem 0.55rem;
            border-radius: 999px;
            font-size: 0.72rem;
            font-weight: 600;
            line-height: 1.2;
        }
        .deal-badge--muted {
            background: var(--bg-card-hover);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
        }
        .deal-badge--accent {
            background: rgba(16, 163, 127, 0.1);
            color: var(--accent-green);
            border: 1px solid rgba(16, 163, 127, 0.32);
        }
        .deal-show-body {
            align-items: flex-start;
        }
        .deal-show-desc {
            color: var(--text-secondary);
            line-height: 1.55;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }
        .deal-person {
            padding: 0.65rem 0.75rem;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: var(--bg-darker);
        }
        .deal-person__label {
            display: block;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            font-weight: 700;
            margin-bottom: 0.2rem;
        }
        .deal-person__name {
            display: block;
            font-size: 0.98rem;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1.3;
        }
        .deal-person__contact {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            margin-top: 0.35rem;
            font-size: 0.8125rem;
            color: var(--text-secondary);
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .deal-person__contact:hover {
            color: var(--accent-green);
        }
        .deal-show-aside {
            height: 100%;
            padding: 0.75rem 0.85rem;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            background: var(--bg-darker);
        }
        .deal-show-h2 {
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.06em;
            color: var(--text-muted);
            margin-bottom: 0.65rem;
        }
        .deal-show-h2::before {
            content: '';
            display: inline-block;
            width: 3px;
            height: 0.85em;
            margin-right: 0.45rem;
            vertical-align: -0.1em;
            border-radius: 2px;
            background: var(--accent-green);
        }
        .deal-terms-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.5rem;
        }
        .deal-term {
            padding: 0.5rem 0.6rem;
            border-radius: 10px;
            background: var(--bg-card);
            border: 1px solid var(--border-color);
        }
        body.light-theme .deal-term {
            background: var(--bg-card);
        }
        .deal-term__label {
            display: block;
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            margin-bottom: 0.15rem;
        }
        .deal-term__value {
            font-size: 1.05rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.15;
        }
        .deal-term__unit {
            font-size: 0.75rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-left: 0.1rem;
        }
        .deal-offer-block {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }
        .deal-show-h3 {
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--text-muted);
            margin-bottom: 0.4rem;
        }
        .deal-show-note {
            color: var(--text-secondary);
            line-height: 1.5;
            font-size: 0.8125rem;
            word-break: break-word;
            overflow-wrap: anywhere;
        }
        .deal-offer-comment-scroll {
            max-height: min(38vh, 14rem);
            overflow-y: auto;
            overflow-x: hidden;
            padding-right: 0.25rem;
            -webkit-overflow-scrolling: touch;
        }
        .deal-offer-comment-scroll::-webkit-scrollbar {
            width: 5px;
        }
        .deal-offer-comment-scroll::-webkit-scrollbar-thumb {
            background: var(--border-color);
            border-radius: 4px;
        }
        .deal-offer-comment-scroll::-webkit-scrollbar-track {
            background: transparent;
        }
    </style>

@endsection
