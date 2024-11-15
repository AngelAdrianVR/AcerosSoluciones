<template>
    <LandingLayout :title="'Inicio'">
        <main class="px-3 md:px-7 lg:px-14">
            <figure class="rounded-[70px] mt-20 h-[calc(90vh)] bg-gray-700 relative">
                <img class="rounded-[70px] h-full w-full object-cover" src="@/../../public/images/desktop_cover.png"
                    alt="imagen de portada que muestra materiales metalicos en fondo negro">
                <h1 class="text-white text-3xl w-[28%] font-bold absolute right-[10%] top-1/2">
                    MATERIALES DE ACERO PARA GRANDES Y PEQUEÑOS PROYECTOS
                </h1>
                <a href="https://api.whatsapp.com/send?phone=523329570747&text=¡Hola!%20vi%20tu%20página,%20quiero%20cotizar"
                    as="button" target="_blank"
                    class="border border-grayAF text-grayAF px-6 py-5 absolute bottom-20 right-[10%] hover:text-white hover:border-white transition-all duration-500">
                    COTIZA CON NOSOTROS
                </a>
            </figure>

            <!-- Productos populares -->
            <section class="mt-16">
                <div class="flex items-center space-x-5">
                    <h2 class="text-lg">Productos populares</h2>
                    <PrimaryButton @click="$inertia.visit(route('landing.products'))">Ver todos</PrimaryButton>
                </div>
                <div class="mt-8 grid grid-cols-4 gap-3">
                    <ProductCard v-for="item in products" :key="item.id" :product="item" />
                </div>
            </section>
            <!-- marcas -->
            <section class="mt-12">
                <h2 class="text-lg font-bold">Algunas de nuestras marcas</h2>
                <Carousel v-bind="brandsSettings" :breakpoints="brandsBreackpoints">
                    <Slide v-for="slide in brandsImages" :key="slide">
                        <img class="w-1/3 md:w-[70%]" :src="slide">
                    </Slide>
                    <template #addons>
                        <Navigation />
                    </template>
                </Carousel>
            </section>
            <!-- ubicacion -->
            <section class="mt-12">
                <h2 class="text-lg">
                    <b>Encuéntranos en</b>
                    <span class="text-[#717171]">Fraccionamiento Revolución</span>
                </h2>
            </section>
            <!-- calidad -->
            <section class="flex justify-center items-center space-x-28 mt-16 mb-20">
                <div class="flex flex-col items-center space-y-2 w-1/5">
                    <p class="text-2xl w-3/4 text-center">Envíos a toda la Republica Mexicana</p>
                    <img src="@/../../public/images/envios.png" class="w-1/2" alt="camion de envios">
                </div>
                <img src="@/../../public/images/calidad.png" class="w-[15%]" alt="camion de envios">
                <div class="flex flex-col items-center space-y-2 w-1/5">
                    <p class="text-2xl w-3/4 text-center">Extenso conocimiento en la industria</p>
                    <img src="@/../../public/images/conocimiento.png" class="w-1/2" alt="camion de envios">
                </div>
            </section>
        </main>
    </LandingLayout>
</template>

<script>
import LandingLayout from '@/Layouts/LandingLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import ProductCard from '@/Components/MyComponents/Product/ProductCard.vue';
import axios from 'axios';
import gerdau from '@/../../public/images/gerdau.png';
import mittal from '@/../../public/images/mittal.png';
import hylsa from '@/../../public/images/hylsa.png';
import suacero from '@/../../public/images/suacero.png';
import deacero from '@/../../public/images/deacero.png';
import sanluis from '@/../../public/images/sanluis.png';
//carousel
import { Carousel, Navigation, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';
// import Footer from '@/Components/MyComponents/Landing/Footer.vue';

export default {
    data() {
        return {
            loading: true,
            products: [],
            brandsSettings: {
                wrapAround: true,
                itemsToShow: 5,
                snapAlign: 'start',
                autoplay: 4000,
            },
            brandsBreackpoints: {
                // 320px and up
                320: {
                    itemsToShow: 2,
                    snapAlign: 'start',
                },
                // 700px and up
                700: {
                    itemsToShow: 3,
                    snapAlign: 'start',
                },
                // 1024 and up
                1024: {
                    itemsToShow: 5,
                    snapAlign: 'start',
                },
            },
            brandsImages: [
                gerdau,
                mittal,
                hylsa,
                suacero,
                deacero,
                sanluis,
            ],
        }
    },
    components: {
        LandingLayout,
        PrimaryButton,
        ProductCard,
        Navigation,
        Carousel,
        Slide,
        // Footer,
    },
    props: {

    },
    methods: {
        async fetchProducts() {
            try {
                this.loading = true;
                const response = await axios.get(route('products.get-all'));

                if (response.status === 200) {
                    this.products = response.data.items;
                }
            } catch (error) {
                console.log(error);
            } finally {
                this.loading = false;
            }
        },
    },
    mounted() {
        this.fetchProducts();
    }
}
</script>