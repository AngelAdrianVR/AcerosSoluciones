<template>
    <LandingLayout :title="'Inicio'">
        <main class="px-3 md:px-7 lg:px-14">
            <!-- portada tablet , laptop y desktop -->
            <figure class="hidden md:block rounded-[70px] mt-20 h-[calc(90vh)] bg-gray-700 relative">
                <img class="rounded-[70px] h-full w-full object-cover" src="@/../../public/images/desktop_cover.png"
                    alt="imagen de portada que muestra materiales metalicos en fondo negro">
                <h1 class="text-white text-3xl w-[28%] font-bold absolute right-[10%] md:top-16 xl:top-1/2">
                    MATERIALES DE ACERO PARA GRANDES Y PEQUEÑOS PROYECTOS
                </h1>
                <a href="https://api.whatsapp.com/send?phone=523329570747&text=¡Hola!%20vi%20tu%20página,%20quiero%20cotizar"
                    as="button" target="_blank"
                    class="border border-grayAF text-grayAF px-6 py-5 absolute bottom-20 md:right-10 xl:right-[10%] hover:text-white hover:border-white transition-all duration-500">
                    COTIZA CON NOSOTROS
                </a>
            </figure>
            <!-- portada de movil -->
            <figure class="md:hidden rounded-[16px] mt-20 bg-gray-700 relative">
                <img class="rounded-[16px] h-full w-full object-cover" src="@/../../public/images/hero_mobile.png"
                    alt="imagen de portada que muestra materiales metalicos en fondo negro">
                <h1 class="text-white text-sm w-1/2 font-bold absolute right-[10%] top-4">
                    MATERIALES DE ACERO PARA GRANDES Y PEQUEÑOS PROYECTOS
                </h1>
                <a href="https://api.whatsapp.com/send?phone=523329570747&text=¡Hola!%20vi%20tu%20página,%20quiero%20cotizar"
                    as="button" target="_blank"
                    class="text-xs border border-grayAF text-grayAF px-3 py-2 absolute bottom-4 right-[10%] hover:text-white hover:border-white transition-all duration-500">
                    COTIZA CON NOSOTROS
                </a>
            </figure>
            <!-- Productos populares -->
            <section class="mt-8 lg:mt-16">
                <div class="flex items-center space-x-5">
                    <h2 class="text-lg">Productos populares</h2>
                    <PrimaryButton @click="$inertia.visit(route('landing.products'))">Ver todos</PrimaryButton>
                </div>
                <el-skeleton v-if="loading" class="mt-5 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3" animated>
                    <template #template>
                        <el-skeleton-item v-for="item in 4" :key="item" class="!h-60" />
                    </template>
                </el-skeleton>
                <div v-else class="mt-8 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                    <ProductCard v-for="item in products" :key="item.id" :product="item" isInLanding />
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
                <h2 class="text-lg flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                    </svg>
                    <b>Encuéntranos en</b>
                    <span class="text-[#717171]"> Fraccionamiento Revolución </span>
                </h2>
            </section>
            <!-- calidad -->
            <section class="flex justify-center items-center space-x-6 lg:space-x-28 mt-6 lg:mt-16 mb-20">
                <div class="flex flex-col items-center space-y-2 w-1/3 lg:w-1/5">
                    <p class="text-sm lg:text-xl w-3/4 text-center">Envíos a toda la Republica Mexicana</p>
                    <img src="@/../../public/images/envios.png" class="w-1/2" alt="camion de envios">
                </div>
                <img src="@/../../public/images/calidad.png" class="w-1/4 lg:w-[15%]" alt="camion de envios">
                <div class="flex flex-col items-center space-y-2 w-1/3 lg:w-1/5">
                    <p class="text-sm lg:text-xl w-3/4 text-center">Extenso conocimiento en la industria</p>
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
    },
    props: {

    },
    methods: {
        async fetchPopularProducts() {
            try {
                this.loading = true;
                const response = await axios.get(route('products.get-popular'));

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
        this.fetchPopularProducts();
    }
}
</script>