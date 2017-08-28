<template>
    <div>
        <button class="btn btn-sm btn-success"
                data-toggle="tooltip"
                data-placement="bottom"
                title="افزودن گروه"
                v-on:click="showModal">
            <span class="glyphicon glyphicon-plus"></span>
        </button>
        <div class="modal fade"
             ref="create_group_modal"
             tabindex="-1"
             role="dialog"
             aria-labelledby="create-student-title">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title text-right" id="create-student-title">افزودن منبع درسی</h4>
                    </div>
                    <div class="modal-body">
                        <validation-errors-alert :errors="errors"></validation-errors-alert>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="input-name" class="col-sm-2 col-md-4 control-label">نام منبع</label>
                                <div class="col-sm-10 col-md-8">
                                    <input class="form-control"
                                           id="input-name"
                                           placeholder="فیزیک 1 و آزمایشگاه"
                                           v-model="course_source.reference_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-code" class="col-sm-2 col-md-4 control-label">کد منبع</label>
                                <div class="col-sm-10 col-md-8">
                                    <input class="form-control"
                                           id="input-code"
                                           placeholder="134/98"
                                           v-model="course_source.reference_code">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" v-on:click="btnSaveClicked()">ذخیره</button>
                        <button class="btn btn-default" data-dismiss="modal">انصراف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

    export default {
        data() {
            return {
                course_source: {
                    reference_name: null,
                    reference_code: null,
                },
                errors: {},
            }
        },
        methods: {
            btnSaveClicked: function () {
                this.$Progress.start();
                this.errors = {};
                axios.post(route('staff.lookup.course.source.store'), removeNulls(this.course_source, true))
                    .then(this.onStoreSuccess)
                    .catch(this.onLoadError);
            },
            onStoreSuccess: function (response) {
                this.$emit('created', response.data);
                this.reset();
                this.hideModal();
                this.$Progress.finish();
            },
            onLoadError: function (error) {
                this.$Progress.fail();
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            },
            showModal: function () {
                $(this.$refs.create_group_modal).modal('show');
            },
            hideModal: function () {
                $(this.$refs.create_group_modal).modal('hide');
            },
            reset: function () {
                $.extend(true, this.course_source, {
                    reference_name: null,
                    reference_code: null,
                });
            }
        }
    }
</script>
