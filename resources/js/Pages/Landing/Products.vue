<template>
    <LandingLayout :title="'Productos'">
        <main class="px-3 md:px-7 lg:px-14 min-h-[77vh] mt-24">
            <section>
                <h1 v-if="!category" class="text-center font-bold text-lg">
                    Todos los productos
                </h1>
                <h1 v-else class="text-center font-bold text-lg">
                    Productos de categoría "{{ category }}"
                </h1>
                <el-tag v-if="currentQuery" @close="removeQuery" closable type="primary" class="mt-2">
                    Estas buscando: <b>{{ currentQuery }}</b>
                </el-tag>
            </section>
            <section class="my-12 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                <ProductCard v-for="item in filteredProducts" :key="item.id" :product="item" isInLanding />
                <p v-if="!filteredProducts.length" class="text-gray1 text-center my-8 col-span-full">
                    No hay productos para mostrar
                </p>
            </section>
        </main>
    </LandingLayout>
</template>

<script>
import LandingLayout from '@/Layouts/LandingLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ProductCard from '@/Components/MyComponents/Product/ProductCard.vue';

export default {
    data() {
        return {
            loading: true,
            currentQuery: null,
            // category: null,
            filteredProducts: [],
        }
    },
    components: {
        LandingLayout,
        PrimaryButton,
        ProductCard,
    },
    props: {
        products: Array,
        query: String,
        category: String,
        categories: Array,
    },
    methods: {
        removeQuery() {
            // Obtener la URL actual
            const url = new URL(window.location.href);

            // Remover la variable "query"
            url.searchParams.delete('query');

            this.currentQuery = null;
            // Actualizar la URL sin recargar la página
            window.history.replaceState({}, '', url.toString());

            this.filterProducts();
        },
        filterProducts() {
            if (!this.category) {
                this.filteredProducts = this.products;
            } else {
                this.filteredProducts = this.products.filter(item => item.category.name == this.category);
            }

            // buscar también por query
            this.filterByQuery();
        },
        filterByQuery() {
            if (this.currentQuery) {
                const regex = new RegExp(this.currentQuery, 'i'); // 'i' hace la búsqueda sin distinguir mayúsculas y minúsculas
                this.filteredProducts = this.filteredProducts.filter(product => regex.test(product.name));
            }
        },
    },
    mounted() {
        // this.category = this.category;
        this.currentQuery = this.query;
        this.filterProducts();
    },
}
</script>