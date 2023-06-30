<template>
    <div>
        <div>
            <input v-model="origin" placeholder="Origin" @input="updateValue">
        </div>
        <div>
            <input v-model="destination" placeholder="Destination" @input="updateValue">
        </div>
        <div>
            <svg v-if="isLoading" class="preloader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                <circle class="preloader__circle" cx="50" cy="50" r="45"/>
            </svg>
            <span v-else-if="distance">{{ distance }}</span>
            <span v-else>-</span>
        </div>
        <div>
            <span v-if="!isLoading && duration">{{ duration }}</span>
            <span v-else-if="!isLoading">-</span>
        </div>
    </div>
</template>

<script>
export default {
    props: ['value'],

    data() {
        return {
            origin: this.value.origin || '',
            destination: this.value.destination || '',
            distance: '',
            duration: '',
            isLoading: false,
        };
    },

    watch: {
        value(newValue) {
            this.origin = newValue.origin || '';
            this.destination = newValue.destination || '';
        },
    },

    methods: {
        updateValue() {
            this.$emit('input', {
                origin: this.origin,
                destination: this.destination,
            });

            this.calculateDistance();
        },

        calculateDistance() {
            this.isLoading = true;

            axios
                .get('/api/calculate-distance', {
                    params: {
                        origin: this.origin,
                        destination: this.destination,
                    },
                })
                .then(({data}) => {
                    this.distance = data.distance;
                    this.duration = data.duration;
                })
                .catch(error => {
                    console.error(error);
                    this.distance = '';
                    this.duration = '';
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
    },
};
</script>
