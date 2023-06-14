<template>
    <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
        <template #field>
            <div class="medium licence-plate">
                <div class="flex items-center inset">
                    <div class="eu"></div>
                    <input
                        :id="field.name"
                        type="text"
                        class="w-full form-control form-input form-input-bordered"
                        :class="errorClasses"
                        maxlength="7"
                        v-model="formattedValue"
                        @input="updateValue"
                    />
                </div>
            </div>
        </template>
    </default-field>
</template>

<script>
import {FormField, HandlesValidationErrors} from 'laravel-nova';

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            value: '',
        };
    },

    computed: {
        formattedValue: {
            get() {
                return this.value;
            },
            set(newValue) {
                const formatted = newValue.toUpperCase().replace(/[^A-Z\d]/g, '').slice(0, 6);
                const firstThreeLetters = formatted.match(/[A-Z]{0,3}/)[0];
                const remainingChars = formatted.slice(firstThreeLetters.length);
                this.value = firstThreeLetters + (remainingChars ? ' ' + remainingChars.replace(/-/g, '') : '');
            },
        },
    },

    methods: {
        setInitialValue() {
            this.value = this.field.value || '';
        },

        fill(formData) {
            formData.append(this.field.attribute, this.value || '');
        },

        updateValue() {
            this.$emit('input', this.value);
        },
    },
};
</script>
