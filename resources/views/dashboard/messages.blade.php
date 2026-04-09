@extends('layout.app')

@section('content')

    <section class="section-creative" style="padding: 40px 0; min-height: calc(100vh - 200px);">
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <x-dashboard-sidebar />

                <!-- Main Content Area -->
                <div class="col-lg-9 col-md-8">
                    <div class="card-creative p-4">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h1 class="fw-black mb-0" style="color: var(--text-primary); font-size: 2rem;">
                                <i class="bi bi-envelope me-2" style="color: var(--primary);"></i>
                                Сообщения
                            </h1>
                            <div class="mailbox-actions">
                                <button class="btn btn-sm" style="background: var(--bg-card-hover); color: var(--text-primary); border: 1px solid var(--border-color);">
                                    <i class="bi bi-arrow-clockwise me-1"></i>Обновить
                                </button>
                            </div>
                        </div>

                        @if($advertsWithComments->count() > 0 || $projectsWithComments->count() > 0)
                            <!-- Mailbox List -->
                            <div class="mailbox-list">
                                <!-- Сообщения по объявлениям -->
                                @foreach($advertsWithComments as $advert)
                                    <div class="mailbox-item" data-type="advert" data-id="{{ $advert->id }}">
                                        <div class="mailbox-item-header">
                                            <div class="mailbox-checkbox">
                                                <input type="checkbox" class="form-check-input">
                                            </div>
                                            <div class="mailbox-icon">
                                                <i class="bi {{ $advert->moderation_status === 'rejected' ? 'bi-x-circle-fill text-danger' : 'bi-arrow-repeat text-warning' }}"></i>
                                            </div>
                                            <div class="mailbox-from">
                                                <strong>Администратор</strong>
                                            </div>
                                            <div class="mailbox-subject">
                                                <span class="mailbox-type-badge badge {{ $advert->moderation_status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark' }} me-2">
                                                    {{ $advert->moderation_status === 'rejected' ? 'Отклонено' : 'На доработку' }}
                                                </span>
                                                <span>Объявление: {{ $advert->title }}</span>
                                            </div>
                                            <div class="mailbox-date">
                                                {{ $advert->updated_at->format('d.m.Y') }}
                                            </div>
                                        </div>
                                        <div class="mailbox-item-body" style="display: none;">
                                            <div class="mailbox-message-content">
                                                <div class="mb-3">
                                                    <strong>От:</strong> Администратор<br>
                                                    <strong>Кому:</strong> {{ Auth::user()->name }}<br>
                                                    <strong>Дата:</strong> {{ $advert->updated_at->format('d.m.Y H:i') }}<br>
                                                    <strong>Тема:</strong> {{ $advert->moderation_status === 'rejected' ? 'Отклонено' : 'На доработку' }} - {{ $advert->title }}
                                                </div>
                                                <div class="mailbox-message-text">
                                                    {{ $advert->admin_comment }}
                                                </div>
                                                <div class="mt-3">
                                                    <a href="{{ route('edit-ads', $advert) }}" class="btn btn-creative btn-sm">
                                                        <i class="bi bi-eye me-1"></i>Посмотреть объявление и внести изменения
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Сообщения по проектам -->
                                @foreach($projectsWithComments as $project)
                                    <div class="mailbox-item" data-type="project" data-id="{{ $project->id }}">
                                        <div class="mailbox-item-header">
                                            <div class="mailbox-checkbox">
                                                <input type="checkbox" class="form-check-input">
                                            </div>
                                            <div class="mailbox-icon">
                                                <i class="bi {{ $project->moderation_status === 'rejected' ? 'bi-x-circle-fill text-danger' : 'bi-arrow-repeat text-warning' }}"></i>
                                            </div>
                                            <div class="mailbox-from">
                                                <strong>Администратор</strong>
                                            </div>
                                            <div class="mailbox-subject">
                                                <span class="mailbox-type-badge badge {{ $project->moderation_status === 'rejected' ? 'bg-danger' : 'bg-warning text-dark' }} me-2">
                                                    {{ $project->moderation_status === 'rejected' ? 'Отклонено' : 'На доработку' }}
                                                </span>
                                                <span>Проект: {{ $project->title }}</span>
                                            </div>
                                            <div class="mailbox-date">
                                                {{ $project->updated_at->format('d.m.Y') }}
                                            </div>
                                        </div>
                                        <div class="mailbox-item-body" style="display: none;">
                                            <div class="mailbox-message-content">
                                                <div class="mb-3">
                                                    <strong>От:</strong> Администратор<br>
                                                    <strong>Кому:</strong> {{ Auth::user()->name }}<br>
                                                    <strong>Дата:</strong> {{ $project->updated_at->format('d.m.Y H:i') }}<br>
                                                    <strong>Тема:</strong> {{ $project->moderation_status === 'rejected' ? 'Отклонено' : 'На доработку' }} - {{ $project->title }}
                                                </div>
                                                <div class="mailbox-message-text">
                                                    {{ $project->admin_comment }}
                                                </div>
                                                <div class="mt-3">
                                                    <a href="{{ route('list-project') }}" class="btn btn-sm" style="background: var(--primary); color: white; border-radius: 8px; padding: 6px 12px;">
                                                        <i class="bi bi-eye me-1"></i>Посмотреть проект
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="mailbox-empty">
                                <div class="text-center py-5">
                                    <i class="bi bi-inbox" style="font-size: 3rem; color: var(--text-muted);"></i>
                                    <p class="text-muted mt-3 mb-0" style="font-size: 1rem;">
                                        У вас нет новых сообщений от администратора.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        /* Mailbox Styles */
        .mailbox-list {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            overflow: hidden;
            background: var(--bg-card);
        }

        .mailbox-item {
            border-bottom: 1px solid var(--border-color);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .mailbox-item:last-child {
            border-bottom: none;
        }

        .mailbox-item:hover {
            background: var(--bg-card-hover);
        }

        .mailbox-item.active {
            background: var(--bg-card-hover);
        }

        .mailbox-item-header {
            display: flex;
            align-items: center;
            padding: 12px 16px;
            gap: 12px;
        }

        .mailbox-checkbox {
            flex-shrink: 0;
        }

        .mailbox-checkbox input {
            margin: 0;
            cursor: pointer;
        }

        .mailbox-icon {
            flex-shrink: 0;
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
        }

        .mailbox-from {
            flex-shrink: 0;
            width: 150px;
            color: var(--text-primary);
            font-size: 0.9rem;
        }

        .mailbox-subject {
            flex-grow: 1;
            color: var(--text-primary);
            font-size: 0.9rem;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .mailbox-type-badge {
            font-size: 0.7rem;
            padding: 2px 6px;
        }

        .mailbox-date {
            flex-shrink: 0;
            width: 100px;
            text-align: right;
            color: var(--text-muted);
            font-size: 0.85rem;
        }

        .mailbox-item-body {
            padding: 20px 16px;
            border-top: 1px solid var(--border-color);
            background: var(--bg-card);
        }

        .mailbox-message-content {
            color: var(--text-primary);
        }

        .mailbox-message-text {
            padding: 16px;
            background: var(--bg-card-hover);
            border-radius: 8px;
            border-left: 3px solid var(--accent-green);
            line-height: 1.6;
            white-space: pre-wrap;
        }

        .mailbox-empty {
            padding: 40px 20px;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .mailbox-from {
                width: 120px;
            }

            .mailbox-date {
                width: 80px;
                font-size: 0.8rem;
            }
        }

        @media (max-width: 767px) {
            .mailbox-item-header {
                flex-wrap: wrap;
                gap: 8px;
            }

            .mailbox-from {
                width: 100%;
                order: 3;
            }

            .mailbox-subject {
                width: 100%;
                order: 2;
                white-space: normal;
            }

            .mailbox-date {
                width: auto;
                order: 4;
                margin-left: auto;
            }

            .mailbox-checkbox {
                order: 1;
            }

            .mailbox-icon {
                order: 1;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mailboxItems = document.querySelectorAll('.mailbox-item');

            mailboxItems.forEach(item => {
                const header = item.querySelector('.mailbox-item-header');
                const body = item.querySelector('.mailbox-item-body');

                header.addEventListener('click', function(e) {
                    // Не открывать при клике на чекбокс
                    if (e.target.type === 'checkbox') {
                        e.stopPropagation();
                        return;
                    }

                    // Переключить активное состояние
                    const isActive = item.classList.contains('active');

                    // Закрыть все остальные
                    mailboxItems.forEach(otherItem => {
                        if (otherItem !== item) {
                            otherItem.classList.remove('active');
                            otherItem.querySelector('.mailbox-item-body').style.display = 'none';
                        }
                    });

                    // Переключить текущий
                    if (isActive) {
                        item.classList.remove('active');
                        body.style.display = 'none';
                    } else {
                        item.classList.add('active');
                        body.style.display = 'block';
                    }
                });
            });
        });
    </script>

@endsection
