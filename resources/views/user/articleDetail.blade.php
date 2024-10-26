<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Artikel</title>
    <!-- CDN Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- CDN Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="px-20 py-8">
    <div class="container mx-auto mt-5">



        <div class="bg-white shadow-lg rounded-lg overflow-hidden ">


            <div class="p-8">
                <div class="flex flex-row gap-8 items-start mb-4">
                    <a href="javascript:history.back()" class="flex items-center text-blue-500 hover:underline mb-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 mr-1" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M19 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H19v-2z" />
                        </svg>

                    </a>
                    <div class=" items-start mb-8 me-12 flex flex-col ">
                        <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>
                        <div class="flex flex-row gap-4">
                            <div class="bg-blue-500 text-white px-2 py-1 text-xs font-semibold rounded-full mr-2">
                                {{ $article->category }}
                            </div>
                            <p class="text-sm text-gray-500">
                                <span class="font-semibold">{{ $article->author->name }}</span> &#8226;
                                {{ $article->created_at->format('d F Y') }} •
                                {{ $article->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mb-8">
                    <img src="{{ asset($article->image) }}" alt="image_blog"
                        class="w-auto h-auto max-w-2xl object-cover rounded-lg mb-4">
                </div>


                <div class="text-gray-700 mb-4 leading-relaxed">
                    {!! $article->body !!}
                </div>


            </div>
        </div>
    </div>
</body>

</html>
