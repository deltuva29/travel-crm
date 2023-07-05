<template>
    <span :class="statusClass">
        {{ statusText }}
    </span>
</template>

<script>
import {colorClassMap, statusMap} from '../utils/statusMap';
import DEFAULTS from "../utils/constants";

export default {
    props: {
        resourceName: String,
        field: {
            type: Object,
            default: () => ({
                attribute: 'first_name',
                value: DEFAULTS.STATUS
            }),
        }
    },
    mounted() {
        console.log(this.field.value);
    },
    computed: {
        statusText() {
            const status = this.field.value;
            return statusMap[status] || status;
        },
        statusClass() {
            const status = this.field.value;
            const statusClass = colorClassMap[status] || DEFAULTS.CLASS;
            return `${DEFAULTS.STYLE} ${statusClass}`;
        }
    }
}
</script>
