<template>
	<section>
		<div class="card mx-5">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-primary mx-3" @click="openProduct">Añadir otro producto</button>
				<button class="btn btn-danger" @click="clearCart">Vaciar Carrito</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-4 mx-4">
					<table class="table table-bordered" id="product_table">
						<thead>
							<tr>
								<th>Imagen</th>
								<th>Producto</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Eliminar producto</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(product, index) in products" :key="index">
								<td><img :src="product.file.route"  style="width:40px; height:40px;"></td>
								<td>{{ product.title }}</td>
								<td>{{formatCurrency(product.totalPrice)}}</td>
								<td>{{ product.quantity}}</td>
								<td>
									<div class="d-flex justify-content-center" title="Editar">
										<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar" @click="deletProduct(product)">
											<i class="fas fa-trash-alt"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-footer">
				<div>
					<div class="d-inline">
						<h3 class="d-inline" style="max-width: content;">Total:</h3>
						<h4 class="d-inline mx-3">
							{{formatCurrency(totalCartValue)}}
						</h4>
					</div>
					<div class="col-md-8 mt-3">
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	import { deleteMessage, successMessage } from '@/helpers/Alert.js'
	export default {
		props: ['products'],

		data() {
			return {
				product: {}
			}
		},
		mounted() {
			this.index()
		},
		computed: {
			// se calcula el valor total del carrito.
			totalCartValue() {
				return this.products.reduce((total, product) => total + product.totalPrice, 0)
			},
			//formatea los numeros a tipo moneda
			formatCurrency() {
				return value => {
					if (typeof value !== 'number') {
						return value
					}
					return '$' + value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
				}
			}
		},
		methods: {
			async index() {
				$('#product_table').DataTable()
			},
			async deletProduct({ id }) {
				if (!(await deleteMessage())) return
				try {
					await axios.delete(`/cart/delete/${id}`)
					await successMessage({ is_delete: true, reload: true })
				} catch (error) {
					console.error(error)
				}
			},
			openProduct() {
				window.location.href = '/'
			},
			async clearCart() {
				if (!(await deleteMessage())) return
				try {
					await axios.delete(`/cart/clear`)
					await successMessage({ is_delete: true, reload: true })
				} catch (error) {
					console.error(error)
				}
			}
		}
	}
</script>
