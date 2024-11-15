<template>
    <main class="rounded-2xl border-2 border-[#D9D9D9] p-4 h-72 relative group">
        <!-- Botones de acción -->
        <div class="absolute top-2 right-2 flex items-center justify-end space-x-2 opacity-0 group-hover:opacity-100 group-hover:translate-y-2 transition-all duration-300 ease-out">
            <button @click="$inertia.get(route('products.edit', product.id))" class="rounded-full w-6 h-6 bg-primary text-white flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </button>
            <button @click="handleRemoveItem()" class="rounded-full w-6 h-6 bg-primary text-white flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>
        </div>

        <!-- Imagen del producto -->
        <figure class="flex items-center justify-center h-1/2 w-full">
            <img v-if="product.media?.length" class="object-contain h-full" :src="product.media[0].original_url" :alt="product.name">
            <svg v-else xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10 text-gray-400">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
            </svg>
        </figure>

        <!-- Detalles del producto -->
        <div class="text-center mt-4">
            <h2 class="font-bold">{{ product.name }}</h2>
            <h1 class="text-[13px] mt-3 line-clamp-2">{{ product.description }}</h1>
        </div>
    </main>
</template>

<script>
export default {
data() {
    return {

    }
},
components:{

},
props:{
product: Object
},
emits:['product-deleted'],
methods:{
    async handleRemoveItem(item) {
        this.$confirm('¿Estás seguro de eliminar este archivo?', 'Confirmar', {
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
            type: 'warning'
        }).then(async () => {
            try {
                // Realiza la petición DELETE al controlador
                const response = await axios.delete(route('products.destroy', this.product.id));
                
                // Verifica si la respuesta fue exitosa
                if (response.status === 200) {
                    this.$notify({
                        title: "Correcto",
                        message: "",
                        type: "success",
                    });
                    
                    // emite un evento para remover el producto de la lista de productos en el index
                    this.$emit('product-deleted', this.product);
                }
            } catch (error) {
                this.$message({
                    type: 'error',
                    message: 'Hubo un error al eliminar el producto'
                });
                console.error(error);
            }
        }).catch(() => {
            this.$message({
                type: 'info',
                message: 'Eliminación cancelada'
            });
        });
    }
}
}
</script>
