<x-admin-layout>
    @include('chat.partials.chat-interface', [
        'indexRoute' => 'admin.dashboard',
        'savedRoute' => 'admin.legal.ai.saved',
        'showRoute' => 'admin.legal.ai.show',
        'theme' => 'pro',
        'dashboardMode' => true,
    ])
</x-admin-layout>
