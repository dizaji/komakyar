<template>
    <p class="form-control-static">{{ degree }}</p>
</template>
<script>
    export default {
        props: ['value'],
        computed: {
            degree: function () {
                switch (this.value) {
                    case "below diploma":
                        return "زیر دیپلم";
                    case "diploma":
                        return "دیپلم";
                    case "above diploma":
                        return "فوق دیپلم";
                    case "bsc":
                        return "کارشناسی";
                    case "msc":
                        return "کارشناسی ارشد";
                    case "phd":
                        return "دکتری";
                    default:
                        return "موارد دیگر";
                }
            }
        },
    }
</script>