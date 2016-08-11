var routes = {
  '/': {
    name: 'index',
    component: require('./components/index.vue')
  },
  'user': {
    name: 'user.index',
    component: require('./components/user/index.vue')
  },
  'user/create': {
    name: 'user.create',
    component: require('./components/user/create.vue')
  }
} 

export default {
  route: function (router) {
    router.map(routes);
  },
  routes : function () {
    return routes;
  }
}

