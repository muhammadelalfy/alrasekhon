<template>
  <div class="change-img mb-3" :class="width">
    <img v-if="src" :src="src" alt="form image" class="w-100 h-100" />
    <div v-else class="cam p-2">
      <font-awesome-icon icon="fa-solid fa-cloud-arrow-up" />
      <div class="text-grayClr fs-13 mt-2">
        {{ $t("pages.maximum_size") }} {{ size }} {{ $t("pages.mega") }}
      </div>
    </div>
    <input
      class="file-upload"
      type="file"
      accept=".jpg, .jpeg, .png"
      @change="uploadImage($event)"
    />
  </div>
  <div v-if="errors.length > 0">
    <div
      v-for="(error, index) in errors"
      :key="index"
      class="file-upload__error invalid-feedback mb-3"
    >
      <span>{{ error }}</span>
    </div>
  </div>
</template>
<script>
import { reactive, ref } from "vue";
import { useI18n } from "vue-i18n";
export default {
  name: "ImageUploader",
  props: {
    src: String,
    size: {
      type: Number,
      default: 5,
      required: true,
    },
    accept: {
      type: String,
      default: "image/*",
    },
    width: {
      type: String,
      default: "",
    },
  },
  emits: ["file-uploaded"],
  setup(props, ctx) {
    const { t } = useI18n();
    const errors = ref([]);
    const myFile = reactive({
      name: "",
      size: 0,
      type: "",
      fileExtention: "",
      url: "",
      isImage: false,
      isUploaded: false,
    });
    function uploadImage(e) {
      errors.value = [];
      if (e.target.files && e.target.files[0]) {
        // Check if file is valid
        if (isFileValid(e.target.files[0])) {
          const file = e.target.files[0],
            // Get file size
            fileSize = Math.round((file.size / 1024 / 1024) * 100) / 100,
            // Get file extension
            fileExtention = file.name.split(".").pop(),
            // Get file name
            fileName = file.name.split(".").shift(),
            // Check if file is an image
            isImage = ["jpg", "jpeg", "png", "gif"].includes(fileExtention);
          // Print to console
          console.log(fileSize, fileExtention, fileName, isImage);
          const reader = new FileReader();
          if (file) {
            reader.readAsDataURL(file);
            reader.onload = () => {
              file.previewBase64 = reader.result;
              this.myFile = {
                name: fileName,
                size: fileSize,
                type: file.type,
                fileExtention: fileExtention,
                isImage: isImage,
                url: reader.result,
                isUploaded: true,
              };
              ctx.emit("file-uploaded", file);
            };
            reader.onerror = (error) => {
              console.log("Error ", error);
            };
          }
        }
      }
    }

    function isFileSizeValid(fileSize) {
      if (fileSize <= props.size) {
        console.log("File size is valid");
      } else {
        console.log(`File size should be less than ${props.size} MB`);
        errors.value.push(` ${t("pages.maximum_size")} ${props.size} MB`);
      }
    }
    function isFileTypeValid(fileExtention) {
      if (props.accept.split(",").includes(fileExtention)) {
        console.log("File type is valid");
      } else {
        console.log(`File type should be ${props.accept}`);
        errors.value.push(` ${t("pages.file_type")} ${props.accept}`);
        console.log("errors", errors);
      }
    }
    function isFileValid(file) {
      isFileSizeValid(Math.round((file.size / 1024 / 1024) * 100) / 100);
      isFileTypeValid(file.name.split(".").pop());
      if (errors.value.length === 0) {
        return true;
      } else {
        return false;
      }
    }

    return {
      t,
      uploadImage,
      myFile,
      errors,
      isFileTypeValid,
      isFileSizeValid,
    };
  },
};
</script>
