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
                paidType: DEFAULTS.STATUS
            }),
        }
    },
    computed: {
        paidType() {
            return this.field.paidType;
        },
        statusText() {
            return statusMap[this.paidType] || this.paidType;
        },
        statusClass() {
            const statusClass = colorClassMap[this.paidType] || DEFAULTS.CLASS;
            return `${DEFAULTS.STYLE} ${statusClass}`;
        }
    }
}
</script>
