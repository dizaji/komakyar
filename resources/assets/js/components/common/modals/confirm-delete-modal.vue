<template>
    <div class="modal fade" ref="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <slot name="title">
                        <h4 class="modal-title text-right" id="myModalLabel">تایید حذف</h4>
                    </slot>
                </div>
                <div class="modal-body text-right">
                    <slot name="body">آیا برای حذف مطمئن هستید؟</slot>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-default" v-on:click="$emit('dismiss')" data-dismiss="modal">
                        <slot name="dismiss-button">لغو</slot>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger" v-on:click="$emit('confirm')" data-dismiss="modal">
                        <slot name="confirm-button">حذف</slot>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        methods: {
            show: function () {
                $(this.$refs.deleteModal).modal('show');
            },
            hide: function () {
                $(this.$refs.deleteModal).modal('hide');
            },
            toggle: function () {
                $(this.$refs.deleteModal).modal('toggle');
            }
        }
    }
</script>