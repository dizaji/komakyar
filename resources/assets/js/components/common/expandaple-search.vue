<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="well">
                <div class="row">
                    <div class="col-xs-11">
                        <div class="row">
                            <slot name="less"></slot>
                        </div>
                        <div class="collapse row" ref="collapsable">
                            <slot name="more"></slot>
                        </div>
                    </div>
                    <div class="col-xs-1">
                        <button class="btn btn-sm btn-link"
                                type="button"
                                v-on:click="toggle">
                            <span class="glyphicon glyphicon-plus" v-if="mode === 'less'"></span>
                            <span class="glyphicon glyphicon-minus" v-else=""></span>
                        </button>
                        <slot name="buttons"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                mode: 'less',
            }
        },
        methods: {
            toggle: function () {
                this.mode = this.mode === 'less' ? 'more' : 'less';
                $(this.$refs.collapsable).collapse('toggle');
            }
        }
    }
</script>