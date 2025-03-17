<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <style>
        .product-article {
            page-break-inside: avoid;
        }

        h4 {
            page-break-after: avoid;
        }

        body {
            font-family: Arial, sans-serif;
        }

        header {
            margin: 0 2rem 1rem 2rem;
        }

        .flex {
            display: flex;
        }

        .items-center {
            align-items: center;
        }

        .justify-between {
            justify-content: space-between;
        }

        .space-x-8>*+* {
            margin-left: 2rem;
        }

        .space-y-2>*+* {
            margin-top: 0.5rem;
        }

        .text-white {
            color: white;
        }

        .bg-primary {
            background-color: #121212;
        }

        .rounded-full {
            border-radius: 9999px;
        }

        .px-8 {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .py-1 {
            padding-top: 0.25rem;
            padding-bottom: 0.25rem;
        }

        .mt-3 {
            margin-top: 0.75rem;
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto;
        }

        .grid {
            display: grid;
        }

        .grid-cols-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .gap-4 {
            gap: 1rem;
        }

        .mx-8 {
            margin-left: 2rem;
            margin-right: 2rem;
        }

        .py-5 {
            padding-top: 1.25rem;
            padding-bottom: 1.25rem;
        }

        .text-sm {
            font-size: 0.8rem;
        }

        .font-bold {
            font-weight: bold;
        }

        .object-contain {
            object-fit: contain;
        }

        .h-20 {
            height: 5rem;
        }

        .h-7 {
            height: 1.75rem;
        }

        .h-28 {
            height: 7rem;
        }

        .text-xs {
            font-size: 0.7rem;
        }

        .mt-6 {
            margin-top: 1rem;
        }

        .self-center {
            align-self: center;
        }

        .text-lg {
            font-size: 0.9rem;
        }
    </style>
</head>

<body>
    <header class="" style="margin-bottom: 1rem;">
        <section style="display: flex; align-items: center; justify-content: space-between;">
            @if (app()->environment() === 'production')
                {{-- en servidor cpanel colocar asset --}}
                <img src="{{ asset('images/logo_black.png') }}" alt="Logo de la empresa" class="h-20"
                    style="margin-right: 8rem">
                <img src="{{ asset('images/contact_qr.png') }}" alt="Contacto y Qr del sitio web" class="h-20">
            @else
                <img src="{{ public_path('images/logo_black.png') }}" alt="Logo de la empresa" class="h-20"
                    style="margin-right: 8rem">
                <img src="{{ public_path('images/contact_qr.png') }}" alt="Contacto y Qr del sitio web" class="h-20">
            @endif

        </section>
        @if (app()->environment() === 'production')
            <img src="{{ asset('images/title_catalog.png') }}" alt="Letras con sombra que dicen: Catálogo de productos"
                class="h-7" style="margin-top: 1rem; margin-left: 8rem;">
        @else
            <img src="{{ public_path('images/title_catalog.png') }}"
                alt="Letras con sombra que dicen: Catálogo de productos" class="h-7"
                style="margin-top: 1rem; margin-left: 8rem;">
        @endif
    </header>
    <main class="mx-10">
        @foreach ($categories as $category)
            <section class="h-min-screen">
                <h4 class="text-white bg-primary rounded-full px-8 py-1" style="size: 13px">
                    {{ $category }}
                </h4>
                <div class="divide-y">
                    @foreach ($products->where('category.name', $category) as $product)
                        @php
                            if (app()->environment() === 'production') {
                                $path = $product->media[0]['id'] . '/' . $product->media[0]['file_name'];
                            } else {
                                $path = $product->media[0]['id'] . '\\' . $product->media[0]['file_name'];
                            }
                        @endphp
                        <article style="display: flex; border-bottom: 1px solid #d9d9d9; margin-bottom: 14px" class="product-article">
                            <div style="display: inline-block; width: 29%; margin-top: 1rem;">
                                <h5 class="font-bold">{{ $product->name }}</h5>
                                @if (app()->environment() === 'production')
                                    <img src="{{ asset("storage/$path") }}" class="h-28 object-contain mx-auto">
                                @else
                                    <img src="{{ public_path("storage\\$path") }}"
                                        class="h-28 object-contain mx-auto">
                                @endif
                            </div>
                            <p style="white-space: pre-line; width: 70%; display: inline-block; height: 10rem; margin-top: 2rem; margin-bottom: 2rem;" class="text-xs">
                                {{ $product->description }}</p>
                        </article>
                    @endforeach
                </div>
            </section>
        @endforeach
    </main>
</body>

</html>
