<template>
    <LandingLayout :title="'Inicio'">
        <main class="px-3 md:px-7 lg:px-14">
            <figure class="mt-20 relative">
                <h1 class="text-white text-2xl w-96 font-bold absolute right-[310px] top-1/2">MATERIALES DE ACERO PARA GRANDES Y PEQUEÑOS PROYECTOS</h1>
                <img class="mx-auto rounded-2xl h-[800px]" src="@/../../public/images/desktop_cover.png" alt="">
            </figure>
            
            <!-- Productos populares -->
            <section class="mt-16">
                <div class="flex items-center space-x-3">
                    <h2 class="text-lg">Productos populares</h2>
                    <PrimaryButton>Ver todos</PrimaryButton>
                </div>
            </section>
        </main>
    </LandingLayout>
</template>

<script>
import LandingLayout from '@/Layouts/LandingLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
// import Footer from '@/Components/MyComponents/Landing/Footer.vue';

export default {
data() {
    return {

    }
},
components:{
    LandingLayout,
    PrimaryButton,
    // Footer,
},
props:{

},
methods:{

}
}
</script>