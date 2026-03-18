<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @if (file_exists(public_path('hot')) || file_exists(public_path('build/manifest.json')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <style>
            @media (min-width: 1024px) {
                .admin-content {
                    zoom: 0.8;
                }
            }
        </style>
    </head>
<<<<<<< HEAD
    <body class="font-sans antialiased selection:bg-purple-500/30 selection:text-purple-200">
        <div class="admin-shell h-screen bg-[#0b0b1a] text-slate-200 overflow-hidden relative">
            <div class="admin-content mx-auto flex h-full max-w-[1600px] flex-col px-4 py-6 lg:px-8">
                <!-- Top Header -->
                <header class="flex items-center justify-between mb-8 px-4">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-800/50 ring-1 ring-white/10 overflow-hidden">
                            <img
                                src="https://upload.wikimedia.org/wikipedia/commons/c/c9/Department_of_the_Interior_and_Local_Government_%28DILG%29_Seal_-_Logo.svg"
                                alt="DILG Seal"
                                class="h-full w-full object-contain"
                            >
                        </div>
                        <span class="text-xl font-bold tracking-tight text-white">DILG AI Law-Assist</span>
                    </div>

                    <div class="flex items-center gap-3">
                        
                        <button class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-800/50 text-slate-400 ring-1 ring-white/10 hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                            </svg>
                        </button>
                        <button class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-800/50 text-slate-400 ring-1 ring-white/10 hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h17.25" />
                            </svg>
                        </button>
                        <button class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-800/50 text-slate-400 ring-1 ring-white/10 hover:text-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.438.995a6.19 6.19 0 010 1.902c0 .382.145.755.438.995l1.003.827c.424.35.534.954.26 1.431l-1.296 2.247a1.125 1.125 0 01-1.37.49l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.645-.87a6.52 6.52 0 01-.22-.127c-.324-.196-.72-.257-1.075-.124l-1.217.456a1.125 1.125 0 01-1.37-.49l-1.296-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.437-.995a6.19 6.19 0 010-1.902c0-.382-.145-.755-.437-.995l-1.004-.827a1.125 1.125 0 01-.26-1.431l1.296-2.247a1.125 1.125 0 011.37-.49l1.217.456c.355.133.75.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </button>
                    </div>
                </header>

                <div class="grid flex-1 min-h-0 grid-cols-1 gap-8 lg:grid-cols-[280px_1fr]">
                    <aside class="flex min-h-0 flex-col overflow-hidden rounded-[2rem] bg-[#13132b] p-6 shadow-2xl">
                        @php
                            $activeConversationId = optional(request()->route('conversation'))->id;
                            $sidebarChats = auth()->user()
                                ? auth()->user()->conversations()
                                    ->orderByDesc('last_message_at')
                                    ->orderByDesc('id')
                                    ->limit(10)
                                    ->get()
                                : collect();
                        @endphp
                        <nav class="shrink-0 space-y-3">
                            <a href="{{ route('admin.legal.ai.new') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-slate-400 hover:text-white hover:bg-white/[0.03] ring-1 ring-transparent hover:ring-white/10">
                                <div class="flex h-6 w-6 items-center justify-center rounded bg-amber-500/20 text-amber-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                </div>
                                <span class="text-sm font-medium">New Chat</span>
                            </a>

                            <a href="{{ route('admin.opinions.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ request()->routeIs('admin.opinions.*') ? 'bg-slate-800/50 text-white' : 'text-slate-400 hover:text-white' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 opacity-60">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                                </svg>
                                <span class="text-sm font-medium">Opinions Library</span>
                            </a>

                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-5 w-5 opacity-60">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                </svg>
                                <span class="text-sm font-medium">Archive</span>
                            </a>
                        </nav>

                        <div class="mt-6 flex min-h-0 flex-1 flex-col">
                            <button id="sidebar-chats-toggle" type="button" class="flex items-center justify-between px-4 py-2 text-left">
                                <div class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-600">Your Chats</div>
                                <svg id="sidebar-chats-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="h-4 w-4 text-slate-600 transition-transform duration-200">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>

                            <div id="sidebar-chats-panel" class="mt-3 min-h-0 flex-1 overflow-hidden">
                                <div id="sidebar-chats-scroll" class="h-full overflow-y-auto px-2 pr-1">
                                    <div class="space-y-1.5">
                                        @forelse ($sidebarChats as $conversation)
                                            <a href="{{ route('admin.legal.ai.show', $conversation) }}" class="block rounded-xl border px-4 py-3 transition-all {{ $activeConversationId === $conversation->id ? 'border-indigo-500/30 bg-indigo-600/10 text-white ring-1 ring-indigo-500/20' : 'border-white/5 bg-white/[0.02] text-slate-400 hover:border-white/10 hover:bg-white/[0.04] hover:text-slate-200' }}">
                                                <div class="truncate text-sm font-semibold tracking-tight">
                                                    {{ $conversation->title ?: 'Untitled Thread' }}
                                                </div>
                                            </a>
                                        @empty
                                            <div class="px-4 py-3 text-xs font-bold text-slate-600 uppercase tracking-widest">
                                                No chats yet
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="shrink-0 mt-6 space-y-4">
                            <a href="#" class="flex items-center gap-3 px-4 py-2 text-slate-400 hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4 opacity-60">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.438.995a6.19 6.19 0 010 1.902c0 .382.145.755.438.995l1.003.827c.424.35.534.954.26 1.431l-1.296 2.247a1.125 1.125 0 01-1.37.49l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.645-.87a6.52 6.52 0 01-.22-.127c-.324-.196-.72-.257-1.075-.124l-1.217.456a1.125 1.125 0 01-1.37-.49l-1.296-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.437-.995a6.19 6.19 0 010-1.902c0-.382-.145-.755-.437-.995l-1.004-.827a1.125 1.125 0 01-.26-1.431l1.296-2.247a1.125 1.125 0 011.37-.49l1.217.456c.355.133.75.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                </svg>
                                <span class="text-xs font-medium">Settings</span>
                            </a>

                            <div class="relative px-2 py-4">
                                <div id="sidebar-profile-menu" class="absolute bottom-full left-2 right-2 mb-3 hidden overflow-hidden rounded-2xl bg-slate-950/90 ring-1 ring-white/10 backdrop-blur-xl shadow-[0_24px_70px_rgba(0,0,0,0.55)]">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-200 hover:bg-white/5 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4 text-slate-300">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 20.118a7.5 7.5 0 0115 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.5-1.632z" />
                                        </svg>
                                        <span>Profile Settings</span>
                                    </a>
                                    <div class="h-px bg-white/10"></div>
                                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-semibold text-rose-200 hover:bg-rose-500/10 transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4 text-rose-200">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9l3 3m0 0l-3 3m3-3H8.25" />
                                            </svg>
                                            <span>Logout</span>
                                        </button>
                                    </form>
                                </div>

                                <button id="sidebar-profile-trigger" type="button" class="w-full flex items-center gap-3 rounded-2xl px-2 py-2 hover:bg-white/[0.04] transition">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff" alt="User Avatar" class="h-10 w-10 rounded-xl shadow-lg">
                                    <div class="min-w-0 flex-1 text-left">
                                        <div class="truncate text-sm font-bold text-white">{{ auth()->user()->name }}</div>
                                        <div class="truncate text-[10px] font-medium text-slate-500">{{ auth()->user()->email }}</div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4 text-slate-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
=======
    <body class="font-sans antialiased">
        <div class="admin-shell min-h-screen bg-[#0f172a] text-white">
            <div class="mx-auto max-w-[1400px] px-4 py-6 lg:px-8">
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-[280px_1fr]">
                    <aside class="admin-panel flex flex-col h-[calc(100vh-2rem)] sticky top-4 rounded-3xl p-4 bg-[#171717] ring-1 ring-white/10 shadow-2xl transition-all duration-300">
                        <!-- Sidebar Header: New Chat -->
                        <div class="mb-4">
                            <form action="{{ route('conversations.store') }}" method="POST">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-white hover:bg-white/5 transition-all">
                                    <div class="flex h-7 w-7 items-center justify-center rounded-lg bg-white/10 ring-1 ring-white/20">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                        </svg>
                                    </div>
                                    <span>New chat</span>
                                    <div class="ml-auto opacity-40">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </div>
                                </button>
                            </form>
                        </div>

                        <!-- Sidebar Nav: Main Items -->
                        <nav class="space-y-1">
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }} transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 opacity-80">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                </svg>
                                <span>Search chats</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium text-white/60 hover:bg-white/5 hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 opacity-80">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <span>Images</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium text-white/60 hover:bg-white/5 hover:text-white transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 opacity-80">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                                </svg>
                                <span>Apps</span>
                            </a>
                            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-white/10 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }} transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 opacity-80">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0l8.954 8.955M2.25 12l8.954 8.955a1.5 1.5 0 002.122 0l8.954-8.955M2.25 12h19.5" />
                                </svg>
                                <span>Dashboard</span>
                            </a>
                            <a href="{{ route('admin.legal.ai') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.legal.ai*') ? 'bg-white/10 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }} transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 opacity-80">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z" />
                                </svg>
                                <span>Legal AI Chat</span>
                            </a>

                            <a href="{{ route('admin.laws.index') }}" class="flex items-center gap-3 rounded-xl px-3 py-2 text-sm font-medium {{ request()->routeIs('admin.laws.index') ? 'bg-white/10 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }} transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 opacity-80">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0z" />
                                </svg>
                                <span>Manage Laws</span>
                            </a>
                        </nav>

                        <!-- Sidebar Body: History -->
                        <div class="mt-8 flex-1 overflow-y-auto scrollbar-hide">
                            <h3 class="px-3 text-[11px] font-bold text-white/40 uppercase tracking-widest mb-4">Your chats</h3>
                            <div class="space-y-1">
                                @isset($sidebarConversations)
                                    @foreach($sidebarConversations as $sidebarConv)
                                        <a href="{{ route('admin.legal.ai.show', $sidebarConv) }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium {{ (isset($activeConversation) && $activeConversation->id === $sidebarConv->id) ? 'bg-white/10 text-white' : 'text-white/60 hover:bg-white/5 hover:text-white' }} transition-all truncate">
                                            <span class="truncate">{{ $sidebarConv->title ?: 'Untitled chat' }}</span>
                                        </a>
                                    @endforeach
                                @endisset
>>>>>>> 34036aaff8a4409a974abde8df238722cec97ddb
                            </div>
                        </div>

                        <!-- Sidebar Footer: Profile -->
                        <div class="mt-auto pt-4 border-t border-white/10 relative" x-data="{ open: false }">
                            <!-- Dropdown Menu -->
                            <div x-show="open" 
                                 x-on:click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="transform opacity-0 translate-y-2 scale-95"
                                 x-transition:enter-end="transform opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="transform opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="transform opacity-0 translate-y-2 scale-95"
                                 class="absolute bottom-full left-0 w-full mb-4 bg-[#1e1e1e] border border-white/10 rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.5)] z-[100] overflow-hidden p-1.5"
                                 style="display: none;">
                                <div class="px-3 py-2 border-b border-white/5 mb-1.5">
                                    <p class="text-[10px] font-bold text-white/30 uppercase tracking-widest">Account Actions</p>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-white/70 hover:bg-white/10 rounded-xl transition-all group">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-white/5 ring-1 ring-white/10 group-hover:bg-blue-500/20 group-hover:ring-blue-500/30 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-white/50 group-hover:text-blue-400">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                        </svg>
                                    </div>
                                    <span class="font-medium">Profile Settings</span>
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center gap-3 px-3 py-2.5 text-sm text-rose-400 hover:bg-rose-500/10 rounded-xl transition-all group">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-500/5 ring-1 ring-rose-500/10 group-hover:bg-rose-500/20 transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-rose-500/50 group-hover:text-rose-400">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                            </svg>
                                        </div>
                                        <span class="font-medium">Logout</span>
                                    </button>
                                </form>
                            </div>

                            <button x-on:click="open = !open" 
                                    class="flex w-full items-center gap-3 rounded-xl bg-white/5 p-3 ring-1 ring-white/10 group cursor-pointer hover:bg-white/10 transition-all text-left">
                                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-500 text-xs font-bold text-white shrink-0">
                                    {{ substr(auth()->user()->name, 0, 2) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <div class="truncate text-sm font-bold text-white">{{ auth()->user()->name }}</div>
                                    <div class="truncate text-[11px] font-medium text-white/40">Personal account</div>
                                </div>
                                <div class="opacity-40 group-hover:opacity-100 transition-opacity shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="h-4 w-4" :class="{'rotate-180': open}">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                    </svg>
                                </div>
                            </button>
                        </div>
                    </aside>

<<<<<<< HEAD
                    <main class="min-w-0 min-h-0 {{ request()->routeIs('admin.legal.ai*') ? 'flex flex-col overflow-hidden' : 'overflow-y-auto' }}">
                        {{ $slot }}
=======
                    <main class="admin-panel rounded-3xl p-6 bg-white/5 backdrop-blur-sm ring-1 ring-white/10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.898 20.562L16.5 21.75l-.398-1.188a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.188-.398a2.25 2.25 0 001.423-1.423L16.5 15.75l.398 1.188a2.25 2.25 0 001.423 1.423L19.5 18.75l-1.188.398a2.25 2.25 0 00-1.423 1.423z" />
                                </svg>
                                <h1 class="text-xl font-semibold">Hi, {{ auth()->user()->name }}! I'm LOVELOVE, your intelligent assistant.</h1>
                            </div>
                            <button class="inline-flex items-center justify-center rounded-xl bg-blue-500/50 px-4 py-2 text-sm font-semibold text-white ring-1 ring-blue-400/50 hover:bg-blue-500/70">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                                Upgrade
                            </button>
                        </div>

                        <div class="mt-2 text-sm text-white/60">Start a conversation, ask questions, or explore what I can help you with today.</div>

                        <div class="mt-6">
                            {{ $slot }}
                        </div>
>>>>>>> 34036aaff8a4409a974abde8df238722cec97ddb
                    </main>
                </div>
            </div>
        </div>
<<<<<<< HEAD
        <script type="module">
            const toggle = document.getElementById('sidebar-chats-toggle');
            const chevron = document.getElementById('sidebar-chats-chevron');
            const panel = document.getElementById('sidebar-chats-panel');

            if (toggle && chevron && panel) {
                let expanded = true;
                const wrapper = toggle.parentElement;

                const setExpanded = (next) => {
                    expanded = next;
                    chevron.classList.toggle('rotate-180', expanded);

                    const available = wrapper ? Math.max(0, wrapper.clientHeight - toggle.offsetHeight - 12) : 0;
                    panel.style.height = expanded ? `${available}px` : '0px';
                    panel.style.opacity = expanded ? '1' : '0';
                    panel.style.pointerEvents = expanded ? 'auto' : 'none';
                };

                panel.style.transition = 'height 200ms ease, opacity 200ms ease';
                setExpanded(true);

                toggle.addEventListener('click', () => {
                    setExpanded(!expanded);
                });

                if (wrapper) {
                    const ro = new ResizeObserver(() => {
                        if (expanded) {
                            const available = Math.max(0, wrapper.clientHeight - toggle.offsetHeight - 12);
                            panel.style.height = `${available}px`;
                        }
                    });
                    ro.observe(wrapper);
                }
            }

            const profileTrigger = document.getElementById('sidebar-profile-trigger');
            const profileMenu = document.getElementById('sidebar-profile-menu');

            if (profileTrigger && profileMenu) {
                let open = false;

                const setOpen = (next) => {
                    open = next;
                    profileMenu.classList.toggle('hidden', !open);
                    profileTrigger.setAttribute('aria-expanded', open ? 'true' : 'false');
                };

                setOpen(false);

                profileTrigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    setOpen(!open);
                });

                document.addEventListener('click', (e) => {
                    if (!open) return;
                    if (profileMenu.contains(e.target) || profileTrigger.contains(e.target)) return;
                    setOpen(false);
                });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') setOpen(false);
                });
            }
        </script>
=======
>>>>>>> 34036aaff8a4409a974abde8df238722cec97ddb
    </body>
</html>

