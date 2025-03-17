<template>
    <LandingLayout :title="'Productos'">
        <main class="px-3 md:px-7 lg:px-14 min-h-[77vh] mt-24">
            <section>
                <a as="button" href="/descargar-pdf" target="_blank"
                    class="flex items-center space-x-2 text-[#AA0000] focus:outline-none">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <mask id="mask0_16577_357" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="14" height="14">
                            <rect width="14" height="14" fill="#D9D9D9" />
                        </mask>
                        <g mask="url(#mask0_16577_357)">
                            <path
                                d="M6.9987 9.33301L4.08203 6.41634L4.8987 5.57051L6.41536 7.08717V2.33301H7.58203V7.08717L9.0987 5.57051L9.91536 6.41634L6.9987 9.33301ZM3.4987 11.6663C3.17786 11.6663 2.90321 11.5521 2.67474 11.3236C2.44627 11.0952 2.33203 10.8205 2.33203 10.4997V8.74967H3.4987V10.4997H10.4987V8.74967H11.6654V10.4997C11.6654 10.8205 11.5511 11.0952 11.3227 11.3236C11.0942 11.5521 10.8195 11.6663 10.4987 11.6663H3.4987Z"
                                fill="#AA0000" />
                        </g>
                    </svg>
                    <span>Descargar catálogo</span>
                    <svg width="21" height="27" viewBox="0 0 21 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.5364 9.11258V25.0066C20.5364 26 20.5364 26 19.543 26H1.49669C0.99996 26 0.99996 26 1 25.0066V1.82781C1 1 1 1 1.49669 1H14.0795M20.5364 9.11258L14.0795 1M20.5364 9.11258H14.0795V1"
                            stroke="#AA0000" stroke-width="0.662252" />
                        <path
                            d="M5.30417 20.2056C5.96653 20.3712 14.7414 13.5831 14.7414 12.9209M5.30417 20.2056C5.13871 20.2056 5.09032 20.0799 5.06043 19.9729M5.30417 20.2056C9.2221 17.5831 11.7612 15.6818 14.4102 13.1865M14.7414 12.9209C14.7717 12.8943 14.7978 12.8677 14.8197 12.8413M14.7414 12.9209C14.6295 13.0106 14.5192 13.0991 14.4102 13.1865M14.8197 12.8413C14.2447 14.0798 10.6223 16.5503 5.77677 20.0271M14.8197 12.8413C15.0222 12.5974 14.876 12.3671 14.5758 12.2753M5.06043 19.9729C4.86905 19.2876 6.72231 17.5343 9.44324 17.3911C11.3218 17.2922 12.8741 17.4623 14.0537 18.3235M5.06043 19.9729C5.21357 20.1978 5.39604 20.1527 5.80096 19.8745M14.5758 12.2753C13.8954 12.0672 12.4235 12.5703 12.4235 15.2388C12.3543 16.8257 12.388 17.8452 13.0701 19.0467M14.5758 12.2753C14.9069 12.4242 14.7771 12.8877 14.4102 13.1865M13.748 20.0401C13.6294 19.9215 13.6389 19.8975 13.5824 19.8236M13.748 20.0401L13.5824 19.8236M13.748 20.0401C13.8135 20.1056 13.8811 20.156 13.9494 20.1929M13.5824 19.8236C13.3806 19.5524 13.2114 19.2956 13.0701 19.0467M13.5824 19.8236C13.7347 19.9653 13.8971 20.0542 14.0537 20.0971M14.6754 18.8811C14.7243 18.9346 14.7811 18.9836 14.8197 19.0467C15.2476 19.7468 14.5718 20.5296 13.9494 20.1929M14.6754 18.8811C14.4814 18.6693 14.274 18.4844 14.0537 18.3235M14.6754 18.8811C14.8768 19.1405 14.9103 19.3939 14.879 19.5943M13.0701 19.0467C13.4169 19.709 13.5005 19.9204 13.9494 20.1929M13.0701 19.0467C13.4503 19.637 13.6609 20.0182 14.0537 20.0971M14.0537 20.0971C14.4663 20.2099 14.8387 20.0027 14.879 19.5943M14.0537 18.3235C14.7097 18.8257 14.9168 19.1043 14.879 19.5943"
                            stroke="#AA0000" stroke-width="0.4" />
                        <path
                            d="M2.82031 7.29106V5.96661M2.82031 5.96661V4.80772L3.74742 4.80762C4.44276 4.80772 4.44276 5.96651 3.74742 5.96651L2.82031 5.96661ZM8.38298 7.29106V5.96654M8.38298 5.96654V4.80772L9.77364 4.80762H10.0054M8.38298 5.96654L9.77364 5.96661M5.36987 4.80762V7.1255L6.52876 7.12536C7.68764 7.12536 7.68764 4.80758 6.52876 4.80772L5.36987 4.80762Z"
                            stroke="#AA0000" stroke-width="0.463555" />
                    </svg>
                </a>
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