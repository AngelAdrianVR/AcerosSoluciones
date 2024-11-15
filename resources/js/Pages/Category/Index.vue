<template>
    <AppLayout title="Categorías">
        <template #header>
            <div class="flex justify-between">
                <div class="flex items-center space-x-4">
                    <Back />
                    <h2 class="font-semibold text-xl leading-tight">Categorías</h2>
                </div>
                <div>
                    <PrimaryButton @click="editFlag = false; showModal = true;">Nueva categoría</PrimaryButton>
                </div>
            </div>
        </template>

        <!-- tabla -->
        <div class="lg:w-5/6 mx-auto mt-6">
            <div class="flex justify-between">
                <!-- pagination -->
                <div>
                    <el-pagination @current-change="handlePagination" layout="prev, pager, next"
                        :total="categories.length" />
                </div>

                <!-- buttons -->
                <div>
                    <el-popconfirm confirm-button-text="Si" cancel-button-text="No" icon-color="#0355B5"
                        title="¿Continuar?" @confirm="deleteSelections">
                        <template #reference>
                            <el-button type="danger" plain class="mb-3"
                                :disabled="disableMassiveActions">Eliminar</el-button>
                        </template>
                    </el-popconfirm>
                </div>
            </div>
            <el-table :data="filteredTableData" max-height="450" style="width: 100%"
                @selection-change="handleSelectionChange" ref="multipleTableRef" :row-class-name="tableRowClassName">
                <el-table-column type="selection" width="45" />
                <el-table-column prop="name" label="Categorías" width="150" />
                    <el-table-column align="right">
                        <!-- Usar scope para acceder a los datos de la fila -->
                        <template #default="scope">
                            <button 
                                @click="handleRowEdit(scope.row)" 
                                class="size-7 rounded-full"
                            >
                                <svg 
                                xmlns="http://www.w3.org/2000/svg" 
                                fill="none" 
                                viewBox="0 0 24 24" 
                                stroke-width="1.5" 
                                stroke="currentColor" 
                                class="size-4 mr-2"
                                >
                                <path 
                                    stroke-linecap="round" 
                                    stroke-linejoin="round" 
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" 
                                />
                                </svg>
                            </button>
                        </template>
                    </el-table-column>
                </el-table>
        </div>
        <!-- tabla -->

        <!-- -------------- Modal starts----------------------- -->
        <DialogModal :show="showModal" @close="showModal = false">
            <template #title>
                <p v-if="editFlag">Editar categría "{{ itemClicked.name }}"</p>
                <p v-else>Crear categría</p>
            </template>
            <template #content>
                <form @submit.prevent="editFlag ? update() : store()">
                    <div>
                        <InputLabel value="Nombre*" class="ml-3 mb-1" />
                        <el-input v-model="form.name" placeholder="Escribe el nombre de la categoría" />
                        <InputError :message="form.errors.name" />
                    </div>
                </form>
            </template>
            <template #footer>
                <div class="flex items-center space-x-3">
                    <CancelButton @click="showModal = false; form.reset(); editFlag = false;" :disabled="form.processing">
                        Cancelar
                    </CancelButton>

                    <PrimaryButton @click="editFlag ? update() : store()" :disabled="form.processing">
                        {{ editFlag ? 'Actualizar' : 'Crear' }}
                    </PrimaryButton>
                </div>
            </template>
        </DialogModal>
        <!-- --------------------------- Modal ends ------------------------------------ -->

    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import CancelButton from "@/Components/MyComponents/CancelButton.vue";
import DialogModal from "@/Components/DialogModal.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import Back from "@/Components/MyComponents/Back.vue";
import { useForm } from "@inertiajs/vue3";
import axios from 'axios';

export default {
data() {
    const form = useForm({
        name: null,
    });

    return {
        form,

        //table
        disableMassiveActions: true,
        search: '',

        // pagination
        itemsPerPage: 10,
        start: 0,
        end: 10,

        //general
        showModal: false,
        editFlag: false,
        itemClicked: null,
    }
},
components:{
    SecondaryButton,
    PrimaryButton,
    CancelButton,
    DialogModal,
    InputLabel,
    InputError,
    AppLayout,
    Back,
},
props:{
    categories: Object
},
methods:{
    update() {
        this.form.put(route('categories.update', this.itemClicked), {
            onSuccess: () => {
                this.$notify({
                    title: 'Correcto',
                    message: '',
                    type: 'success'
                });
                this.form.reset();
                this.showModal = false;
            }
        });
    },
    store() {
        this.form.post(route('categories.store'), {
            onSuccess: () => {
                this.$notify({
                    title: 'Correcto',
                    message: '',
                    type: 'success'
                });
                this.form.reset();
                this.showModal = false;
            }
        });
    },
    handleSelectionChange(val) {
        this.$refs.multipleTableRef.value = val;

        if (!this.$refs.multipleTableRef.value.length) {
            this.disableMassiveActions = true;
        } else {
            this.disableMassiveActions = false;
        }
    },
    handlePagination(val) {
        this.start = (val - 1) * this.itemsPerPage;
        this.end = val * this.itemsPerPage;
    },
    async deleteSelections() {
        try {
            const response = await axios.post(route('categories.massive-delete', {
                categories: this.$refs.multipleTableRef.value
            }));

            if (response.status == 200) {
                this.$notify({
                    title: 'Éxito',
                    message: response.data.message,
                    type: 'success'
                });

                // update list of quotes
                let deletedIndexes = [];
                this.categories.forEach((bonus, index) => {
                    if (this.$refs.multipleTableRef.value.includes(bonus)) {
                        deletedIndexes.push(index);
                    }
                });

                // Ordenar los índices de forma descendente para evitar problemas de desplazamiento al eliminar elementos
                deletedIndexes.sort((a, b) => b - a);

                // Eliminar cotizaciones por índice
                for (const index of deletedIndexes) {
                    this.categories.splice(index, 1);
                }

            } else {
                this.$notify({
                    title: 'Algo salió mal',
                    message: response.data.message,
                    type: 'error'
                });
            }

        } catch (err) {
            this.$notify({
                title: 'Algo salió mal',
                message: err.message,
                type: 'error'
            });
            console.log(err);
        }
    },
    tableRowClassName({ row, rowIndex }) {
        let classes = 'cursor-default';

        return classes;
    },
    handleRowEdit(row) {
        console.log(row);
        this.itemClicked = row;
        this.editFlag = true;
        this.showModal = true;

        this.form.name = row.name;
    },
},
computed: {
    filteredTableData() {
        if (!this.search) {
            return this.categories.filter((item, index) => index >= this.start && index < this.end);
        } else {
            return this.categories.filter(
                (bonus) =>
                    bonus.name.toLowerCase().includes(this.search.toLowerCase())
            )
        }
    }
},
}
</script>