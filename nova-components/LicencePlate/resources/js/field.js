Nova.booting((Vue, router, store) => {
  Vue.component('index-licence-plate', require('./components/IndexField'))
  Vue.component('detail-licence-plate', require('./components/DetailField'))
  Vue.component('form-licence-plate', require('./components/FormField'))
})
