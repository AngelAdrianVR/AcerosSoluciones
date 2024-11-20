<template>
    <LandingLayout title="Ver producto">
        <Back :to="route('landing.products')" class="mt-20 lg:mt-24 mx-5 lg:mx-24" />
        <main class="mt-2 mx-5 md:mx-16 lg:mx-48 lg:grid grid-cols-2 gap-x-1">
            <section class="border border-grayD9 rounded-[10px] p-4">
                <Carousel v-bind="settings" :itemsToShow="1">
                    <Slide v-for="slide in product.media" :key="slide">
                        <img :src="slide.original_url" class="object-contain w-1/3 lg:w-3/4 rounded-md">
                    </Slide>
                    <template #addons>
                        <Pagination />
                    </template>
                </Carousel>
            </section>
            <section class="mt-2 lg:pt-8 lg:mt-8 lg:mx-10 ring-0">
                <p class="text-gray-700 flex items-center space-x-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                    </svg>
                    <span class="text-xs">{{ product.category.name }}</span>
                </p>
                <h2 class="text-center font-bold mt-3">{{ product.name }}</h2>
                <div class="mt-5 lg:mt-8 text-sm">
                    <h3 v-if="product.description" class="font-semibold">Descripción</h3>
                    <p style="white-space: pre-line;" class="mt-1 text-justify">
                        {{ product.description }}
                    </p>
                </div>
                <div class="flex justify-center space-x-1 xl:mx-24 mt-5 lg:mt-12">
                    <a :href="wpUrl" target="_blank" class="w-full">
                        <PrimaryButton class="w-full flex justify-center">Enviar mensaje</PrimaryButton>
                    </a>
                    <PrimaryButton @click="makeCall" class="size-[34px] flex justify-center items-center">
                        <i class="fa-solid fa-phone"></i>
                    </PrimaryButton>
                </div>
            </section>
        </main>
    </LandingLayout>
</template>
<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Back from '@/Components/MyComponents/Back.vue';
import LandingLayout from '@/Layouts/LandingLayout.vue';
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel';
import 'vue3-carousel/dist/carousel.css';

export default {
    data() {
        return {
            settings: {
                wrapAround: true,
                itemsToShow: 1,
                snapAlign: 'start',
            },
            wpUrl: 'https://api.whatsapp.com/send?phone=523329570747&text=Hola!%20vi%20tu%20página,%20me%20interesa%20el%20producto%20*' + this.product.name + '*',
        };
    },
    components: {
        LandingLayout,
        Back,
        Carousel,
        Slide,
        Pagination,
        Navigation,
        PrimaryButton
    },
    props: {
        product: Object,
    },
    methods: {
        makeCall() {
            const phoneNumber = "3329570747";
            window.location.href = `tel:${phoneNumber}`;
        },
    }
}
</script>