<template>
    <AppLayout title="Productos">
        <main class="px-4 md:px-12 lg:w-3/4 mx-auto pt-8 pb-16">
            <section class="md:flex justify-between items-center">
                <article class="flex items-center space-x-5 md:w-1/2 lg:w-1/3">
                    <div class="mb-3 md:mb-0 w-full relative">
                        <input v-model="searchQuery" @keydown.enter="handleSearch" class="input w-full pl-9"
                            placeholder="Buscar por nombre o categoría" type="search" ref="searchInput" />
                        <i class="fa-solid fa-magnifying-glass text-xs text-gray99 absolute top-[10px] left-4"></i>
                    </div>
                </article>
                <PrimaryButton @click="$inertia.visit(route('products.create'))">Nuevo producto</PrimaryButton>
            </section>
            <el-tag @close="closedTag" v-if="searchedWord" closable type="primary" class="mt-2">
                Estas buscando: <b>{{ searchedWord }}</b>
            </el-tag>
            <h1 class="font-bold mt-7 ml-4 text-[#717171] text-sm">
                {{ searchedWord ? filteredProducts.data.length : totalProducts }} productos
            </h1>
            <!-- pagination -->
            <div class="overflow-auto mb-2">
                <PaginationWithNoMeta v-if="!searchedWord" :pagination="products" class="py-2" />
            </div>
            <!-- Estado de carga -->
            <div v-if="loading" class="text-center">
                <LoadingLogo class="mt-4 lg:mt-20" />
            </div>
            <!-- productos -->
            <section v-else class="md:grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 space-y-3 md:space-y-0">
                <ProductCard @product-deleted="removeProductDeleted" v-for="product in filteredProducts.data"
                    :key="product" :product="product" />
                <el-empty v-if="!filteredProducts.data.length" description="No se encontraron productos para mostrar"
                    class="col-span-full" />
            </section>
        </main>
    </AppLayout>
</template>

<script>
import PaginationWithNoMeta from "@/Components/MyComponents/PaginationWithNoMeta.vue";
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ProductCard from '@/Components/MyComponents/Product/ProductCard.vue';
import LoadingLogo from "@/Components/MyComponents/LoadingLogo.vue";
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    data() {
        return {
            // buscador
            searchQuery: null,
            searchedWord: null,
            //general
            filteredProducts: this.products,
            loading: false,
        }
    },
    components: {
        PaginationWithNoMeta,
        PrimaryButton,
        LoadingLogo,
        ProductCard,
        AppLayout
    },
    props: {
        products: Object,
        totalProducts: Number,
    },
    methods: {
        inputFocus() {
            this.$nextTick(() => {
                this.$refs.searchInput.focus();
            });
        },
        closedTag() {
            this.searchedWord = null;
            this.filteredProducts = this.products;
        },
        removeProductDeleted(item) {
            const index = this.filteredProducts.data.findIndex(product => product.id == item.id);
            if (index !== -1) {
                this.filteredProducts.data.splice(index, 1);
            }
        },
        async handleSearch() {
            this.loading = true;
            this.searchedWord = this.searchQuery;
            this.searchQuery = null;
            try {
                const response = await axios.post(route('products.get-matches', { query: this.searchedWord }));
                if (response.status === 200) {
                    this.filteredProducts = response.data.items;
                }
            } catch (error) {
                console.log(error);
                this.$message({
                    type: 'error',
                    message: error
                });

            } finally {
                this.loading = false;
            }
        },
    },
    mounted() {
        //enfoca el input de busqueda
        this.inputFocus();
    }
}
</script>