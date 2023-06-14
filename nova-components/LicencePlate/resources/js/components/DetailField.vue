<template>
    <div class="medium licence-plate">
        <div class="flex items-center inset info">
            <div class="eu"></div>
            <div class="w-full">
                {{ field.value }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],
}
</script>
