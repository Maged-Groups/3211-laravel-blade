@extends('layout.app')

@section('main-content')

    <!-- Main Feed -->
    <!-- Create Post -->
    <div class="bg-white rounded-xl shadow-md hover-lift overflow-hidden fade-in">
        <div class="p-6">
            <div class="flex items-start">
                <div
                    class="rounded-full border-2 border-indigo-100 w-12 h-12 bg-gradient-to-r from-cyan-500 to-blue-500 flex items-center justify-center text-white font-bold mr-3">
                    M
                </div>
                <div class="flex-1">
                    <textarea id="postContent" rows="3"
                        class="block p-4 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="What's on your mind today?"></textarea>
                    <div class="flex items-center justify-between mt-4">
                        <div class="flex space-x-2">
                            <button type="button"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none">
                                <i data-lucide="image" class="w-5 h-5"></i>
                            </button>
                            <button type="button"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none">
                                <i data-lucide="smile" class="w-5 h-5"></i>
                            </button>
                            <button type="button"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none">
                                <i data-lucide="code" class="w-5 h-5"></i>
                            </button>
                            <button type="button"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none">
                                <i data-lucide="link" class="w-5 h-5"></i>
                            </button>
                        </div>
                        <button type="button"
                            class="text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Publish Post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Post Filters -->
    <div class="bg-white rounded-xl shadow-sm p-4 fade-in">
        <div class="flex flex-wrap gap-2">
            <button type="button"
                class="text-gray-800 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-4 py-2 text-center">Latest</button>
            <button type="button"
                class="text-gray-800 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-4 py-2 text-center">Trending</button>
            <button type="button"
                class="text-gray-800 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-4 py-2 text-center">Following</button>
            <button type="button"
                class="text-gray-800 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-4 py-2 text-center">Saved</button>
            <button type="button"
                class="text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:bg-gradient-to-l focus:outline-none focus:ring-4 focus:ring-purple-300 font-medium rounded-full text-sm px-4 py-2 text-center">For
                You</button>
        </div>
    </div>

    <!-- Posts Feed -->
    <div id="postsFeed" class="space-y-6">
        @foreach ($posts as $post)
            <!-- Post -->
            <div class="bg-white rounded-xl shadow-md post-card overflow-hidden fade-in">
                <div class="p-6">
                    <!-- Post Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <div
                                class="rounded-full border-2 border-indigo-100 w-10 h-10 bg-gradient-to-r from-pink-500 to-rose-500 flex items-center justify-center text-white font-bold mr-3">
                                S
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800">{{ $post->user->name }}</h4>
                                <div class="flex items-center text-gray-500 text-sm">
                                    <span>@sarah_j</span>
                                    <span class="mx-2">•</span>
                                    <span title='{{ $post->created_at->format("F j, Y g:i A") }}'>{{ $post->created_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="text-gray-400 hover:text-gray-600">
                            <i data-lucide="more-horizontal" class="w-6 h-6"></i>
                        </button>
                    </div>

                    <!-- Post Content -->
                    <div class="mb-4">
                        <p class="text-gray-800">
                        <h2 class="text-2xl text-bold">{{ $post->post_title }}</h2>
                        <p class="text-bold">{{ substr($post->post_body, 0, 20) }}...</p>
                        </p>
                    </div>

                    <!-- Post Stats -->
                    <div class="flex items-center justify-between text-gray-500 text-sm mb-4">
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <i data-lucide="heart" class="w-5 h-5 mr-1"></i>
                                <span>{{ $post->reactions_count }}</span>
                            </div>
                            <div class="flex items-center">
                                <i data-lucide="message-circle" class="w-5 h-5 mr-1"></i>
                                <span>{{ $post->comments_count }}</span>
                            </div>
                            <div class="flex items-center">
                                <i data-lucide="share-2" class="w-5 h-5 mr-1"></i>
                                <span>7</span>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                            <span>324 views</span>
                        </div>
                    </div>

                    <!-- Post Actions -->
                    <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                        <div class="flex space-x-2">
                            <button type="button"
                                class="reaction-btn flex items-center text-gray-500 hover:text-indigo-600 px-3 py-1.5 rounded-full hover:bg-indigo-50">
                                <i data-lucide="heart" class="w-5 h-5 mr-1"></i>
                                <span>Like</span>
                            </button>
                            <button type="button"
                                class="reaction-btn flex items-center text-gray-500 hover:text-green-600 px-3 py-1.5 rounded-full hover:bg-green-50">
                                <i data-lucide="message-circle" class="w-5 h-5 mr-1"></i>
                                <span>Comment</span>
                            </button>
                            <button type="button"
                                class="reaction-btn flex items-center text-gray-500 hover:text-blue-600 px-3 py-1.5 rounded-full hover:bg-blue-50">
                                <i data-lucide="share-2" class="w-5 h-5 mr-1"></i>
                                <span>Share</span>
                            </button>
                        </div>
                        <button type="button"
                            class="reaction-btn text-gray-500 hover:text-red-500 p-1.5 rounded-full hover:bg-red-50">
                            <i data-lucide="bookmark" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <!-- Comments Preview -->
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-start">
                            <div
                                class="rounded-full border border-gray-200 w-8 h-8 bg-gradient-to-r from-amber-500 to-orange-500 flex items-center justify-center text-white text-xs font-bold mr-2">
                                T
                            </div>
                            <div class="flex-1">
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="flex items-center mb-1">
                                        <span class="font-medium text-sm text-gray-800">Thomas Lee</span>
                                        <span class="text-gray-400 text-xs mx-2">•</span>
                                        <span class="text-gray-400 text-xs">1 hour ago</span>
                                    </div>
                                    <p class="text-gray-600 text-sm">Completely agree! Vue's reactivity
                                        system is intuitive and the documentation is excellent.</p>
                                </div>
                                <div class="flex items-center mt-2 ml-2">
                                    <button class="text-xs text-gray-500 hover:text-indigo-600 flex items-center mr-3">
                                        <i data-lucide="heart" class="w-3 h-3 mr-1"></i>
                                        <span>3</span>
                                    </button>
                                    <button class="text-xs text-gray-500 hover:text-green-600 flex items-center">
                                        <i data-lucide="message-circle" class="w-3 h-3 mr-1"></i>
                                        <span>Reply</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endforeach

    </div>

    <!-- Load More Button -->
    <div class="text-center">
        <button type="button" id="loadMoreBtn"
            class="text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:bg-gradient-to-l focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
            Load More Posts
        </button>
    </div>

@endsection