<template>
    <dropzone ref="dropzone" id="dropzone"
            url="/upload"
            accepted-file-types="image/*"
            v-on:vdropzone-success="showImagePage"
            :headers="csrfHeader"
            class="flex-center position-ref full-height">
        <input type="hidden" name="csrf-token" :value="csrfToken">
    </dropzone>
</template>

<script>
import Dropzone from 'vue2-dropzone';

const LARAVEL_TOKEN = document.head.querySelector('meta[name="csrf-token"]').content

export default {
    components: { Dropzone },
    data() {
        return {
            csrfToken: LARAVEL_TOKEN,
            csrfHeader: { 'X-CSRF-TOKEN': LARAVEL_TOKEN }
        }
    },
    methods: {
        showImagePage: (file, response) => {
            if (response.url) {
                return window.location = `/feedback/${response.url}`;
            }
        }
    },
    mounted () {
        this.$refs.dropzone.dropzone.on('addedfile', function (file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0])
            }
        })
    }
}
</script>
