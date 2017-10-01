<template>
  <div id="add-modal" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
          <div class="modal-content">
              <form method="post" :action="'/feedback/'+photo.url+'post'" @submit.prevent="submitFeedback()">
                  <div class="modal-header">
                      <h4 class="modal-title">Add Feedback</h4>
                  </div>
                  <div class="modal-body">
                      <textarea name="feedback" id="feedback-provided" cols="10" rows="5" class="form-control" v-model="feedback" placeholder="Enter feedback..." required minlength="2" maxlength="2000"></textarea>
                  </div>
                  <div class="modal-footer">
                      <button type="submit" class="btn btn-primary pull-right">Submit</button>
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                  </div>
              </form>
          </div>
    </div>
  </div>
</template>

<script>
export default {
    props: ['image'],
    data() {
        return { photo: this.image, feedback: null }
    },
    methods: {
        submitFeedback: function () {
            let vm = this
            let modal = $('#add-modal')
            let position = modal.data("comment-position")

            // Create HTTP POST payload
            let url = `/feedback/${this.photo.url}/comment`;
            let payload = {comment: this.feedback, left: position.left, top: position.top}

            axios.post(url, payload).then(response => {
                this.feedback = null
                modal.modal('hide')
                vm.photo.comments[modal.data('comment-index')] = response.data
                $(document).ready(() => $('[data-toggle="popover"]').popover())
            })
        }
    }
}
</script>

