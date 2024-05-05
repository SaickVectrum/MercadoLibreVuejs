<template>
	<div class="container">
		<div class="row">
			<div v-for="product in products" :key="product.id" class="col-lg-3 col-md-4 col-sm-6 mb-4">
				<div class="card h-100">
					<a :href="getProductLink(product.id)" class="m-2"><img :src="product.file.route" class="card-img-top rounded" alt="Portada producto"></a>
					<div class="card-body">
						<h5 class="card-title">{{ product.title }}</h5>
						<p class="card-text">{{ formatCurrency(product.price) }}</p>
					</div>
				</div>
			</div>
		</div>
	</div>

</template>

<script>
	export default {
		props: ['products'],

		data() {
			return {
				product: {}
			}
		},
		methods: {
			getProductLink(productId) {
				return `/products/product/${productId}`
			}
		},
		computed: {
			formatCurrency() {
				return value => {
					if (typeof value !== 'number') {
						return value
					}
					return '$' + value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
				}
			}
		}

	}
</script>

