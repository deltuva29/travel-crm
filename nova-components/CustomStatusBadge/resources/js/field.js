Nova.booting((Vue, router, store) => {
  Vue.component('index-custom-status-badge', require('./components/IndexField'))
  Vue.component('detail-custom-status-badge', require('./components/DetailField'))
  Vue.component('form-custom-status-badge', require('./components/FormField'))
})
