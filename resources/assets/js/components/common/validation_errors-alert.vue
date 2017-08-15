<template>
    <div class="row">
        <div class="col-xs-12" v-if="Object.keys(errors).length > 0 && show_errors">
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" v-on:click="btnCloseAlertClicked()"><span aria-hidden="true">&times;</span></button>
                <ul>
                    <li v-for="error in errors">
                        {{ error[0] }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['errors'],
        data: function() {
            return {
                show_errors: true,
            }
        },
        watch: {
            errors: function(new_errors) {
                this.show_errors = true;
                console.log("here");
            }
        },
        methods: {
            btnCloseAlertClicked() {
                this.show_errors = false;
            }
        }
    }
</script>
