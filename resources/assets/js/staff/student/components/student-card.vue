<template>
    <div>
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-6">
                        {{ student.user.first_name }} {{ student.user.surname }}
                    </div>
                    <div class="col-xs-6 text-left">
                        <a class="btn btn-sm btn-success" :href="url.show">
                            <span class="glyphicon glyphicon-eye-open"></span>
                        </a>
                        <!--<button class="btn btn-sm btn-danger" v-on:click="$refs.confirm_delete_modal.show()">
                            <span class="glyphicon glyphicon-trash"></span>
                        </button>
                        <confirm-delete-modal ref="confirm_delete_modal"
                                              v-on:confirm="btnDeleteClicked"></confirm-delete-modal>-->
                        <slot name="buttons"></slot>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="col-sm-3 col-xs-4 text-center">

                    <img style="max-width: 100%; max-height: 140px;"
                         :src="profile_picture"
                         class="img-circle">
                </div>
                <div class="form-horizontal col-sm-9 col-xs-6">
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">ایمیل</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">{{ student.user.email }}</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label"
                               data-toggle="tooltip"
                               data-placement="bottom"
                               title="شماره دانش آموزی">شماره د.آ</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">{{ student.student_code }}</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">کد ملی</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">{{ student.user.national_code }}</p>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-md-4 col-sm-3 col-xs-4 control-label">تلفن</label>
                        <div class="col-md-8 col-sm-9 col-xs-8">
                            <p class="form-control-static">{{ student.phone }}</p>
                        </div>
                    </div>
                    <div class="form-group hidden-sm hidden-xs">
                        <div class="col-md-2 col-sm-3 col-xs-4 control-label">آدرس</div>
                        <div class="col-md-10 col-sm-9 col-xs-8">
                            <p class="form-control-static">
                                {{ student.address }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {

        props: ['student'],

        data() {
            return {
            }
        },
        computed: {
            profile_picture: function () {
                if (this.student && this.student.user.profile_picture) {
                    if(window.isValidURL(this.student.user.profile_picture)) {
                        return this.student.user.profile_picture;
                    } else {
                        return window.default_values.storage_base_url + this.student.user.profile_picture;
                    }
                } else {
                    return window.default_values.defaults.dp;
                }
            },
            url: function () {
                return {
                    show: route('staff.student.show', {student: this.student.id}),
                };
            }
        },
        methods: {
            test: function () {
                console.log("mounted");
            }
        }
    }


</script>
