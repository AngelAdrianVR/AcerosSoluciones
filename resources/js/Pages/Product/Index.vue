<template>
    <AppLayout title="Productos">
        <main class="px-2 md:px-10 pt-1 pb-16">
            <h1 class="font-bold my-3 ml-4 text-lg">{{ products.length }} productos</h1>
            <section class="md:flex justify-between items-center">
                <article class="flex items-center space-x-5 lg:w-1/3">
                    <div class="mb-3 md:mb-0 w-full relative">
                        <input v-model="searchQuery" @keydown.enter="handleSearch" class="input w-full pl-9"
                            placeholder="Buscar por nombre, categoria o número de parte del fabricante" type="search"
                            ref="searchInput" />
                        <i class="fa-solid fa-magnifying-glass text-xs text-gray99 absolute top-[10px] left-4"></i>
                    </div>
                    <el-tag @close="closedTag" v-if="searchedWord" closable type="primary">
                        {{ searchedWord }}
                    </el-tag>
                </article>
                <PrimaryButton>Nuevo producto</PrimaryButton>
            </section>
        </main>
    </AppLayout>
</template>

<script>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
data() {
    return {

    }
},
components:{
    PrimaryButton,
    AppLayout
},
props:{

},
methods:{

}
}
</script>