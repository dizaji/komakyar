<template>
    <div>
        <template v-if="mode === 'show'">
            <button class="btn btn-sm btn-primary" v-on:click="toggle">
                <span class="glyphicon glyphicon-pencil"></span>
            </button>
            <button class="btn btn-sm btn-danger" v-on:click="$refs.confirm_delete_modal.show()">
                <span class="glyphicon glyphicon-trash"></span>
            </button>
            <confirm-delete-modal ref="confirm_delete_modal"
                                  v-on:confirm="btnDeleteClicked">
            </confirm-delete-modal>
        </template>
        <template v-else="">
            <button class="btn btn-sm btn-success" v-on:click="btnUpdateClicked">
                <span class="glyphicon glyphicon-ok"></span>
            </button>
            <button class="btn btn-sm btn-default" v-on:click="toggle">
                <span class="glyphicon glyphicon-remove"></span>
            </button>
        </template>
    </div>
</template>
<script>
    export default {
        props: {
            value: {
                default: 'show',
            },
        },
        data: function () {
            return {
                mode: 'show'
            }
        },
        watch: {
            mode: function (newMode) {
                this.$emit('input', newMode);
            },
            value: function (newValue) {
                this.mode = newValue;
            }
        },
        methods: {
            btnUpdateClicked: function () {
                this.$emit('update')
            },
            btnDeleteClicked: function () {
                this.$emit('delete')
            },
            toggle: function () {
                this.$emit('toggle');
                if (this.mode === 'show') {
                    this.edit();
                } else {
                    this.show();
                }
            },
            edit: function () {
                this.$emit('edit');
                this.mode = 'edit'
            },
            show: function () {
                this.$emit('show');
                this.mode = 'show'
            }
        }
    }
</script>