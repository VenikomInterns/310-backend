<template>
    <div>
        <!--This will result to raw json-->
        {{category}}
    </div>
</template>

<script>
export default {
    name: "Show",
    props: {
        category: Object,
    }
}
</script>

<style scoped>

</style>
