Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'nova-databoards',
      path: '/nova-databoards',
      component: require('./components/Tool'),
    },
  ])
})
