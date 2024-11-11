<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { Head, Link, router  } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';


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

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};

const goToWhatsApp = () => {
  const url = "https://api.whatsapp.com/send?phone=523313825055&text=Hola!%20vi%20tu%20página%20de%20fletes%20y%20reparaciones.%20Me%20interesa%20su%20servicio!";
  window.open(url, "_blank", "noopener,noreferrer");
};
</script>

<style>
/* Estilos para la barra de navegación */
.navbar {
    position: absolute;
    top: 0;
    background-color: #fff;
    opacity: 0.9;
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
                            <div>
                                <el-input
                                    v-model="search" placeholder="¿Qué estás buscando?" class="!w-52 md:!w-96">
                                    <template #prefix>
                                        <div>
                                            <i class="fa-solid fa-magnifying-glass pr-3 py-1 border-r-2 border-gray-300"></i>
                                        </div>
                                    </template>
                                </el-input>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-10 sm:-my-px sm:ms-10 sm:flex items-center">
                                <NavLink :href="route('home')" :active="route().current('home')">
                                    Inicio
                                </NavLink>
                                <Dropdown align="right" width="60">
                                    <template #trigger>
                                        <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
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
                            <button class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out" @click="showingNavigationDropdown = ! showingNavigationDropdown">
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
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
        </div>
    </div>
</template>
