<template>
    <LandingLayout :title="'Productos'">
        <main class="px-3 md:px-7 lg:px-14 min-h-[77vh] mt-24">
            <h1 class="text-center font-bold text-lg">Todos los productos</h1>
            <section class="my-12 grid grid-cols-4 gap-3">
                <ProductCard v-for="item in products" :key="item.id" :product="item" />
            </section>
        </main>
    </LandingLayout>
</template>

<script>
import LandingLayout from '@/Layouts/LandingLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ProductCard from '@/Components/MyComponents/Product/ProductCard.vue';
import axios from 'axios';

export default {
    data() {
        return {
            loading: true,
        }
    },
    components: {
        LandingLayout,
        PrimaryButton,
        ProductCard,
    },
    props: {
        products: Array,
    },
    methods: {
        // async fetchProducts() {
        //     try {
        //         this.loading = true;
        //         const response = await axios.get(route('products.get-all'));

        //         if (response.status === 200) {
        //             this.products = response.data.items;
        //         }
        //     } catch (error) {
        //         console.log(error);
        //     } finally {
        //         this.loading = false;
        //     }
        // },
    },
    mounted() {
        // this.fetchProducts();
    }
}
</script>