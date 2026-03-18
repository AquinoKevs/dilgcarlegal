@php
    $isPro = ($theme ?? '') === 'pro';
    $dashboardMode = (bool) ($dashboardMode ?? false);
    $dashboardCollapsed = $dashboardMode && (!($activeConversation ?? null) || ($messages ?? collect())->isEmpty());
@endphp

<style>
    .chat-shell {
        background: {{ $isPro ? 'transparent' : 'radial-gradient(circle at top left, rgba(14, 165, 233, 0.14), transparent 28%), radial-gradient(circle at bottom right, rgba(99, 102, 241, 0.14), transparent 32%), linear-gradient(180deg, #f8fbff 0%, #eef4ff 100%)' }};
    }

    .chat-panel {
        backdrop-filter: blur(18px);
        background: {{ $isPro ? 'rgba(255, 255, 255, 0.03)' : 'rgba(255, 255, 255, 0.82)' }};
        box-shadow: {{ $isPro ? '0 8px 32px 0 rgba(0, 0, 0, 0.37)' : '0 24px 80px rgba(15, 23, 42, 0.08)' }};
        border: {{ $isPro ? '1px solid rgba(255, 255, 255, 0.1)' : '1px solid rgba(255, 255, 255, 0.7)' }};
    }

    .pro-input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
    }

    .pro-input:focus {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.2);
        box-shadow: none;
    }

    .chat-scrollbar::-webkit-scrollbar {
        width: 6px;
    }

    .chat-scrollbar::-webkit-scrollbar-thumb {
        background: {{ $isPro ? 'rgba(255, 255, 255, 0.1)' : 'rgba(148, 163, 184, 0.45)' }};
        border-radius: 999px;
    }

    .chat-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }

    .message-enter {
        animation: message-in 220ms ease-out;
    }

    @keyframes message-in {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="chat-shell {{ $isPro ? '' : 'min-h-[calc(100vh-4rem)] px-4 py-4 sm:px-6 lg:px-8' }}">
    <div class="mx-auto flex h-[calc(100vh-16rem)] {{ $isPro ? 'max-w-full' : 'max-w-[1700px]' }} flex-col">
        <section class="chat-panel flex min-w-0 flex-1 flex-col overflow-hidden rounded-[32px]">
            <div id="chat-header" class="border-b {{ $isPro ? 'border-white/5' : 'border-slate-200/70' }} px-5 py-5 sm:px-7 {{ $dashboardCollapsed ? 'hidden' : '' }}">
                <div class="flex flex-col gap-5 xl:flex-row xl:items-start xl:justify-between">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="rounded-full {{ $isPro ? 'bg-blue-500/10 text-blue-400' : 'bg-sky-50 text-sky-700' }} px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em]">Active thread</span>
                            <span id="chat-saved-badge" class="rounded-full {{ $isPro ? 'bg-amber-500/10 text-amber-400' : 'bg-amber-50 text-amber-700' }} px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.22em] {{ ($activeConversation && $activeConversation->is_saved) ? '' : 'hidden' }}">Saved</span>
                        </div>

                        <div id="chat-header-active" class="{{ $activeConversation ? '' : 'hidden' }}">
                            <form id="chat-rename-form" method="POST" action="{{ $activeConversation ? route('conversations.update', $activeConversation) : '#' }}" class="mt-4 flex max-w-3xl flex-col gap-3 sm:flex-row">
                                @csrf
                                @method('PATCH')
                                <input
                                    id="chat-title-input"
                                    name="title"
                                    value="{{ old('title', $activeConversation?->title) }}"
                                    class="w-full rounded-2xl {{ $isPro ? 'pro-input' : 'border-slate-200 bg-white/90 focus:border-sky-500 focus:ring-sky-500' }} px-4 py-3 text-base font-semibold shadow-sm"
                                    placeholder="Untitled chat"
                                >
                                <button type="submit" class="rounded-2xl border {{ $isPro ? 'border-white/10 bg-white/5 text-white hover:bg-white/10' : 'border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50' }} px-5 py-3 text-sm font-semibold transition">
                                    Rename
                                </button>
                            </form>
                            <p class="mt-3 text-sm {{ $isPro ? 'text-white/40' : 'text-slate-500' }}">Conversation #<span id="chat-conversation-id">{{ $activeConversation?->id }}</span> · Keep titles specific so retrieval stays organized.</p>
                        </div>
                        <div id="chat-header-empty" class="{{ $activeConversation ? 'hidden' : '' }}">
                            <h2 class="mt-4 text-3xl font-semibold tracking-tight {{ $isPro ? 'text-white' : 'text-slate-950' }}">Start a new conversation</h2>
                            <p class="mt-2 max-w-2xl text-sm leading-6 {{ $isPro ? 'text-white/50' : 'text-slate-500' }}">Ask about a statute, opinion, or administrative issue. Responses will appear here in a cleaner threaded view.</p>
                        </div>
                    </div>

                    <div id="chat-header-actions" class="flex flex-wrap items-center gap-2 {{ $activeConversation ? '' : 'hidden' }}">
                            <form id="chat-save-form" method="POST" action="{{ $activeConversation ? route('conversations.toggle-save', $activeConversation) : '#' }}">
                                @csrf
                                <button id="chat-save-button" type="submit" class="rounded-2xl border {{ $isPro ? 'border-white/10 bg-white/5 text-white hover:bg-white/10' : 'border-slate-200 bg-white text-slate-700 hover:border-slate-300 hover:bg-slate-50' }} px-4 py-3 text-sm font-semibold transition">
                                    {{ $activeConversation && $activeConversation->is_saved ? 'Remove from Saved' : 'Save Conversation' }}
                                </button>
                            </form>
                            <form id="chat-delete-form" method="POST" action="{{ $activeConversation ? route('conversations.destroy', $activeConversation) : '#' }}" onsubmit="return confirm('Delete this conversation?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rounded-2xl border {{ $isPro ? 'border-rose-500/20 bg-rose-500/10 text-rose-400 hover:bg-rose-500/20' : 'border-rose-200 bg-rose-50 text-rose-700 hover:bg-rose-100' }} px-4 py-3 text-sm font-semibold transition">
                                    Delete
                                </button>
                            </form>
                    </div>
                </div>
            </div>

            <div id="chat-scroll" class="chat-scrollbar flex-1 overflow-y-auto px-4 py-5 sm:px-6 lg:px-8">
                @if ($dashboardMode && $dashboardCollapsed)
                    <div id="dashboard-cards" class="mx-auto w-full max-w-6xl pt-2 opacity-100 translate-y-0 transition-all duration-300">
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                            <div class="rounded-2xl bg-blue-500/10 p-6 ring-1 ring-blue-500/20 backdrop-blur-sm">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8 text-blue-400">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.898 20.562L16.5 21.75l-.398-1.188a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.188-.398a2.25 2.25 0 001.423-1.423L16.5 15.75l.398 1.188a2.25 2.25 0 001.423 1.423L19.5 18.75l-1.188.398a2.25 2.25 0 00-1.423 1.423z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold text-white">Legal AI Assistant</h3>
                                </div>
                                <p class="mt-2 text-sm text-white/60">Access the ChatGPT-style legal AI interface for research and drafting.</p>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 backdrop-blur-sm">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold">AI Chatbot</h3>
                                </div>
                                <p class="mt-2 text-sm text-white/60">Create text for ads, emails, and content instantly.</p>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 backdrop-blur-sm">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.898 20.562L16.5 21.75l-.398-1.188a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.188-.398a2.25 2.25 0 001.423-1.423L16.5 15.75l.398 1.188a2.25 2.25 0 001.423 1.423L19.5 18.75l-1.188.398a2.25 2.25 0 00-1.423 1.423z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold">Artwork Generation</h3>
                                </div>
                                <p class="mt-2 text-sm text-white/60">Design unique visuals with AI creativity.</p>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 backdrop-blur-sm">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold">Research</h3>
                                </div>
                                <p class="mt-2 text-sm text-white/60">Find, summarize, and organize info fast.</p>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 backdrop-blur-sm">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold">Generate Article</h3>
                                </div>
                                <p class="mt-2 text-sm text-white/60">Write articles or blogs in seconds.</p>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 backdrop-blur-sm">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v18h16.5V3H3.75zm.75 16.5V4.5h15v15h-15z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold">Data Analytics</h3>
                                </div>
                                <p class="mt-2 text-sm text-white/60">Turn data into clear insights with LYRA AI.</p>
                            </div>
                            <div class="rounded-2xl bg-white/5 p-6 ring-1 ring-white/10 backdrop-blur-sm">
                                <div class="flex items-center gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.5l3 2.25-3 2.25m4.5 0h3m-9 8.25h13.5A2.25 2.25 0 0021 18V6a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 6v12a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                    <h3 class="text-lg font-semibold">Dev Mode</h3>
                                </div>
                                <p class="mt-2 text-sm text-white/60">Generate and refine code effortlessly.</p>
                            </div>
                        </div>
                    </div>
                @elseif ($messages->isEmpty())
                    <div class="flex h-full items-center justify-center">
                        <div class="max-w-2xl rounded-[28px] border border-dashed {{ $isPro ? 'border-white/10 bg-white/5' : 'border-slate-200 bg-white/80' }} px-8 py-10 text-center shadow-sm">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl {{ $isPro ? 'bg-blue-600' : 'bg-slate-950' }} text-lg font-semibold text-white">AI</div>
                            <h3 class="mt-5 text-2xl font-semibold tracking-tight {{ $isPro ? 'text-white' : 'text-slate-950' }}">Ready for legal research</h3>
                            <p class="mt-3 text-sm leading-7 {{ $isPro ? 'text-white/50' : 'text-slate-500' }}">Draft a question below to search DILG materials, clarify administrative rules, or summarize legal guidance in a more polished workspace.</p>
                        </div>
                    </div>
                @else
                    <div data-message-stack="true" class="mx-auto flex w-full max-w-5xl flex-col gap-6">
                        @foreach ($messages as $message)
                            <div class="message-enter {{ $message->role === 'user' ? 'ml-auto max-w-2xl' : 'mr-auto max-w-3xl' }}">
                                <div class="mb-2 flex items-center gap-3 px-1">
                                    <div class="{{ $message->role === 'user' ? ($isPro ? 'bg-blue-600 text-white' : 'bg-slate-950 text-white') : ($isPro ? 'bg-white/10 text-blue-400' : 'bg-sky-100 text-sky-800') }} flex h-9 w-9 items-center justify-center rounded-2xl text-xs font-semibold uppercase tracking-[0.18em]">
                                        {{ $message->role === 'user' ? 'You' : 'AI' }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-semibold {{ $isPro ? 'text-white' : 'text-slate-900' }}">{{ $message->role === 'user' ? 'You' : 'Assistant' }}</div>
                                        <div class="text-xs {{ $isPro ? 'text-white/30' : 'text-slate-400' }}">
                                            {{ $message->created_at->format('M d, Y h:i A') }}
                                            @if ($message->role === 'assistant' && $message->model)
                                                · {{ $message->model }}
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="{{ $message->role === 'user' ? ($isPro ? 'rounded-[28px_28px_8px_28px] bg-blue-600 text-white shadow-lg' : 'rounded-[28px_28px_8px_28px] bg-slate-950 text-white shadow-[0_24px_40px_rgba(15,23,42,0.18)]') : ($isPro ? 'rounded-[28px_28px_28px_8px] border border-white/5 bg-white/5 text-white/90' : 'rounded-[28px_28px_28px_8px] border border-slate-200/80 bg-white text-slate-800 shadow-sm') }} px-5 py-4 sm:px-6">
                                    <div class="whitespace-pre-wrap text-sm leading-7 sm:text-[15px]">{{ $message->content }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="border-t {{ $isPro ? 'border-white/5 bg-white/5' : 'border-slate-200/70 bg-white/70' }} px-4 py-4 sm:px-6 lg:px-8">
                <form
                    id="chat-form"
                    class="mx-auto flex w-full max-w-5xl flex-col gap-3"
                    data-create-url="{{ route('conversations.store') }}"
                    data-messages-url="{{ $activeConversation ? route('messages.store', $activeConversation) : '' }}"
                    data-active-conversation-url="{{ $activeConversation ? route($showRoute ?? 'chat.show', $activeConversation) : '' }}"
                    data-show-base="{{ preg_replace('/0$/', '', route($showRoute ?? 'chat.show', 0)) }}"
                    data-dashboard-mode="{{ $dashboardMode ? '1' : '0' }}"
                    data-preserve-url="{{ $dashboardMode ? '1' : '0' }}"
                >
                    <div class="overflow-hidden rounded-[28px] border {{ $isPro ? 'border-white/10 bg-white/5' : 'border-slate-200 bg-white shadow-[0_14px_40px_rgba(15,23,42,0.06)]' }}">
                        <textarea
                            id="chat-prompt"
                            rows="3"
                            class="w-full resize-none border-0 bg-transparent px-5 py-4 text-[15px] {{ $isPro ? 'text-white placeholder:text-white/30' : 'text-slate-800 placeholder:text-slate-400' }} focus:ring-0"
                            placeholder="Ask about RA 9003, procurement rules, DILG opinions, or draft a legal summary..."
                        ></textarea>
                        <div class="flex flex-col gap-3 border-t {{ $isPro ? 'border-white/5' : 'border-slate-100' }} px-4 py-4 sm:flex-row sm:items-center sm:justify-between">
                            <p class="text-xs uppercase tracking-[0.22em] {{ $isPro ? 'text-white/30' : 'text-slate-400' }}">Shift + Enter for a new line</p>
                            <button id="chat-send" type="submit" class="inline-flex items-center justify-center rounded-2xl {{ $isPro ? 'bg-blue-600 hover:bg-blue-500' : 'bg-slate-950 hover:bg-slate-800' }} px-5 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 disabled:cursor-not-allowed disabled:opacity-50">
                                Send Message
                            </button>
                        </div>
                    </div>
                </form>
                <div id="chat-error" class="mx-auto hidden w-full max-w-5xl rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700"></div>
            </div>
        </section>
    </div>
</div>

<script type="module">
    const form = document.getElementById('chat-form');
    const promptEl = document.getElementById('chat-prompt');
    const sendBtn = document.getElementById('chat-send');
    const scrollEl = document.getElementById('chat-scroll');
    const errorEl = document.getElementById('chat-error');
    const isPro = @json($isPro);
    const isDashboard = form.dataset.dashboardMode === '1';
    const preserveUrl = form.dataset.preserveUrl === '1';
    const showBase = form.dataset.showBase || '';
    const headerEl = document.getElementById('chat-header');
    const headerActiveEl = document.getElementById('chat-header-active');
    const headerEmptyEl = document.getElementById('chat-header-empty');
    const headerActionsEl = document.getElementById('chat-header-actions');
    const savedBadgeEl = document.getElementById('chat-saved-badge');
    const renameFormEl = document.getElementById('chat-rename-form');
    const titleInputEl = document.getElementById('chat-title-input');
    const conversationIdEl = document.getElementById('chat-conversation-id');
    const saveFormEl = document.getElementById('chat-save-form');
    const saveButtonEl = document.getElementById('chat-save-button');
    const deleteFormEl = document.getElementById('chat-delete-form');
    const dashboardCardsEl = document.getElementById('dashboard-cards');
    let dashboardTransitioned = false;

    const buildConversationUrls = (conversationId) => {
        const base = (form.dataset.createUrl || '').replace(/\/$/, '');
        const updateUrl = `${base}/${conversationId}`;
        const messagesUrl = `${updateUrl}/messages`;
        const showUrl = showBase ? `${showBase}${conversationId}` : (form.dataset.activeConversationUrl || '');
        const toggleSaveUrl = `${updateUrl}/toggle-save`;
        return { updateUrl, messagesUrl, showUrl, toggleSaveUrl };
    };

    const setActiveConversationHeader = (conversationId, titleSeed) => {
        if (!headerEl) return;

        headerEl.classList.remove('hidden');
        headerEmptyEl?.classList.add('hidden');
        headerActiveEl?.classList.remove('hidden');
        headerActionsEl?.classList.remove('hidden');

        if (savedBadgeEl) savedBadgeEl.classList.add('hidden');
        if (saveButtonEl) saveButtonEl.textContent = 'Save Conversation';

        if (conversationIdEl) conversationIdEl.textContent = String(conversationId);
        if (titleInputEl && typeof titleSeed === 'string') {
            titleInputEl.value = titleSeed;
        }

        const urls = buildConversationUrls(conversationId);
        if (renameFormEl) renameFormEl.action = urls.updateUrl;
        if (saveFormEl) saveFormEl.action = urls.toggleSaveUrl;
        if (deleteFormEl) deleteFormEl.action = urls.updateUrl;
    };

    const hideDashboardCards = () => {
        if (!isDashboard || dashboardTransitioned || !dashboardCardsEl) return;
        dashboardTransitioned = true;
        dashboardCardsEl.classList.add('opacity-0', 'translate-y-2', 'pointer-events-none');
        setTimeout(() => {
            dashboardCardsEl.classList.add('hidden');
        }, 280);
    };

    const renderMessage = (role, content) => {
        const container = document.createElement('div');
        container.className = 'message-enter ' + (role === 'user' ? 'ml-auto max-w-2xl' : 'mr-auto max-w-3xl');

        const meta = document.createElement('div');
        meta.className = 'mb-2 flex items-center gap-3 px-1';

        const avatar = document.createElement('div');
        if (isPro) {
            avatar.className = (role === 'user'
                ? 'bg-blue-600 text-white'
                : 'bg-white/10 text-blue-400') + ' flex h-9 w-9 items-center justify-center rounded-2xl text-xs font-semibold uppercase tracking-[0.18em]';
        } else {
            avatar.className = (role === 'user'
                ? 'bg-slate-950 text-white'
                : 'bg-sky-100 text-sky-800') + ' flex h-9 w-9 items-center justify-center rounded-2xl text-xs font-semibold uppercase tracking-[0.18em]';
        }
        avatar.textContent = role === 'user' ? 'You' : 'AI';

        const metaText = document.createElement('div');

        const label = document.createElement('div');
        label.className = 'text-sm font-semibold ' + (isPro ? 'text-white' : 'text-slate-900');
        label.textContent = role === 'user' ? 'You' : 'Assistant';

        const stamp = document.createElement('div');
        stamp.className = 'text-xs ' + (isPro ? 'text-white/30' : 'text-slate-400');
        stamp.textContent = new Date().toLocaleString([], {
            month: 'short',
            day: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
        });

        metaText.appendChild(label);
        metaText.appendChild(stamp);
        meta.appendChild(avatar);
        meta.appendChild(metaText);

        const bubble = document.createElement('div');
        if (isPro) {
            bubble.className = (role === 'user'
                ? 'rounded-[28px_28px_8px_28px] bg-blue-600 text-white shadow-lg'
                : 'rounded-[28px_28px_28px_8px] border border-white/5 bg-white/5 text-white/90') + ' px-5 py-4 sm:px-6';
        } else {
            bubble.className = (role === 'user'
                ? 'rounded-[28px_28px_8px_28px] bg-slate-950 text-white shadow-[0_24px_40px_rgba(15,23,42,0.18)]'
                : 'rounded-[28px_28px_28px_8px] border border-slate-200/80 bg-white text-slate-800 shadow-sm') + ' px-5 py-4 sm:px-6';
        }

        const body = document.createElement('div');
        body.className = 'whitespace-pre-wrap text-sm leading-7 sm:text-[15px]';
        body.textContent = content;

        bubble.appendChild(body);
        container.appendChild(meta);
        container.appendChild(bubble);

        let stack = scrollEl.querySelector('[data-message-stack]');
        if (!stack) {
            scrollEl.innerHTML = '';
            stack = document.createElement('div');
            stack.dataset.messageStack = 'true';
            stack.className = 'mx-auto flex w-full max-w-5xl flex-col gap-6';
            scrollEl.appendChild(stack);
        }

        stack.appendChild(container);
        return container;
    };

    const scrollToBottom = () => {
        scrollEl.scrollTop = scrollEl.scrollHeight;
    };

    const ensureConversation = async (titleSeed) => {
        const existingUrl = form.dataset.activeConversationUrl;
        const existingMessagesUrl = form.dataset.messagesUrl;

        if (existingUrl && existingMessagesUrl) {
            return { url: existingUrl, messagesUrl: existingMessagesUrl, id: null };
        }

        const resp = await window.axios.post(form.dataset.createUrl, {}, { headers: { Accept: 'application/json' } });
        const conversationId = resp.data.id;
        const showUrl = showBase ? `${showBase}${conversationId}` : resp.data.url;
        form.dataset.activeConversationUrl = showUrl;
        form.dataset.messagesUrl = resp.data.messages_url;

        if (!preserveUrl) {
            window.history.replaceState({}, '', showUrl);
        }

        if (conversationId) {
            setActiveConversationHeader(conversationId, titleSeed);
        }

        return { url: showUrl, messagesUrl: resp.data.messages_url, id: conversationId };
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        errorEl.classList.add('hidden');
        errorEl.textContent = '';

        const prompt = (promptEl.value || '').trim();
        if (!prompt) return;

        sendBtn.disabled = true;
        promptEl.disabled = true;

        if (isDashboard) {
            hideDashboardCards();
            headerEl?.classList.remove('hidden');
        }

        renderMessage('user', prompt);
        promptEl.value = '';
        scrollToBottom();

        try {
            const titleSeed = prompt.length > 60 ? prompt.slice(0, 60) : prompt;
            const conv = await ensureConversation(titleSeed);
            const resp = await window.axios.post(conv.messagesUrl, { prompt }, { headers: { Accept: 'application/json' } });
            renderMessage('assistant', resp.data.assistant_message.content);
            scrollToBottom();
        } catch (err) {
            const message = err?.response?.data?.message || 'Something went wrong while contacting the AI provider.';
            errorEl.textContent = message;
            errorEl.classList.remove('hidden');
        } finally {
            sendBtn.disabled = false;
            promptEl.disabled = false;
            promptEl.focus();
        }
    });

    promptEl.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            form.requestSubmit();
        }
    });

    scrollToBottom();
</script>
