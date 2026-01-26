@extends('layout.settings')

@section('title', 'App Settings')

@section('main-content')



    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    <i class="fas fa-cogs text-purple-600 mr-2"></i> Settings
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Manage your account settings and preferences
                </p>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ url('/dashboard') }}"
                    class="ml-3 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Dashboard
                </a>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <div class="w-full lg:w-64 flex-shrink-0">
                <nav class="space-y-1 bg-white rounded-lg shadow p-4">
                    <a href="#" onclick="showTab('profile')" id="profile-tab"
                        class="sidebar-link group flex items-center px-3 py-2 text-sm font-medium rounded-md transition active">
                        <i class="fas fa-user-circle text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0"></i>
                        <span class="truncate">Profile Settings</span>
                    </a>

                    <a href="#" onclick="showTab('account')" id="account-tab"
                        class="sidebar-link group flex items-center px-3 py-2 text-sm font-medium rounded-md transition">
                        <i class="fas fa-user-cog text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0"></i>
                        <span class="truncate">Account Settings</span>
                    </a>

                    <a href="#" onclick="showTab('notifications')" id="notifications-tab"
                        class="sidebar-link group flex items-center px-3 py-2 text-sm font-medium rounded-md transition">
                        <i class="fas fa-bell text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0"></i>
                        <span class="truncate">Notifications</span>
                    </a>

                    <a href="#" onclick="showTab('security')" id="security-tab"
                        class="sidebar-link group flex items-center px-3 py-2 text-sm font-medium rounded-md transition">
                        <i class="fas fa-shield-alt text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0"></i>
                        <span class="truncate">Security</span>
                    </a>

                    <a href="#" onclick="showTab('privacy')" id="privacy-tab"
                        class="sidebar-link group flex items-center px-3 py-2 text-sm font-medium rounded-md transition">
                        <i class="fas fa-lock text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0"></i>
                        <span class="truncate">Privacy</span>
                    </a>

                    <a href="#" onclick="showTab('billing')" id="billing-tab"
                        class="sidebar-link group flex items-center px-3 py-2 text-sm font-medium rounded-md transition">
                        <i class="fas fa-credit-card text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0"></i>
                        <span class="truncate">Billing</span>
                    </a>

                    <a href="#" onclick="showTab('appearance')" id="appearance-tab"
                        class="sidebar-link group flex items-center px-3 py-2 text-sm font-medium rounded-md transition">
                        <i class="fas fa-palette text-gray-400 group-hover:text-gray-500 mr-3 flex-shrink-0"></i>
                        <span class="truncate">Appearance</span>
                    </a>
                </nav>

                <!-- Settings Status Card -->
                <div class="mt-6 bg-gradient-to-r from-purple-500 to-pink-500 rounded-lg shadow p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm opacity-90">Settings Updated</p>
                            <p class="text-2xl font-bold">
                                {{ \Carbon\Carbon::parse(Auth::user()->updated_at)->diffForHumans() }}
                            </p>
                        </div>
                        <i class="fas fa-check-circle text-3xl opacity-75"></i>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-green-400"></i>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Profile Settings Tab -->
                <div id="profile" class="tab-content active">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                <i class="fas fa-user-circle mr-2"></i> Profile Settings
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Update your personal information and profile details.
                            </p>

                            <form action="{{ route('settings.profile.update') }}" method="POST" class="mt-6 space-y-6"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Profile Picture -->
                                <div>
                                    <div class="flex items-center">
                                        <div class="mr-4">
                                            <img id="avatar-preview"
                                                class="h-24 w-24 rounded-full object-cover border-4 border-gray-200"
                                                src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&size=96&background=667eea&color=fff' }}"
                                                alt="{{ Auth::user()->name }}">
                                        </div>
                                        <div>
                                            <label class="block">
                                                <span class="sr-only">Choose profile photo</span>
                                                <input type="file" name="avatar" id="avatar"
                                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100"
                                                    accept="image/*" onchange="previewImage(event)">
                                            </label>
                                            <p class="mt-1 text-xs text-gray-500">JPG, PNG or GIF. Max size 2MB.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <!-- Name -->
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Full
                                            Name</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ old('name', Auth::user()->name) }}"
                                            class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Email -->
                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email
                                            Address</label>
                                        <input type="email" name="email" id="email"
                                            value="{{ old('email', Auth::user()->email) }}"
                                            class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Bio -->
                                    <div class="sm:col-span-2">
                                        <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                                        <textarea id="bio" name="bio" rows="3"
                                            class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('bio', Auth::user()->bio) }}</textarea>
                                        <p class="mt-2 text-sm text-gray-500">Brief description for your profile.</p>
                                    </div>

                                    <!-- Website -->
                                    <div>
                                        <label for="website" class="block text-sm font-medium text-gray-700">Website</label>
                                        <input type="url" name="website" id="website"
                                            value="{{ old('website', Auth::user()->website) }}"
                                            class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <!-- Location -->
                                    <div>
                                        <label for="location"
                                            class="block text-sm font-medium text-gray-700">Location</label>
                                        <input type="text" name="location" id="location"
                                            value="{{ old('location', Auth::user()->location) }}"
                                            class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>
                                </div>

                                <div class="pt-5">
                                    <div class="flex justify-end">
                                        <button type="button" onclick="resetProfileForm()"
                                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            Reset
                                        </button>
                                        <button type="submit"
                                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            Save Changes
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Account Settings Tab -->
                <div id="account" class="tab-content">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                <i class="fas fa-user-cog mr-2"></i> Account Settings
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Manage your account preferences and settings.
                            </p>

                            <form action="{{ route('settings.account.update') }}" method="POST" class="mt-6 space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="space-y-4">
                                    <!-- Language -->
                                    <div>
                                        <label for="language"
                                            class="block text-sm font-medium text-gray-700">Language</label>
                                        <select id="language" name="language"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-md">
                                            <option value="en" {{ Auth::user()->language == 'en' ? 'selected' : '' }}>
                                                English</option>
                                            <option value="es" {{ Auth::user()->language == 'es' ? 'selected' : '' }}>
                                                Spanish</option>
                                            <option value="fr" {{ Auth::user()->language == 'fr' ? 'selected' : '' }}>
                                                French</option>
                                            <option value="de" {{ Auth::user()->language == 'de' ? 'selected' : '' }}>
                                                German</option>
                                        </select>
                                    </div>

                                    <!-- Timezone -->
                                    <div>
                                        <label for="timezone"
                                            class="block text-sm font-medium text-gray-700">Timezone</label>
                                        <select id="timezone" name="timezone"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-md">
                                            <option value="UTC" {{ Auth::user()->timezone == 'UTC' ? 'selected' : '' }}>
                                                UTC</option>
                                            <option value="America/New_York" {{ Auth::user()->timezone == 'America/New_York' ? 'selected' : '' }}>Eastern
                                                Time</option>
                                            <option value="America/Chicago" {{ Auth::user()->timezone == 'America/Chicago' ? 'selected' : '' }}>Central Time</option>
                                            <option value="America/Denver" {{ Auth::user()->timezone == 'America/Denver' ? 'selected' : '' }}>Mountain Time</option>
                                            <option value="America/Los_Angeles" {{ Auth::user()->timezone == 'America/Los_Angeles' ? 'selected' : '' }}>
                                                Pacific Time</option>
                                        </select>
                                    </div>

                                    <!-- Date Format -->
                                    <div>
                                        <label for="date_format" class="block text-sm font-medium text-gray-700">Date
                                            Format</label>
                                        <select id="date_format" name="date_format"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-md">
                                            <option value="Y-m-d" {{ Auth::user()->date_format == 'Y-m-d' ? 'selected' : '' }}>YYYY-MM-DD</option>
                                            <option value="m/d/Y" {{ Auth::user()->date_format == 'm/d/Y' ? 'selected' : '' }}>MM/DD/YYYY</option>
                                            <option value="d/m/Y" {{ Auth::user()->date_format == 'd/m/Y' ? 'selected' : '' }}>DD/MM/YYYY</option>
                                            <option value="F j, Y" {{ Auth::user()->date_format == 'F j, Y' ? 'selected' : '' }}>Month Day, Year</option>
                                        </select>
                                    </div>

                                    <!-- Account Status -->
                                    <div class="pt-4 border-t border-gray-200">
                                        <div class="flex items-center">
                                            <input id="account_active" name="account_active" type="checkbox" {{ Auth::user()->is_active ? 'checked' : '' }}
                                                class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                            <label for="account_active" class="ml-2 block text-sm text-gray-900">
                                                Account Active
                                            </label>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-500">Deactivate your account temporarily</p>
                                    </div>
                                </div>

                                <div class="pt-5">
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            Update Account Settings
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Notifications Tab -->
                <div id="notifications" class="tab-content">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                <i class="fas fa-bell mr-2"></i> Notification Settings
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Configure how you receive notifications.
                            </p>

                            <form action="{{ route('settings.notifications.update') }}" method="POST"
                                class="mt-6 space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="space-y-4">
                                    <div class="space-y-4">
                                        <!-- Email Notifications -->
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-900">Email Notifications</h4>
                                                <p class="text-sm text-gray-500">Receive notifications via email</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="email_notifications" class="sr-only peer" {{ Auth::user()->email_notifications ? 'checked' : '' }}>
                                                <div
                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600">
                                                </div>
                                            </label>
                                        </div>

                                        <!-- Push Notifications -->
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-900">Push Notifications</h4>
                                                <p class="text-sm text-gray-500">Receive push notifications in browser
                                                </p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="push_notifications" class="sr-only peer" {{ Auth::user()->push_notifications ? 'checked' : '' }}>
                                                <div
                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600">
                                                </div>
                                            </label>
                                        </div>

                                        <!-- Notification Types -->
                                        <div class="pt-4 border-t border-gray-200">
                                            <h4 class="text-sm font-medium text-gray-900 mb-3">Notification Types</h4>
                                            <div class="space-y-3">
                                                <div class="flex items-center">
                                                    <input id="new_features" name="notification_types[]" type="checkbox"
                                                        value="new_features"
                                                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                                    <label for="new_features" class="ml-2 block text-sm text-gray-900">
                                                        New Features & Updates
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="security_alerts" name="notification_types[]" type="checkbox"
                                                        value="security_alerts"
                                                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                                    <label for="security_alerts" class="ml-2 block text-sm text-gray-900">
                                                        Security Alerts
                                                    </label>
                                                </div>
                                                <div class="flex items-center">
                                                    <input id="marketing" name="notification_types[]" type="checkbox"
                                                        value="marketing"
                                                        class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                                    <label for="marketing" class="ml-2 block text-sm text-gray-900">
                                                        Marketing & Promotions
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Notification Frequency -->
                                        <div>
                                            <label for="notification_frequency"
                                                class="block text-sm font-medium text-gray-700">Notification
                                                Frequency</label>
                                            <select id="notification_frequency" name="notification_frequency"
                                                class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-md">
                                                <option value="realtime" {{ Auth::user()->notification_frequency == 'realtime' ? 'selected' : '' }}>Realtime</option>
                                                <option value="daily" {{ Auth::user()->notification_frequency == 'daily' ? 'selected' : '' }}>Daily Digest</option>
                                                <option value="weekly" {{ Auth::user()->notification_frequency == 'weekly' ? 'selected' : '' }}>Weekly Digest</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-5">
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            Update Notification Settings
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Security Tab -->
                <div id="security" class="tab-content">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                <i class="fas fa-shield-alt mr-2"></i> Security Settings
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Manage your account security and authentication.
                            </p>

                            <div class="mt-6 space-y-8">
                                <!-- Change Password -->
                                <div class="border-b border-gray-200 pb-8">
                                    <h4 class="text-md font-medium text-gray-900 mb-4">Change Password</h4>
                                    <form action="{{ route('settings.password.update') }}" method="POST" class="space-y-4">
                                        @csrf
                                        @method('PUT')

                                        <div>
                                            <label for="current_password"
                                                class="block text-sm font-medium text-gray-700">Current Password</label>
                                            <input type="password" name="current_password" id="current_password" required
                                                class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div>
                                            <label for="new_password" class="block text-sm font-medium text-gray-700">New
                                                Password</label>
                                            <input type="password" name="new_password" id="new_password" required
                                                class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div>
                                            <label for="new_password_confirmation"
                                                class="block text-sm font-medium text-gray-700">Confirm New
                                                Password</label>
                                            <input type="password" name="new_password_confirmation"
                                                id="new_password_confirmation" required
                                                class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        </div>

                                        <div class="pt-4">
                                            <button type="submit"
                                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                                Update Password
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Two-Factor Authentication -->
                                <div class="border-b border-gray-200 pb-8">
                                    <div class="flex items-center justify-between mb-4">
                                        <div>
                                            <h4 class="text-md font-medium text-gray-900">Two-Factor Authentication</h4>
                                            <p class="text-sm text-gray-500">Add an extra layer of security to your
                                                account</p>
                                        </div>
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-exclamation-triangle mr-1"></i> Disabled
                                        </span>
                                    </div>
                                    <button type="button"
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                        <i class="fas fa-mobile-alt mr-2"></i> Enable 2FA
                                    </button>
                                </div>

                                <!-- Login Sessions -->
                                <div>
                                    <h4 class="text-md font-medium text-gray-900 mb-4">Active Login Sessions</h4>
                                    <div class="space-y-3">
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <div class="flex items-center">
                                                <i class="fas fa-desktop text-gray-400 mr-3"></i>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Chrome on Windows</p>
                                                    <p class="text-xs text-gray-500">Current session •
                                                        {{ request()->ip() }}
                                                    </p>
                                                </div>
                                            </div>
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </div>
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <div class="flex items-center">
                                                <i class="fas fa-mobile-alt text-gray-400 mr-3"></i>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Safari on iPhone</p>
                                                    <p class="text-xs text-gray-500">Last active 2 days ago</p>
                                                </div>
                                            </div>
                                            <button type="button" class="text-sm text-red-600 hover:text-red-800">
                                                Log out
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <button type="button" onclick="logoutAllSessions()"
                                            class="text-sm text-red-600 hover:text-red-800">
                                            <i class="fas fa-sign-out-alt mr-1"></i> Log out of all other sessions
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Privacy Tab -->
                <div id="privacy" class="tab-content">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                <i class="fas fa-lock mr-2"></i> Privacy Settings
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Control your privacy and data sharing preferences.
                            </p>

                            <form action="{{ route('settings.privacy.update') }}" method="POST" class="mt-6 space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="space-y-4">
                                    <!-- Profile Visibility -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-3">Profile
                                            Visibility</label>
                                        <div class="space-y-3">
                                            <div class="flex items-center">
                                                <input id="public" name="profile_visibility" type="radio" value="public"
                                                    class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300">
                                                <label for="public" class="ml-3 block text-sm font-medium text-gray-700">
                                                    Public
                                                    <span class="text-sm text-gray-500 block">Anyone can see your
                                                        profile</span>
                                                </label>
                                            </div>
                                            <div class="flex items-center">
                                                <input id="private" name="profile_visibility" type="radio" value="private"
                                                    class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300">
                                                <label for="private" class="ml-3 block text-sm font-medium text-gray-700">
                                                    Private
                                                    <span class="text-sm text-gray-500 block">Only you can see your
                                                        profile</span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Data Sharing -->
                                    <div class="pt-4 border-t border-gray-200">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-900">Data Collection</h4>
                                                <p class="text-sm text-gray-500">Allow us to collect usage data to
                                                    improve our services</p>
                                            </div>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="data_collection" class="sr-only peer" checked>
                                                <div
                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600">
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Email Visibility -->
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900">Email Visibility</h4>
                                            <p class="text-sm text-gray-500">Hide your email address from other users
                                            </p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="email_visibility" class="sr-only peer" checked>
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600">
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Ad Personalization -->
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900">Ad Personalization</h4>
                                            <p class="text-sm text-gray-500">Allow personalized advertisements</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="ad_personalization" class="sr-only peer">
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600">
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Data Export -->
                                    <div class="pt-4 border-t border-gray-200">
                                        <h4 class="text-sm font-medium text-gray-900 mb-3">Data Management</h4>
                                        <div class="space-y-3">
                                            <button type="button"
                                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                                <i class="fas fa-download mr-2"></i> Export My Data
                                            </button>
                                            <button type="button" onclick="confirmDelete()"
                                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 ml-3">
                                                <i class="fas fa-trash mr-2"></i> Delete Account
                                            </button>
                                        </div>
                                        <p class="mt-2 text-sm text-gray-500">Download all your data or permanently
                                            delete your account.</p>
                                    </div>
                                </div>

                                <div class="pt-5">
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            Update Privacy Settings
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Billing Tab -->
                <div id="billing" class="tab-content">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                <i class="fas fa-credit-card mr-2"></i> Billing Settings
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Manage your subscription and billing information.
                            </p>

                            <div class="mt-6 space-y-8">
                                <!-- Current Plan -->
                                <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-lg p-6">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="text-lg font-medium text-gray-900">Pro Plan</h4>
                                            <p class="text-sm text-gray-600">$29/month • Next billing on Jan 30, 2024
                                            </p>
                                        </div>
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i> Active
                                        </span>
                                    </div>
                                    <div class="mt-4 grid grid-cols-2 gap-4">
                                        <div>
                                            <p class="text-sm text-gray-600">Storage</p>
                                            <p class="text-lg font-semibold">50 GB / 100 GB</p>
                                            <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                                                <div class="bg-purple-600 h-2 rounded-full" style="width: 50%"></div>
                                            </div>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-600">Users</p>
                                            <p class="text-lg font-semibold">5 / 10 seats</p>
                                        </div>
                                    </div>
                                    <div class="mt-6 flex space-x-3">
                                        <button type="button"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            <i class="fas fa-sync mr-2"></i> Upgrade Plan
                                        </button>
                                        <button type="button"
                                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            <i class="fas fa-times mr-2"></i> Cancel Subscription
                                        </button>
                                    </div>
                                </div>

                                <!-- Payment Methods -->
                                <div class="border-t border-gray-200 pt-8">
                                    <h4 class="text-md font-medium text-gray-900 mb-4">Payment Methods</h4>
                                    <div class="space-y-4">
                                        <div
                                            class="flex items-center justify-between p-4 border border-gray-200 rounded-lg">
                                            <div class="flex items-center">
                                                <i class="fab fa-cc-visa text-blue-600 text-2xl mr-4"></i>
                                                <div>
                                                    <p class="text-sm font-medium text-gray-900">Visa ending in 4242</p>
                                                    <p class="text-xs text-gray-500">Expires 12/2025</p>
                                                </div>
                                            </div>
                                            <span
                                                class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                                Default
                                            </span>
                                        </div>
                                        <button type="button"
                                            class="w-full inline-flex justify-center items-center px-4 py-2 border-2 border-dashed border-gray-300 text-sm font-medium rounded-md text-gray-600 hover:border-gray-400 hover:text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            <i class="fas fa-plus mr-2"></i> Add Payment Method
                                        </button>
                                    </div>
                                </div>

                                <!-- Billing History -->
                                <div class="border-t border-gray-200 pt-8">
                                    <h4 class="text-md font-medium text-gray-900 mb-4">Billing History</h4>
                                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Date</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Description</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Amount</th>
                                                    <th scope="col"
                                                        class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        Status</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                <tr>
                                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">Jan
                                                        15, 2024</td>
                                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">Pro
                                                        Plan Subscription</td>
                                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">$29.00
                                                    </td>
                                                    <td class="px-3 py-4 whitespace-nowrap">
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                                            Paid
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">Dec
                                                        15, 2023</td>
                                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">Pro
                                                        Plan Subscription</td>
                                                    <td class="px-3 py-4 whitespace-nowrap text-sm text-gray-900">$29.00
                                                    </td>
                                                    <td class="px-3 py-4 whitespace-nowrap">
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                                                            Paid
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-4 text-center">
                                        <a href="#" class="text-sm text-purple-600 hover:text-purple-500">
                                            View full billing history
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appearance Tab -->
                <div id="appearance" class="tab-content">
                    <div class="bg-white shadow rounded-lg">
                        <div class="px-4 py-5 sm:p-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                <i class="fas fa-palette mr-2"></i> Appearance Settings
                            </h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Customize the look and feel of your interface.
                            </p>

                            <form action="{{ route('settings.appearance.update') }}" method="POST" class="mt-6 space-y-6">
                                @csrf
                                @method('PUT')

                                <div class="space-y-6">
                                    <!-- Theme -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-3">Theme</label>
                                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="theme" value="light" class="sr-only peer" checked>
                                                <div
                                                    class="border-2 border-gray-200 rounded-lg p-4 peer-checked:border-purple-500 peer-checked:bg-purple-50 transition">
                                                    <div class="flex flex-col items-center">
                                                        <div class="w-full h-32 bg-white border rounded mb-2 flex flex-col">
                                                            <div class="h-4 bg-gray-100 w-full"></div>
                                                            <div class="flex-1 p-2">
                                                                <div class="h-2 bg-gray-200 rounded mb-1"></div>
                                                                <div class="h-2 bg-gray-200 rounded mb-1 w-3/4"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-sm font-medium">Light</span>
                                                    </div>
                                                </div>
                                            </label>

                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="theme" value="dark" class="sr-only peer">
                                                <div
                                                    class="border-2 border-gray-200 rounded-lg p-4 peer-checked:border-purple-500 peer-checked:bg-purple-50 transition">
                                                    <div class="flex flex-col items-center">
                                                        <div
                                                            class="w-full h-32 bg-gray-800 border rounded mb-2 flex flex-col">
                                                            <div class="h-4 bg-gray-700 w-full"></div>
                                                            <div class="flex-1 p-2">
                                                                <div class="h-2 bg-gray-600 rounded mb-1"></div>
                                                                <div class="h-2 bg-gray-600 rounded mb-1 w-3/4"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-sm font-medium">Dark</span>
                                                    </div>
                                                </div>
                                            </label>

                                            <label class="relative cursor-pointer">
                                                <input type="radio" name="theme" value="auto" class="sr-only peer">
                                                <div
                                                    class="border-2 border-gray-200 rounded-lg p-4 peer-checked:border-purple-500 peer-checked:bg-purple-50 transition">
                                                    <div class="flex flex-col items-center">
                                                        <div
                                                            class="w-full h-32 bg-gradient-to-r from-white to-gray-800 border rounded mb-2 flex flex-col">
                                                            <div
                                                                class="h-4 bg-gradient-to-r from-gray-100 to-gray-700 w-full">
                                                            </div>
                                                            <div class="flex-1 p-2">
                                                                <div
                                                                    class="h-2 bg-gradient-to-r from-gray-200 to-gray-600 rounded mb-1">
                                                                </div>
                                                                <div
                                                                    class="h-2 bg-gradient-to-r from-gray-200 to-gray-600 rounded mb-1 w-3/4">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span class="text-sm font-medium">Auto</span>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Color Scheme -->
                                    <div>
                                        <label for="color_scheme" class="block text-sm font-medium text-gray-700">Color
                                            Scheme</label>
                                        <select id="color_scheme" name="color_scheme"
                                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-md">
                                            <option value="purple" selected>Purple</option>
                                            <option value="blue">Blue</option>
                                            <option value="green">Green</option>
                                            <option value="red">Red</option>
                                            <option value="indigo">Indigo</option>
                                        </select>
                                    </div>

                                    <!-- Font Size -->
                                    <div>
                                        <label for="font_size" class="block text-sm font-medium text-gray-700 mb-2">Font
                                            Size</label>
                                        <div class="flex items-center space-x-4">
                                            <span class="text-sm text-gray-500">Small</span>
                                            <input type="range" id="font_size" name="font_size" min="12" max="18" value="16"
                                                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
                                            <span class="text-sm text-gray-500">Large</span>
                                            <span id="font_size_display"
                                                class="text-sm font-medium text-purple-600">16px</span>
                                        </div>
                                    </div>

                                    <!-- Compact Mode -->
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900">Compact Mode</h4>
                                            <p class="text-sm text-gray-500">Reduce spacing for a denser layout</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="compact_mode" class="sr-only peer">
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600">
                                            </div>
                                        </label>
                                    </div>

                                    <!-- Animation Effects -->
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-900">Animation Effects</h4>
                                            <p class="text-sm text-gray-500">Enable smooth animations</p>
                                        </div>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" name="animations" class="sr-only peer" checked>
                                            <div
                                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-purple-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-600">
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <div class="pt-5">
                                    <div class="flex justify-end">
                                        <button type="submit"
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            Update Appearance
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div
                class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="sm:flex sm:items-start">
                    <div
                        class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="fas fa-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Delete Account
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete your account? All of your data will be permanently
                                removed. This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                    <form action="{{ route('settings.account.delete') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                            Delete Account
                        </button>
                    </form>
                    <button type="button" onclick="closeModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:mt-0 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Tab switching
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });

            // Remove active class from all sidebar links
            document.querySelectorAll('.sidebar-link').forEach(link => {
                link.classList.remove('active');
            });

            // Show selected tab
            document.getElementById(tabName).classList.add('active');

            // Add active class to clicked sidebar link
            document.getElementById(`${tabName}-tab`).classList.add('active');

            // Update URL hash
            window.location.hash = tabName;
        }

        // Check URL hash on page load
        window.addEventListener('DOMContentLoaded', () => {
            const hash = window.location.hash.substring(1);
            if (hash && document.getElementById(hash)) {
                showTab(hash);
            }
        });

        // Image preview
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('avatar-preview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Reset profile form
        function resetProfileForm() {
            document.getElementById('name').value = "{{ Auth::user()->name }}";
            document.getElementById('email').value = "{{ Auth::user()->email }}";
            document.getElementById('bio').value = "{{ Auth::user()->bio }}";
            document.getElementById('website').value = "{{ Auth::user()->website }}";
            document.getElementById('location').value = "{{ Auth::user()->location }}";
        }

        // Logout all sessions
        function logoutAllSessions() {
            if (confirm('Are you sure you want to log out of all other sessions?')) {
                // Implement logout all sessions logic here
                alert('All other sessions have been logged out.');
            }
        }

        // Delete account confirmation
        function confirmDelete() {
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.add('hidden');
        }

        // Font size display
        const fontSizeSlider = document.getElementById('font_size');
        const fontSizeDisplay = document.getElementById('font_size_display');

        if (fontSizeSlider && fontSizeDisplay) {
            fontSizeSlider.addEventListener('input', function () {
                fontSizeDisplay.textContent = `${this.value}px`;
            });
        }

        // Close modal on ESC key
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
@endsection