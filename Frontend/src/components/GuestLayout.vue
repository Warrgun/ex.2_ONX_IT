<template >
    <div class="flex-grow-1 align-content-center overflow-hidden bg-success">
        <div class="row">
            <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-4 offset-lg-4 ">
                <slot></slot>
            </div>
        </div>
    </div>
</template>
<script setup>

</script>
<style scoped>
 .bg-success{
    background-color: #19AA8D !important;
 }
</style>