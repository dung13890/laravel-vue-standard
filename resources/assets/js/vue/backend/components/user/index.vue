<template>
<section class="content-header">
    <h1>{{ heading }} </h1>
    <ol class="breadcrumb">
        <li><a v-link="{name:'index'}"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
        <li class="active">{{ heading }}</li>
    </ol>
</section>
<div class="content animated fadeInUp">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="pull-left">
                    </div>

                    <div class="pull-right">
                        <a v-on:click="create" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Create</a>
                    </div>
                </div>
                <div class="box-body">
                	<div class="row">
                		<div class="col-sm-6">
                			<div class="form-inline form-group">
			                    <input v-model="searchFor" class="form-control" @keyup.enter="setFilter" placeholder="Search...">
			                    <button class="btn btn-primary" @click="setFilter"><i class="fa fa-search"></i></button>
			                    <button class="btn btn-default" @click="resetFilter"><i class="fa fa-refresh"></i></button>
			                </div>
                		</div>
                		<div class="col-sm-6">
                			<div class="form-inline form-group pull-right">
	                			<select class="form-control" v-model="perPage">
			                        <option value=10>10</option>
			                        <option value=15>15</option>
			                        <option value=20>20</option>
			                        <option value=25>25</option>
			                    </select>
	                			<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
			                        <i class="glyphicon glyphicon-cog"></i>
			                    </button>
			                    <ul class="dropdown-menu">
			                        <li v-for="field in fields">
			                            <span class="checkbox">
			                                <label>
			                                    <input type="checkbox" v-model="field.visible">
			                                    {{ field.title == '' ? field.name.replace('__', '') : field.title | capitalize }}
			                                </label>
			                            </span>
			                        </li>
			                    </ul>
                			</div>
                		</div>
                	</div>
                    <div class="table-responsive">
                        <vuetable
			                :api-url="routeApi"
			                pagination-path=""
			                :fields="fields"
			                :sort-order="sortOrder"
			                table-class="table table-bordered table-striped table-hover"
			                ascending-icon="glyphicon glyphicon-chevron-up"
			                descending-icon="glyphicon glyphicon-chevron-down"
			                pagination-class=""
			                pagination-info-class=""
			                pagination-component-class=""
			                :pagination-component="paginationComponent"
			                :item-actions="itemActions"
			                :append-params="moreParams"
			                loading-class="loading"
			        	></vuetable>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<modal-create :item="item"></modal-create>
</template>

<script>
	import Vuetable from 'vuetable/src/components/Vuetable.vue';
    import VuetablePagination from 'vuetable/src/components/VuetablePagination.vue';
	import ModalCreate from './create.vue';
	export default {
		data: function () {
			return {
				users: [],
				heading: 'danh sach',
				searchFor: '',
				routeApi: window.laroute.route('api.v1.user.index'),
                item: {},
				fields: [
					{
						name: 'name',
						sortField: 'name',
					},
					{
						name: 'email',
						sortField: 'email',
					},
					{
						name: 'locked',
						sortField: 'locked',
					},
					{
						name: '__actions',
						dataClass: 'text-center',
					},
				],
				itemActions: [
                    { name: 'edit-item', label: '', icon: 'fa fa-pencil', class: 'btn btn-default btn-xs' },
                    { name: 'delete-item', label: '', icon: 'fa fa-times', class: 'btn btn-danger btn-xs handle-delete' }
				],
				moreParams: [],
				perPage: 10,
				paginationComponent: 'vuetable-pagination',
			}
		},
		methods: {
			index: function () {
				var self = this;
				this.$parent.ProductService.index().then((users) => {
					self.users = users.data;
				});
			},
            create: function () {
                $('#create-user').modal('show');
            },
			setFilter: function() {
                this.moreParams = [
                    'filter=' + this.searchFor
                ]
                this.$nextTick(function() {
                    this.$broadcast('vuetable:refresh')
                })
            },
            resetFilter: function() {
                this.searchFor = ''
                this.setFilter()
            }
		},
		watch: {
            'perPage': function(val, oldVal) {
                this.$broadcast('vuetable:refresh')
            }
        },
		events: {
			'vuetable:action': function(action, data) {
                console.log('vuetable:action', action, data)
                if (action == 'view-item') {
                    sweetAlert(action, data.id)
                } else if (action == 'edit-item') {
                    this.item = data;
                    this.create();
                } else if (action == 'delete-item') {
                    sweetAlert(action, data.name)
                }
            },
		},
		route: {
			data: function (transition) {
				//this.index();
			}
		},
		components: { Vuetable, ModalCreate}
	}
</script>