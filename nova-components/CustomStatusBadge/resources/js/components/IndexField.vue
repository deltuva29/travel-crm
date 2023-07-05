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
                status: DEFAULTS.STATUS,
            }),
        },
        meta: {
            type: Object,
            default: () => ({
                status: DEFAULTS.STATUS
            })
        }
    },
    mounted() {
        console.log(this.field.value);
    },
    computed: {
        statusText() {
            const status = this.field.status || this.meta.status;
            return statusMap[status] || status;
        },
        statusClass() {
            const status = this.field.status || this.meta.status;
            const statusClass = colorClassMap[status] || DEFAULTS.CLASS;
            return `${DEFAULTS.STYLE} ${statusClass}`;
        }
    }
}
</script>
