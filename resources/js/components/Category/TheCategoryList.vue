<template>
	<section>
		<div class="card">
			<div class="card-header d-flex justify-content-end">
				<button class="btn btn-warning" @click="openModal">Crear categoría</button>
			</div>
			<div class="card-body">
				<div class="table-responsive my-4 mx-2">
					<table class="table table-bordered" id="category_table">
						<thead>
							<tr>
								<th>Nombre</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr v-for="(category, index) in categories" :key="index">
								<td>{{ category.name }}</td>

								<td>
									<div class="d-flex justify-content-center" title="Editar">
										<button type="button" class="btn btn-warning btn-sm" @click="editCategory(category)">
											<i class="fas fa-pencil-alt"></i>
										</button>
										<button type="button" class="btn btn-danger btn-sm ms-2" title="Eliminar" @click="deletCategory(category)">
											<i class="fas fa-trash-alt"></i>
										</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div>
				<category-modal :category_data="category" ref="category_modal" />
			</div>
		</div>
	</section>
</template>

<script>
	import CategoryModal from './CategoryModal.vue'
	import { deleteMessage, successMessage } from '@/helpers/Alert.js'

	export default {
		//Se registra el componente para que ya se pueda usar
		components: {
			CategoryModal
		},
		props: ['categories'],
		data() {
			return {
				modal: null,
				category: {}
			}
		},
		mounted() {
			this.index()
		},
		methods: {
			async index() {
				$('#category_table').DataTable()
				const modal_id = document.getElementById('category_modal')
				this.modal = new bootstrap.Modal(modal_id)
				modal_id.addEventListener('hidden.bs.modal', e => {
					this.$refs.category_modal.reset()
				})
			},
			editCategory(category) {
				this.category = category
				this.openModal()
			},
			async deletCategory({ id }) {
				if (!(await deleteMessage())) return
				try {
					await axios.delete(`/categories/${id}`)
					await successMessage({ is_delete: true, reload: true })
				} catch (error) {
					console.error(error)
				}
			},
			openModal() {
				this.modal.show()
			}
		}
	}
</script>


