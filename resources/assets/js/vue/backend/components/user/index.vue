<template>
	<section class="content-header">
    <h1>{{ heading or 'Index' }} </h1>
    <ol class="breadcrumb">
        <li><a v-link="name:'index'"><i class="fa fa-dashboard"></i> Tổng quan</a></li>
        <li class="active">{{ heading or 'Index' }}</li>
    </ol>
</section>
</template>

<script>
	import Vuetable from 'vuetable/src/components/Vuetable.vue';
	import VuetablePagination from 'vuetable/src/components/VuetablePagination.vue';
	import VuetablePaginationDropdown  from 'vuetable/src/components/VuetablePaginationDropdown.vue';
	import VuetablePaginationBootstrap from 'vuetable/src/components/VuetablePaginationBootstrap.vue';
	export default {
		data: function () {
			return {
				heading: String,
			}
		}
	}
</script>