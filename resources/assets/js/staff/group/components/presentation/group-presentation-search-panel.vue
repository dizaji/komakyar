<template>
    <expandable-search>
        <template slot="less">
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="نام درس" v-model="search.title"/>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="نام منبع" v-model="search.reference_name"/>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="نام خانوادگی دبیر" v-model="search.surname"/>
                </div>
            </div>
        </template>
        <template slot="more">
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="نام دبیر" v-model="search.first_name"/>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="کد منبع" v-model="search.reference_code"/>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="ضریب" type="number" v-model="search.multiplier"/>
                </div>
            </div>
        </template>
        <button slot="buttons"
                class="btn btn-sm btn-link"
                type="button"
                v-on:click="refresh">
            <span class="glyphicon glyphicon-refresh"></span>
        </button>
    </expandable-search>
</template>
<script>
    export default {
        data: function () {
            return {
                mode: 'less',
                search: {
                    first_name: '',
                    surname: '',
                    title: '',
                    reference_name: '',
                    reference_code: '',
                    multiplier: '',
                }
            }
        },
        watch: {
            search: {
                handler: function (newSearch) {
                    this.emit();
                },
                deep: true
            }
        },
        methods: {
            emit: _.debounce(function () {
                    this.$emit('search', this.search);
                },
                500
            ),
            refresh: function () {
                let self = this;
                $.each(this.search, function (index, value) {
                    self.search[index] = '';
                });
            }
        }
    }
</script>