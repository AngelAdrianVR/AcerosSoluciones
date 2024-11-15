<template>
    <AppLayout title="Editar producto">
        <Back class="mt-3 md:mt-7 md:mb-4 md:mx-12" />

        <form @submit.prevent="update" class="lg:w-2/3 mx-auto rounded-xl lg:border-2 border-gray-400 p-5 my-2">
            <h1 class="text-lg text-center lg:text-left">Editar producto</h1>
            <div class="lg:grid grid-cols-3 lg:space-x-3 mt-3">
                <div>
                    <InputFilePreview
                        v-show="currentImage == 1"
                        :imageUrl="getMediaUrl('cover1')"
                        @imagen="this.form.image_cover1 = $event; form.clearedCover1 = false"
                        @cleared="form.clearedCover1 = true"
                    />
                    <InputFilePreview
                        v-show="currentImage == 2"
                        :imageUrl="getMediaUrl('cover2')"
                        @imagen="this.form.image_cover2 = $event; form.clearedCover2 = false"
                        @cleared="form.clearedCover2 = true"
                    />
                    <p class="text-center mt-2">
                        <i @click="currentImage = currentImage - 1" v-if="currentImage == 2" class="fa-solid fa-angle-left text-xs mr-2 cursor-pointer p-1"></i>
                        Imagen {{ currentImage }} de 2
                        <i @click="currentImage = currentImage + 1" v-if="currentImage == 1" class="fa-solid fa-angle-right text-xs ml-2 cursor-pointer p-1"></i>
                    </p>
                </div>

                <div class="col-span-2 mt-7 lg:mt-0 space-y-2">
                    <div>
                        <div class="flex items-center">
                            <InputLabel value="Nombre del producto*" class="ml-3 mb-1" />
                            <el-tooltip placement="top">
                                <template #content>
                                    <p>Escribe el nombre y una breve descripción <br>
                                        del producto, este se mostrará en la vista de <br>
                                        la sección de los productos
                                    </p>
                                </template>
                                <i class="fa-regular fa-circle-question ml-2 text-primary text-xs"></i>
                            </el-tooltip>
                        </div>
                        <el-input v-model="form.name" placeholder="Escribe el nombre del producto" />
                        <InputError :message="form.errors.name" />
                    </div>

                    <div class="mt-3">
                        <InputLabel value="Nombre del producto*" class="ml-3 mb-1" />
                        <el-input
                            v-model="form.description"
                            maxlength="250"
                            placeholder="Escribe la descripción"
                            show-word-limit
                            type="textarea"
                        />
                        <InputError :message="form.errors.description" />
                    </div>

                    <div class="mt-2">
                        <div class="flex items-center justify-between">
                            <InputLabel value="Categría*" class="ml-3 mb-1" />
                            <button
                                @click="showCategoryFormModal = true" type="button"
                                class="rounded-full border bg-primary size-4 flex items-center justify-center mr-2">
                                <i class="fa-solid fa-plus text-white text-[7px]"></i>
                            </button>
                        </div>
                        <el-select v-model="form.category_id" clearable placeholder="Seleccione"
                        no-data-text="No hay opciones disponibles" no-match-text="No se encontraron coincidencias">
                        <el-option v-for="category in categories" :key="category" :label="category.name" :value="category.id" />
                        </el-select>
                        <InputError :message="form.errors.category_id" />
                    </div>
                </div>
            </div>
            <div class="text-right pt-5 lg:mt-0">
                <PrimaryButton :disabled="form.processing" @click="update">Publicar</PrimaryButton>
            </div>
        </form>

        <!-- category form -->
        <DialogModal :show="showCategoryFormModal" @close="showCategoryFormModal = false">
            <template #title> Agregar categoría </template>
            <template #content>
                <form @submit.prevent="storeCategory">
                    <div>
                        <InputLabel value="Nombre*" class="ml-3 mb-1" />
                        <el-input v-model="categoryForm.name" placeholder="Escribe el nombre de la categoría" />
                        <InputError :message="categoryForm.errors.name" />
                    </div>
                </form>
            </template>
            <template #footer>
                <div class="flex items-center space-x-3">
                    <CancelButton @click="showCategoryFormModal = false" :disabled="categoryForm.processing">Cancelar</CancelButton>
                    <PrimaryButton @click="storeCategory()" :disabled="categoryForm.processing">Crear</PrimaryButton>
                </div>
            </template>
        </DialogModal>
    </AppLayout>
</template>

<script>
import InputFilePreview from '@/Components/MyComponents/InputFilePreview.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import CancelButton from "@/Components/MyComponents/CancelButton.vue";
import InputError from '@/Components/InputError.vue';
import InputLabel from "@/Components/InputLabel.vue";
import DialogModal from "@/Components/DialogModal.vue";
import AppLayout from '@/Layouts/AppLayout.vue';
import Back from "@/Components/MyComponents/Back.vue";
import { useForm } from '@inertiajs/vue3';

export default {
data() {
    const form = useForm({
        name: this.product.name,
        description: this.product.description,
        category_id: this.product.category_id,
        image_cover1: this.product.media[0],
        image_cover2: this.product.media[1],
        clearedCover1: false,
        clearedCover2: false,
    });

    const categoryForm = useForm({
      name: null,
    });
        
    return {
        form,
        categoryForm,
        currentImage: 1,
        showCategoryFormModal: false
    }
},
components:{
    InputFilePreview,
    PrimaryButton,
    CancelButton,
    DialogModal,
    InputError,
    InputLabel,
    AppLayout,
    Back,
},
props:{
    product: Object,
    categories: Array
},
methods:{
    update() {
        this.form.put(route("products.update"), {
            onSuccess: () => {
                this.$notify({
                    title: "Correcto",
                    message: "",
                    type: "success",
                });
            },
        });
    },
    storeCategory() {
        this.categoryForm.post(route("categories.store"), {
            onSuccess: () => {
                this.$notify({
                    title: "Correcto",
                    message: "",
                    type: "success",
                });
                this.showCategoryFormModal = false;
            },
        });
    },
    getMediaUrl(collectionName) {
        const media = this.product.media.find(img => img.collection_name === collectionName);
        return media ? media.original_url : null;
    },
}
}
</script>