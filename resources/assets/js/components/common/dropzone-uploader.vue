<template>
    <dropzone id="myVueDropzone"
              ref="dropzone_1"
              :url="url"
              v-on:vdropzone-success="uploadSuccess"
              v-on:vdropzone-error="uploadError"
              v-on:vdropzone-file-added="addedFile"
              :use-font-awesome="true"
              :accepted-file-types="acceptedFileTypes"
              :language="customOptionsObject"
              :thumbnail-height="thumbnailHeight"
              :thumbnail-width="thumbnailWidth">
        <input type="hidden" name="_token" :value="csrf_token">
    </dropzone>
</template>
<script>
    import Dropzone from 'vue2-dropzone';
    export default {
        props: {
            defaultMessage: {
                type: String,
                default: "برای آپلود، فایل را اینجا بکشید یا کلیک کنید"
            },
            url: {
                type: String,
            },
            acceptedFileTypes: { // 'image/*,application/pdf,.psd'
                type: String,
                default: 'image/*'
            },
            thumbnailHeight: {
                default: 40,
            },
            thumbnailWidth: {
                defualt: 40,
            }
        },
        components: {
            Dropzone,
        },
        data: function () {
            return {
                csrf_token: document.head.querySelector('meta[name="csrf-token"]').content,
                customOptionsObject: {
                    dictDefaultMessage: this.defaultMessage,
                },
            };
        },
        methods: {
            addedFile: function (file) {
                this.$Progress.start();
                this.$emit('added-file', file);
            },
            uploadSuccess: function (file, response) {
                this.$Progress.finish();
                this.$emit('upload-success', file, response);
                this.removeFiles();
            },
            uploadError: function(file) {
                this.$Progress.fail();
                this.$emit('upload-error', file);
                this.removeFiles();
            },
            removeFiles: function(){
                this.$refs.dropzone_1.removeAllFiles();
            }
        }
    }
</script>