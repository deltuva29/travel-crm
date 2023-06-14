<template>
    <div class="small licence-plate">
        <div class="flex items-center inset">
            <div class="eu"></div>
            <span class="mx-auto">{{ field.value }}</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
