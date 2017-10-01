<template>
    <!-- <div class="flex-center position-ref full-height"> -->
    <div>
        <div class="content">
            <div id="canvas">
                <div class="image-hotspot" id="imghotspot">
                    <transition-group name="hotspots">
                      <a
                        href="#"
                        class="hotspot-point"
                        v-for="(comment, index) in image.comments"
                        v-bind:style="{ left: comment.position.left+'%', top: comment.position.top+'%' }"
                        :key="index"
                        @click.prevent
                        data-placement="top"
                        data-toggle="popover"
                        :data-content="comment.comment"
                      >
                            <span>
                                <svg class="icon icon-close" viewBox="0 0 24 24">
                                    <path d="M18.984 12.984h-6v6h-1.969v-6h-6v-1.969h6v-6h1.969v6h6v1.969z"></path>
                                </svg>
                            </span>
                      </a>
                    </transition-group>
                    <img ref="img" :src="'/storage/'+image.image" id="loaded-img"  @click="addCommentPoint">
                </div>
            </div>
        </div>
        <add-comment-modal :image="image"></add-comment-modal>
    </div>
</template>

<script>
    let AddCommentModal   = require('./AddCommentModal.vue')

    export default {
        props: ['photo'],
        components: { AddCommentModal },
        data() {
            return { image: this.photo }
        },
        mounted() {
            let vm = this

            Echo.channel(`feedback-${this.photo.id}`)
                .listen('.added', (e) => {
                    // Look through the comments and if no comment matches the existing comments, add it
                    if (vm.image.comments.filter((comment) => comment.id === e.comment.id).length === 0) {
                        vm.image.comments.push(e.comment)
                        $(document).ready(() => $('[data-toggle="popover"]').popover())
                    }
                })
        },
        created() {
            /** Activate popovers */
            $(document).ready(() => $('[data-toggle="popover"]').popover());

            /** Calculates the coordinates of the click point */
            this.calculateClickCordinates = function (evt) {
                let rect = evt.target.getBoundingClientRect()
                return {
                    left: Math.floor((evt.clientX - rect.left - 7) * 100 / this.$refs.img.width),
                    top: Math.floor((evt.clientY - rect.top - 7) * 100 / this.$refs.img.height)
                }
            }

            /** Removes comments that have not been saved */
            this.removeUnsavedComments = function () {
                var i = this.image.comments.length
                while (i--) {
                    if ( ! this.image.comments[i]['id']) {
                        this.image.comments.splice(i, 1)
                    }
                }
            }
        },
        methods: {
            addCommentPoint: function(evt) {
                let vm       = this
                let position = vm.calculateClickCordinates(evt)
                let count    = this.image.comments.push({ position })

                // Show the modal and add a callback for when the modal is closed
                let modalElem = $("#add-modal")
                modalElem.data({"comment-index": count-1, "comment-position": position})
                modalElem.modal("show").on("hide.bs.modal", () => vm.removeUnsavedComments())
            }
        },
    }
</script>
