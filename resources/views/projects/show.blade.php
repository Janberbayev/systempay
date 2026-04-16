@extends('layout.app')

@section('content')

    <section id="roles" class="section-creative" style="background: white; padding-top: 30px;">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success mt-4">
                    {{session('success')}}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger mt-4">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mt-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $projectBackFrom = request('from');
                $projectBackTab = request('tab', 'on-site');
                $dashboardTabs = ['on-site', 'pending', 'archive'];
                if (! in_array($projectBackTab, $dashboardTabs, true)) {
                    $projectBackTab = 'on-site';
                }
                $projectBackHref = $projectBackFrom === 'dashboard'
                    ? route('dashboard', ['tab' => $projectBackTab])
                    : route('list-project');
            @endphp
            <div class="row g-4">
                <div class="col-lg-8 mx-auto">
                    <div class="mb-3">
                        <a href="{{ $projectBackHref }}" class="text-decoration-none" style="color: var(--text-muted); font-weight: 500;">
                            <i class="bi bi-arrow-left me-1"></i> Назад
                        </a>
                    </div>
                    <div class="role-card-creative h-90 p-4 p-md-5 mt-5">
                        <div class="mb-3">
                            <h1 class="fw-black mb-2" style="font-size: 1.8rem; color: var(--text-primary);">
                                {{ $project->title }}
                            </h1>
                            <div class="d-flex flex-wrap align-items-center gap-2 text-muted small">
                                <span>
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ $project->region->name ?? 'Регион не указан' }}
                                    @if($project->city)
                                        · {{ $project->city->name }}
                                    @endif
                                </span>
                                <span>•</span>
                                <span>
                                    <i class="bi bi-calendar me-1"></i>
                                    {{ $project->created_at->format('d.m.Y') }}
                                </span>
                                @if($project->user)
                                    <span>•</span>
                                    <span>
                                        <i class="bi bi-person me-1"></i>
                                        Автор: {{ $project->user->name }}
                                    </span>
                                    <span>•</span>
                                    <span>
                                        Тел.: {{ $project->user->phone }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-4">
                            <h5 class="mb-2" style="color: var(--text-primary);">Описание</h5>
                            <p style="color: var(--text-secondary); line-height: 1.8;">
                                {{ $project->description }}
                            </p>
                        </div>

                        <div class="d-flex justify-content-end align-items-center flex-wrap gap-3 mt-4">
                            @if(auth()->check() && $project->user_id === auth()->id())
                                <a href="{{ route('edit-project', $project) }}" class="btn btn-creative">
                                    <i class="bi bi-pencil-square me-2"></i>Редактировать
                                </a>
                            @else
                                <button
                                    type="button"
                                    class="btn btn-creative"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#project-price-offer"
                                    aria-expanded="false"
                                    aria-controls="project-price-offer"
                                >
                                    Предложить цену
                                </button>
                            @endif
                        </div>

                        @if(auth()->check() && $project->user_id !== auth()->id())
                            @if(!$hasOffer)
                                <div class="collapse mt-3" id="project-price-offer">
                                    <form method="POST" action="{{route('offer-to-project')}}">
                                        @csrf
                                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="price" placeholder="Введите сумму" min="1">
                                            <span class="input-group-text">Тенге</span>
                                        </div>
                                        <div class="input-group mb-3">
                                            <input type="number" class="form-control" name="duration" placeholder="Укажите срок (количество дней)" min="1">
                                            <span class="input-group-text">Дней</span>
                                        </div>
                                        <div class="mb-3">
                                            <textarea class="form-control" rows="3" name="comments" placeholder="Комментарий"></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-creative">Отправить</button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="mt-3">
                                    <span class="badge mb-3 d-inline-block border-0" style="background: var(--accent-purple); color: #fff;">
                                        ✔ Вы уже отправили предложение
                                    </span>
                                    @if($offer)
                                        <div class="rounded-3 p-3 p-md-4" style="border: 1px solid var(--border-color); background: var(--bg-card-hover); box-shadow: 0 1px 4px var(--shadow);">
                                            <p class="small text-uppercase fw-semibold mb-3" style="letter-spacing: 0.04em; color: var(--text-muted);">
                                                Ваше предложение
                                            </p>
                                            <div class="row g-3">
                                                <div class="col-sm-6">
                                                    <div class="d-flex align-items-start gap-2">
                                                        <i class="bi bi-currency-exchange mt-1" style="color: var(--text-secondary);"></i>
                                                        <div>
                                                            <div class="small" style="color: var(--text-muted);">Сумма</div>
                                                            <div class="fw-semibold" style="color: var(--text-primary);">
                                                                {{ number_format((float) $offer->price, 0, '.', ' ') }} <span class="fw-normal" style="color: var(--text-secondary);">₸</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="d-flex align-items-start gap-2">
                                                        <i class="bi bi-calendar-range mt-1" style="color: var(--text-secondary);"></i>
                                                        <div>
                                                            <div class="small" style="color: var(--text-muted);">Срок</div>
                                                            <div class="fw-semibold" style="color: var(--text-primary);">
                                                                {{ $offer->duration }} дн.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-flex align-items-start gap-2">
                                                        <i class="bi bi-chat-left-text mt-1" style="color: var(--text-secondary);"></i>
                                                        <div class="flex-grow-1">
                                                            <div class="small" style="color: var(--text-muted);">Комментарий</div>
                                                            <div style="color: var(--text-secondary); line-height: 1.6;">
                                                                {{ $offer->comments ? $offer->comments : '—' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 pt-3 mt-1" style="border-top: 1px solid var(--border-color);">
                                                    <div class="d-flex align-items-center gap-2 small" style="color: var(--text-secondary);">
                                                        <i class="bi bi-clock-history" style="color: var(--text-muted);"></i>
                                                        <span>Отправлено {{ $offer->created_at->format('d.m.Y') }} в {{ $offer->created_at->format('H:i') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                        @endif
                    </div>

                    @if(auth()->check() && $project->user_id === auth()->id())
                        <div class="role-card-creative h-90 p-4 p-md-5 mt-4">
                            @if($offers->isNotEmpty())
                                @php($dealLocked = $project->deal)
                                <h5 class="mb-3" style="color: var(--text-primary);">
                                    @if($dealLocked)
                                        Выбран исполнитель — договор запрошен
                                    @else
                                        Предложения по проекту, выберите Исполнителя:
                                    @endif
                                </h5>
                                <form method="POST" action="{{ route('deals.store', $project) }}" class="d-flex flex-column gap-3">
                                    @csrf
                                    @if(in_array($projectBackFrom, ['dashboard', 'list'], true))
                                        <input type="hidden" name="from" value="{{ $projectBackFrom }}">
                                    @endif
                                    @if($projectBackFrom === 'dashboard')
                                        <input type="hidden" name="tab" value="{{ $projectBackTab }}">
                                    @endif
                                    @foreach($offers as $item)
                                        <div class="rounded-3 p-3 p-md-4 d-flex gap-3 align-items-start" style="border: 1px solid var(--border-color); background: var(--bg-card-hover); box-shadow: 0 1px 4px var(--shadow);">
                                            <div class="form-check flex-shrink-0 pt-1">
                                                <input
                                                    class="form-check-input"
                                                    type="radio"
                                                    name="selected_offer_id"
                                                    id="offer-{{ $item->id }}"
                                                    value="{{ $item->id }}"
                                                    aria-label="Выбрать предложение от {{ $item->user->name ?? 'исполнителя' }}"
                                                    @checked($dealLocked && (int) $dealLocked->offer_id === (int) $item->id)
                                                    @disabled($dealLocked)
                                                >
                                            </div>
                                            <div class="flex-grow-1 min-w-0">
                                            <div class="d-flex flex-wrap justify-content-between align-items-start gap-2 mb-3">
                                                <div>
                                                    <label class="fw-semibold mb-0" for="offer-{{ $item->id }}" style="color: var(--text-primary); cursor: pointer;">
                                                        {{ $item->user->name ?? 'Пользователь' }}
                                                    </label>
                                                    @if($item->user && $item->user->phone)
                                                        <div class="small mt-1" style="color: var(--text-secondary);">
                                                            <i class="bi bi-telephone me-1"></i>{{ $item->user->phone }},
                                                            <i class="bi bi-envelope me-1"></i>{{ $item->user->email }}
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-sm-6">
                                                    <div class="d-flex align-items-start gap-2">
                                                        <div>
                                                            <span class="small" style="color: var(--text-muted);">Сумма - </span>
                                                            <span class="fw-semibold" style="color: var(--text-primary);">
                                                                {{ number_format((float) $item->price, 0, '.', ' ') }} <span class="fw-normal" style="color: var(--text-secondary);">₸</span>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="d-flex align-items-start gap-2">
                                                        <div>
                                                            <span class="small" style="color: var(--text-muted);">Срок -</span>
                                                            <span class="fw-semibold" style="color: var(--text-primary);">
                                                                {{ $item->duration }} дн.
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-flex align-items-start gap-2">
                                                        <i class="bi bi-chat-left-text mt-1" style="color: var(--text-secondary);"></i>
                                                        <div class="flex-grow-1">
                                                            <div class="small" style="color: var(--text-muted);">Комментарий</div>
                                                            <div style="color: var(--text-secondary); line-height: 1.6;">
                                                                {{ $item->comments ? $item->comments : '—' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 pt-3 mt-1" style="border-top: 1px solid var(--border-color);">
                                                    <div class="d-flex align-items-center gap-2 small" style="color: var(--text-secondary);">
                                                        <i class="bi bi-clock-history" style="color: var(--text-muted);"></i>
                                                        <span>Отправлено {{ $item->created_at->format('d.m.Y') }} в {{ $item->created_at->format('H:i') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="d-flex justify-content-end mt-2">
                                        <button type="submit" class="btn btn-creative" @disabled($dealLocked)>
                                            @if($dealLocked)
                                                <i class="bi bi-check2-circle me-2"></i>Запросили договор
                                            @else
                                                <i class="bi bi-file-earmark-text me-2"></i>Запросить договор
                                            @endif
                                        </button>
                                    </div>
                                </form>
                            @else
                                <h5 class="mb-2" style="color: var(--text-primary);">Предложения по проекту</h5>
                                <p class="text-muted mb-0 small">Пока нет предложений от исполнителей.</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

