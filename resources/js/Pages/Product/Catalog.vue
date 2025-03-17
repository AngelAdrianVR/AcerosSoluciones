<template>

    <Head title="Catalog" />
    <header class="mx-12 my-6" style="margin-bottom: 1rem;">
        <section class="flex items-center justify-between mb-6">
            <img src="@/../../public/images/logo_black.png" alt="Logo de la empresa" class="h-20">
            <div class="flex items-center space-x-8">
                <div class="flex flex-col space-y-2">
                    <p class="flex space-x-2 items-center">
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                        <span>33 2957 0747</span>
                    </p>
                    <p class="flex space-x-2 items-center">
                        <i class="fa-solid fa-phone text-sm"></i>
                        <span>33 2957 0747</span>
                    </p>
                </div>
                <img src="@/../../public/images/site_qr.png" alt="Logo de la empresa" class="h-20">
            </div>
        </section>
        <img src="@/../../public/images/title_catalog.png" alt="Letras con sombra que dicen: Catálogo de productos"
            class="h-7 mx-auto">
    </header>
    <main class="mx-10 mt-6">
        <section v-for="(category, index) in getCategories" :key="category" class="h-min-screen">
            <h2 class="text-white bg-primary rounded-full px-8 py-1 mt-3">
                {{ category }}
            </h2>
            <div class="divide-y-[1px]">
                <article v-for="product in products.filter(p => p.category.name == category)" :key="product.id"
                    class="grid grid-cols-2 gap-4 mx-8 py-5 text-sm product-article">
                    <div>
                        <h3 class="font-bold">{{ product.name }}</h3>
                        <img :src="product.media[0]?.original_url" alt="Logo de la empresa"
                            class="h-32 object-contain mx-auto mt-6">
                    </div>
                    <div class="self-center">
                        <p style="white-space: pre-line;" class="text-xs">{{ product.description }}</p>
                    </div>
                </article>
            </div>
        </section>
    </main>
</template>

<script>
import { Head } from '@inertiajs/vue3';

export default {
    data() {
        return {
        }
    },
    components: {
        Head,
    },
    props: {
        products: Array
    },
    computed: {
        // funcion para obtener lista de categorias sin repetir de los productos disponibles
        getCategories() {
            let categories = [];
            this.products.forEach(product => {
                if (!categories.includes(product.category.name)) {
                    categories.push(product.category.name);
                }
            });
            return categories;
        }
    },
    methods: {

    }
}
</script>

<style scoped>
.product-article {
    page-break-inside: avoid;
}

/* section {
    page-break-inside: avoid;
} */

h2 {
    page-break-after: avoid;
    /* Evita que el título quede solo al final de la página */
}

/* Evitar salto de página antes del primer título de categoría */
/* .page-break-before-avoid {
    page-break-before: avoid;
} */

/* Forzar salto de página antes de las categorías siguientes */
/* section:not(:first-child) {
    page-break-before: always;
} */
</style>