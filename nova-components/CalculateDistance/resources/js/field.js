Nova.booting((Vue, router, store) => {
    Vue.component('index-calculate-distance', require('./components/IndexField'))
    Vue.component('calculate-distance', require('./components/DistanceField'))
    Vue.component('detail-calculate-distance', require('./components/DetailField'))
    Vue.component('form-calculate-distance', require('./components/FormField'))
})
