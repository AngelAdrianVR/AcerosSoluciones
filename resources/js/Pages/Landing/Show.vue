<template>
    <LandingLayout title="Ver producto">
        <Back :to="route('landing.products')" class="mt-12 lg:mt-24 mx-3 lg:mx-24" />
        <main class="mt-2 lg:mx-48 lg:grid grid-cols-2 gap-x-1">
            <section class="border border-grayD9 rounded-[10px] p-4">
                <Carousel v-bind="settings" :itemsToShow="1">
                    <Slide v-for="slide in product.media" :key="slide">
                        <img :src="slide.original_url" class="object-contain w-3/4 rounded-md">
                    </Slide>
                    <template #addons>
                        <Pagination />
                    </template>
                </Carousel>
            </section>
            <section class="lg:pt-8 lg:mt-10 lg:mx-10">
                <h2 class="text-center font-bold">{{ product.name }}</h2>
                <div class="mt-8 text-sm">
                    <h3 class="font-semibold">Descripción</h3>
                    <p style="white-space: pre-line;" class="mt-1">
                        {{ product.description }}
                    </p>
                </div>
                <div class="flex justify-center lg:mx-24 mt-12">
                    <a :href="wpUrl" target="_blank" class="w-full">
                        <PrimaryButton class="w-full flex justify-center">Enviar mensaje</PrimaryButton>
                    </a>
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
    }
}
</script>