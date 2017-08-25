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
                        <h4 class="modal-title text-right" id="create-student-title">افزودن گروه</h4>
                    </div>
                    <div class="modal-body">
                        <validation-errors-alert :errors="errors"></validation-errors-alert>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="input-name" class="col-sm-2 col-md-4 control-label">نام گروه</label>
                                <div class="col-sm-10 col-md-8">
                                    <input class="form-control"
                                           id="input-name"
                                           placeholder="گروه 101"
                                           v-model="group.title">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-level-field" class="col-sm-2 col-md-4 control-label">رشته / پایه</label>
                                <div class="col-sm-10 col-md-8">
                                    <select class="form-control"
                                            v-model="group.level_field_id"
                                            id="input-level-field">
                                        <option v-for="level_field in level_fields" :value="level_field.id">
                                            {{ level_field.level.title }} - {{ level_field.field.title }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="input-academic-year" class="col-sm-2 col-md-4 control-label">سال تحصیلی</label>
                                <div class="col-sm-10 col-md-8">
                                    <select class="form-control"
                                            v-model="group.academic_year_id"
                                            id="input-academic-year">
                                        <option v-for="academic_year in academic_years" :value="academic_year.id">
                                            {{ academic_year.title }}
                                        </option>
                                    </select>
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
    import AcademicYear from '../../../mixins/lookups/academic-years.vue';
    import LevelField from '../../../mixins/lookups/level-fields.vue';

    export default {
        data() {
            return {
                group: {
                    title: null,
                    level_field_id: null,
                    academic_year_id: null,
                },
                errors: {},
            }
        },
        mixins: [AcademicYear, LevelField],
        methods: {
            btnSaveClicked: function () {
                this.$Progress.start();
                this.errors = {};
                axios.post(route('staff.group.store'), removeNulls(this.group, true))
                    .then(this.onStoreSuccess)
                    .catch(this.onLoadError);
            },
            onStoreSuccess: function (response) {
                console.log('success');
                console.log(response);
                //window.location.href = route('staff.student.show', {group: response.data.id});
                this.$emit('created', response.data);
                this.hideModal();
                this.$Progress.finish();
            },
            onLoadError: function(error) {
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
            }
        }
    }
</script>
