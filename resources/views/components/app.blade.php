<x-master>
    <section>
        <header class="container mx-auto my-6">
            <img class="w-20" src="/images/twitter-logo.png" alt="logo">
        </header>
    </section>
    <section>
        <main class="container mx-auto">
            <div class="lg:flex lg:justify-between">
                <div class="lg:w-32">
                    @include('_sidebar-links')
                </div>
                {{$slot}}
                <div class="lg:w-1/6 bg-blue-100 rounded-lg p-4">
                    @include('_friends-list')
                </div>
            </div>
        </main>
    </section>
</x-master>
