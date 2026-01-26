<header class="sticky top-0 z-50 gradient-bg text-white shadow-lg">
    <nav class="border-gray-200 px-4 lg:px-6 py-3">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center">
                <div class="bg-white p-2 rounded-lg mr-3">
                    <i data-lucide="pen-square" class="w-8 h-8 text-indigo-600"></i>
                </div>
                <span class="self-center text-xl font-semibold whitespace-nowrap">My Company</span>
            </a>

            <!-- Search Bar -->
            <div class="hidden lg:flex items-center w-1/3">
                <form class="w-full">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i data-lucide="search" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="text" id="search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 p-2.5"
                            placeholder="Search posts, users, topics..." required>
                    </div>
                </form>
            </div>

            
            {{-- settings --}}
            <a href="{{ route('settings') }}">
                <i data-lucide="settings" class="w-6 h-6"></i>
            </a>

            <!-- User Menu -->
            <div class="flex items-center lg:order-2">
                <!-- Notification Bell -->
                <button type="button"
                    class="p-2 mr-2 text-gray-100 rounded-lg hover:bg-indigo-500 hover:bg-opacity-30 focus:outline-none focus:ring-2 focus:ring-gray-200 relative">
                    <i data-lucide="bell" class="w-6 h-6"></i>
                    <span
                        class="absolute top-1 right-1 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">3</span>
                </button>

                <!-- Create Post Button -->
                <a href="{{ route('posts.create') }}" id="createPostBtn"
                    class="text-white bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-3 mb-2 pulse-animation">
                    <span class="flex items-center">
                        <i data-lucide="plus" class="w-5 h-5 mr-1"></i>
                        New Post
                    </span>
                </a>

                <!-- User Avatar -->
                <button type="button"
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 hover-lift"
                    id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="font-medium text-white">M</span>
                </button>

                <!-- Dropdown menu -->
                <div class="hidden z-50 my-4 text-base list-none bg-white rounded divide-y divide-gray-100 shadow"
                    id="user-dropdown">
                    <div class="py-3 px-4">
                        <span class="block text-sm text-gray-900">Michael Chen</span>
                        <span class="block text-sm font-medium text-gray-500 truncate">michael@example.com</span>
                    </div>
                    <ul class="py-1" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#"
                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                <i data-lucide="user" class="w-4 h-4 mr-2"></i>
                                My Profile
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
                                My Posts
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                <i data-lucide="settings" class="w-4 h-4 mr-2"></i>
                                Settings
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('logout-current') }}"
                                class="py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 flex items-center">
                                <i data-lucide="log-out" class="w-4 h-4 mr-2"></i>
                                Sign out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>