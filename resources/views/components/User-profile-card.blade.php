<div class="bg-white rounded-xl shadow-md hover-lift overflow-hidden fade-in">
    <div class="gradient-bg h-24"></div>
    <div class="px-6 pb-6 relative">
        <div class="flex justify-center">
            <div
                class="rounded-full border-4 border-white -mt-12 w-24 h-24 bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center text-white text-3xl font-bold">
                M
            </div>
        </div>
        <div class="text-center mt-4">
            <h2 class="text-xl font-bold text-gray-800">{{ auth()->user()->name }}</h2>
            <p class="text-gray-500 text-sm">{{'@' . Str::substr(auth()->user()->email, 0, Str::position(auth()->user()->email, '@')) }}</p>
            <p class="text-gray-600 mt-2">{{ Str::upper(implode(', ', auth()->user()->roles)) }}</p>
        </div>
        <div class="grid grid-cols-3 gap-4 mt-6 text-center">
            <div>
                <p class="text-xl font-bold text-gray-800">{{ session('user_posts_count') }}</p>
                <p class="text-gray-500 text-sm">Posts</p>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-800">2.4K</p>
                <p class="text-gray-500 text-sm">Followers</p>
            </div>
            <div>
                <p class="text-xl font-bold text-gray-800">356</p>
                <p class="text-gray-500 text-sm">Following</p>
            </div>
        </div>
        <div class="mt-6">
            <button
                class="w-full gradient-border py-2 px-4 rounded-lg text-indigo-600 font-medium hover:bg-indigo-50 transition-colors flex items-center justify-center">
                <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                Edit Profile
            </button>
        </div>
    </div>
</div>