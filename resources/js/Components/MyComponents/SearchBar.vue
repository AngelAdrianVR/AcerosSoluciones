<template>
    <div class="flex items-center py-0">
        <el-input v-model="query" @keyup.enter="search" placeholder="¿Qué estás buscando?" class="!w-56 xl:!w-96">
            <template #prefix>
                <div>
                    <i class="fa-solid fa-magnifying-glass pr-3 py-1 border-r-2 border-gray-300"></i>
                </div>
            </template>
        </el-input>
    </div>
</template>
<script>
export default {
    data() {
        return {
            query: null,
        };
    },
    methods: {
        search() {
            this.$inertia.get(route('landing.products', { query: this.query }));
        }
    },
}
</script>