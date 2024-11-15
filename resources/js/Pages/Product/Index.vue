<template>
    <AppLayout title="Productos">
        <main class="px-4 md:px-12 lg:w-3/4 mx-auto pt-8 pb-16">
            <section class="md:flex justify-between items-center">
                <article class="flex items-center space-x-5 lg:w-1/3">
                    <div class="mb-3 md:mb-0 w-full relative">
                        <input v-model="searchQuery" @keydown.enter="handleSearch" class="input w-full pl-9"
                            placeholder="Buscar por nombre o categoría" type="search"
                            ref="searchInput" />
                        <i class="fa-solid fa-magnifying-glass text-xs text-gray99 absolute top-[10px] left-4"></i>
                    </div>
                    <el-tag @close="closedTag" v-if="searchedWord" closable type="primary">
                        {{ searchedWord }}
                    </el-tag>
                </article>
                <PrimaryButton @click="$inertia.visit(route('products.create'))">Nuevo producto</PrimaryButton>
            </section>
            <h1 class="font-bold mt-7 mb-3 ml-4 text-[#717171] text-sm">{{ products.length }} productos</h1>

            <!-- productos -->
            <section class="md:grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                <ProductCard @product-deleted="removeProductDeleted" v-for="product in products" :key="product" :product="product" />
            </section>
        </main>
    </AppLayout>
</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import ProductCard from '@/Components/MyComponents/Product/ProductCard.vue';

export default {
data() {
    return {
        // buscador
        searchQuery: null,
        searchedWord: null,
        search: null
    }
},
components:{
    PrimaryButton,
    ProductCard,
    AppLayout
},
props:{
products: Object
},
methods:{
    inputFocus() {
        this.$nextTick(() => {
            this.$refs.searchInput.focus();
        });
    },
    handleSearch() {
        this.search = this.searchQuery;
        this.searchedWord = this.searchQuery;
        this.searchQuery = null;
    },
    closedTag() {
        this.search = null;
        this.searchedWord = null;
    },
    removeProductDeleted(item) {
        this.products = this.products.filter(product => product.id !== item.id);
    }
},
mounted() {
    //enfoca el input de busqueda
    this.inputFocus();
}
}
</script>