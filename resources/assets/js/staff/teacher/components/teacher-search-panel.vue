<template>
    <expandable-search>
        <h1>search</h1>
        <template slot="less">
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="نام"  />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="نام خانوادگی" v-model="search.surname" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="کد ملی" v-model="search.national_code"/>
                </div>
            </div>
        </template>
        <template slot="more">
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="کد " v-model="search.user_id" />
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="ایمیل" v-model="search.email"/>
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
                    national_code: '',
                    user_id: '',
                    email: '',
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