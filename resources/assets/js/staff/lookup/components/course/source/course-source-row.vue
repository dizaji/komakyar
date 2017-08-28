<template>
    <tr>
        <td>
            <span v-if="mode === 'show'">
                {{ course_source.reference_name }}
            </span>
            <input v-else=""
                   class="form-control input-sm"
                   placeholder="فیزیک 1 و آزمایشگاه"
                   v-model="editable_course_source.reference_name"/>
        </td>
        <td>
            <span v-if="mode === 'show'">
                {{ course_source.reference_code }}
            </span>
            <input v-else=""
                   class="form-control input-sm"
                   placeholder="134/98"
                   v-model="editable_course_source.reference_code"/>
        </td>
        <td>
            <edit-update-delete-buttons v-model="mode"
                                        v-on:update="btnUpdateClicked"
                                        v-on:delete="btnDeleteClicked"></edit-update-delete-buttons>
        </td>
    </tr>
</template>
<script>
    export default {
        props: ['course_source'],
        data: function () {
            return {
                editable_course_source: $.extend(true, {}, this.course_source),
                mode: 'show',
                errors: [],
            }
        },
        watch: {
            mode: function (newMode) {
                $.extend(true, this.editable_course_source, this.course_source);
            }
        },
        methods: {
            btnUpdateClicked: function () {
                this.$Progress.start();
                axios.put(route('staff.lookup.course.source.update', {source: this.course_source.id}), this.editable_course_source)
                    .then(this.onUpdateSuccess)
                    .catch(this.onUpdateError)
            },
            onUpdateSuccess: function (response) {
                this.errors = {};
                this.mode = 'show';
                $.extend(true, this.course_source, response.data);
                this.$Progress.finish();
            },
            onUpdateError(error) {
                this.$Progress.fail();
                if (error.response.status === 422) {
                    this.errors = error.response.data;
                } else {
                    alert("Oops, Something went wrong!!!");
                }
                console.log(error.response);
            },

            btnDeleteClicked: function () {
                this.$Progress.start();
                axios.delete(route('staff.lookup.course.source.destroy', {courseSource: this.course_source.id}))
                    .then(this.onDeleteSuccess)
                    .catch(this.onDeleteError);
            },
            onDeleteSuccess: function (response) {
                this.$Progress.finish();
                this.$emit('deleted');
            },
            onDeleteError: function (error) {
                this.$Progress.fail();
                alert("Oops, Something went wrong!!!");
                console.log(error.response);
            },
        }
    }
</script>
