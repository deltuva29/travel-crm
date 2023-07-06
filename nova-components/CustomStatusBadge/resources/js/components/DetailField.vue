<template>
    <div class="flex border-b border-40 -mx-6 px-6">
        <div class="w-1/4 py-4">
            <h4 class="font-normal text-80" v-text="paidLabel"></h4>
        </div>
        <div class="w-1/4 py-4">
            <span
                :class="statusClass"
                v-text="statusText"
            ></span>
        </div>
    </div>
</template>

<script>
import {colorClassMap, statusMap} from '../utils/statusMap';
import DEFAULTS from "../utils/constants";

export default {
    props: {
        resource: String,
        resourceName: String,
        resourceId: Number,
        field: {
            type: Object,
            default: () => ({
                paidType: DEFAULTS.STATUS
            }),
        }
    },
    computed: {
        paidName() {
            return this.field.name;
        },
        paidType() {
            return this.field.paidType;
        },
        paidLabel() {
            return this.paidName;
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
