<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import SearchBar from '@/Components/MyComponents/SearchBar.vue';


defineProps({
    title: String,
});

// Variables reactivas
const isNavbarFixed = ref(true);
const lastScrollY = ref(0);
const search = ref('');

const showingNavigationDropdown = ref(false);

// Función para manejar el scroll
const handleScroll = () => {
    const currentScrollY = window.scrollY;

    if (currentScrollY > lastScrollY.value && currentScrollY > window.innerHeight) {
        // Si se hace scroll hacia abajo y se ha pasado el alto de la pantalla
        isNavbarFixed.value = false;
    } else {
        // Si se hace scroll hacia arriba
        isNavbarFixed.value = true;
    }

    lastScrollY.value = currentScrollY;
};

// Ciclos de vida del componente
onMounted(() => {
    window.addEventListener('scroll', handleScroll);
});

onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScroll);
});

const goToWhatsApp = () => {
    const url = "https://api.whatsapp.com/send?phone=523329570747&text=¡Hola!%20vi%20tu%20página,%20me%20interesan%20tus%20productos";
    window.open(url, "_blank", "noopener,noreferrer");
};
</script>

<style>
/* Estilos para la barra de navegación */
.navbar {
    position: absolute;
    top: 0;
    background-color: #fff;
    /* opacity: 0.95; */
}

.fixed-navbar {
    position: fixed;
    width: 100%;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
    z-index: 100;
}

html {
    scroll-behavior: smooth;
}

.custom-style .el-segmented {
    --el-segmented-bg-color: #818181;
    --el-segmented-color: #000;
    --el-segmented-item-selected-color: #FFFFFF;
    --el-segmented-item-selected-bg-color: #a1a1a1;
    --el-border-radius-base: 16px;
}
</style>

<template>
    <div>

        <Head :title="title" />

        <Banner />

        <div class="min-h-screen">
            <nav :class="['navbar', { 'fixed-navbar': isNavbarFixed }]" class=" py-1 px-3 md:px-9">
                <!-- Primary Navigation Menu -->
                <div class="max-w-full sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex justify-between items-center space-x-4 w-full mr-16">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('home')">
                                <ApplicationMark class="block h-9 md:h-12 w-auto" />
                                </Link>
                            </div>
                            <!-- buscador -->
                            <SearchBar />
                            <!-- Navigation Links -->
                            <div class="hidden space-x-10 sm:-my-px sm:ms-10 sm:flex items-center">
                                <NavLink :href="route('home')" :active="route().current('home')">
                                    Inicio
                                </NavLink>
                                <Dropdown align="right" width="60">
                                    <template #trigger>
                                        <button type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                            Categorías
                                            <i class="fa-solid fa-angle-down ml-3 text-[8px]"></i>
                                        </button>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- options -->
                                            <DropdownLink as="button">
                                                Perfiles estructurales
                                            </DropdownLink>
                                            <DropdownLink as="button">
                                                Tubos de acero
                                            </DropdownLink>
                                            <DropdownLink as="button">
                                                Láminas y placas de acero
                                            </DropdownLink>
                                            <DropdownLink as="button">
                                                Acero inoxidable
                                            </DropdownLink>
                                            <DropdownLink as="button">
                                                Mallas y cercados
                                            </DropdownLink>
                                            <DropdownLink as="button">
                                                Varilla y alambre
                                            </DropdownLink>
                                            <DropdownLink as="button">
                                                Tornillería y fijación
                                            </DropdownLink>
                                            <DropdownLink as="button">
                                                Herramienta y equipo de corte
                                            </DropdownLink>
                                        </div>
                                    </template>
                                </Dropdown>

                                <!-- <NavLink :href="route('services')" :active="route().current('services')">
                                    Categorías
                                </NavLink> -->
                                <button @click="goToWhatsApp" class="text-[#1BD962]">
                                    <i class="fa-brands fa-whatsapp text-lg"></i>
                                </button>

                            </div>
                        </div>
                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                                @click="showingNavigationDropdown = !showingNavigationDropdown">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{ 'hidden': showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path
                                        :class="{ 'hidden': !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{ 'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown }"
                    class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('home')" :active="route().current('home')">
                            Inicio
                        </ResponsiveNavLink>
                        <!-- <ResponsiveNavLink :href="route('services')" :active="route().current('services')">
                            Servicios
                        </ResponsiveNavLink> -->
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>

            <footer class="bg-[#121212] text-white mt-10">
                <section class="mx-16 pt-6 flex items-center justify-between">
                    <figure>
                        <img src="@/../../public/images/logo_footer.png"
                            alt="logo de acero soluciones en pie de página">
                    </figure>
                    <div class="flex items-center space-x-2">
                        <!-- <a as="button">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="14" cy="14" r="13.35" stroke="white" stroke-width="1.3" />
                                <path
                                    d="M9.25549 5.2793C6.9604 5.2793 5.27734 7.03886 5.27734 10.1755V18.5143C5.27734 20.8094 6.8839 22.7219 9.25549 22.7219H18.4358C21.1134 22.7219 22.9495 20.5798 22.9495 18.5143V10.1755C22.9495 7.65088 21.4194 5.2793 18.4358 5.2793H9.25549Z"
                                    stroke="white" stroke-width="1.5" />
                                <circle cx="14.0732" cy="14.0761" r="3.48415" stroke="white" stroke-width="1.6" />
                                <circle cx="19.2022" cy="8.79793" r="1.14754" fill="white" />
                            </svg>
                        </a>
                        <a as="button">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M27.3368 14C27.3368 21.3657 21.3657 27.3368 14 27.3368C6.63427 27.3368 0.663158 21.3657 0.663158 14C0.663158 6.63427 6.63427 0.663158 14 0.663158C21.3657 0.663158 27.3368 6.63427 27.3368 14Z"
                                    stroke="white" stroke-width="1.32632" />
                                <path
                                    d="M11.4768 18.1646V27.7216C12.5968 27.9574 14.5568 28.0016 16.0501 27.7216V18.1646H19.5034V14.1882H16.0501V10.7349C16.0795 10.0441 16.6532 9.57358 17.4501 9.6149H19.9701V5.60156H16.2368C13.6234 5.60156 11.4768 7.6549 11.4768 10.5482V14.1882H8.02344V18.1646H11.4768Z"
                                    fill="white" />
                            </svg>
                        </a> -->
                        <a href="https://api.whatsapp.com/send?phone=523329570747&text=¡Hola!%20vi%20tu%20página,%20me%20interesan%20tus%20productos"
                            as="button" target="_blank">
                            <svg width="27" height="28" viewBox="0 0 27 28" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.7861 17.4302C20.6946 17.2787 20.4517 17.1854 20.0868 17.0043C19.7219 16.8231 17.9247 15.9372 17.5914 15.8164C17.2581 15.6956 17.0119 15.6331 16.769 15.9986C16.5261 16.3642 15.8257 17.1854 15.6122 17.4258C15.3987 17.6662 15.1863 17.7003 14.8214 17.518C13.7445 17.0899 12.7494 16.4766 11.8805 15.7055C11.0828 14.9703 10.3985 14.1193 9.85011 13.1805C9.63226 12.816 9.82724 12.6184 10.0102 12.4362C10.3931 12.0844 10.7033 11.6598 10.923 11.1869C10.9718 11.0862 10.9946 10.9748 10.9893 10.8629C10.9839 10.751 10.9507 10.6423 10.8925 10.5468C10.8043 10.3657 10.0734 8.56746 9.76951 7.8407C9.42531 7.01074 7.89056 6.9822 7.27296 7.65626C5.3243 9.78714 5.77416 12.2013 7.49081 14.4793C7.6738 14.723 10.0179 18.5313 13.73 19.9936C17.4421 21.4559 17.4421 20.9674 18.112 20.9059C20.0367 20.7314 21.3395 18.3557 20.7905 17.4335"
                                    fill="#1BD962" />
                                <path
                                    d="M4.43162 5.12551C6.77998 2.77738 9.95664 1.46405 13.2646 1.47369C16.5727 1.46434 19.7493 2.77791 22.0976 5.12622C24.446 7.47453 25.7742 10.6658 25.7909 13.9999C25.7712 16.2699 25.1451 18.4927 23.9785 20.4346C22.8119 22.3765 21.1478 23.9658 19.1611 25.0354C17.1744 26.1051 14.9386 26.6157 12.6885 26.5134C10.4384 26.4112 8.25715 25.7 6.37404 24.4545L1.56066 25.9969L3.12482 21.3443C1.57271 19.2148 0.736521 16.6411 0.738284 13.9988C0.755002 10.6648 2.08326 7.47365 4.43162 5.12551Z"
                                    stroke="#1BD962" stroke-width="1.36651" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                        </a>
                    </div>
                </section>
                <section class="mx-16 pt-6 flex items-center justify-between text-sm">
                    <span>&COPY; 2024. ACERO SOLUCIONES</span>
                    <p class="flex items-center space-x-2">
                        <a as="button" target="_blank" :href="route('terms.show')" class="underline">Términos y
                            condiciones</a>
                        <span>•</span>
                        <a as="button" target="_blank" :href="route('policy.show')" class="underline">Política de
                            privacidad</a>
                    </p>
                    <div class="flex items-center space-x-2">
                        <span>Desarrollado por</span>
                        <a href="https://app.dtw.com.mx" target="_blank">
                            <figure>
                                <img src="@/../../public/images/logo_dtw.png"
                                    alt="logo de empresa desarrolladora de paginas web, DTW">
                            </figure>
                        </a>
                    </div>
                </section>
            </footer>
        </div>
    </div>
</template>
