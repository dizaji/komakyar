<template>
    <student-search-panel v-on:search="search"></student-search-panel>
</template>
<script>
    import StudentSearchPanel from '../../../student/components/student-search-panel';

    export default {
        components: {
            'student-search-panel': StudentSearchPanel
        },
        methods: {
            search: function (search) {
                this.$emit('search', search);
            }
        }
    }
</script>