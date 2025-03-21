<template>
  <div class="inline">
    <figure @click="triggerImageInput"
      class="flex items-center justify-center rounded-md border border-dashed border-gray-400 w-68 h-60 cursor-pointer relative">
      <button v-if="image && canDelete" @click.stop="clearImage" class="size-5 rounded-full bg-gray-300 absolute top-1 right-1 z-10 flex items-center justify-center">
        <i class="fa-solid fa-xmark text-xs text-red-600"></i>
      </button>
      <svg v-if="!image" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
        stroke="currentColor" class="w-6 h-6">
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M6.827 6.175A2.31 2.31 0 0 1 5.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 0 0-1.134-.175 2.31 2.31 0 0 1-1.64-1.055l-.822-1.316a2.192 2.192 0 0 0-1.736-1.039 48.774 48.774 0 0 0-5.232 0 2.192 2.192 0 0 0-1.736 1.039l-.821 1.316Z" />
        <path stroke-linecap="round" stroke-linejoin="round"
          d="M16.5 12.75a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0ZM18.75 10.5h.008v.008h-.008V10.5Z" />
      </svg>
      <img v-if="image" :src="image" :alt="alt" class="w-full h-full object-contain bg-no-repeat rounded-md opacity-50" />
      <input ref="fileInput" type="file" @change="handleImageUpload" class="hidden" />
    </figure>
    <InputError :message="fileSizeError" />
  </div>
</template>

<script>
import InputError from '../InputError.vue';

export default {
  data() {
    return {
      image: null,
      formData: {
        file: null,
      },
      fileSizeError: null,
    };
  },
  props: {
    alt: {
      type: String,
      default: "Vista previa no disponible",
    },
    canDelete: {
      type: Boolean,
      default: true,
    },
    imageUrl: {
      type: String,
      default: null,
    },
  },
  components: {
    InputError,
  },
  watch: {
    imageUrl: {
      immediate: true,
      handler(newImageUrl) {
        this.image = newImageUrl;
      },
    },
  },
  emits: ['imagen', 'cleared'],
  methods: {
    triggerImageInput() {
      this.$refs.fileInput.click();
    },
    handleImageUpload(event) {
      const file = event.target.files[0];
      this.formData.file = file;

      if (file) {
        const fileSize = file.size; // Tamaño en bytes
        const maxSize = 10 * 1024 * 1024; // 10 MB en bytes

        if (fileSize > maxSize) {
          this.fileSizeError = 'El archivo excede el tamaño máximo permitido (10 MB).';
        } else {
          this.fileSizeError = null;
          const imageURL = URL.createObjectURL(file);
          this.image = imageURL;
          // Emitir evento al componente padre con la imagen
          this.$emit("imagen", file);
        }
      }

    },
    clearImage() {
      this.image = null;
      this.formData.file = null;
      this.$emit("cleared");
    },
  },
};
</script>

