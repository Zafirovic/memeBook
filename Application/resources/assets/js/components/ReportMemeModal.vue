<template>
    <modal title="Fade/Zoom Modal" effect="fade/zoom"
         :value="show" @ok="okAction" @cancel="cancelAction">
         <!-- custom header -->
        <div slot="modal-header" class="modal-header">
            <h4 class="modal-title">
            <i>Custom</i> <code>Modal</code> <b>Title</b>
            </h4>
        </div>
        <!-- custom buttons -->
        <div slot="modal-footer" class="modal-footer">
            <button type="button" class="btn btn-default" @click="show = false">Exit</button>
            <button type="button" class="btn btn-success" @click="saveMethod">Custom Save</button>
            <button type="button" class="btn btn-success" @click="otherMethod">Another Action</button>
        </div>
    </modal>
</template>

<script>
import { modal } from 'vue-strap'

export default {
    components: {
        modal
    },
}
</script>
