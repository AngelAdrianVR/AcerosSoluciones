<template>
  <div class="inicio-container flex-col">
    <transition name="logo-grow">
        <figure class="rounded-3xl border p-3 shadow-md shadow-black/30 size-28  md:size-36 text-center flex items-center justify-center">
            <img class="w-20 animate-spin-slow" src="@/../../public/images/isologotipo.png" alt="Logo" />
        </figure>
    </transition>
    <p class="mt-2">{{ loadingText }}</p>
  </div>
</template>

<script>
export default {
    data() {
        return {
            loadingText: "Cargando",
            intervalId: null,
            dots: 0,
        }
    },
    methods: {
        startLoadingAnimation() {
        this.intervalId = setInterval(() => {
            this.dots = (this.dots + 1) % 4; // Ciclo entre 0 y 3
            this.loadingText = "Cargando" + ".".repeat(this.dots);
        }, 1000);
        },
        stopLoadingAnimation() {
        if (this.intervalId) {
            clearInterval(this.intervalId);
        }
        },
    },
    mounted() {
        this.startLoadingAnimation();

        // Después de 3 segundos, oculta el logo y redirige al login
        setTimeout(() => {
          this.$inertia.visit(this.route('products.index'));
        }, 3000);
    },
};
</script>

<style scope>
.inicio-container {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background-color: #f3f4f6; /* Cambia el color de fondo si deseas */
}

.logo-grow-enter-active {
  transition: transform 3s ease;
}

.logo-grow-enter {
  transform: scale(0.3); /* Tamaño inicial pequeño */
}

.logo-grow-enter-to {
  transform: scale(0.5); /* Tamaño final */
}

/* Personaliza el tamaño y estilo del contenedor del logotipo */
.logo-container {
  display: inline-block;
  transform-origin: center;
}
</style>
